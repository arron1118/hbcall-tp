<?php

namespace app\common\event;

use think\facade\Config;
use think\facade\Log;
use think\facade\Session;
use Yansongda\Artful\Exception\InvalidConfigException;
use Yansongda\Artful\Exception\Exception;
use Yansongda\Artful\Exception\InvalidParamsException;
use Yansongda\Artful\Exception\InvalidResponseException;
use Yansongda\Pay\Pay;

class Payment
{
    public function handle()
    {
        $where = ['status' => 0];
        $cid = Session::get('company.id');
        if ($cid) {
            $where['company_id'] = $cid;
        }

        $notpay = \app\common\model\Payment::where($where)->select();
        foreach ($notpay as $key => $value) {
            try {
                if ($value->pay_type === 1) {
                    // 检查微信订单是否已支付
                    Pay::config(Config::get('payment'));
                    $data = Pay::wechat()->query([
                        'out_trade_no' => $value->payno,
                        '_action' => 'native', // 查询扫码支付订单
                    ]);
                    Log::info('微信订单：' . json_encode($data));

                    switch ($data->trade_state) {
                        case 'SUCCESS': // 支付成功
                            $mt = mktime(
                                substr($data->success_time, 11, 2),
                                substr($data->success_time, 14, 2),
                                substr($data->success_time, 17, 2),
                                substr($data->success_time, 5, 2),
                                substr($data->success_time, 8, 2),
                                substr($data->success_time, 0, 4)
                            );
                            $value->pay_time = $mt;
                            $value->payment_no = $data->transaction_id;
                            $value->status = 1;
                            $value->save();
                            break;

                        case 'CLOSED':  // 已关闭
                            $value->status = 2;
                            $value->save();
                            break;

                        case 'REFUND':  // 转入退款
                        case 'REVOKED': // 已撤销（仅付款码支付会返回）
                        case 'USERPAYING':  // 用户支付中（仅付款码支付会返回）
                        case 'PAYERROR':    // 支付失败（仅付款码支付会返回）
                            // TODO
                            break;

                        default:
                            // NOTPAY 未支付
                            // TODO
                            break;
                    }
                } elseif ($value->pay_type === 2) {
                    // 检查支付宝订单是否已支付
                    $data = Pay::alipay(Config::get('payment'))
                        ->query(['out_trade_no' => $value->payno, '_config' => 'web']);
                    Log::info('支付宝订单：' . json_encode($data));

                    if ((int)$data->code === 40004 && $data->sub_code === 'ACQ.TRADE_NOT_EXIST') {
                        // 订单不存在
                        $value->status = 2;
                        $value->comment = $data->sub_msg;
                        $value->save();
                    } else {
                        switch ($data->trade_status) {
                            case 'TRADE_SUCCESS':   // 交易支付成功
                            case 'TRADE_FINISHED':  // 交易结束，不可退款
                                $value->pay_time = strtotime($data->send_pay_date);
                                $value->payment_no = $data->trade_no;
                                $value->status = 1;
                                $value->save();
                                break;

                            case 'TRADE_CLOSED':  // 未付款交易超时关闭，或支付完成后全额退款
                                $value->payment_no = $data->trade_no;
                                $value->status = 2;
                                $value->comment = '订单已关闭';
                                $value->save();
                                break;

                            default:
                                // WAIT_BUYER_PAY 交易创建，等待买家付款
                                // TODO
                                break;
                        }
                    }
                }
            }
            catch (InvalidConfigException $e){
                // 配置异常
                Log::error('[' . $e->getCode() . '] ' . $e->getMessage());
            }
            catch (InvalidParamsException $e) {
                // 参数异常
                Log::error('[' . $e->getCode() . '] ' . $e->getMessage());
            }
            catch (InvalidResponseException $e) {
                // 返回异常
                Log::error('[' . $e->getCode() . '] ' . $e->getMessage());
            }
            catch (Exception $e) {
                // 订单异常
                Log::error('[' . $e->getCode() . '] ' . $e->getMessage());
                Log::debug('订单异常raw：' . $e->getTraceAsString());
            }
        }
    }
}

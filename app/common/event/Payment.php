<?php

namespace app\common\event;

use think\facade\Config;
use think\facade\Log;
use think\facade\Session;
use Yansongda\Pay\Exception\Exception;
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
            if ($value->pay_type === 1) {
                try {
                    // 检查微信订单是否已支付
                    $data = Pay::wechat(Config::get('payment'))
                        ->query([
                            'out_trade_no' => $value->payno,
                            '_action' => 'native', // 查询扫码支付订单
                        ]);
                    Log::info('微信订单：' . json_encode($data));
                    if ($data->trade_state === 'SUCCESS') {
                        $mt = mktime(
                            substr($data->success_time, 8, 2),
                            substr($data->success_time, 10, 2),
                            substr($data->success_time, 12, 2),
                            substr($data->success_time, 4, 2),
                            substr($data->success_time, 6, 2),
                            substr($data->success_time, 0, 4)
                        );
                        $value->pay_time = $mt;
                        $value->payment_no = $data->transaction_id;
                        $value->status = 1;
                        $value->save();
                    } elseif ($data->trade_state === 'CLOSED') {
                        $value->status = 2;
                        $value->save();
                    }
                } catch (Exception $e) {
                    Log::error('微信订单异常：' . json_encode($e));
                }
            } elseif ($value->pay_type === 2) {
                // 检查支付宝订单是否已支付
                try {
                    $data = Pay::alipay(Config::get('payment'))
                        ->query(['out_trade_no' => $value->payno]);
                    Log::info('支付宝订单：' . json_encode($data));
                    if ($data->trade_status === 'TRADE_SUCCESS') {
                        $value->pay_time = strtotime($data->send_pay_date);
                        $value->payment_no = $data->trade_no;
                        $value->status = 1;
                        $value->save();
                    } elseif ($data->trade_status === 'TRADE_CLOSED') {
                        $value->payment_no = $data->trade_no;
                        $value->status = 2;
                        $value->save();
                    }
                } catch (Exception $e) {
                    Log::error('支付宝订单异常：' . json_encode($e));
                    $response = $e->raw['alipay_trade_query_response'];
                    if ($response['code'] === '40004' && $response['sub_code'] === 'ACQ.TRADE_NOT_EXIST') {
                        $value->status = 2;
                        $value->comment = $response['sub_msg'];
                        $value->save();
                    }
                }
            }
        }
    }
}

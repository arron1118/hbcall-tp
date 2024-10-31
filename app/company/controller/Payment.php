<?php


namespace app\company\controller;

use app\common\traits\PaymentTrait;
use chillerlan\QRCode\QRCode;
use think\facade\Config;
use think\facade\Log;
use Yansongda\Artful\Contract\ConfigInterface;
use Yansongda\Artful\Exception\InvalidConfigException;
use Yansongda\Artful\Logger;
use Yansongda\Pay\Exception\Exception;
use Yansongda\Pay\Pay;

class Payment extends \app\common\controller\CompanyController
{
    use PaymentTrait;

    /**
     * 检测微信扫码支付订单
     * @return \think\response\Json
     * @throws \Yansongda\Pay\Exceptions\GatewayException
     * @throws \Yansongda\Pay\Exceptions\InvalidArgumentException
     * @throws \Yansongda\Pay\Exceptions\InvalidSignException
     */
    public function checkOrder()
    {
        if ($this->request->isPost()) {
            $payno = $this->request->param('payno');
            $this->returnData['code'] = 1;
            $this->returnData['msg'] = 'success';
            $this->returnData['data'] = Pay::wechat(Config::get('payment'))
                ->query([
                    'out_trade_no' => $payno,
                    '_action' => 'native',  // 查询扫码支付订单
                ]);
        }

        return json($this->returnData);
    }

    /**
     * 二维码支付
     */
    public function pay()
    {
        $amount = (float) $this->request->param('amount', 0);
        $payType = (int) $this->request->param('payType/d', 1);
        $orderNo = $this->request->param('payno', '');

        if ($amount <= 0) {
            $this->returnData['msg'] = '请输入正确的金额';
            return json($this->returnData);
        }

        $data = $this->createOrder($this->userInfo, $amount, $payType, $orderNo);
        try {
            Pay::config(Config::get('payment'));
            if ($payType === 1) {
                $pay = Pay::wechat()->scan($data);
                $this->returnData['code'] = 1;
                $this->returnData['msg'] = '订单创建成功';
                $this->returnData['data'] = [
                    'qr' => (new QRCode())->render($pay->code_url),
                    'payno' => $data['out_trade_no'],
                    'amount' => $amount,
                ];
                return json($this->returnData);
            }

            if ($payType === 2) {
                $data['_config'] = 'web';
                return Pay::alipay()->web($data);
            }
        } catch (InvalidConfigException $e) {
            Log::debug('[' . $e->getCode() . '] ' . $e->getMessage());
            return '配置出现异常，请联系管理员处理';
        } catch (Exception $e) {
            Log::debug('[' . $e->getCode() . '] ' . $e->getMessage());
            return '数据返回异常';
        }
    }

    /**
     * 支付宝结果回调 （目前无用）
     * @return \think\response\Redirect
     */
    public function alipayResult()
    {
        // TODO
        return redirect(url('common@payment/index'));
    }
}

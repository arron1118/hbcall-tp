<?php


namespace app\common\controller;

use app\common\model\Company;
use think\facade\Session;
use think\facade\View;
use app\common\traits\CompanyTrait;

class CompanyController extends \app\BaseController
{
    use CompanyTrait;

    protected array $middleware = [\app\common\middleware\Check::class];

    protected $userType = 'company';

    protected $model = null;

    protected $userInfo = null;

    protected $token = null;

    protected $noNeedLogin = ['login'];

    protected $returnData = [
        'code' => 0,
        'msg' => '未知错误',
        'data' => []
    ];

    protected function initialize(): void
    {
        parent::initialize();

        $this->token = $this->request->cookie('hbcall_' . $this->module . '_token');
        if ($this->token) {
            $this->userInfo = Company::withCount('user')
                ->with(['companyXnumber' => ['numberStore']])
                ->where('token', $this->token)
                ->find();
            $this->userInfo && cookie('balance', $this->userInfo->balance);
        }
        $this->view->assign('user', $this->userInfo);
    }

    public function delSession()
    {
        Session::delete('company');
    }
}

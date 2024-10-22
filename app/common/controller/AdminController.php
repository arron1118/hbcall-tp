<?php


namespace app\common\controller;

use app\admin\model\Admin;
use think\facade\View;
use think\Model;

class AdminController extends \app\BaseController
{
    protected array $middleware = [\app\common\middleware\Check::class];

    /**
     * @var Model
     */
    protected Model $model;

    /**
     * @var Admin|null
     */
    protected $userInfo = null;

    /**
     * 用户类型
     * @var string
     */
    protected string $userType = 'admin';

    /**
     * 返回数据
     * @var array
     */
    protected array $returnData = [];

    protected function initialize(): void
    {
        parent::initialize();

        $this->returnData = [
            'code' => 0,
            'msg' => lang('Unknown error'),
            'data' => []
        ];

        $token = $this->request->cookie('hbcall_admin_token', '');
        if ($token) {
            $this->userInfo = Admin::where('token', $token)->find();
        }
        $this->view->assign('user', $this->userInfo);
    }

    /**
     * 上传文件
     * @return array
     */
    public function upload(): array
    {
        $upload = (new \app\common\library\Attachment())->upload('file');

        if (!$upload) {
            $this->returnData['msg'] = '上传失败: 未找到文件';
            return $this->returnData;
        }

        $this->returnData['code'] = 1;
        $this->returnData['data']['savePath'] = $upload['savePath'];
        $this->returnData['msg'] = '上传成功';

        return $this->returnData;
    }

}

<?php
declare (strict_types = 1);

namespace app;

use Jenssegers\Agent\Agent;
use think\App;
use think\exception\ValidateException;
use think\facade\View;
use think\Validate;

/**
 * 控制器基础类
 */
abstract class BaseController
{
    /**
     * Request实例
     * @var \think\Request
     */
    protected \think\Request $request;

    /**
     * 应用实例
     * @var App
     */
    protected App $app;

    /**
     * 是否批量验证
     * @var bool
     */
    protected bool $batchValidate = false;

    /**
     * 控制器中间件
     * @var array
     */
    protected array $middleware = [];

    /**
     * View 实例
     * @var object
     */
    protected object $view;

    /**
     * @var Agent
     */
    protected Agent $agent;

    /**
     * 业务模块
     * @var string
     */
    protected string $module;

    /**
     * Token 过期时间
     * @var float|int
     */
    protected float|int $token_expire_time = 3600 * 24 * 7;

    /**
     * baseFile
     * @var string
     */
    protected string $baseFile;

    /**
     * 站点名称
     * @var string
     */
    protected string $app_name = '站点名称';

    /**
     * 构造方法
     * @access public
     * @param  App  $app  应用对象
     */
    public function __construct(App $app)
    {
        $this->app     = $app;
        $this->request = $this->app->request;
        $this->view = View::instance();
        $this->agent = new Agent();
        $this->baseFile = $this->request->baseFile();
        $this->module = app('http')->getName();
        $this->app_name = systemConfig('site', 'site_name');

        $this->view->assign([
            'module' => $this->module,
            'app_name' => $this->app_name,
            'baseFile' => $this->baseFile,
        ]);

        // 控制器初始化
        $this->initialize();
    }

    /**
     * @return void
     */
    protected function initialize(): void
    {}

    /**
     * 验证数据
     * @access protected
     * @param  array        $data     数据
     * @param  string|array $validate 验证器名或者验证规则数组
     * @param  array        $message  提示信息
     * @param  bool         $batch    是否批量验证
     * @return array|string|true
     * @throws ValidateException
     */
    protected function validate(array $data, string|array $validate, array $message = [], bool $batch = false)
    : bool|array|string
    {
        if (is_array($validate)) {
            $v = new Validate();
            $v->rule($validate);
        } else {
            if (strpos($validate, '.')) {
                // 支持场景
                [$validate, $scene] = explode('.', $validate);
            }
            $class = false !== strpos($str, '\\') ? $validate : $this->app->parseClass('validate', $validate);
            $v     = new $class();
            if (!empty($scene)) {
                $v->scene($scene);
            }
        }

        $v->message($message);

        // 是否批量验证
        if ($batch || $this->batchValidate) {
            $v->batch(true);
        }

        return $v->failException(true)->check($data);
    }

}

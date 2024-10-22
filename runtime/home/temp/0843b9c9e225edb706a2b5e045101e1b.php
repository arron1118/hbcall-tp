<?php /*a:4:{s:57:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\user\login.html";i:1713777139;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\base.html";i:1651129808;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\meta.html";i:1710927703;s:70:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\script.html";i:1710927714;}*/ ?>
<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlentities($app_name); ?></title>
    <meta name="keywords" content="">
<meta name="description" content="">
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Access-Control-Allow-Origin" content="*">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<link rel="icon" href="/favicon.ico">
<link rel="stylesheet" href="/static/lib/layui-v2.6.8/css/layui.css" media="all"/>
<link rel="stylesheet" href="/static/css/layuimini.css?v=<?php echo time(); ?>" media="all"/>
<link rel="stylesheet" href="/static/css/themes/default.css" media="all"/>
<link rel="stylesheet" href="/static/lib/fontawesome-6.1.1/css/all.min.css" media="all"/>
<link rel="stylesheet" href="/static/lib/sweetalert2-11.7.2/sweetalert2.min.css"/>

<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

<script>
    const BASE_FILE = '<?php echo htmlentities($baseFile); ?>',
        APP_MODULE = '<?php echo htmlentities($module); ?>'
</script>

    
<style>
    html, body {
        width: 100%;
        height: 100%;
        overflow: hidden
    }

    body {
        padding: 0 !important;
        background: #1E9FFF !important;
    }

    body:after {
        content: '';
        background-repeat: no-repeat;
        background-size: cover;
        -webkit-filter: blur(3px);
        -moz-filter: blur(3px);
        -o-filter: blur(3px);
        -ms-filter: blur(3px);
        filter: blur(3px);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
    }

    .layui-container {
        width: 100%;
        height: 100%;
        overflow: hidden
    }

    .admin-login-background {
        width: 360px;
        height: 300px;
        position: absolute;
        left: 50%;
        top: 40%;
        margin-left: -180px;
        margin-top: -100px;
    }

    .logo-title {
        text-align: center;
        letter-spacing: 2px;
        padding: 14px 0;
    }

    .logo-title h1 {
        color: #1E9FFF;
        font-size: 25px;
        font-weight: bold;
    }

    .login-form {
        background-color: #fff;
        border: 1px solid #fff;
        border-radius: 3px;
        padding: 14px 20px;
        box-shadow: 0 0 8px #eeeeee;
    }

    .login-form .layui-form-item {
        position: relative;
    }

    .login-form .layui-form-item label {
        position: absolute;
        left: 1px;
        top: 1px;
        width: 38px;
        line-height: 36px;
        text-align: center;
        color: #d2d2d2;
    }

    .login-form .layui-form-item input {
        padding-left: 36px;
    }

    .captcha {
        width: 60%;
        display: inline-block;
    }

    .captcha-img {
        display: inline-block;
        width: 34%;
        float: right;
    }

    .captcha-img img {
        height: 34px;
        border: 1px solid #e6e6e6;
        height: 36px;
        width: 100%;
    }

</style>

    <link rel="stylesheet" href="/static/css/public.css" media="all">
    <style id="layuimini-bg-color"></style>
</head>


<div class="layui-container">
    <div class="admin-login-background">
        <div class="layui-form login-form">
            <form class="layui-form" action="">
                <div class="layui-form-item logo-title"
                     style="display: flex; flex-direction: column;
                        justify-content: center; align-items: center; margin-right: 10px; padding: 0 15px;">
                    <h1><?php echo htmlentities($app_name); ?></h1>
                    <div style="margin-top: 5px;">(
                        <?php if(($module === 'admin')): ?>
                        超级管理员入口
                        <?php elseif(($module === 'company')): ?>
                        管理员入口
                        <?php else: ?>
                        用户入口
                        <?php endif; ?>
                        )</div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-username" for="username"></label>
                    <input type="text" name="username" lay-verify="required|account" placeholder="用户名或者邮箱"
                           autocomplete="off" class="layui-input" value="">
                </div>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-password" for="password"></label>
                    <input type="password" name="password" lay-verify="required|password" placeholder="密码"
                           autocomplete="off" class="layui-input" value="">
                </div>
                <div class="layui-form-item">
                    <label class="layui-icon layui-icon-vercode" for="captcha"></label>
                    <input type="text" name="captcha" lay-verify="required|captcha" placeholder="图形验证码" autocomplete="off" class="layui-input verification captcha" value="">
                    <div class="captcha-img">
                        <?php echo captcha_img(); ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <input type="checkbox" name="rememberMe" value="true" lay-skin="primary" title="记住密码" checked>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn layui-btn-normal layui-btn-fluid" lay-submit=""
                            lay-filter="login">登 入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="/static/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
<script src="/static/lib/layui-v2.6.8/layui.js" charset="utf-8"></script>
<script src="/static/js/lay-config.js?v=2.0.0" charset="utf-8"></script>
<script src="/static/lib/bootstrap/js/bootstrap.bundle.min.js" charset="utf-8"></script>
<script src="/static/lib/sweetalert2-11.7.2/sweetalert2.all.min.js"></script>
<script src="/static/lib/jq-module/jquery.particleground.min.js" charset="utf-8"></script>
<script src="/static/lib/layui_exts/excel.js"></script>

<script>
    $.ajaxSetup({
        statusCode: {
            200: function (data) {
                if (data.code === 5003) {
                    window.location.href = data.url
                }
            }
        }
    })

    // 启用 bootstrap Tooltip
    const tooltipTriggerList = $('[data-bs-toggle="tooltip"]')
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>


<script src="/static/js/common/login.js?v=<?php echo time(); ?>"></script>

</html>

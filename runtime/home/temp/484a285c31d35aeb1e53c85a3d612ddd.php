<?php /*a:5:{s:66:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\user\reset_password.html";i:1681176803;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\base.html";i:1651129808;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\meta.html";i:1710927703;s:73:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\bootstrap.html";i:1676531188;s:70:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\script.html";i:1710927714;}*/ ?>
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

    

<link rel="stylesheet" href="/static/lib/bootstrap/css/bootstrap.min.css" media="all">
<link rel="stylesheet" href="/static/lib/bootstrap/font/bootstrap-icons.css" media="all">


    <link rel="stylesheet" href="/static/css/public.css" media="all">
    <style id="layuimini-bg-color"></style>
</head>

<div class="container-fluid bg-white rounded-3 py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-sm-12">
            <form class="layui-form layuimini-form">
                <div class="layui-form-item">
                    <label class="layui-form-label required">旧的密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="old_password" lay-verify="required" lay-reqtext="旧的密码不能为空"
                               placeholder="请输入旧的密码" autocomplete="off" value="" class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label required">新的密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="new_password" lay-verify="required" lay-reqtext="新的密码不能为空"
                               placeholder="请输入新的密码" autocomplete="off" value="" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label required">确认密码</label>
                    <div class="layui-input-block">
                        <input type="password" name="confirm_password" lay-verify="required"
                               lay-reqtext="确认密码不能为空" placeholder="请输入确认密码" autocomplete="off" value=""
                               class="layui-input">
                    </div>
                </div>

                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn layui-btn-normal" lay-submit lay-filter="saveBtn">确认保存</button>
                    </div>
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


<script src="/static/js/common/reset_password.js?v=<?php echo time(); ?>"></script>

</html>

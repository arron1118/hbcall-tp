<?php /*a:5:{s:57:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\user\profile.html";i:1710386727;s:66:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\base.html";i:1651129808;s:66:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\meta.html";i:1710927703;s:71:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\bootstrap.html";i:1676531188;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\script.html";i:1710927714;}*/ ?>
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

<div class="layuimini-container ">
    <div class="layuimini-main ">
        <div class="container-fluid ">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-10 col-sm-12">
                    <form class="layui-form layuimini-form">
                        <div class="layui-form-item">
                            <label class="layui-form-label">用户名</label>
                            <div class="layui-input-block">
                                <input type="text" name="username"  value="<?php echo htmlentities($user['username']); ?>" class="layui-input border-0 text-muted" readonly>
                                <tip>登录账号，暂不支持更改！</tip>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">昵称</label>
                            <div class="layui-input-block">
                                <input type="text" name="nickname" placeholder="请输入昵称"  value="<?php echo htmlentities($user['nickname']); ?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">真实姓名</label>
                            <div class="layui-input-block">
                                <input type="text" name="realname" placeholder="请输入真实姓名"  value="<?php echo htmlentities($user['realname']); ?>" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label required">手机号</label>
                            <div class="layui-input-block">
                                <input type="text" name="phone" lay-verify="required|phone" placeholder="请输入手机号"  value="<?php echo htmlentities($user['phone']); ?>" class="layui-input">
                                <tip>手机号用于拨号，请认真填写</tip>
                            </div>
                        </div>
                        <div class="layui-form-item">
                            <label class="layui-form-label">呼叫线路</label>
                            <div class="layui-input-block">
                                <input type="text" name="" value="<?php echo htmlentities((isset($user['company']['callType']['title']) && ($user['company']['callType']['title'] !== '')?$user['company']['callType']['title']:'')); ?>" class="layui-input text-muted border-0" disabled>
                            </div>
                        </div>
                        <div class="layui-form-item <?php if(!in_array($user->company->call_type_id, [3, 4])): ?>d-none<?php endif; ?>">
                            <label class="layui-form-label" for="callback_number">回拨号码</label>
                            <div class="layui-input-block" id="callback_number">
                                <input type="text" name="callback_number" placeholder="回拨号码"
                                       autocomplete="off" class="layui-input" value="<?php echo htmlentities($user['callback_number']); ?>">
                                <tip>提示：呼叫线路为<strong>电信回拨</strong>、<strong>移动回拨</strong>时，必须提供回拨号码才能进行拨号</tip>
                            </div>
                        </div>

                        <div class="layui-form-item">
                            <label class="layui-form-label">联系地址</label>
                            <div class="layui-input-block">
                                <div class="layui-input-inline">
                                    <select class="layui-form-select region-province" name="region[]" lay-filter="province">
                                        <option value="">省</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select class="layui-form-select region-city" name="region[]" lay-filter="city">
                                        <option value="">市</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select class="layui-form-select region-district" name="region[]" lay-filter="district">
                                        <option value="">区</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select class="layui-form-select region-town" name="region[]" lay-filter="town">
                                        <option value="">镇</option>
                                    </select>
                                </div>
                                <div class="layui-input-inline">
                                    <select class="layui-form-select region-street" name="region[]" lay-filter="street">
                                        <option value="">街道</option>
                                    </select>
                                </div>
                            </div>
                            <label></label>
                            <div class="layui-input-block">
                                <input name="address" value="<?php echo htmlentities($user['address']); ?>" class="layui-input" placeholder="详细地址" />
                            </div>
                        </div>

                        <div class="layui-form-item">
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


<script>
    $(function(){
        layui.use(['form', 'miniTab', 'jquery', 'arronUtil'], function () {
            let form = layui.form,
                arronUtil = layui.arronUtil,
                $ = layui.jquery,
                miniTab = layui.miniTab;

            function getRegionList(pid = 0, target = '') {
                $.ajax({
                    url: '/Ajax/getRegionList',
                    data: { pid: pid },
                    success: function (res) {
                        if (res.length) {
                            let options = '<option value="">请选择</option>'
                            $.each(res, (index, item) => {
                                options += '<option value="' + item.id + '">' + item.region_name + '</option>'
                            })
                            $('.region-' + target).html(options)

                            form.render('select')
                        }
                    }
                })
            }

            getRegionList(0, 'province')
            const selectList = ['province', 'city', 'district', 'town', 'street']
            $.each(selectList, function (index, item) {
                form.on('select(' + item + ')', function (data) {
                    getRegionList(data.value, selectList[index + 1])
                })
            })

            //监听提交
            form.on('submit(saveBtn)', function (data) {
                $.post(arronUtil.url("/user/profile"), data.field, function (res) {
                    let option = { title: res.msg, position: 'center' }
                    if (res.code) {
                        option.icon = 'success'
                    }

                    arronUtil.Toast.fire(option)
                })

                return false;
            });

        });
    })
</script>


</html>

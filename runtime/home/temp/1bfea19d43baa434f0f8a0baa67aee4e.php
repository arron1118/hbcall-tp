<?php /*a:6:{s:63:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\hbcall\call_center.html";i:1682133031;s:66:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\base.html";i:1651129808;s:66:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\meta.html";i:1710927703;s:71:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\bootstrap.html";i:1676531188;s:75:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\customer\edit_record.html";i:1677235567;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\home\..\common\public\script.html";i:1710927714;}*/ ?>
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

<style type="text/css">
    #phone-numbers span:active {
        background-color: blue;
    }
</style>

    <link rel="stylesheet" href="/static/css/public.css" media="all">
    <style id="layuimini-bg-color"></style>
</head>

<div class="container-fluid bg-white rounded-3 py-2">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-7 mb-3">
            <div class="layui-tab layui-tab-card">
                <ul class="layui-tab-title">
                    <li class="layui-this ">客户管理</li>
                </ul>
                <div class="layui-tab-content p-3 pt-0 overflow-scroll" style="max-height: 750px;">
                    <div class="layui-tab-item layui-show">
                        <div class="import-description mb-3">
                            <button class="btn btn-outline-primary btn-sm" id="lastImport">
                                <i class="fa fa-clock"></i> 上次导入
                            </button>
                            <button class="btn btn-primary btn-sm" id="importExcel">
                                <i class="fa fa-file-import"></i> 导入客户
                            </button>
                            <button class="btn btn-danger btn-sm clear-customer">
                                <i class="fa fa-trash-can"></i> 清空列表
                            </button>
                            <a href="/HbCall/downloadTemplate" class="btn btn-info btn-sm download-template"><i class="fa fa-download"></i> 下载模板</a>
                            <a href="javascript:;" class="ms-3 check-rules text-decoration-none"><i class="fa fa-info-circle"></i> 导入说明</a>
                        </div>
                        <div class="customer-list">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-5">
            <div class="row justify-content-center mb-5">
                <div class="col-sm-12 col-md-8 col-lg-7 col-xl-8">
                    <div class="row pb-3" style="background-color: #f4f4f4;">
                        <div class="col">
                            <div class="row">
                                <div class="col p-0 position-relative">
                                    <button type="button" class="btn btn-sm position-absolute top-0 end-0 call-info" data-bs-toggle="modal"
                                            id="infoToggleModal" data-bs-target="#infoModal"
                                    >
                                        <i class="fa fa-info-circle fs-5 text-secondary" data-bs-toggle="tooltip" data-bs-title="注意事项"></i>
                                    </button>
                                    <input type="text" name="phone" value=""
                                           placeholder="请输入号码"
                                           class="w-100 callinginput fs-1 border-0 text-center py-5 bg-transparent"
                                           id="input"
                                           onkeyup="this.value= this.value.match(/\d+(\d{0,2})?/) ? this.value.match(/\d+(\d{0,2})?/)[0] : ''">
                                </div>
                            </div>

                            <!-- 拨号键 -->
                            <div class="row row-cols-3 gy-5 py-4 justify-content-center fs-1"
                                 id="phone-numbers"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="infoModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h1 class="modal-title fs-6">温馨提示</h1>
            </div>
            <div class="modal-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0">1、只允许拨打本公司业务电话，不允许拨打其他行业电话。</li>
                    <li class="list-group-item border-0">2、拨号当中不允许出现：金融、地产相关高频行业。</li>
                    <li class="list-group-item border-0">3、通话中不允许出现：代开发票、造假等违法字眼。</li>
                    <li class="list-group-item border-0">4、不允许在通话中辱骂。</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal" data-bs-target="#infoModal">我知道了</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="recordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">回访记录</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" name="record-add-form" action="">
                    <input type="hidden" name="id" value="" />
                    <input type="hidden" name="customer_id" value="<?php echo htmlentities((isset($customer_id) && ($customer_id !== '')?$customer_id:'')); ?>" />

                    <div class="mb-3">
                        <label class="form-label" for="comment">记录内容</label>
                        <textarea type="text" name="content" id="comment" placeholder="记录内容"
                                  autocomplete="off" class="layui-textarea" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">下次回访</label>
                        <input type="text" class="layui-input" name="next_call_time" id="record-datetime" placeholder="yyyy-MM-dd" required>
                    </div>
                    <div class="mb-3 d-grid">
                        <button class="btn btn-primary" type="submit">保 存
                        </button>
                    </div>
                </form>
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


<script src="/static/js/home/call_center.js?v=<?php echo time(); ?>"></script>


</html>

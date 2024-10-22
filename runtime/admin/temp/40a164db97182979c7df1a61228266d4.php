<?php /*a:5:{s:62:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\index\dashboard.html";i:1713844180;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\base.html";i:1651129808;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\meta.html";i:1710927703;s:73:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\bootstrap.html";i:1676531188;s:70:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\script.html";i:1710927714;}*/ ?>
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

<style>
    .lqp-hover:hover .card-img {
        transform: rotateY(90deg);
    }
</style>

    <link rel="stylesheet" href="/static/css/public.css" media="all">
    <style id="layuimini-bg-color"></style>
</head>

<div class="container-fluid bg-white rounded-3 shadow-sm mb-3">
    <?php if($module === 'company'): ?>
    <div class="row mb-3 py-3">
        <div class="col-12 col-md-3 mb-3 mb-sm-3 mb-md-0 d-flex align-items-end justify-content-center">
            <div class="me-3">
                <img src="/static/images/dashuser.png" style="max-height: 80px;">
            </div>
            <div class=" align-self-end">
                <h6>账号：<span class="fs-bold important"><?php echo htmlentities($user['username']); ?></span></h6>
                <h6>手机：<?php echo htmlentities($user['phone']); ?></h6>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 mb-sm-12 mb-md-0 d-flex align-items-end justify-content-center">
            <div class="">
                <p class="mb-2 text-muted">当前余额/元</p>
                <h5 class="text-success fs-2">
                    <?php 
                    $number = number_format($user['balance'], 3);
                    $numbers = explode('.', $number);
                    $numbers[0] = '<span class="mx-1">' . $numbers[0] . '</span>';
                    $numbers[1] = '<span class="fs-6 text-muted">.' . $numbers[1] . '</span>';
                    echo '<i class="fa fa-yen-sign fs-6 text-muted"></i>' . implode('', $numbers);
                     ?>
                    <a href="javascript:;" layuimini-content-href="payment/index.html" data-title="充值管理"
                       class="layui-btn layui-btn-sm layui-btn-normal text-decoration-none shadow rounded-pill ms-3 px-3">
                        <i class="fa fa-wallet me-1"></i>
                        充值
                    </a>
                </h5>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 mb-sm-12 mb-md-0 d-flex align-items-end justify-content-center">
            <div class="d-flex flex-row align-items-end">
                <img src="/static/images/22.png" style="max-height: 78px;">
                <div class="ms-3">
                    <p class="mb-0">客服咨询</p>
                    <p class="fw-bold mb-0">13622850769</p>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3 mb-3 mb-sm-12 mb-md-0 d-flex align-items-end justify-content-center">
            <div class="text-center d-flex flex-row align-items-center">
                <img src="/static/images/xiaoqiang.png" style="max-height: 78px;">
                <p class="mb-0 ms-3">微信咨询</p>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row mb-3 py-3">
        <?php if($module === 'admin'): ?>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 border-end d-flex align-items-end justify-content-center">
            <div>
                <p class="text-black-50">总收入</p>
                <h5 class="fs-2 total-payment"></h5>
            </div>
        </div>
        <?php elseif($module === 'company'): ?>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 d-flex align-items-center justify-content-center">
            <div>
                <h4>网站概况</h4>
            </div>
        </div>
        <?php endif; ?>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 border-end d-flex align-items-end justify-content-center">
            <div>
                <p class="text-black-50">总消费</p>
                <h5 class="fs-2 total-cost"></h5>
            </div>
        </div>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 border-end d-flex align-items-end justify-content-center">
            <div class="">
                <p class="text-black-50">
                    今日<?php echo htmlentities($total_title); ?>
                    [<span class="text-warning fs-6 percentage"></span>]
                </p>
                <h5 class="fs-2 current-day-cost"></h5>
            </div>
        </div>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 border-end d-flex align-items-end justify-content-center">
            <div>
                <p class="text-black-50">
                    昨日<?php echo htmlentities($total_title); ?>
                    [<span class="text-warning fs-6 yesterday-percentage"></span>]
                </p>
                <h5 class="fs-2 yesterday-cost"></h5>
            </div>
        </div>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 border-end d-flex align-items-end justify-content-center">
            <div>
                <p class="text-black-50">前天<?php echo htmlentities($total_title); ?></p>
                <h5 class="fs-2 two-days-ago-cost"></h5>
            </div>
        </div>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 border-end d-flex align-items-end justify-content-center">
            <div>
                <p class="text-black-50">本月<?php echo htmlentities($total_title); ?></p>
                <h5 class="fs-2 current-month-cost"></h5>
            </div>
        </div>
        <div class="col-6 col-lg mb-3 mb-sm-3 mb-md-0 d-flex align-items-end justify-content-center">
            <div>
                <p class="text-black-50">今年<?php echo htmlentities($total_title); ?></p>
                <h5 class="fs-2 current-year-cost"></h5>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mb-xl-0">
        <div class="col-xl-7 col-lg-12 mb-3 bg-white rounded-3 shadow-sm">
            <div class="row p-3">
                <div class="col-lg-6 col-12 mb-sm-3 h-100">
                    <div id="historyChart" class="h-100" style="height: 270px;" data-chart-list=""></div>
                </div>
                <div class="col-lg-6 col-12 mb-3">
                    <div class="row h-50 gap-3 mb-3">
                        <div class="col p-3 rounded-3" style="background-color: #f7f7f7;">
                            <div class="mb-3 text-black-50">总呼出(个)</div>
                            <h2 class="totalCallHistory "></h2>
                        </div>
                        <div class="col p-3 rounded-3" style="background-color: #f7f7f7;">
                            <div class="mb-3 text-black-50">总时间(分)</div>
                            <h2 class="totalCallDuration "></h2>
                        </div>
                    </div>
                    <div class="row h-50 gap-3">
                        <div class="col p-3 rounded-3" style="background-color: #f7f7f7;">
                            <div class="mb-3 text-black-50">已接听(个)</div>
                            <h2 class="totalCallAndPickUp"></h2>
                        </div>
                        <div class="col p-3 rounded-3" style="background-color: #f7f7f7;">
                            <div class="mb-3 text-black-50">未接听(个)</div>
                            <h2 class="totalCallAndNoPickUp"></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-5 col-lg-12 mb-3">
            <div class="row">
                <div class="col">
                    <div class="card border border-light-subtle shadow-sm">
                        <div class="card-header border-light-subtle"><i class="fa fa-chart-simple text-warning-emphasis me-1"></i>排行榜</div>
                        <div class="card-body">
                            <table class="table table-hover toplist-table">
                                <thead>
                                <tr>
                                    <th>名称</th>
                                    <th>总呼叫</th>
                                    <th>已接听</th>
                                    <th>时间(分)</th>
                                    <th>消费金额(￥)</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row mb-3">
        <div class="col bg-white rounded-3 shadow-sm py-3">
            <div id="callChart" class="h-100" style="height: 350px;"></div>
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


<script src="/static/lib/echarts/echarts.min.js"></script>
<script src="/static/js/common/dashboard.js?v=<?php echo time(); ?>"></script>

</html>

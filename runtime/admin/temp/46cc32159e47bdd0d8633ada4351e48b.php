<?php /*a:5:{s:60:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\payment\index.html";i:1711416488;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\base.html";i:1651129808;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\meta.html";i:1710927703;s:73:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\bootstrap.html";i:1676531188;s:70:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\script.html";i:1710927714;}*/ ?>
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

<div class="container-fluid bg-white  pt-3">
    <div class="row">
        <div class="col">
            <form class="layui-form layui-form-pane" lay-filter="searchForm" name="searchForm">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">充值方式</label>
                        <div class="layui-input-inline">
                            <select name="pay_type" lay-filter="payTypeFilter">
                                <?php foreach($payTypeList as $key => $val): ?>
                                <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">支付状态</label>
                        <div class="layui-input-inline">
                            <select name="status" lay-filter="payStateFilter">
                                <?php foreach($statusList as $key => $val): ?>
                                <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="layui-inline" id="datetime">
                        <label class="layui-form-label">充值时间</label>
                        <div class="layui-input-inline">
                            <input type="text" name="startDate" autocomplete="off" id="startDate"
                                   class="layui-input" placeholder="开始日期">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="endDate" autocomplete="off" id="endDate" class="layui-input"
                                   placeholder="结束日期">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">订单号</label>
                        <div class="layui-input-inline">
                            <input type="text" name="payno" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-btn-normal" lay-submit lay-filter="data-search-btn">
                            <i class="fa fa-magnifying-glass"></i> 搜 索
                        </button>
                        <button type="reset" class="layui-btn layui-btn-primary">
                            <i class="fa fa-refresh"></i> 重 置
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php if(($module === 'company')): ?>
    <div class="row">
        <div class="col">
            <form class="layui-form layui-form-pane" lay-filter="paymentForm" action="">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">支付方式</label>
                        <div class="layui-input-block">
                            <input type="radio" name="pay_type" value="1" title="微信" checked="">
                            <input type="radio" name="pay_type" value="2" title="支付宝">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">金额/元</label>
                        <div class="layui-input-inline">
                            <input type="number" min="0" name="money" autocomplete="off" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-btn-normal" lay-submit
                                lay-filter="data-money-btn">立即充值
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>
    <div class="row">
        <?php if($module === 'admin'): ?>
        <div class="col-lg-2 col-md-3 col-sm-12">
            <div class="layui-card border border-light-subtle mt-2">
                <div class="layui-card-header">筛选</div>
                <div class="layui-card-body overflow-y-auto overflow-x-hidden" style="max-height: 680px;">
                    <ul class="layui-menu p-0" id="filterUser">
                        <?php if($module === 'admin'): ?>
                        <li class="layui-menu-item-checked" lay-options="{company_id: 0}">
                            <div class="layui-menu-body-title">全部</div>
                        </li>
                        <?php foreach($company as $key => $val): ?>
                        <li class="" lay-options="{company_id: <?php echo htmlentities($val['id']); ?>}">
                            <div class="layui-menu-body-title">
                                <?php echo htmlentities($val['corporation']); ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-10 col-md-9 col-sm-12">
        <?php else: ?>
        <div class="col">
        <?php endif; ?>
            <table class="layui-table" id="currentTableId" lay-filter="currentTableFilter" lay-even lay-data="">
                <thead>
                <tr>
                    <th lay-data="{field: 'id', title: 'ID', align: 'center', width: 100, fixed: 'left'}"></th>
                    <th lay-data="{field: 'payno', title: '订单号', align: 'center', width: 250}"></th>
                    <th lay-data="{field: 'title', title: '类型', align: 'center'}"></th>
                    <?php if($module === 'admin'): ?>
                    <th lay-data="{field: 'corporation', title: '充值方', align: 'center'}"></th>
                    <?php endif; ?>
                    <th lay-data="{field: 'amount', title: '金额(￥)', align: 'center'}"></th>
                    <th lay-data="{field: 'create_time', title: '充值时间', align: 'center'}"></th>
                    <th lay-data="{field: 'pay_time', title: '支付时间', align: 'center'}"></th>
                    <th lay-data="{field: 'pay_type', title: '充值方式', align: 'center', templet: '#paymentType'}"></th>
                    <th lay-data="{field: 'status', title: '状态', align: 'center', templet: '#paymentStatus'}"></th>
                </tr>
                </thead>
            </table>
            <script type="text/html" id="paymentType">
                {{# if (d.pay_type === 1) { }}
                <img width="20" src="/static/images/wepay-logo.png" title="{{d.pay_type_text}}" alt="{{d.pay_type_text}}" />
                {{# } else if (d.pay_type === 2) { }}
                <i class="fa-brands fa-alipay fs-4 text-primary" title="{{d.pay_type_text}}"></i>
                {{# } }}
            </script>

            <script type="text/html" id="paymentStatus">
                {{# if (d.status === 0) { }}
                    <?php if(($module === 'admin')): ?>
                        <span class="text-warning">{{d.status_text}}</span>
                    <?php elseif(($module === 'company')): ?>
                        <span class="layui-btn layui-btn-xs layui-btn-danger" lay-event="gopay">去支付</span>
                    <?php endif; ?>
                {{# } else if (d.status === 2) { }}
                    <span class="text-danger">{{d.status_text}}</span>
                {{# } else { }}
                    <span class="text-info">{{d.status_text}}</span>
                {{# } }}
            </script>
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


<script src="/static/js/common/payment.js?v=<?php echo time(); ?>"></script>

</html>

<?php /*a:5:{s:66:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\hbcall\history_list.html";i:1696930498;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\base.html";i:1651129808;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\meta.html";i:1710927703;s:73:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\bootstrap.html";i:1676531188;s:70:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\script.html";i:1710927714;}*/ ?>
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

<div class="container-fluid bg-white rounded-3 py-3">
    <div class="row">
        <div class="col">
            <form class="layui-form layui-form-pane" lay-filter="searchForm" name="searchForm">
                <div class="layui-form-item">
                    <div class="layui-inline" id="datetime">
                        <label class="layui-form-label">时间筛选</label>
                        <div class="layui-input-inline">
                            <input type="text" name="startDate" autocomplete="off" id="startDate" class="layui-input" placeholder="开始日期">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline">
                            <input type="text" name="endDate" autocomplete="off" id="endDate" class="layui-input" placeholder="结束日期">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">通话时长</label>
                        <div class="layui-input-inline">
                            <select name="operate" lay-filter="filterOperate">
                                <option value="">请选择操作符</option>
                                <option value="eq">等于</option>
                                <option value="gt">大于</option>
                                <option value="lt">小于</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="number" name="duration" class="layui-input" value="" placeholder="秒" min="0">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <label class="layui-form-label">号码筛选</label>
                        <div class="layui-input-inline">
                            <select name="caller" lay-filter="filterCaller">
                                <?php if($module !== 'home'): ?>
                                <option value="caller_number">主叫号码</option>
                                <?php endif; ?>
                                <option value="called_number">被叫号码</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="phone" class="layui-input" value="" placeholder="电话号码">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-btn-normal" lay-submit
                                lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索
                        </button>
                        <button type="reset" class="layui-btn layui-btn-primary"><i class="fa fa-refresh"></i> 重 置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        <?php if($module !== 'home'): ?>
        <div class="col-lg-2 col-md-3 col-sm-12">
            <div class="layui-card border border-light-subtle mt-2">
                <div class="layui-card-header">筛选</div>
                <div class="layui-card-body overflow-y-auto overflow-x-hidden" style="max-height: 680px;">
                    <ul class="layui-menu p-0" id="filterUser">
                        <?php if($module === 'admin'): ?>
                        <li class="layui-menu-item-checked" lay-options="{user_id: 0, company_id: 0}">
                            <div class="layui-menu-body-title">全部</div>
                        </li>
                        <?php foreach($company as $key => $val): ?>
                        <li class="layui-menu-item-group layui-menu-item-up" lay-options="{type: 'group'}">
                            <div class="layui-menu-body-title">
                                <?php echo htmlentities($val['corporation']); ?> <i class="layui-icon layui-icon-up"></i>
                            </div>
                            <?php if(!empty($val['user'])): ?>
                            <ul class="p-0">
                                <li class="" lay-options="{user_id: 0, company_id: <?php echo htmlentities($val['id']); ?>}">
                                    <div class="layui-menu-body-title">全部</div>
                                </li>
                                <?php foreach($val['user'] as $k => $v): ?>
                                <li lay-options="{user_id: <?php echo htmlentities($v['id']); ?>, company_id: <?php echo htmlentities($val['id']); ?>}">
                                    <div class="layui-menu-body-title"><?php echo htmlentities($v['realname']); ?></div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; elseif($module === 'company'): ?>
                        <li class="layui-menu-item-checked" lay-options="{user_id: 0, company_id: <?php echo htmlentities($user['id']); ?>}">
                            <div class="layui-menu-body-title">全部</div>
                        </li>
                        <?php foreach($users as $key => $val): ?>
                        <li class="" lay-options="{user_id: <?php echo htmlentities($val['id']); ?>, company_id: <?php echo htmlentities($val['company_id']); ?>}">
                            <div class="layui-menu-body-title"><?php echo htmlentities($val['realname']); ?></div>
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
            <table class="layui-table" id="currentTableId" lay-filter="currentTableFilter" lay-data="">
                <thead>
                <tr>
                    <th lay-data="{field: 'id', title: 'ID', align: 'center', width: 100, fixed: 'left'}"></th>
                    <th lay-data="{field: 'subid', title: '编号', align: 'center', width: 240}"></th>
                    <?php if(($module !== 'home')): ?>
                    <th lay-data="{field: 'username', title: '操作人', align: 'center', width: 200}"></th>
                    <?php if(($module === 'admin')): ?>
                    <th lay-data="{field: 'company', title: '所属公司', align: 'center', width: 200}"></th>
                    <?php endif; ?>
                    <th lay-data="{field: 'caller_number', title: '主叫号码', align: 'center', width: 150}"></th>
                    <?php endif; ?>
                    <th lay-data="{field: 'customer', title: '客户名称', align: 'center', width: 200,}"></th>
                    <th lay-data="{field: 'called_number', title: '被叫号码', align: 'center', width: 150}"></th>
                    <th lay-data="{field: 'callType.title', title: '呼叫线路', align: 'center', width: 200, templet: row => {
                        return row.callType.title
                    }}"></th>
                    <th lay-data="{field: 'create_time', title: '呼叫时间', align: 'center', sort: true, width: 180}"></th>
                    <th lay-data="{field: 'call_duration', title: '通话时长（分）', sort: true, align: 'center', width: 150}"></th>
                    <th lay-data="{field: 'cost', title: '消费金额（￥/元）', align: 'center', width: 150}"></th>
                    <?php if(($module === 'home')): ?>
                    <th lay-data="{title: '录音', align: 'center', templet: '#record'}"></th>
                    <?php else: ?>
                    <th lay-data="{title: '录音', width: 250, align: 'center', templet: '#record'}"></th>
                    <?php endif; if($module === 'admin'): ?>
                    <th lay-data="{field: 'status', title: '同步状态', width: 80, align: 'center'}"></th>
                    <?php endif; ?>
                </tr>
                </thead>
            </table>

            <script type="text/html" id="record">
                {{# if (d.record_url) { }}
                <audio style='width: 100%; height: 100%;' src='{{d.record_url}}' controls>您的浏览器不支持 audio 标签。</audio>
                {{# } }}
            </script>
            <script type="text/html" id="currentTableBar">
                <a class="layui-btn layui-btn-xs layui-btn-info" lay-event="preview">查看</a>
            </script>

            <?php if(($module === 'admin')): ?>
            <script type="text/html" id="syncCallHistory">
                <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" lay-event="syncCallHistory"><i class="fa fa-refresh"></i> 同步数据</button>
            </script>
            <?php endif; ?>
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


<script src="/static/js/common/history_list.js?v=<?php echo time(); ?>"></script>

</html>

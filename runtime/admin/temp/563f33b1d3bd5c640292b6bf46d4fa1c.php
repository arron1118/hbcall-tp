<?php /*a:6:{s:61:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\customer\index.html";i:1690449976;s:58:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\public\base.html";i:1651129808;s:68:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\meta.html";i:1710927703;s:63:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\public\bootstrap.html";i:1676531188;s:60:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\customer\edit.html";i:1686017392;s:70:"D:\phpstudy_pro\WWW\hbcall-tp\view\common\..\common\public\script.html";i:1710927714;}*/ ?>
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
                    <?php if(($module !== 'home')): ?>
                    <div class="layui-inline">
                        <label class="layui-form-label">分配状态</label>
                        <div class="layui-input-inline">
                            <select name="status" lay-filter="distributionFilter">
                                <option value="-1">全部</option>
                                <option value="0">未分配</option>
                                <option value="1">已分配</option>
                            </select>
                        </div>
                    </div>
                    <?php endif; ?>

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
                        <label class="layui-form-label">搜索</label>
                        <div class="layui-input-inline">
                            <select name="operate" lay-filter="filterOperate">
                                <?php foreach($searchItem as $key => $item): ?>
                                <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($item); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="keyword" class="layui-input" value="" placeholder="关键词">
                        </div>
                    </div>

                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-btn-normal" lay-submit
                                lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索
                        </button>
                        <button type="reset" class="layui-btn layui-btn-primary"><i class="fa fa-refresh"></i> 重 置
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-2 col-md-3 col-sm-12">
            <div class="layui-card border border-light-subtle mt-2">
                <div class="layui-card-header">分类</div>
                <div class="layui-card-body">
                    <ul class="layui-menu p-0" id="filterCate">
                        <?php foreach($cateList as $key => $val): ?>
                        <li class="<?php if(($key == '-1')): ?>layui-menu-item-checked<?php endif; ?>" lay-options="{cate: <?php echo htmlentities($key); ?>}">
                            <div class="layui-menu-body-title"><?php echo htmlentities($val); ?></div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <?php if($module !== 'home'): ?>
            <div class="layui-card border border-light-subtle">
                <div class="layui-card-header">筛选</div>
                <div class="layui-card-body overflow-y-auto overflow-x-hidden" style="max-height: 380px;">
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
                                <li class="" lay-options="{user_id: 0, company_id: <?php echo htmlentities($company[$key]['user'][0]['company_id']); ?>}">
                                    <div class="layui-menu-body-title">全部</div>
                                </li>
                                <?php foreach($val['user'] as $k => $v): ?>
                                <li lay-options="{user_id: <?php echo htmlentities($v['id']); ?>, company_id: <?php echo htmlentities($v['company_id']); ?>}">
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
            <?php endif; ?>
        </div>

        <div class="col-lg-10 col-md-9 col-sm-12">
            <table class="layui-table" id="currentTableId" lay-filter="currentTableFilter" lay-data="">
                <thead>
                <tr>
                    <th lay-data="{type: 'checkbox', fixed: 'left'}"></th>
                    <th lay-data="{field: 'id', title: 'ID', align: 'center', width: 100, fixed: 'left'}"></th>
                    <th lay-data="{field: 'title', title: '<?php echo htmlentities($typeText); ?>名称', align: 'center', width: 200}"></th>
                    <th lay-data="{field: 'contact', title: '联系人', align: 'center', width: 100}"></th>
                    <th lay-data="{field: 'phone', title: '联系电话', align: 'center', style: 'cursor: pointer;', templet: '#phone', event: 'showPhone', width: 150}"></th>
                    <th lay-data="{field: 'province', title: '所在地', align: 'center', width: 100}"></th>
                    <th lay-data="{field: 'comment', title: '备注', align: 'center', width: 240}"></th>
                    <th lay-data="{field: 'cate_text', title: '类型', align: 'center', width: 100}"></th>
                    <?php if($type === 2): ?>
                    <th lay-data="{field: 'professional', title: '专业', align: 'center', width: 150}"></th>
                    <th lay-data="{field: 'certificate', title: '证书类型', align: 'center', width: 100}"></th>
                    <?php endif; if(($module === 'admin')): ?>
                    <th lay-data="{field: 'corporation', title: '所属公司', align: 'center', width: 300}"></th>
                    <?php endif; if(($module !== 'home')): ?>
                    <th lay-data="{field: 'realname', title: '跟进人', align: 'center', width: 150}"></th>
                    <?php endif; ?>
                    <th lay-data="{field: 'called_count', title: '呼叫次数', align: 'center', width: 100}"></th>
                    <th lay-data="{field: 'record_count', title: '回访记录', align: 'center', width: 100, event: 'showRecord', style: 'cursor: pointer;', templet: '#record'}"></th>
                    <th lay-data="{field: 'last_calltime', title: '最近呼叫', align: 'center', width: 180}"></th>
                    <th lay-data="{field: 'create_time', title: '创建时间', align: 'center', width: 180}"></th>
                    <th lay-data="{field: 'update_time', title: '更新时间', align: 'center', width: 180}"></th>
                    <?php if(($module !== 'admin')): ?>
                    <th lay-data="{fixed: 'right', title: '操作', toolbar: '#barDemo', align: 'center', width: 150}"></th>
                    <?php endif; ?>
                </tr>
                </thead>
            </table>

            <script type="text/html" id="phone">
                <span class="hide-phone d-inline" data-value="{{d.phone}}" data-show="false">{{d.phone}}</span> <i class="fa-regular fa-eye phone-icon" title="点击查看"></i>
            </script>

            <script type="text/html" id="record">
                <span class="text-primary" title="点击查看">{{d.record_count}}</span>
            </script>

            <button type="button" class="layui-btn layui-btn-sm data-count-edit layui-btn-normal d-none" id="importExcel">导入<?php echo htmlentities($typeText); ?></button>
            <script type="text/html" id="currentTableBar">
                <?php if(($module !== 'admin')): ?>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"><i class="fa fa-plus"></i> 添加<?php echo htmlentities($typeText); ?></button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" lay-event="importExcel"><i class="fa fa-file-import"></i> 导入<?php echo htmlentities($typeText); ?></button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-info" lay-event="info"><i class="fa fa-info"></i> 导入说明</button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-warm" lay-event="delete"><i class="fa fa-trash-can"></i> 批量删除</button>
                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="changeCate"><i class="fa fa-up-down-left-right"></i> 移动分类</button>
                    <?php if(($module === 'company')): ?>
                        <button type="button" class="layui-btn layui-btn-sm layui-btn-danger" lay-event="distribution"><i class="fa fa-share-from-square"></i> 分配<?php echo htmlentities($typeText); ?></button>
                        <?php if($user->talent_on): ?>
                        <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" lay-event="migrate"><i class="fa fa-share-from-square"></i> 迁移<?php echo htmlentities($typeText); ?></button>
                        <?php endif; if($user->recycle_on): ?>
                        <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="trash" title="已分配并且被回收的数据"><i class="fa fa-trash-can"></i> 回收站</button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <button type="button" class="layui-btn layui-btn-sm layui-btn-primary" lay-event="recycle" title="已删除的数据"><i class="fa fa-trash-can"></i> 已删除</button>
                <?php endif; ?>
                <span class="ms-3 text-secondary">注：点击'回访记录'列可查看详细内容</span>
            </script>

            <script type="text/html" id="barDemo">
                <?php if(($module === 'home')): ?>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-normal" lay-event="makeCall" title="点击拨号"><i class="fa fa-phone"></i></button>
                <?php endif; ?>
                <button type="button" class="layui-btn layui-btn-info layui-btn-xs" data-bs-toggle="offcanvas" data-id="{{ d.id }}" data-bs-target="#offcanvas" title="编辑"><i class="fa fa-user-edit"></i></button>
                <button type="button" class="layui-btn layui-btn-xs layui-btn-danger" lay-event="delete" title="删除"><i class="fa fa-trash-can"></i></button>
            </script>
        </div>
    </div>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" style="width: 600px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">编辑</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form class="" action="" id="formEditor" name="formEditor">
            <input type="hidden" name="id" value="" />
            <input type="hidden" name="type" value="<?php echo htmlentities($type); ?>" />
            <div class="mb-3">
                <label class="form-label">类型</label>
                <select class="form-select" name="cate">
                    <?php foreach($cateList as $key => $val): if($key >= 0): ?>
                    <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label" for="account"><?php echo htmlentities($typeText); ?>名称</label>
                <input type="text" name="title" id="account" placeholder="<?php echo htmlentities($typeText); ?>名称"
                       autocomplete="off" class="form-control" value="" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="contact">联系人</label>
                <input type="text" name="contact" id="contact" placeholder="联系人"
                       autocomplete="off" class="form-control" value="" required>
            </div>

            <div class="mb-3">
                <label class="form-label" for="phone">手机号</label>
                <input type="text" name="phone" id="phone" placeholder="手机号"
                       autocomplete="off" class="form-control" value="" required>
            </div>
            <?php if($type === 2): ?>
            <div class="mb-3">
                <label class="form-label" for="certificate">证书类型</label>
                <input type="text" name="certificate" id="certificate" placeholder="证书类型"
                       autocomplete="off" class="form-control" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="professional">专业</label>
                <input type="text" name="professional" id="professional" placeholder="专业"
                       autocomplete="off" class="form-control" value="">
            </div>
            <?php endif; ?>
            <div class="mb-3">
                <label class="form-label" for="province">所在地</label>
                <input type="text" name="province" placeholder="所在地"
                       autocomplete="off" class="form-control" id="province" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="email">邮箱</label>
                <input type="text" name="email" id="email" placeholder="邮箱"
                       autocomplete="off" class="form-control" value="">
            </div>

            <div class="mb-3">
                <label class="form-label" for="comment">备注</label>
                <textarea type="text" name="comment" placeholder="备注"
                          autocomplete="off" rows="5" class="form-control" id="comment"></textarea>
            </div>
            <div class="mb-3 d-grid">
                <button class="btn btn-primary" type="submit">
                    保 存
                </button>
            </div>
        </form>
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


<?php if(($module === 'company')): ?>
<script>
    let user = JSON.parse('<?php echo json_encode($user->user->visible(["id", "username"])); ?>')
</script>
<?php endif; ?>
<script>
    let type = <?php echo htmlentities($type); ?>,
        typeText = '<?php echo htmlentities($typeText); ?>',
        cateList = JSON.parse('<?php echo json_encode($cateList); ?>');
</script>
<script src="/static/js/common/customer.js?v=<?php echo time(); ?>"></script>

</html>

<?php /*a:6:{s:56:"D:\phpstudy_pro\WWW\hbcall-tp\view\admin\user\index.html";i:1697271467;s:67:"D:\phpstudy_pro\WWW\hbcall-tp\view\admin\..\common\public\base.html";i:1651129808;s:67:"D:\phpstudy_pro\WWW\hbcall-tp\view\admin\..\common\public\meta.html";i:1710927703;s:72:"D:\phpstudy_pro\WWW\hbcall-tp\view\admin\..\common\public\bootstrap.html";i:1676531188;s:55:"D:\phpstudy_pro\WWW\hbcall-tp\view\admin\user\edit.html";i:1696924823;s:69:"D:\phpstudy_pro\WWW\hbcall-tp\view\admin\..\common\public\script.html";i:1710927714;}*/ ?>
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

<div class="container-fluid bg-white rounded-3 py-2">
    <div class="row">
        <div class="col pt-2">
            <form class="layui-form layui-form-pane" lay-filter="searchForm" name="searchForm">
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">关键词</label>
                        <div class="layui-input-inline">
                            <select name="operate" lay-filter="filterOperate">
                                <option value="username">账号</option>
                                <option value="corporation">公司名称</option>
                                <option value="phone">手机号</option>
                            </select>
                        </div>
                        <div class="layui-input-inline">
                            <input type="text" name="keyword" class="layui-input" value="" placeholder="关键词">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">用户状态</label>
                        <div class="layui-input-inline">
                            <select name="status" lay-filter="userStatusFilter">
                                <?php foreach($statusList as $key => $val): ?>
                                <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">是否试用</label>
                        <div class="layui-input-inline">
                            <select name="is_test" lay-filter="tryUserFilter">
                                <?php foreach($isTestList as $key => $val): ?>
                                <option value="<?php echo htmlentities($key); ?>"><?php echo htmlentities($val); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button type="submit" class="layui-btn layui-btn-normal" lay-submit
                                lay-filter="data-search-btn"><i class="layui-icon"></i> 搜 索
                        </button>
                    </div>
                    <div class="layui-inline">
                        <button type="reset" class="layui-btn layui-btn-primary"><i class="fa fa-refresh"></i> 重 置
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <script type="text/html" id="toolbarDemo">
                <button type="button" class="layui-btn layui-btn-sm layui-btn-normal" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"><i
                        class="fa fa-plus"></i> 开通账号
                </button>
                <span class="ms-3 text-secondary">注：点击'已开通用户'列可查看用户列表内容</span>
            </script>
            <table class="layui-table" id="currentTableId" lay-filter="currentTableFilter" lay-even lay-data="">
                <thead>
                <tr>
                    <th lay-data="{field: 'id', title: '编号', width: 100, fixed: 'left'}"></th>
                    <th lay-data="{field: 'username', title: '账号', fixed: 'left', width: 200,}"></th>
                    <th lay-data="{field: 'corporation', title: '公司名称', width: 200,}"></th>
                    <th lay-data="{field: 'ration', title: '座席', align: 'center', edit: 'text', width: 80}"></th>
                    <th lay-data="{field: 'limit_user', title: '限制用户数量', align: 'center', edit: 'text', sort: true, width: 130}"></th>
                    <th lay-data="{field: 'user_count', title: '已开通用户', align: 'center', sort: true, event: 'checkUserList', width: 130, style: 'cursor: pointer;', templet: '#hasUser'}"></th>
                    <th lay-data="{field: '', title: '呼叫线路', align: 'center', width: 150, templet: row => {
                        return row.callType?.title || ''
                    }}"></th>
                    <th lay-data="{field: 'rate', title: '费率(￥/元)', align: 'center', edit: 'text', sort: true, width: 120}"></th>
                    <th lay-data="{field: 'balance', title: '余额(￥/元)', align: 'center', sort: true, templet: '#balance', width: 120}"></th>
                    <th lay-data="{field: 'deposit', title: '充值', align: 'center', sort: true, width: 150}"></th>
                    <th lay-data="{field: 'expense', title: '总消费', align: 'center', sort: true, width: 150}"></th>
                    <th lay-data="{field: 'is_test_text', title: '试用', align: 'center', width: 120}"></th>
                    <th lay-data="{field: 'test_endtime', title: '到期日期', align: 'center', width: 180}"></th>
                    <th lay-data="{field: 'status_text', title: '状态', align: 'center', templet: '#status', width: 100}"></th>
                    <th lay-data="{field: 'call_status_text', title: '拨号状态', align: 'center', templet: '#call_status', width: 100}"></th>
                    <th lay-data="{title: '操作', width: 150, toolbar: '#currentTableBar', align: 'center', fixed: 'right'}"></th>
                </tr>
                </thead>
            </table>
            <script type="text/html" id="balance">
                {{# if (d.balance < 0) { }}
                <div class="layui-bg-red">{{d.balance}}</div>
                {{# } else { }}
                {{d.balance}}
                {{# } }}
            </script>
            <script type="text/html" id="hasUser">
                <span class="text-primary" title="点击查看用户列表">{{d.user_count}}</span>
            </script>
            <script type="text/html" id="status">
                {{# if(d.status === 1) { }}
                <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="正常|禁止" lay-filter="statusFilter" checked>
                {{# } else { }}
                <input type="checkbox" name="status" value="{{d.id}}" lay-skin="switch" lay-text="正常|禁止" lay-filter="statusFilter">
                {{# } }}
            </script>
            <script type="text/html" id="call_status">
                {{# if(d.call_status === 1) { }}
                <input type="checkbox" name="call_status" value="{{d.id}}" lay-skin="switch" lay-text="正常|禁止" lay-filter="callStatusFilter" checked>
                {{# } else { }}
                <input type="checkbox" name="call_status" value="{{d.id}}" lay-skin="switch" lay-text="正常|禁止" lay-filter="callStatusFilter">
                {{# } }}
            </script>
            <script type="text/html" id="currentTableBar">
                <a class="layui-btn layui-btn-xs data-count-edit" data-id="{{ d.id }}" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" title="编辑">
                    <i class="fa fa-user-edit"></i>
                </a>
                <a class="layui-btn layui-btn-xs layui-btn-danger data-count-delete" lay-event="delete" title="删除">
                    <i class="fa fa-trash-can"></i>
                </a>
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
        <div class="">
            <form class="" action="" name="formEditor">
                <input name="id" value="" type="hidden"/>
                <div class="mb-3">
                    <h5 class="text-black-50 text-center">账号信息</h5>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="call_type_id">呼叫线路</label>
                    <select name="call_type_id" id="call_type_id" class="form-select" required>
                        <?php foreach($callTypeList as $key => $val): ?>
                        <option value="<?php echo htmlentities($val['id']); ?>"><?php echo htmlentities($val['title']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="account">账号<span class="text-warning px-1">*</span></label>
                    <input type="text" name="username" id="account" placeholder="账号"
                           autocomplete="off" class="form-control" value="" required>
                    <div class="form-text">提示：此昵称作为登录账号使用，创建后暂不支持更改</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="password">密码<span class="text-warning px-1">*</span></label>
                    <input type="password" name="password" id="password"
                           placeholder="密码"
                           autocomplete="off" class="form-control" value="" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="ration">座席</label>
                    <input type="number" name="ration" min="0" placeholder="1"
                           autocomplete="off" class="form-control" value="1">
                    <div class="form-text">提示：1个小号为1个座席，默认 1</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="limit_user">限制用户数</label>
                    <input type="number" name="limit_user" id="limit_user" min="0" placeholder="0"
                           autocomplete="off" class="form-control" value="">
                    <div class="form-text">提示：0 为无限制开通拨号用户</div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="xnumber">小号</label>
                    <select name="number_store_id" id="xnumber" class="form-select">
                        <?php foreach($numberList as $val): ?>
                        <option value="<?php echo htmlentities($val['id']); ?>"><?php echo htmlentities($val['number']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="rate">费率(元)</label>
                    <input type="text" name="rate" id="rate" placeholder="0"
                           autocomplete="off" class="form-control" value="0.15">
                    <div class="form-text">提示：用于计算话费，默认 0.15/分钟</div>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="talent_on" name="talent_on"
                           value="1">
                    <label class="form-check-label" for="talent_on">人才管理</label>
                    <div class="form-text">
                        开启人才管理
                    </div>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="recycle_on" name="recycle_on"
                           value="1">
                    <label class="form-check-label" for="recycle_on">回收站</label>
                    <div class="form-text">
                        开启客户、人才管理回收功能
                    </div>
                </div>
                <div class="mb-3 form-check form-switch">
                    <input type="checkbox" class="form-check-input" id="isTest" name="is_test"
                           value="1">
                    <label class="form-check-label" for="isTest">测试账号</label>
                    <div class="form-text">
                        设为测试账号
                    </div>
                </div>
                <div class="mb-3 d-none test-endtime">
                    <label class="form-label" for="test_endtime">结束时间</label>
                    <input type="text" name="test_endtime" placeholder="1970-01-01 00:00:00"
                           autocomplete="off" class="form-control" value="" id="testEndTime">
                    <div class="form-text">超过测试时间将禁止拨号，空为无限制。</div>
                </div>
                <div class="mb-5 form-check form-switch">
                    <label class="form-check-label" for="status1">状态</label>
                    <input type="checkbox" id="status1" class="form-check-input" name="status"
                           value="1" checked>
                    <div class="form-text">禁止后，该账号下的所有拨号账号将无法正常使用。</div>
                </div>
                <div class="my-3">
                    <h5 class="text-black-50 text-center">客户信息</h5>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="corporation">公司名称</label>
                    <input type="text" name="corporation" id="corporation" placeholder="公司名称"
                           autocomplete="off" class="form-control" value="" required>
                    <div class="form-text">添加后不能更改，请慎重填写。</div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="realname">法 人</label>
                    <input type="text" name="realname" id="realname" placeholder="法人" autocomplete="off"
                           class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">联系电话</label>
                    <input type="text" name="phone" id="phone" placeholder="联系电话"
                           autocomplete="off" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="address">联系地址</label>
                    <input type="text" name="address" id="address" placeholder="联系地址"
                           autocomplete="off" class="form-control" value="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="contractDatetime">合同时间</label>
                    <div class="row" id="contractDatetime">
                        <div class="col">
                            <input type="text" name="contract_start_datetime" value="" autocomplete="off" id="startDate"
                                   class="form-control" placeholder="开始日期">
                        </div>
                        <div class="col-1 align-content-center">-</div>
                        <div class="col">
                            <input type="text" name="contract_end_datetime" value="" autocomplete="off" id="endDate"
                                   class="form-control" placeholder="结束日期">
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="newsImg">合同</label>
                    <div class="input-group mb-3" id="newsImg">
                        <span class="input-group-text">点击上传</span>
                        <input name="contract_attachment" class="form-control" type="text" value="" readonly/>
                    </div>
                    <div class="layui-upload-list" id="newsImgBox"></div>
                </div>

                <div class="mb-3 d-grid">
                    <button class="btn btn-primary" type="submit">保 存</button>
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


<script>
    const CallTypeList = <?php echo json_encode($callTypeList); ?>;
</script>
<script src="/static/js/admin/user.js?v=<?php echo time(); ?>"></script>

</html>

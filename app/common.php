<?php
// 应用公共文件
use think\facade\Cache;

if (!function_exists('getEncryptPassword')) {
    /**
     * 获取密码加密后的字符串
     * @param string $password 密码
     * @param string $salt 密码盐
     * @return string
     */
    function getEncryptPassword(string $password, string $salt = ''): string
    {
        return md5(md5($password) . $salt);
    }
}

if (!function_exists('getRandChar')) {
    /**
     * 随机生成要求位数个字符
     * @param int $length 规定几位字符
     * @return string
     */
    function getRandChar(int $length = 16): string
    {
        $str = '';
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz"; //大小写字母以及数字
        $max = strlen($strPol) - 1;

        for ($i = 0; $i < $length; $i++) {
            $str .= $strPol[rand(0, $max)];
        }

        return $str;
    }
}

if (!function_exists('getOrderNo')) {
    /**
     * 生成订单号
     * @return string 返回24位订单号
     */
    function getOrderNo(): string
    {
        $t = explode(' ', microtime());
        $m = explode('.', $t[0]);
        return date('Ymd') . $t[1] . substr($m[1], 0, 6);
    }
}

if (!function_exists('getCosts')) {
    /**
     * 统计当天、当月、当年消费
     * @param int $company_id
     * @param int $user_id
     * @return array
     */
    function getCosts(int $company_id = 0, int $user_id = 0): array
    {
        $where = [
            ['cost', '>', '0'],
        ];

        if ($company_id > 0) {
            $where[] = ['company_id', '=', $company_id];
        }

        if ($user_id > 0) {
            $where[] = ['user_id', '=', $user_id];
        }

        $callHistoryModel = \app\common\model\CallHistory::class;

        return [
            // 当日消费
            'current_day_cost' => $callHistoryModel::where($where)
                ->whereBetweenTime('create_time', strtotime('today'), strtotime('tomorrow'))->sum('cost'),
            // 昨日消费
            'yesterday_cost' => $callHistoryModel::where($where)
                ->whereBetweenTime('create_time', strtotime('yesterday'), strtotime('today'))->sum('cost'),
            // 前天消费
            'two_days_ago_cost' => $callHistoryModel::where($where)
                ->whereBetweenTime('create_time', strtotime('-2 day', strtotime('today')), strtotime('yesterday'))
                ->sum('cost'),
            // 本月消费
            'current_month_cost' => $callHistoryModel::where($where)
                ->whereBetweenTime('create_time',
                    mktime(0, 0, 0, date('m'), 1, date('Y')),
                    mktime(0, 0, 0, date('m') + 1, 1, date('Y')))->sum('cost'),
            // 当年消费
            'current_year_cost' => $callHistoryModel::where($where)
                ->whereBetweenTime('create_time',
                    mktime(0, 0, 0, 1, 1, date('Y')),
                    mktime(0, 0, 0, 1, 1, date('Y') + 1))->sum('cost'),
        ];
    }
}

/**
 * @param string $msg
 * @param array $options
 * @return void
 */
function showMsg(string $msg, array $options = []): void
{
    $o = array_merge($options, ['content' => $msg,
        'icon' => 0,
        'time' => '2500']);
    layerOpen($o);
}

/**
 * @param string $msg
 * @param array $options
 * @param callable|null $callback
 * @return void
 */
function showAlert(string $msg, array $options = [], callable $callback = null): void
{
    layerOpen(array_merge($options, [
        'content' => $msg
    ]));

//    is_callable($callback) && $callback();
}

/**
 * @param array $options
 * @return void
 */
function layerOpen(array $options = []): void
{
    $defaultOptions = [];
    $options = array_merge($defaultOptions, $options);
    $optionsToJson = json_encode($options);
    $script = getLayuiFiles();
    $html = <<<HTML
{$script}
<script>
    layui.use(['jquery', 'layer'], function () {
        let $ = layui.jquery,
            layer = layui.layer;
        let op = $optionsToJson;
        $.each(op, function (index, item) {
            if (['yes', 'cancel', 'end'].includes(index)) {
                op[index] = eval("(" +item + ")")
            }
        })
        parent.layer.open(op)
    })
</script>
HTML;

    echo $html;
}

/**
 * @return string
 */
function getLayuiFiles(): string
{
    return <<<SCRIPT
<link href="/static/lib/layui-v2.6.8/css/layui.css" rel="stylesheet" />
<script src="/static/lib/layui-v2.6.8/layui.js"></script>
<script src="/static/js/lay-config.js"></script>
SCRIPT;
}


if (!function_exists('readExcel')) {
    /**
     * @param $file
     * @param array $appendColumns
     * @param int $is_repeat_customer
     * @param int $limitNum
     * @return array
     */
    function readExcel($file, array $appendColumns = [], int $is_repeat_customer = 0, int $limitNum = 0): array
    {
        $read = \PhpOffice\PhpSpreadsheet\IOFactory::createReader(ucfirst($file->extension()));
        $spreadsheet = $read->load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();
        // 最大列索引（固定8列数据）
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
        $log = [];

        // 限制行数（从第二行开始）
        if ($limitNum && $highestRow >= ($limitNum + 1)) {
            $highestRow = $limitNum + 1;
        }

        for ($row = 2; $row <= $highestRow; $row++) {
            $data = [];
            for ($col = 1; $col <= 8; $col++) {
                $value = $sheet->getCell([$col, $row])->getValue();
                $data[] = $value ? trim($value) : '';
            }
            $rowData = array_combine([
                'title',
                'phone',
                'province',
                'email',
                'comment',
                'professional',
                'certificate',
                'contact'
            ], $data);
            $customer = null;
            if ($rowData['title'] && $rowData['phone'] && validateMobile($rowData['phone'])) {
                if (!$is_repeat_customer) {
                    $customer = \app\common\model\Customer::where([
                        'phone' => $rowData['phone'],
                        'company_id' => $appendColumns['company_id'],
                        'type' => $appendColumns['type'],
                    ])->findOrEmpty();
                }

                if (($customer && $customer->isEmpty()) || $is_repeat_customer) {
                    $log[] = array_merge($appendColumns, $rowData);
                }
            }
        }

        return $is_repeat_customer ? $log : array_intersect_key($log, array_unique(array_column($log, 'phone')));
    }
}

if (!function_exists('createToken')) {
    /**
     * @param string $password
     * @return string
     */
    function createToken(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}

if (!function_exists('getDateFormatInfo')) {
    /**
     * @param string|null $time
     * @return string
     */
    function getDateFormatInfo(string|null $time): string
    {
        if (!$time) {
            return '-';
        }

//    if (date('Y-m-d', $time) === date('Y-m-d', time())) {
//        return date('H:i:s', $time);
//    }
//
//    if (date('Y', $time) === date('Y', time())) {
//        return date('m-d H:i:s', $time);
//    }

        return date('Y-m-d H:i:s', $time);
    }
}

if (!function_exists('validateMobile')) {
    /**
     * 验证手机号
     *
     * @param string $mobile
     * @return bool
     */
    function validateMobile(string $mobile): bool
    {
        if (strlen($mobile) !== 11) {
            return false;
        }

        $prefix = substr($mobile, 0, 3);

        /**
         * 中国移动: 134/135/136/137/138/139/150/151/152/157/158/159/182/183/184/187/188/198
         * 中国联通: 130/131/132/155/156/185/186/166
         * 中国电信: 133/149/153/173/177/180/181/189/199
         */
        $prefixes = [
            '134',
            '135',
            '136',
            '137',
            '138',
            '139',
            '150',
            '151',
            '152',
            '157',
            '158',
            '159',
            '182',
            '183',
            '184',
            '187',
            '188',
            '198',
            '130',
            '131',
            '132',
            '155',
            '156',
            '185',
            '186',
            '166',
            '133',
            '149',
            '153',
            '173',
            '177',
            '180',
            '181',
            '189',
            '199'
        ];

        /**
         * 11 位手机号码
         * 带区号的11位电话号码
         * 带‘-’的11位电话号码
         */
        return (in_array($prefix, $prefixes, true) && preg_match('/^1[3-9]\d{9}$/', $mobile)) ||
            preg_match('/^0\d{2,3}\d{7,8}$/', $mobile) ||
            preg_match('/^(\d{3}-|\d{4}-)?\d{7,8}$/', $mobile);
    }
}


if (!function_exists('systemConfig')) {

    /**
     * 获取系统配置信息
     * @param string $group
     * @param string $name
     * @return array|mixed
     */
    function systemConfig(string $group, string $name = ''): array|string
    {
        $where = ['group_name' => $group];
        $value = empty($name) ? Cache::get("system_config_{$group}") : Cache::get("system_config_{$group}_{$name}");
        if (empty($value)) {
            if (!empty($name)) {
                $where['name'] = $name;
                $value = \app\admin\model\SystemConfig::where($where)->value('value');
                Cache::tag('system_config')->set("system_config_{$group}_{$name}", $value, 3600);
            } else {
                $value = \app\admin\model\SystemConfig::where($where)->column('value', 'name');
                Cache::tag('system_config')->set("system_config_{$group}", $value, 3600);
            }
        }
        return $value;
    }
}

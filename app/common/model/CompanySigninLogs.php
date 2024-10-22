<?php
/**
 * copyright@Administrator
 * 2023/8/21 0021 10:47
 * email:arron1118@icloud.com
 */

namespace app\common\model;

class CompanySigninLogs extends CommonModel
{

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}

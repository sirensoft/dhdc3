<?php

namespace components\rbac;

use yii\rbac\Rule;
use components\MyHelper;

class OnlyOwnHosRule extends Rule {

    public $name = 'OnlyOwnHosRule';

    public function execute($user_id, $item, $params) {
        return $params['data_hoscode'] == MyHelper::getUserHoscode($user_id);
    }

}

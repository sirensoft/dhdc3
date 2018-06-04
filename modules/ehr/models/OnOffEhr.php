<?php

namespace modules\ehr\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "log_ehr".
 *
 * @property string $status

 */
class OnOffEhr extends ActiveRecord {

    public static function tableName() {
        return 'ehr_onoff';
    }

    public static  function primaryKey() {
        return ['status'];
    }

    public function rules() {
        return [
            [['status'], 'safe']
        ];
    }

}

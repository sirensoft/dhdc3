<?php

namespace modules\ehr\models;

use Yii;

/**
 * This is the model class for table "log_ehr".
 *
 * @property integer $id
 * @property string $username
 * @property string $ip
 * @property string $patient_cid
 * @property string $datetime
 */
class LogEhr extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'log_ehr';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            
            [['username', 'ip', 'patient_cid','datetime'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'ip' => 'Ip',
            'patient_cid' => 'Patient Cid',
            'datetime' => 'Datetime',
        ];
    }
}

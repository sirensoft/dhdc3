<?php

namespace frontend\modules\qc\models;

use Yii;

/**
 * This is the model class for table "last_err_check".
 *
 * @property string $last_time
 */
class LastErrCheck extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'last_err_check';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['last_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'last_time' => 'Last Time',
        ];
    }
}

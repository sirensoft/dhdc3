<?php

namespace backend\modules\exec\models;

use Yii;

/**
 * This is the model class for table "last_transform".
 *
 * @property string $last_time
 */
class LastTransform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'last_transform';
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

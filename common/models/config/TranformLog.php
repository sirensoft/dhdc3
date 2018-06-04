<?php

namespace common\models\config;

use Yii;

/**
 * This is the model class for table "hdc_log".
 *
 * @property integer $id
 * @property string $p_date
 * @property string $p_name
 */
class TranformLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hdc_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['p_date'], 'required'],
            [['p_date'], 'safe'],
            [['p_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_date' => 'P Date',
            'p_name' => 'P Name',
        ];
    }
}

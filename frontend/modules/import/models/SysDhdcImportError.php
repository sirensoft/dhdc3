<?php

namespace frontend\modules\import\models;

use Yii;

/**
 * This is the model class for table "sys_dhdc_import_error".
 *
 * @property integer $id
 * @property string $date_err
 * @property string $err
 */
class SysDhdcImportError extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_dhdc_import_error';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_err'], 'safe'],
            [['err'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_err' => 'วันที่',
            'err' => 'ความผิดพลาด',
        ];
    }
}

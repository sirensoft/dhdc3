<?php

namespace frontend\modules\import\models;
use Yii;

/**
 * This is the model class for table "sys_file_not_import".
 *
 * @property integer $id
 * @property string $zip_name
 * @property string $file_name
 * @property string $date_time
 */
class SysFileNotImport extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_file_not_import';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_time'], 'safe'],
            [['zip_name', 'file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'zip_name' => 'Zip Name',
            'file_name' => 'File Name',
            'date_time' => 'Date Time',
        ];
    }
}

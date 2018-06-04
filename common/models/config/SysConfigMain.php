<?php

namespace common\models\config;

use Yii;

/**
 * This is the model class for table "sys_dhdc_config".
 *
 * @property integer $id
 * @property string $provcode
 * @property string $distcode
 * @property string $district_code
 * @property string $district_name
 * @property string $note1
 * @property string $note2
 * @property string $note3
 * @property string $note4
 * @property string $note5
 */
class SysConfigMain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_config_main';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['provcode', 'distcode', 'district_code', 'district_name', 'note1', 'note2', 'note3', 'note4', 'note5'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provcode' => 'Provcode',
            'distcode' => 'Distcode',
            'district_code' => 'รหัสอำเภอ 4 หลัก',
            'district_name' => 'ชื่ออำเภอ',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
            'note4' => 'Note4',
            'note5' => 'Note5',
        ];
    }
}

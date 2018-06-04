<?php

namespace common\models\config;

use Yii;

/**
 * This is the model class for table "chospital_amp".
 *
 * @property string $hoscode
 * @property string $hosname
 * @property string $hostype
 * @property string $address
 * @property string $road
 * @property string $mu
 * @property string $subdistcode
 * @property string $distcode
 * @property string $provcode
 * @property string $postcode
 * @property string $hoscodenew
 * @property string $bed
 * @property string $level_service
 * @property string $bedhos
 * @property integer $hdc_regist
 * @property string $dep
 * @property string $hmain_sent
 */
class ChospitalAmp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chospital_amp';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hoscode','hosname'], 'required'],
            [['hoscode'], 'unique'],
            [['hdc_regist'], 'integer'],
            [['hoscode', 'postcode', 'bed', 'bedhos', 'dep', 'hmain_sent'], 'string', 'max' => 5],
            [['hosname', 'level_service'], 'string', 'max' => 255],
            [['hostype', 'mu', 'subdistcode', 'distcode', 'provcode'], 'string', 'max' => 2],
            [['address', 'road'], 'string', 'max' => 50],
            [['hoscodenew'], 'string', 'max' => 9],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'hoscode' => 'รหัสหน่วยบริการ',
            'hosname' => 'ชื่อหน่วยบริการ',
            'hostype' => 'Hostype',
            'address' => 'Address',
            'road' => 'Road',
            'mu' => 'Mu',
            'subdistcode' => 'Subdistcode',
            'distcode' => 'Distcode',
            'provcode' => 'Provcode',
            'postcode' => 'Postcode',
            'hoscodenew' => 'Hoscodenew',
            'bed' => 'Bed',
            'level_service' => 'Level Service',
            'bedhos' => 'Bedhos',
            'hdc_regist' => 'Hdc Regist',
            'dep' => 'Dep',
            'hmain_sent' => 'Hmain Sent',
        ];
    }
    public function getFullname(){
        return $this->hoscode.'-'.$this->hosname;
    }
}

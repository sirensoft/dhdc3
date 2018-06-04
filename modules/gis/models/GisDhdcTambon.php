<?php

namespace modules\gis\models;

use Yii;

/**
 * This is the model class for table "gis_dhdc_tambon".
 *
 * @property string $PROV_CODE
 * @property string $AMP_CODE
 * @property string $TAM_CODE
 * @property string $TAM_NAMT
 * @property string $TAM_NAME
 * @property string $GIS_TYPE
 * @property string $COORDINATES
 * @property string $NOTE1
 * @property string $NOTE2
 * @property string $NOTE3
 * @property string $NOTE4
 * @property string $NOTE5
 */
class GisDhdcTambon extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gis_dhdc_tambon';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PROV_CODE', 'AMP_CODE', 'TAM_CODE'], 'required'],
            [['COORDINATES'], 'string'],
            [['PROV_CODE', 'AMP_CODE', 'TAM_CODE'], 'string', 'max' => 2],
            [['TAM_NAMT', 'TAM_NAME', 'GIS_TYPE', 'NOTE1', 'NOTE2', 'NOTE3', 'NOTE4', 'NOTE5'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PROV_CODE' => 'Prov  Code',
            'AMP_CODE' => 'Amp  Code',
            'TAM_CODE' => 'Tam  Code',
            'TAM_NAMT' => 'Tam  Namt',
            'TAM_NAME' => 'Tam  Name',
            'GIS_TYPE' => 'Gis  Type',
            'COORDINATES' => 'Coordinates',
            'NOTE1' => 'Note1',
            'NOTE2' => 'Note2',
            'NOTE3' => 'Note3',
            'NOTE4' => 'Note4',
            'NOTE5' => 'Note5',
        ];
    }
}

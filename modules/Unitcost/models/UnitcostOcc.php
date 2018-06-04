<?php

namespace modules\Unitcost\models;

use Yii;

/**
 * This is the model class for table "dhdc_module_unitcost_occ".
 *
 * @property string $HOSPCODE
 * @property string $OCC_CODE
 * @property string $OCC_NAME
 * @property double $COST
 * @property double $PRICE
 * @property double $TOTAL
 * @property double $PAYPRICE
 * @property string $TYPE
 */
class UnitcostOcc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhdc_module_unitcost_occ';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'OCC_CODE', 'OCC_NAME', 'COST', 'PRICE', 'TOTAL', 'PAYPRICE', 'TYPE'], 'required'],
            [['COST', 'PRICE', 'TOTAL', 'PAYPRICE','BYEAR'], 'number'],
            [['HOSPCODE', 'OCC_CODE'], 'string', 'max' => 5],
            [['OCC_NAME'], 'string', 'max' => 200],
            [['TYPE'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOSPCODE' => 'รหัสสถานบริการ',
            'OCC_CODE' => 'รหัสอาชีพ',
            'OCC_NAME' => 'อาชีพ',
            'COST' => 'ต้นทุน',
            'PRICE' => 'ราคาขาย',
            'TOTAL' => 'ราคาขาย-ต้นทุน',
            'PAYPRICE' => 'จ่ายจริง',
            'TYPE' => 'ประเภท',
            'BYEAR' => 'ปีงบ'
        ];
    }
}

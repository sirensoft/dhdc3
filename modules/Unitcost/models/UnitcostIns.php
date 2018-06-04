<?php

namespace modules\Unitcost\models;

use Yii;

/**
 * This is the model class for table "dhdc_module_unitcost_ins".
 *
 * @property string $HOSPCODE
 * @property string $INS_CODE
 * @property string $INS_NAME
 * @property double $COST
 * @property double $PRICE
 * @property double $TOTAL
 * @property double $PAYPRICE
 * @property string $TYPE
 */
class UnitcostIns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhdc_module_unitcost_ins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'INS_CODE', 'INS_NAME', 'COST', 'PRICE', 'TOTAL', 'PAYPRICE', 'TYPE'], 'required'],
            [['COST', 'PRICE', 'TOTAL', 'PAYPRICE','BYEAR'], 'number'],
            [['HOSPCODE', 'INS_CODE'], 'string', 'max' => 5],
            [['INS_NAME'], 'string', 'max' => 200],
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
            'INS_CODE' => 'Ins  Code',
            'INS_NAME' => 'กลุ่มสิทธิ์',
            'COST' => 'ต้นทุน',
            'PRICE' => 'ราคาขาย',
            'TOTAL' => 'ราคาขาย-ต้นทุน',
            'PAYPRICE' => 'จ่ายจริง',
            'TYPE' => 'ประเภท',
            'BYEAR' => 'ปีงบ'
        ];
    }
}

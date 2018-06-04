<?php

namespace modules\Unitcost\models;

use Yii;

/**
 * This is the model class for table "dhdc_module_unitcost".
 *
 * @property string $HOSPCODE
 * @property string $INCOME
 * @property string $INCOME_NAME
 * @property double $COST
 * @property double $PRICE
 * @property double $TOTAL
 */
class Unitcost extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhdc_module_unitcost';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'INCOME', 'INCOME_NAME', 'COST', 'PRICE','PAYPRICE','TYPE','TOTAL'], 'required'],
            [['COST', 'PRICE', 'TOTAL','PAYPRICE','BYEAR'], 'number'],
            [['HOSPCODE'], 'string', 'max' => 5],
            [['INCOME'], 'string', 'max' => 2],
            [['INCOME_NAME','TYPE'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'HOSPCODE' => 'รหัสถานบริการ',
            'INCOME' => 'หมวด',
            'INCOME_NAME' => 'ชื่อหมวด',
            'COST' => 'ต้นทุน',
            'PRICE' => 'ราคาขาย',
            'TOTAL' => 'ส่วนต่าง',
            'TYPE' => 'ประเภท',
            'PAYPRICE' => 'จ่ายจริง',
            'BYEAR' => 'ปีงบ'
        ];
    }
}

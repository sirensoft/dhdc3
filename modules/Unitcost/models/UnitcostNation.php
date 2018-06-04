<?php

namespace modules\Unitcost\models;

use Yii;

/**
 * This is the model class for table "dhdc_module_unitcost_nation".
 *
 * @property string $HOSPCODE
 * @property string $NATION
 * @property string $NATION_NAME
 * @property string $NATION_GROUP
 * @property string $NATION_GROUP_NAME
 * @property double $COST
 * @property double $PRICE
 * @property double $TOTAL
 * @property double $PAYPRICE
 * @property string $TYPE
 */
class UnitcostNation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dhdc_module_unitcost_nation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['HOSPCODE', 'NATION', 'NATION_NAME', 'NATION_GROUP', 'NATION_GROUP_NAME', 'COST', 'PRICE', 'TOTAL', 'PAYPRICE', 'TYPE'], 'required'],
            [['COST', 'PRICE', 'TOTAL', 'PAYPRICE','BYEAR'], 'number'],
            [['HOSPCODE', 'NATION', 'NATION_GROUP'], 'string', 'max' => 5],
            [['NATION_NAME', 'NATION_GROUP_NAME'], 'string', 'max' => 200],
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
            'NATION' => 'รหัสสัญชาติ',
            'NATION_NAME' => 'สัญชาตื',
            'NATION_GROUP' => 'กล่มสัญชาติ',
            'NATION_GROUP_NAME' => 'สัญชาติ AEC',
            'COST' => 'ต้นทุน',
            'PRICE' => 'ราคาขาย',
            'TOTAL' => 'ราคาขาย-ต้นทุน',
            'PAYPRICE' => 'จ่ายจริง',
            'TYPE' => 'ประเภท',
            'BYEAR' => 'ปีงบ'
        ];
    }
}

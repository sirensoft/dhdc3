<?php

namespace modules\Unitcost\models;

use Yii;

/**
 * This is the model class for table "cbyear".
 *
 * @property string $BYEAR
 * @property string $DATE1
 * @property string $DATE2
 * @property string $NOTE
 */
class Cbyear extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbyear';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['BYEAR', 'DATE1', 'DATE2'], 'required'],
            [['DATE1', 'DATE2'], 'safe'],
            [['BYEAR', 'NOTE'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'BYEAR' => 'Byear',
            'DATE1' => 'Date1',
            'DATE2' => 'Date2',
            'NOTE' => 'Note',
        ];
    }
}

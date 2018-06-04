<?php

namespace frontend\modules\hdc\models;

use Yii;

/**
 * This is the model class for table "hdc_rpt_sql".
 *
 * @property string $rpt_id
 * @property string $rpt_name
 * @property string $sql_indiv
 * @property string $note_indiv
 * @property string $sql_sum
 * @property string $note_sum
 * @property string $sql_check
 * @property string $tb_source
 * @property string $dupdate
 * @property string $note1
 * @property string $note2
 * @property string $note3
 */
class Hdcsql extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'hdc_rpt_sql';
    }
    
    public function beforeSave($insert) {
    if ($insert) {
        
        $this->dupdate = date("Y-m-d H:i:s");
    } else {
     
         $this->dupdate = date("Y-m-d H:i:s");
    }
    return parent::beforeSave($insert);
}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['rpt_id'], 'required'],
            [['sql_indiv', 'sql_sum', 'sql_check'], 'string'],
            [['dupdate'], 'safe'],
            [['rpt_id', 'rpt_name', 'tb_source','note_indiv','note_sum', 'note1', 'note2', 'note3'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'rpt_id' => 'ID',
            'rpt_name' => 'ชื่อรายงาน HDC',
            'sql_indiv' => 'คำสั่ง Individual SQL (รายบุคคล)',
            'note_indiv'=>'คำอธิบาย (รายบุคคล)',
            'sql_sum' => 'คำสั่ง Summary SQL (ผลรวม)',
            'note_sum'=>'คำอธิบาย (ผลรวม)',
            'sql_check' => 'Sql Check',
            'tb_source' => 'Tb Source',
            'dupdate' => 'Dupdate',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
        ];
    }
}

<?php

namespace frontend\modules\import\models;

use Yii;

/**
 * This is the model class for table "sys_files".
 *
 * @property string $file_name
 * @property string $qc
 * @property string $note1
 * @property string $note2
 * @property string $note3
 */
class SysFiles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_files';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name'], 'required'],
            [['qc'], 'number'],
            [['note3'], 'string'],
            [['file_name', 'note1', 'note2'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file_name' => 'File Name',
            'qc' => 'Qc',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
        ];
    }
}

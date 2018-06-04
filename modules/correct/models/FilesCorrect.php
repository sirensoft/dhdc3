<?php

namespace modules\correct\models;

use Yii;

/**
 * This is the model class for table "files_correct".
 *
 * @property string $filename
 * @property string $note1
 * @property string $note2
 * @property string $note3
 */
class FilesCorrect extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'files_correct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['filename'], 'required'],
            [['filename', 'note1', 'note2', 'note3'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'filename' => 'Filename',
            'note1' => 'Note1',
            'note2' => 'Note2',
            'note3' => 'Note3',
        ];
    }
}

<?php

namespace modules\adhoc\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "dhdc_adhoc_transform".
 *
 * @property integer $id
 * @property string $sql
 * @property string $date_begin
 * @property string $date_end
 * @property string $created_at
 * @property string $created_by
 * @property string $updated_at
 * @property string $updated_by
 */
class Transform extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'dhdc_adhoc_transform';
    }

    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className()
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => new \yii\db\Expression("NOW()")
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['sql'], 'required'],
            [['sql'], 'string'],
            [['date_begin', 'date_end', 'created_at', 'updated_at'], 'safe'],
            [['created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'sql' => 'Sql',
            'date_begin' => 'Date Begin',
            'date_end' => 'Date End',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

}

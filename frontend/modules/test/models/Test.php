<?php

namespace frontend\modules\test\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use dektrium\user\models\User;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $name
 * @property string $birth
 * @property integer $age
 * @property string $created_by
 * @property string $updated_by
 * @property string $created_at
 * @property string $updated_at
 */
class Test extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['birth', 'created_at', 'updated_at'], 'safe'],
            [['age'], 'integer'],
            [['name', 'created_by', 'updated_by'], 'string', 'max' => 255],
        ];
    }

    public function behaviors() {
        return [
            [
                'class' => BlameableBehavior::className()
            ],
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression("NOW()")
            ]
        ];
    }

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->age = (int)(date('Y') - date('Y',strtotime($this->birth)));
            
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'birth' => 'Birth',
            'age' => 'Age',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function getUser(){
        return $this->hasOne(User::className(), ['id'=>'created_by']);
    }

}

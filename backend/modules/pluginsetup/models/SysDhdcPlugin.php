<?php

namespace backend\modules\pluginsetup\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "sys_dhdc_plugin".
 *
 * @property integer $id
 * @property string $name
 * @property string $mod_name
 * @property string $route
 * @property string $type
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
class SysDhdcPlugin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_dhdc_plugin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','route','type','status','mod_name'],'required'],
            [['type','status','mod_name'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'route'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'mod_name'=>'Module Name',
            'route' => 'Routing',
            'type' => 'Type',
            'status'=>'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
    public function behaviors() {
        return[
            [
                'class'=>  TimestampBehavior::className(),
                'value'=>new \yii\db\Expression("NOW()")
            ]
        ];
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_transform".
 *
 * @property integer $id
 * @property string $t_name
 * @property string $t_sql
 * @property string $active
 * @property string $bycase
 * @property string $version
 */
class SysTransform extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_transform';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['t_sql'], 'string'],
            [['t_name'], 'string', 'max' => 100],
            [['active'], 'string', 'max' => 1],
            [['bycase'], 'string', 'max' => 15],
            [['version'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            't_name' => 'T Name',
            't_sql' => 'T Sql',
            'active' => 'Active',
            'bycase' => 'Bycase',
            'version' => 'Version',
        ];
    }
}

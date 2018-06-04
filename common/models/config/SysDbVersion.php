<?php

namespace common\models\config;

use Yii;

/**
 * This is the model class for table "sys_db_version".
 *
 * @property string $version
 */
class SysDbVersion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_db_version';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['version'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'version' => 'Version',
        ];
    }
}

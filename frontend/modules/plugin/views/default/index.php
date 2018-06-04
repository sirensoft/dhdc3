<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use backend\modules\pluginsetup\models\SysDhdcPlugin;
use yii\helpers\Url;
$this->params['breadcrumbs'][]="ระบบงาน";

$models = SysDhdcPlugin::find()->where(['status'=>'on'])->all();
?>
<div class="container">
    <div class="row">
        <?php foreach ($models as $model) : ?>
            <div class="col-lg-4" style="vertical-align: top;display: inline-block;text-align: center;">
                <?php
                $img = '@web/images/mod.png';
                $win_type = '_self';
                if ($model->type == 'app') {
                    $route = $model->route;
                    $win_type = '_blank';
                    $img = '@web/images/app.png';
                } else {
                    $route = Url::to([$model->route]);
                }
                ?>
                <a href="<?= $route ?>" target="<?= $win_type ?>">
                    <div style="margin-top: 15px">                        
                        <?= Html::img($img, ['class' => 'img', 'width' => '125px', 'height' => '100px']) ?>
                        <span style="display: block;color: #007788;"><?= $model->name ?></span>
                    </div>
                </a>
            </div>
        
        <?php endforeach; ?>
    </div>
</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\plugin\models\SysDhdcPlugin */

$this->title = 'ปรับปรุง Plugin: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการ Plugin', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ปรับปรุง';
?>
<div class="sys-dhdc-plugin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\plugin\models\SysDhdcPlugin */

$this->title = 'เพิ่ม';
$this->params['breadcrumbs'][] = ['label' => 'จัดการ Plugin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-dhdc-plugin-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

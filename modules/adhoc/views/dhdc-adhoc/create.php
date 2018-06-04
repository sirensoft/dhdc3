<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\adhoc\models\DhdcAdhoc */

$this->title = 'เพิ่ม';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dhdc-adhoc-create">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

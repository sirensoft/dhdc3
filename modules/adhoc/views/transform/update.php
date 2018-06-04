<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model modules\adhoc\models\Transform */

$this->title = 'Update Transform: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Transforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="transform-update">

   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

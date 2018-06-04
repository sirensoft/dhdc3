<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hdcsql */

$this->title = 'Update Hdcsql: ' . ' ' . $model->rpt_id;
$this->params['breadcrumbs'][] = ['label' => 'Hdcsqls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->rpt_id, 'url' => ['view', 'id' => $model->rpt_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hdcsql-update">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\SysDhdcImportError */

$this->title = 'Update Sys Dhdc Import Error: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sys Dhdc Import Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sys-dhdc-import-error-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

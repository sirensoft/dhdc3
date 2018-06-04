<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\SysDhdcImportError */

$this->title = 'Create Sys Dhdc Import Error';
$this->params['breadcrumbs'][] = ['label' => 'Sys Dhdc Import Errors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-dhdc-import-error-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\HdcsqlSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hdcsql-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'rpt_id') ?>

    <?= $form->field($model, 'rpt_name') ?>

    <?= $form->field($model, 'sql_indiv') ?>

    <?= $form->field($model, 'sql_sum') ?>

    <?= $form->field($model, 'sql_check') ?>

    <?php // echo $form->field($model, 'tb_source') ?>

    <?php // echo $form->field($model, 'dupdate') ?>

    <?php // echo $form->field($model, 'note1') ?>

    <?php // echo $form->field($model, 'note2') ?>

    <?php // echo $form->field($model, 'note3') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

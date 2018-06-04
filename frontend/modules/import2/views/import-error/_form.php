<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\SysDhdcImportError */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-dhdc-import-error-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_err')->textInput() ?>

    <?= $form->field($model, 'err')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

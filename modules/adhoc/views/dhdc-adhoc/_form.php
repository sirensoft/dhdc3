<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model modules\adhoc\models\DhdcAdhoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dhdc-adhoc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sql_indiv')->textarea(['rows' => 8]) ?>
   <?= $form->field($model, 'desc_indiv')->textInput(['maxlength' => true]) ?>    
    <?= $form->field($model, 'sql_sum')->textarea(['rows' => 12]) ?>
     <?= $form->field($model, 'desc_sum')->textInput(['maxlength' => true]) ?>
    
     <?= $form->field($model, 'type')->textInput() ?>

 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'เพิ่ม' : 'บันทึก', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

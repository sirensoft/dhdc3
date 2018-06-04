<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\plugin\models\SysDhdcPlugin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-dhdc-plugin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'mod_name')->textInput() ?>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'module' => 'Module', 'app' => 'App', ], ['prompt' => '']) ?>
     <?= $form->field($model, 'status')->dropDownList([ 'on' => 'On', 'off' => 'Off', ], ['prompt' => '']) ?>

  

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-ok"></i> บันทึก', ['class' => 'btn btn-green' ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

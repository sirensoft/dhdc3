<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
    'id'=>'chospital-form',
]);

echo $form->field($model,'hoscode')->textInput();
echo $form->field($model,'hosname')->textInput();
echo Html::button('<i class="glyphicon glyphicon-ok"></i>บันทึก', ['class'=>'btn btn-success','type'=>'submit']);

ActiveForm::end();


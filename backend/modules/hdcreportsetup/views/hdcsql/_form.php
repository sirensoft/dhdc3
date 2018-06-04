<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\Hdcsql */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hdcsql-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $sql = "SELECT t.cat_id,t.category_name cat_name from sys_reportcategory_dhdc t";
    $array = \Yii::$app->db->createCommand($sql)->queryAll();
    $items = ArrayHelper::map($array,'cat_id', 'cat_name');
    
    $sql = "SELECT t.cat_id FROM sys_report_dhdc t WHERE t.id = '$model->rpt_id'";
    $select =\Yii::$app->db->createCommand($sql)->queryOne();
    
    $select = empty($select['cat_id'])?'':$select['cat_id'];
    echo Html::dropDownList('cat_id',$select, $items,['prompt'=>'-- หมวดรายงาน --']);
    
    if($model->isNewRecord){
        $model->rpt_id = uniqid();
    }     
    
    ?>
    
    <?= $form->field($model, 'rpt_id')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'rpt_name')->textInput(['maxlength' => true]) ?>
    <hr>
    <?= $form->field($model, 'sql_sum')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'note_sum')->textInput(['maxlength' => true]) ?>
    <hr>
    <?= $form->field($model, 'sql_indiv')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'note_indiv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tb_source')->textInput(['maxlength' => true]) ?>

 

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

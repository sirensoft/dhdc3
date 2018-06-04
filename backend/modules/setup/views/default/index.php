<?php

use yii\widgets\ActiveForm;
use common\models\config\ChospitalAmp;
use yii\data\ActiveDataProvider;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$css = <<< CSS
.alignment
{
    margin-top:25px;
}
CSS;
$this->registerCss($css);

$this->params['breadcrumbs'][] = "ตั้งค่าอำเภอ"
?>


<div class="panel panel-danger">
    <div class="panel-heading">
        <h3 class="panel-title">รายละเอียด</h3>
    </div>
    <div class="panel-body">           
        <?php $form = ActiveForm::begin(); ?>
        <div class="form-group row">
            
            <div class="col-sm-4 ">
                <div class="input-group">
                    <?= $form->field($model, 'district_code') ?>
                    <span class="input-group-btn">

                        <button class="btn btn-default alignment" type="submit" id="btn_find_hdc" data-confirm="การกระทำนี้จะเริ่มต้นรายการหน่วยบริการใหม่ทั้งหมด" >
                            <i class="glyphicon glyphicon-ok"></i>
                        </button>
                    </span> 
                </div>
            </div>

        </div>
        <div class="form-group row">
            <div class="col-sm-4 ">
                <span style="color: blue; font-size: x-large">อ.<?= $model->district_name ?></span>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>        
</div>
<div>
    <?php
    $hos = ChospitalAmp::find();
    $dataProvider = new ActiveDataProvider([
        'query' => $hos,
        'pagination' => [
            'pageSize' => 30
        ]
    ]);

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => FALSE,
        'toolbar' => [
            ['content' =>
                Html::a('<i class="glyphicon glyphicon-plus"></i> เพิ่ม', '#', ['class' => 'btn btn-default btn-create']) .
                '{toggleData}'
            //'{export}'
            ],
        ],
        'panel' => [
            'type' => 'info',
            'heading' => 'เพิ่ม-ลบ-แก้ไข หน่วยบริการได้ที่ตาราง chospital_amp',
            'before' => ''
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'hoscode:text:รหัสหน่วยบริการ',
            'hosname:text:ชื่อหน่วยบริการ',
            [
                //'label' => '',
                'format' => 'raw',
                'value' => function($model) {
                    return
                            Html::a('<i class="glyphicon glyphicon-pencil"></i>', '#', ['class' => 'btn btn-info btn-update', 'data-hos' => $model->hoscode]) . " " .
                            Html::a('<i class="glyphicon glyphicon-remove"></i>', ['/setup/chospital/delete', 'hoscode' => $model->hoscode], ['class' => 'btn btn-danger', 'data-method' => 'POST', 'data-confirm' => 'ยืนยันการลบ?']);
                }
                    ]
                ]
            ]);
            ?>
        </div>

        <?php
        Modal::begin([
            'header' => 'แก้ไขหน่วยบริการ',
            'size' => 'modal-md',
            'id' => 'modal-update',
        ]);
        echo "<div id='modalContent'>Loading...</div>";
        Modal::end();
        ?>

        <?php
        Modal::begin([
            'header' => 'เพิ่มหน่วยบริการ',
            'size' => 'modal-md',
            'id' => 'modal-create',
        ]);
        echo "<div id='modalContent'>Loading...</div>";
        Modal::end();
        ?>

        <?php
        $route_update = Url::to(['/setup/chospital/update']);
        $route_create = Url::to(['/setup/chospital/create']);
        $js = <<<JS
$('.btn-update').click(function(){
   var hoscode = $(this).data('hos');
   $('#modal-update').modal('show').find('#modalContent').load('$route_update?hoscode='+hoscode);
   
});

$('.btn-create').click(function(){
   
   $('#modal-create').modal('show').find('#modalContent').load('$route_create');
   
});
                
JS;
        $this->registerJs($js);
        ?>




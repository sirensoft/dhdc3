<?php

//use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\Pjax;


$this->params['breadcrumbs'][] = ['label' => 'รายการไฟล์', 'url' => ['/import/upload/index']];
$this->params['breadcrumbs'][] = 'ปริมาณข้อมูล';
?>
 <?php Pjax::begin();?>
<div class='well'>
     <?php
    ActiveForm::begin([
        'method' => 'get',
        'action' => Url::to(['/import/count-file/index']),
    ]);
    ?>

        <?php
        $sql = "SELECT DISTINCT t.tb FROM sys_dhdc_count_file t ORDER BY t.tb DESC";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $items = ArrayHelper::map($rawData, 'tb', 'tb');
        echo Html::dropDownList('tb', $tb, $items, ['prompt' => '--- แฟ้ม ---']);
        ?>

        <?php
        $sql = "SELECT DISTINCT t.b_year FROM sys_dhdc_count_file t ORDER BY t.b_year DESC";
        $rawData = \Yii::$app->db->createCommand($sql)->queryAll();
        $items = ArrayHelper::map($rawData, 'b_year', 'b_year');
        echo Html::dropDownList('b_year', $b_year, $items, ['prompt' => '--- ปีงบประมาณ ---']);
        ?>    

   <?php
    echo Html::submitButton(' ตกลง ', ['class' => 'btn btn-danger']);
    ActiveForm::end();
    ?>
</div>
<?php
$a = substr($b_year, 2) - 1;
$b = substr($b_year, 2);
echo GridView::widget([
    'floatHeader'=>true,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '0'],
    'responsiveWrap'=>FALSE,
    'dataProvider' => $dataProvider,
    'panel' => [
        'before' => 'ประมวลผลล่าสุด ' . $last_process
    ],
    'export' => [
        'showConfirmAlert' => false,
        'target' => GridView::TARGET_BLANK
    ],
    //'pjax' => true,
    'columns' => [
        [
            'attribute' => 'hoscode',
            'label' => 'หน่วยบริการ',
            'value' => function($data) {
                return $data['hoscode'] . "-" . $data['hosname'];
            }
        ],
        [
            'attribute' => 'tb',
            'label' => 'แฟ้ม',
            'value' => function ($data) use ($tb) {
                return $tb;
            }
        ],
        [
            'attribute' => 'm10',
            'label' => "ต.ค.$a",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m10'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
            }
        ],
        [
            'attribute' => 'm11', 
            'label' => "พ.ย.$a", 
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m11'] <= 0) {
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
        [
            'attribute' => 'm12', 
            'label' => "ธ.ค.$a", 
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m12'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                } 
             }
        ],
        [
            'attribute' => 'm01',
            'label' => "ม.ค.$b",
            'contentOptions' => function ($data) use ($tb) {
               if ($tb == 'service' and $data['m01'] <= 0){
                   return ['style' => 'background-color:#FF0000;color:white'];                   
               }
            }
        ],
        [
            'attribute' => 'm02',
            'label' => "ก.พ.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m02'] <= 0)
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
        ],
        [
            'attribute' => 'm03',
            'label' => "มี.ค.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m03'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'm04',
            'label' => "เม.ย.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m04'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'm05',
            'label' => "พ.ค.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m05'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'm06',
            'label' => "มิ.ย.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m06'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'm07',
            'label' => "ก.ค.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m07'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'm08',
            'label' => "ส.ค.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m08'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'm09',
            'label' => "ก.ย.$b",
            'contentOptions' => function ($data) use ($tb) {
                if ($tb == 'service' and $data['m09'] <= 0){
                    return ['style' => 'background-color:#FF0000;color:white'];
                }
            }
        ],
        [
            'attribute' => 'total',
            'label' => "รวม",
            'contentOptions' => [
                'style' => 'background-color:blue;color:white'
            ]
        ],
    ]//columns
]);
      
        ?>
 <?php Pjax::end();?> 



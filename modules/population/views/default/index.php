<?php

use yii\helpers\Html;
use components\MyHelper;
use miloschuman\highcharts\HighchartsAsset;
use yii\helpers\ArrayHelper;
use common\models\config\ChospitalAmp;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\grid\GridView;

HighchartsAsset::register($this)->withScripts([
    'highcharts-more',
    'themes/grid'
]);
$this->params['breadcrumbs'][] = "ข้อมูลประชากร";
?>
<?php if (MyHelper::user_can('Admin')): ?>
   
<?php endif; ?>

<div class="dropdown">
    <div class="well">
        <?php
        ActiveForm::begin([
            'method' => 'get',
            'action' => Url::to(['index'])
        ]);
        ?>
        <div class="row">
            <div class="col-sm-3">
                <?php
                $items = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'hosname');
                echo Html::dropDownList('hospcode', $hospcode, $items, [
                    'prompt' => 'เลือกสถานบริการ',
                    'class' => 'form-control'
                ]);
                ?>

            </div>
            <div class="col-sm-3">
                <button class="btn btn-danger">ตกลง</button>
               
            </div>
            <div class="col-sm-3">
                 <?= Html::a('TYPEAREA', ['typearea'], ['class' => 'btn btn-blue']) ?>
                <?= Html::a('ความหนาแน่น', ['map'], ['class' => 'btn btn-purple pull-right','target'=>'_blank']) ?>
            </div>

        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>
</div>
<div id="pyramid">   

</div>

<?php
$male = [];
$female = [];
$category = [];
foreach ($raw5 as $value) {
    $male[] = $value['MALE'] * (-1);
    $female[] = $value['FEMALE'] * (1);
    $category[] = $value['AGE_GROUP'];
}

//คำนวณค่า max , min 
if(count($male)==0 || count($female)==0){
    $max=0;
}else{
    $max_female = max($female);
    $max_male = abs(min($male));
    $max = $max_female > $max_male ? $max_female : $max_male;
}

$male = json_encode($male);
$female = json_encode($female);
$category = json_encode($category);


$js = <<<JS
  
        $('#pyramid').highcharts({
            colors: ['#ED921C', '#1F7CDB'],
            chart: {
                type: 'bar',
                //plotBackgroundImage:'./images/bg_pop.png',
                height:460
            },
            credits:{'enabled':false},
            title: {
                text: 'ปิรามิดประชากร $hospcode'
            },           
            subtitle: {
                text: ' ข้อมูลจากตาราง t_person_cid'
            },
            xAxis: [{
                categories: $category,
                reversed: false,
                labels: {
                    step: 1
                }
            }, { 
                opposite: true,
                reversed: false,
                categories: $category,
                linkedTo: 0,
                labels: {
                    step: 1
                }
            }],
            yAxis: {
                title: {
                    text: null
                },
                labels: {
                    formatter: function () {
                        return (Math.abs(this.value));
                    }
                },
                min: -$max,
                max: $max
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
            tooltip: {
                formatter: function () {
                    return '<b>' + this.series.name + ', อายุ ' + this.point.category + '</b><br/>' +
                        'ประชากร: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
                }
            },
            series: [{
                name: 'ชาย',
                data: $male
            }, {
                name: 'หญิง',
                data: $female
            }]
        });
JS;
$this->registerJs($js);
?>





<div class="pop-grid">
<?php
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'responsiveWrap'=>false,
    'panel'=>['before'=>'ข้อมูลประชากร'],
    'columns'=>[
        'AGE_GROUP:text:ช่วงอายุ(ปี)',
        'MALE:integer:ชาย',
        'FEMALE:integer:หญิง',
        'TOTAL:integer:รวม'
    ]
]);

?>
</div>

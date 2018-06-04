<?php
use yii\helpers\Html;
use modules\Unitcost\models\ChospitalAmp;
use modules\Unitcost\models\Unitcost;
use modules\Unitcost\models\Sysconfigmain;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;
use yii\helpers\Json;
use miloschuman\highcharts\HighchartsAsset;
use miloschuman\highcharts\Highcharts;
HighchartsAsset::register($this)->withScripts([
    'highcharts-more',
    'themes/grid'
]);
?>
<div class="Unitcost-default-index">
<?php
$this->params['breadcrumbs'][] = ['label' => 'UNITCOST', 'url' => ['/Unitcost/default/index']];
$this->params['breadcrumbs'][] = "ต้นทุนความค่าบริการ ผู้ป่วยนอก";
?>

<div class="well">
<?php 
	$form = ActiveForm::begin([
				'method'=>'Post',
				'action'=>Url::to(['/Unitcost/default/costopd']),
			]);
?>
    <div class="row">
        <div class="col-sm-3">
            <?php
           // $list = yii\helpers\ArrayHelper::map(Unitcost::find()->select('BYEAR')->groupBy('BYEAR')->all(), 'BYEAR', 'BYEAR');
            echo yii\helpers\Html::dropDownList('BYEAR',$BYEAR, ['2018'=>'2561', '2017'=>'2560','2016'=>'2559'], 
                [
                    'prompt' => 'เลือกปีงบประมาณ',
                    'class' => 'form-control'
                ]);
            ?>
        </div>
        <div class="col-sm-3">
            <?php
            $list = yii\helpers\ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'hosname');
            echo yii\helpers\Html::dropDownList('hospcode',$hospcode, $list, [
                'prompt' => 'เลือกสถานบริการ',
                'class' => 'form-control'
            ]);
            ?>
        </div>
        <div class="col-sm-3">
            <button class="btn btn-danger">ตกลง</button>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$BYEAR = $BYEAR+543;
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsiveWrap' => false,
    'panel' => ['before' => '<h3>ต้นทุนความค่าบริการ ผู้ป่วยนอก Unitcost '.$hosname.' ปีงบ '.$BYEAR.'</h3>'],
    'columns' => [
        //'HOSPCODE',
        'INCOME',
        'INCOME_NAME',
        [
            'attribute' =>'COST',
            'format'=>['decimal',2]
        ],
        [
            'attribute' =>'PRICE',
            'format'=>['decimal',2]
        ],
        [
            'attribute' =>'PAYPRICE',
            'format'=>['decimal',2]
        ],
        /*[
            'attribute' =>'TOTAL',
            'format'=>['decimal',2]
        ],*/
    ]
]);
?>
</div>
<div id="container"></div>
<?php

$raw = $dataProvider->getModels();

foreach($raw as $value){
        $categories[] = $value['INCOME_NAME'];
}
$categories =  str_replace('"',"'",Json::encode($categories));
foreach($raw as $value){
        $cost[] =  $value['COST'];
}
$cost =  str_replace('"',"",Json::encode($cost));
foreach($raw as $value){
        $price[] =  $value['PRICE'];
}
$price =  str_replace('"',"",Json::encode($price));
foreach($raw as $value){
        $pay[] =  $value['PAYPRICE'];
}
$pay =  str_replace('"',"",Json::encode($pay));
?>
<?php
$js=<<<JS
Highcharts.chart('container', {
    chart: {
        type: 'bar',
        height:520
    },
    title: {
        text: 'ต้นทุนความค่าบริการ ผู้ป่วยนอก $hosname'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: $categories,
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'ค่าใช้จ่าย (บาท)',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: '(บาท)'
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'COST',
        data: $cost
    }, {
        name: 'PRICE',
        data: $price
    }, {
        name: 'PAY',
        data: $pay
    },]
});
JS;
$this->registerJs($js);


?>


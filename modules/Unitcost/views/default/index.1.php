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
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลค่าบริการ', 'url' => ['index']];
//$this->params['breadcrumbs'][] = "แบ่งตาม TYPEAREA";
?>

<div class="well">
<?php 
	$form = ActiveForm::begin([
				'method'=>'Post',
				'action'=>Url::to(['/Unitcost/default/index']),
			]);
?>
    <div class="row">
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
echo \kartik\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'responsiveWrap' => false,
    'panel' => ['before' => 'ข้อมูลค่าบริการในสถานบริการ Unitcost'],
    'columns' => [
        'HOSPCODE',
        'INCOME',
        'INCOME_NAME',
        //'COST',
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
        [
            'attribute' =>'TOTAL',
            'format'=>['decimal',2]
        ],
    ]
]);
?>
</div>
<div id="container"></div>
<?php


$raw = $dataProvider->getModels();

//$data = [];
//$categories=[];
foreach($raw as $value){
    //if($value['INCOME']!='00'){
        $categories[] = $value['INCOME_NAME'];
    //}
}
$categories =  str_replace('"',"'",Json::encode($categories));
//echo ($categories);
foreach($raw as $value){
    //if($value['INCOME']!='00'){
        $cost[] =  $value['COST'];
    //}

}
$cost =  str_replace('"',"",Json::encode($cost));
//echo $cost;
foreach($raw as $value){
    //if($value['INCOME']!='00'){
        $price[] =  $value['PRICE'];
    //}
}
$price =  str_replace('"',"",Json::encode($price));
//echo $price;
/*foreach($raw as $value){
    if($value['INCOME']!='00'){
        $data[]= [  'name'=> 'PRICE', 
                    'data'=> $value['PRICE']
                    ];
    }
}

$price =  str_replace('"',"'",Json::encode($data));
echo $price;
*/

?>
<?php
$js=<<<JS
Highcharts.chart('container', {
    chart: {
        type: 'bar',
        height:520
    },
    title: {
        text: 'UnitCost $hosname'
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
    }, ]
});
JS;
$this->registerJs($js);


?>


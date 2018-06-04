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
$this->params['breadcrumbs'][] = "ประเมินค่าใช้จ่ายจริงในสถานบริการ";
?>

<div class="well">
<?php 
	$form = ActiveForm::begin([
				'method'=>'Post',
				'action'=>Url::to(['/Unitcost/default/price']),
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
    'panel' => ['before' => '<h3>ต้นทุนความค่าบริการ '.$hosname.' ปีงบ '.$BYEAR.'</h3>'],
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
            'attribute' =>'TOTAL',
            'label' =>'ราคาขาย-ต้นทุน',
            'format'=>['decimal',2]
        ],
        [
            'attribute' =>'PAYPRICE',
            'format'=>['decimal',2]
        ],
        [
            'label' =>'จ่ายจริง-ราคาขาย',
            'format'=>['decimal',2],
            'value' => function($model){ 
                                        $sum =  ($model->PAYPRICE)-($model->PRICE); 
                                        return  $sum  ;
                                        },
        ],
    ]
]);
?>
</div>



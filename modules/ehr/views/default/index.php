<?php
/* @var $this yii\web\View */

use yii\helpers\Url;
//use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Html;
use kartik\grid\GridView;
use yii\jui\Tabs;
use kartik\tabs\TabsX;
use yii\i18n\Formatter;
$formatter = new Formatter();

?>
<h1><p align="center"> Electronic Health Record (EHR)</p></h1>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-search"></i> ค้นหาผู้ป่วย</div>
            <div class="panel-body">

                <?= Html::beginForm(); ?>

                <label for="pwd">เลขบัตรประชาชน 13 หลัก : &nbsp;&nbsp; </label>
                <input type="text"  name="cid"  placeholder="">


                &nbsp;&nbsp;<button class='btn btn-danger'>ค้นหา</button>
                <?= Html::endForm(); ?>


            </div>
        </div>
    </div>
</div>

<?php if ($cid <> '') { ?>



    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-id-card-o"></i>&nbsp;&nbsp;ข้อมูลบุคคล</div>
                <div class="panel-body">

                    <?php
                    if ($sex == '1') {
                        $ipath = Yii::$app->request->baseUrl . '/images/men.png';
                    } else {
                        $ipath = Yii::$app->request->baseUrl . '/images/women.png';
                    }
                    ?>


                    <div class="row" >
                        <div class="col-md-2">
                            <img src="<?= $ipath ?>" class="img-circle" alt="User Image" height="100" width="100" >
                        </div>
                        <div class="col-md-10">
                            <p> ชื่อ-สกุล  : <?= $tname ?>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เลขบัตรประชาชน : <?=$cid?> </p>
                            <p> ที่อยู่  : <?= $taddr ?></p>
                            <p> โรคประจำตัว  : <?= $chronic ?></p>
                            <p> วันเกิด  : <?= $formatter->asDate($birth) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-info">
                <div class="panel-heading"><i class="fa fa-calendar-check-o"></i>&nbsp;&nbsp;วันที่รับบริการ</div>
                <div class="panel-body">
   

                    <?php
                    $gridColumns = [
                            ['class' => 'kartik\grid\SerialColumn'],
                            [
                            'attribute' => 'tdate',
                            'label' => 'วัน/เวลามารับบริการ',
                            'value' => function ($model, $key, $index, $widget) {
                                if ($model['tadmit'] === 'N') {
                                    return "<font  color='000000'>" . $model['tdate'] . "</font>";
                                } else {
                                    return "<font  color='ff0066'>" . $model['tdate'] . "</font>";
                               
                                }
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'vAlign' => 'middle',
                            'format' => 'raw',
                            'width' => '150px',
                            'noWrap' => true
                        ],
                           
                            [
                            'attribute' => 'hospcode',
                            'label' => 'สถานที่',
                            'value' => function($model, $key) {
                                return Html::a($model['hospcode'], ['/ehr', 'hospcode' => $model['hospcode'],
                                            'pid' => $model['pid'],
                                            'an' => $model['an'],
                                            'seq' => $model['seq']], ['title' => $model['hospname'],
                                ]);
                            },
                            'filterType' => GridView::FILTER_COLOR,
                            'hAlign' => 'center',
                            'format' => 'raw',
                        ]
                    ];

                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        //'filterModel' => $searchModel,
                        'autoXlFormat' => true,
                        'export' => [
                            'fontAwesome' => true,
                            'showConfirmAlert' => false,
                            'target' => GridView::TARGET_BLANK
                        ],
                        'columns' => $gridColumns,
                        'resizableColumns' => true,
                        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
                            //'floatHeader' => true,
                            //'floatHeaderOptions' => ['scrollingTop' => '100'],
                            /* 'pjax' => true,
                              'pjaxSettings' => [
                              'neverTimeout' => true,
                              //'beforeGrid' => 'My fancy content before.',
                              //'afterGrid' => 'My fancy content after.',
                              ] */
                    ]);
                    ?>



                </div>
            </div>
        </div>
    <?php } ?>    
    <?php if ($hospcode <> '') { ?>    
        <div class="col-md-9">
            <div class="panel panel-primary">
                <div class="panel-heading"><i class="fa fa-th-large"></i>&nbsp;&nbsp; รายละเอียด</div>
                <div class="panel-body">
                    <?php
                    echo TabsX::widget([
                        'position' => TabsX::POS_ABOVE,
                        'align' => TabsX::ALIGN_LEFT,
                        'items' => [
                                [
                                'label' => 'อาการ/วินิจฉัย',
                                'content' => $this->render('diag', [
                                    'dataProvider' => $dataProvideri,
                                    'dateserv' => $dateserv,
                                       'cc'=>$cc,
                                       'sbp'=>$sbp,
                                       'dbp'=>$dbp,
                                       'pr'=>$pr,
                                       'rr'=>$rr,
                                       'btemp'=>$btemp,
                                       'timeserv'=>$timeserv,
                                       'hospname'=>$hospname,
                                       'hospcode'=>$hospcode,
                                    
                                ]),
                                'active' => true
                            ],
                                [
                                'label' => 'ยา',
                                'content' => $this->render('drug', [
                                        'dataProvider' => $dataProviderdr,
                                ]),
                            ],
                                [
                                'label' => 'Lab',
                                'content' => $this->render('lab', [
                                    'dataProvider' => $dataProviderl,
                                ]),
                            ],
                            /*  [
                              'label' => 'หัตถการ',
                              'content' => $this->render('diag', [
                              //'searchModel' => $searchModel,
                              //'dataProvider' => $dataProvider,
                              ]),
                              'headerOptions' => ['style' => 'font-weight:bold'],
                              'options' => ['id' => 'lab'],
                              ], */
                                [
                                'label' => 'วัคซีน',
                                'content' => "รออัพเดท",
                                'headerOptions' => ['style' => 'font-weight:bold'],
                                'options' => ['id' => 'myveryownID'],
                            ],
                                [
                                'label' => 'ANC',
                                'content' => "รออัพเดท",
                                'headerOptions' => ['style' => 'font-weight:bold'],
                                'options' => ['id' => 'myveryownID'],
                            ],
                        /* [
                          'label' => 'Dropdown',
                          'items' => [
                          [
                          'label' => 'DropdownA',
                          'content' => 'DropdownA, Anim pariatur cliche...',
                          ],
                          [
                          'label' => 'DropdownB',
                          'content' => 'DropdownB, Anim pariatur cliche...',
                          ],
                          ],
                          ], */
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<?php
$this->registerJs('');
?>



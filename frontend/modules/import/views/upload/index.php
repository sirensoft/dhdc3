<?php

use yii\helpers\Html;
use yii\grid\GridView;
use components\MyHelper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UploadFortythreeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'รายการไฟล์');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-fortythree-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row" style="margin-bottom: 5px">
        <div class="col-xs-6">
            <?=
            Html::a(Yii::t('app', '{modelClass}', [
                        'modelClass' => '<i class="glyphicon glyphicon-open"></i> Upload 43 แฟ้ม',
                    ]), ['create'], ['class' => 'btn btn-blue'])
            ?>
            <?= Html::a('ปริมาณข้อมูล', ['count-file/index'], ['class' => 'btn btn-orange']) ?>
        </div>
        <div class="col-xs-6">
            <?php if (MyHelper::user_can('Admin')): ?>
                <div class="button-group pull-right">
                    <?= Html::a('<i class="glyphicon glyphicon-info-sign"></i> ข้อผิดพลาด', ['/import/import-error/index'], ['class' => 'btn btn-red']) ?>
                </div>
            <div class="button-group pull-right" style="margin-right: 5px">
                    <?= Html::a("รอนำเข้า $zip", ['/import/upload/importall'], ['class' => 'btn btn-green']) ?>
                </div>

            <?php endif; ?>
        </div>

    </div>

    <?=
    kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>TRUE,
        'responsiveWrap' => FALSE,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        //'floatHeader' => true,
        'pjax' => TRUE,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'hospcode',
            [
                'attribute' => 'file_name',
                'format' => 'raw',
                'value' => function ($data) {
                    if ($data->note3 === 'import all') {
                        return Html::a($data->file_name, array('detail2', 'filename' => $data->file_name));
                    }
                    return Html::a($data->file_name, array('view', 'id' => $data->id));
                },
                    ],
                    'file_size',
                    'upload_date',
                    'upload_time',
                    // 'note1',
                    array(
                        'attribute' => 'note2',
                        'label' => 'status',
                        'value' => function ($data) {
                            return $data->note2;
                        },
                    ),
                    //'note3',
                    array(
                        'attribute' => 'note3',
                        'label' => 'note',
                        'value' => function ($data) {
                            return $data->note3;
                        },
                    ),
                // 'note4',
                // 'note5',
                ],
            ]);
            ?>

</div>

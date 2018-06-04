<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel modules\adhoc\models\TransformSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Transforms';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['dhdc-adhoc/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transform-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('เพิ่ม Transform', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options' => [ 'style' => 'table-layout: fixed; width: 100%'],
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'sql',
            //'date_begin',
            //'date_end',
            //'created_at',
            // 'created_by',
             'updated_at',
            // 'updated_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>

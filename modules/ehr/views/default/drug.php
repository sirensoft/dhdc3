
<?php

use kartik\grid\GridView;
?>

<?php

$gridColumns = [
        ['class' => 'kartik\grid\SerialColumn'],
        [
        'attribute' => 'dname',
        'label' => 'รายการ',
        'pageSummary' => 'รวมทั้งหมด',
    ],
        [
        'attribute' => 'AMOUNT',
        'label' => 'จำนวน',
        'format' => ['decimal', 0],
        'hAlign' => 'right',
        'pageSummary' => true,
        'pageSummaryOptions' => ['id' => 'total_sum'],
    ],
     /*   [
        'attribute' => 'DRUGPRICE',
        'label' => 'ราคา/หน่วย',
        'format' => ['decimal', 2],
        'hAlign' => 'right',
        'pageSummary' => true,
        'pageSummaryOptions' => ['id' => 'total_sum'],
    ],
        [
        'attribute' => 'tprice',
        'label' => 'ราคารวม',
        'format' => ['decimal', 2],
        'hAlign' => 'right',
        'pageSummary' => true,
        'pageSummaryOptions' => ['id' => 'total_sum'],
    ],*/
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
     'showPageSummary' => true,
        //'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
]);
?>
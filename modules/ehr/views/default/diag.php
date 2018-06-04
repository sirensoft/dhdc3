
<?php

use kartik\grid\GridView;
?>

<div class="row">
    <div class="col-lg-2">
        <p class="text-right text-green">วันที่รับบริการ : </p>
        <p class="text-right text-green">อาการสำคัญ : </p>
        <p class="text-right text-green">สัญญาณชีพ : </p>
    </div>
     <div class="col-lg-4">
        <p class="text-left text-red"><?=': '.$dateserv?> เวลา : <?=$timeserv?> </p>
        <p class="text-left text-red"><?=': '.$cc?> </p>
        <p class="text-left text-red">: BP = <?=$sbp.':'.$dbp.' ,T='.$btemp.' ,P='.$pr.' ,R='.$rr?> </p>
    </div>
    <div class="col-lg-6">
        <p class="text-left "> <?= ' สถานที่รับบริการ :'.$hospcode.' '.$hospname?></p>
    </div>

</div>
<div class="row">
    <div class="col-lg-12">
    <?php
    $gridColumns = [
            [
            'attribute' => 'diagcode',
            'label' => 'รหัสโรค'
        ],
            [
            'attribute' => 'diagename',
            'label' => 'ชื่อโรค'
        ],
            [
            'attribute' => 'diagtype',
            'label' => 'ประเภทวินิจฉัย'
        ],
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
            //'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
    ]);
    ?>
    </div>
</div>
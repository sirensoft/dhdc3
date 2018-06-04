<?php

use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$raw = [];
$raw[] = ['pname' => 'นาย', 'name' => 'สมปอง', 'lname' => 'แสงสว่าง'];
$raw[] = ['pname' => 'นาง', 'name' => 'สมหญิง', 'lname' => 'แสงสว่าง'];

$dataProvider = new ArrayDataProvider([
    'allModels' => $raw
        ]);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'beforeHeader' => [
        [
            'columns' => [
                ['content' => '', 'options' => ['colspan' => 1]],
                ['content' => '', 'options' => ['colspan' => 1]],
                ['content' => 'รายละเอียด', 'options' => ['colspan' => 2, 'class' => 'text-center']],
            ],
        ]
    ],
    'columns' => [
        [
            'class' => 'yii\grid\SerialColumn',
            
        ],
        [
            'attribute' => 'pname',
            
        ],
        'name',
        'lname'
    ]
]);

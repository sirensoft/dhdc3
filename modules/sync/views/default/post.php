<?php

use yii\data\ArrayDataProvider;
use kartik\grid\GridView;

$dataProvider = new ArrayDataProvider([
    'allModels' => $raw
        ]);
?>
<h3>ส่งข้อมูลสำเร็จ!!!</h3>
<?=
GridView::widget([
    'layout' => '{items}',
    'responsiveWrap' => FALSE,
    'options' => [ 'style' => 'table-layout: fixed; width: 100%'],
    'dataProvider' => $dataProvider
]);
?>




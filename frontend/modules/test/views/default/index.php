<?php
use kartik\grid\GridView;


\Yii::$app->db->open();
$data=[];
$data[]=[
    'name'=>'อุเทน',
    'lname'=>'จาดยางโทน',
    'dob'=> '2017-01-23'
];

$dataProvider = new yii\data\ArrayDataProvider([
    'allModels'=>$data
]);
echo GridView::widget([
    'dataProvider'=>$dataProvider,
    'columns'=>[
        'name',
        'lname',
        'dob:date:วันที่'
    ]
]);

if(components\MyHelper::user_can_own('07554')){
    echo "OK";
}else{
    echo "NO";
}

use common\models\config\SysOnoffUpload;
$m = SysOnoffUpload::findOne(1);
echo $m->status;

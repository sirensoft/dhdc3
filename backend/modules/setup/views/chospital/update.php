
<?php
use yii\helpers\Html;
$this->params['breadcrumbs'][] = ['label'=>'ตั้งค่าอำเภอ','url'=>['/setup/default/index']];
$this->params['breadcrumbs'][] = "แก้ไข";

echo $this->render('_form',[
    'model'=>$model
]);
?>



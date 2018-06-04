<?php
use yii\helpers\Html;


$this->params['breadcrumbs'][] = 'ระบบ HDC DATA-Exchange';
$db = \Yii::$app->db;
?>
<h3>หมวดข้อมูล</h3>
<?php
$sql = "SELECT DISTINCT t.cat_id,c.category_name from sys_data_exchange t
LEFT JOIN sys_reportcategory  c on c.cat_id = t.cat_id";

$raw = $db->createCommand($sql)->queryAll();
?>
<?php foreach ($raw as $value): ?>
<?php 
$link= $value['category_name'];
$cat_id=$value['cat_id'];
?>
<p><i class="glyphicon glyphicon-check"></i> <?=  Html::a($link, ['/hdcex/default/report-list','cat_id'=>$cat_id,'cat_name'=>$link])?></p>
<?php endforeach;  ?>

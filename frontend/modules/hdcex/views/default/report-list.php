<?php
use yii\helpers\Html;

$this->params['breadcrumbs'][]= ['label' => 'ระบบ HDC DATA-Exchange', 'url' => ['/hdcex/default/index']];
$this->params['breadcrumbs'][] = "$cat_name";

$db = \Yii::$app->db;
?>
<h3>ข้อมูล</h3>
<?php
$sql = " SELECT * from sys_data_exchange t WHERE  t.active=1 and t.cat_id = '$cat_id'";

$raw = $db->createCommand($sql)->queryAll();
?>
<?php foreach ($raw as $value): ?>
<?php 
$ex_id= $value['ex_id'];
$title=$value['title'];
$ex_sql = $value['ex_sql'];
?>
<p><i class="glyphicon glyphicon-check"></i> 
<?=  Html::a($title, ['/hdcex/default/report-id','ex_id'=>$ex_id,'title'=>$title],['target'=>'_blank'])?>
</p>
<?php endforeach;  ?>




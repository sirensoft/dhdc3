<?php
use yii\helpers\Html;
$sql = "SELECT t.yearprocess+543 'byear' FROM pk_byear t limit 1";
$raw = \Yii::$app->db->createCommand($sql)->queryOne();

$this->params['breadcrumbs'][]= ['label' => 'ระบบรายงาน HDC ปีงบประมาณ '.$raw['byear'], 'url' => ['/hdc/default/index']];
$this->params['breadcrumbs'][] = "$cat_name";
 
?>

<div class="alert alert-danger">
    <h4>ประมวลผลรายงานโดยใช้หลักการแบบเดียวกับ HDC กระทรวงสาธารณสุข</h4>
</div>

<?php
$sql = " SELECT t.* from sys_report_dhdc  t ";
$sql.= " WHERE t.cat_id = '$cat_id' and t.id not in (select id from sys_report_drop) ";
$sql.= "group by t.id";


$raw = \Yii::$app->db->createCommand($sql)->queryAll();
?>
<?php
$i=1;
foreach ($raw as $itm):
    $link_lb = $itm['report_name'];
    $id = $itm['id'];
    $sql = " insert ignore into hdc_rpt_sql (rpt_id,rpt_name,sql_indiv,sql_sum) 
            value ('$id','$link_lb','select name from person limit 5;','select name from person limit 5;')";
    //\Yii::$app->db->createCommand($sql)->execute();
?>
<p><?=$i++?>. <?=  Html::a($link_lb
        ,['/hdc/default/report-id','id'=>$id,'rpt'=>$link_lb]
        ,['target'=>'_blank'])?></p>
<?php
endforeach;
?>
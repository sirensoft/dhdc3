<?php

use yii\helpers\Html;

$sql = "SELECT t.yearprocess+543 'byear' FROM pk_byear t limit 1";
$raw = \Yii::$app->db->createCommand($sql)->queryOne();

$this->params['breadcrumbs'][] = 'ระบบรายงาน HDC ปีงบประมาณ ' . $raw['byear']
?>


<h4>กลุ่มรายงาน</h4>


<?php
$sql = " SELECT t.* from sys_reportcategory_dhdc t ";

$raw = \Yii::$app->db->createCommand($sql)->queryAll();
?>
<?php
foreach ($raw as $itm):
    $link_lb = $itm['category_name'];
    $cat_id = $itm['cat_id'];
    ?>
    <p>
        <i class="glyphicon glyphicon-edit"></i> 
        <?= Html::a($link_lb, ['/hdc/default/report-group', 'cat_id' => $cat_id, 'cat_name' => $link_lb]) ?>
    </p>
    <?php
endforeach;
?>




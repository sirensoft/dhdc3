<?php
$this->title = 'ระบบจัดการข้อมูลเทียบเคียง HDC';

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$sql = " select yearprocess from sys_config limit 1";
$res = \Yii::$app->db->createCommand($sql)->queryOne();

$current_year = $res['yearprocess'];
$next_year = $current_year + 1;
$prev_year1 = $current_year - 1;
$prev_year2 = $current_year - 2
?>
<?php if (\Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-info alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Success!</h4>
  <?= \Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>


<div class="well well-large">
    <h4>ตั้งค่าปีประมวลผล</h4>

</div>

<div class="panel" style="padding: 20px">
    <?php $form = ActiveForm::begin(); ?>

    <?php
    $items = [
        
        $next_year => $next_year+543,
        $current_year => $current_year + 543,
        $prev_year1=>$prev_year1+543,
        $prev_year2=>$prev_year2+543
    ];
    echo Html::dropDownList('year', $current_year, $items,['prompt'=>'--- เลือกปีประมวลผล ---']);
    ?>
    <button type="submit" class="btn btn-success"> ตกลง </button>
    <?php ActiveForm::end(); ?>
</div>
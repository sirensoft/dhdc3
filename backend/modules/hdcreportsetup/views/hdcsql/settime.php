<?php

use kartik\time\TimePicker;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$sql = " select time from sys_hdc_time limit 1 ";
$res = \Yii::$app->db->createCommand($sql)->queryOne();
$current_time = $res['time'];
?>
<?php if (\Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-info alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Success!</h4>
  <?= \Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>

<div style="padding: 20px">
    <?php
    $f = ActiveForm::begin();
    echo '<label><h3>เวลาประมวลผลข้อมูลเพื่อเทียบเคียง HDC อัตโนมัติ</h3></label>';
    echo TimePicker::widget([
        'name' => 'time',
        'value' => $current_time,
        'pluginOptions' => [
            'showSeconds' => true,
            'showMeridian' => false,
            'minuteStep' => 1,
            'secondStep' => 5,
        ]
    ]);
    ?>
    <?=  Html::submitButton(' ตกลง ')?>
    <?php
    ActiveForm::end();
    ?>
</div>


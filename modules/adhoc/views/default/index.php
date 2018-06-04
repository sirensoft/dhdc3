<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->params['breadcrumbs'][] = "ระบบรายงานเร่งด่วน";
?>

<div class="adhoc-default-index">
  <?=  Html::a('เข้าดูรายงาน',['report/index'],['class'=>'btn btn-lg btn-blue'])?>
    <?=  Html::a('จัดการรายงาน',['dhdc-adhoc/index'],['class'=>'btn btn-lg btn-red'])?>
</div>

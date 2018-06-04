<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;

$this->params['breadcrumbs'][] = 'ตรวจสอบประวัติ SpecialPP';
?>
<div class="vaccine-default-index">
    <div class="panel panel-danger">
        <div class="panel-heading">ตรวจสอบ</div>
        <div class="panel-body">
            <?php
            $cid = trim(\Yii::$app->request->post('cid'));
            
            ?>
            <div class="row">
                <div class="col-md-6">
                    <?php $form = ActiveForm::begin(); ?>
                    <?= Html::textInput('cid', $cid, ['placeholder' => 'เลข 13 หลัก']) ?>
                    <?= Html::submitButton('ค้นหา'); ?>
                    <?php ActiveForm::end(); ?>
                </div>                
            </div>
            <br>
            <?php if ($cid): ?>    
                ผลการค้นหาด้วย 13 หลัก
                <?php
                $sql = "SELECT p.CID,concat(p.`NAME`,' ',p.LNAME) NAME,p.SEX,p.BIRTH,t.HOSPCODE,t.PID
,t.DATE_SERV,t.PPSPECIAL,s.itmname PP,t.PPSPLACE
FROM specialpp t
LEFT JOIN t_person_cid p on t.HOSPCODE = p.HOSPCODE AND t.PID = p.PID
LEFT JOIN cppspecial s ON s.itmcode = t.PPSPECIAL

WHERE p.CID = '$cid'

ORDER BY t.DATE_SERV ASC";
                try {
                    $raw = \Yii::$app->db->createCommand($sql)->queryAll();
                } catch (\yii\db\Exception $e) {
                    throw new yii\web\ForbiddenHttpException('sql error');
                }
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $raw
                ]);
                echo GridView::widget([
                    'panel'=>['before'=>''],
                    'responsiveWrap' => false,
                    'dataProvider' => $dataProvider
                ]);
                ?>

            <?php endif; ?>
            
        </div>
    </div>
</div>

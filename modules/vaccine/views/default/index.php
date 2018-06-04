<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use kartik\widgets\DatePicker;
use common\models\config\ChospitalAmp;
use yii\helpers\ArrayHelper;

$this->params['breadcrumbs'][] = 'ตรวจสอบประวัติวัคซีน';
?>
<div class="vaccine-default-index">
    <div class="panel panel-danger">
        <div class="panel-heading">ตรวจสอบ</div>
        <div class="panel-body">
            <?php
            $cid = trim(\Yii::$app->request->get('cid'));
            $bdate = trim(\Yii::$app->request->get('bdate'));
            $bdate_begin = trim(\Yii::$app->request->get('bdate_begin'));
            $bdate_end = trim(\Yii::$app->request->get('bdate_end'));
            ?>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group row">
                        <?php
                        $form = ActiveForm::begin([
                                    'method' => 'get',
                                    'action' => Url::to(['index'])
                        ]);
                        ?>

                        <div class="col-xs-9">
                            เลข 13 หลัก
                            <?= Html::textInput('cid', $cid, ['placeholder' => 'เลข 13 หลัก', 'class' => 'form-control']) ?>
                        </div>
                        <div class="col-xs-3">
                            <br>
                            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-blue']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group row">
                        <?php
                        $form = ActiveForm::begin([
                                    'method' => 'get',
                                    'action' => Url::to(['index'])
                        ]);
                        ?>
                        <div class="col-xs-3">
                            เกิดระหว่าง:
                            <?php
                            echo DatePicker::widget([
                                'name' => 'bdate_begin',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => $bdate_begin,
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-3">
                            ถึง <?php
                            echo DatePicker::widget([
                                'name' => 'bdate_end',
                                'type' => DatePicker::TYPE_INPUT,
                                'value' => $bdate_end,
                                'pluginOptions' => [
                                    'format' => 'yyyy-mm-dd',
                                    'autoclose' => true,
                                ]
                            ]);
                            ?>
                        </div>
                        <div class="col-xs-3">
                            หน่วยบริการ:
                            <?php
                            $mHos = ChospitalAmp::find()->select(['hoscode', 'concat(hoscode,"-",hosname) as hosname'])->all();
                            $items = yii\helpers\ArrayHelper::map($mHos, 'hoscode', 'hosname');
                            $hoscode = \Yii::$app->request->get('hoscode');
                            echo Html::dropDownList('hoscode', $hoscode, $items, ['class' => 'form-control', 'prompt' => 'เลือก']);
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <?= Html::hiddenInput('bdate', 'yes') ?>
                            <br>
                            <?= Html::submitButton('ค้นหา', ['class' => 'btn btn-red']); ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
            <br>
            <?php if ($cid): ?>    
                ผลการค้นหาด้วย 13 หลัก
                <?php
                $sql = " SELECT p.HOSPCODE,p.PID,p.CID,concat(p.`NAME`,' ',p.LNAME) NAME,p.SEX,p.BIRTH,TIMESTAMPDIFF(MONTH,p.BIRTH,CURDATE()) AGE_MON

,t.DATE_SERV,concat('(',t.VACCINETYPE,')-',v.engvaccine) VACC 
,t.VACCINEPLACE 
,TIMESTAMPDIFF(MONTH,p.BIRTH,t.DATE_SERV) VAC_MON
,t.HOSPCODE HOS_VACC
,date(t.D_UPDATE) 'DUPDATE'

FROM t_person_cid p
LEFT JOIN epi t on t.HOSPCODE = p.HOSPCODE AND t.PID = p.PID AND t.VACCINETYPE is not NULL

LEFT JOIN cvaccinetype v ON v.vaccinecode = t.VACCINETYPE
where  p.CID = '$cid'
ORDER BY t.DATE_SERV ASC ";
                try {
                    $raw = \Yii::$app->db->createCommand($sql)->queryAll();
                } catch (\yii\db\Exception $e) {
                    throw new yii\web\ForbiddenHttpException('sql error');
                }
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $raw
                ]);
                ?>

                <?php
                $info = '';
                if (count($raw) > 0) {
                    $info = $raw[0]['HOSPCODE'] . '-' . $raw[0]['PID'] . '  ชื่อ <b>' . $raw[0]['NAME'] . '</b>'
                            . ',เกิด ' . $raw[0]['BIRTH']
                            . ' เพศ ' . $raw[0]['SEX']
                            . ' อายุปัจจุบัน ' . $raw[0]['AGE_MON'] . ' ด.';
                }
                echo GridView::widget([
                    'panel' => ['before' => $info],
                    'responsiveWrap' => false,
                    'dataProvider' => $dataProvider,
                    'columns' => [
                        'DATE_SERV:text:วดป.ฉีด',
                        'VAC_MON:text:อายุ ณ วันฉีด(ด)',
                        'VACC:text:วัคซีน',
                        'VACCINEPLACE:text:ฉีดที่',
                        'HOS_VACC:text:ผู้บันทึก',
                        'DUPDATE:text:วันบันทึก'
                    ]
                ]);
                ?>

            <?php endif; ?>

            <?php if ($bdate): ?>
                <?php
                $sql = "SELECT concat(p.`NAME`,' ',p.LNAME) name,t.* from t_person_epi t 
LEFT JOIN t_person_cid p on t.cid = p.CID
WHERE t.birth BETWEEN '$bdate_begin' AND '$bdate_end' ";
                if (!empty($hoscode)) {
                    $sql.=" AND t.HOSPCODE in ($hoscode)";
                }
                $sql.=" order by t.birth ASC";
                try {
                    $raw = \Yii::$app->db->createCommand($sql)->queryAll();
                } catch (\yii\db\Exception $e) {
                    throw new yii\web\ForbiddenHttpException('sql error');
                }
                $dataProvider = new ArrayDataProvider([
                    'allModels' => $raw
                ]);
                ?>

                <?php
                $info = 'รายการที่พบ';
                echo GridView::widget([
                    'panel' => ['before' => $info],
                    'responsiveWrap' => false,
                    'dataProvider' => $dataProvider,                   
                ]);
                ?>
            <?php endif; ?>
        </div>
    </div>
</div>

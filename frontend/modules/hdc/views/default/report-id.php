<?php

use components\MyHelper;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use frontend\modules\hdc\models\Hdcsql;
use common\models\config\ChospitalAmp;

$this->title = $rpt;

$sql = " SELECT * FROM sys_report_dhdc t WHERE t.id = '$id' limit 1 ";
$raw = Yii::$app->db->createCommand($sql)->queryOne();
$tb = $raw['source_table'];
$report_name = $raw['report_name'];
$proc = $raw['t_sql'];
$sp = $tb . '_' . $id;
$sql_sp = "call $sp;";
try {
    //$res = \Yii::$app->db->createCommand($sql_sp)->execute();
} catch (\yii\db\Exception $e) {
    //echo $e->getMessage();
}
?>




<?php
$sql = " select * from  hdc_rpt_sql t where t.rpt_id = '$id' limit 1";
$raw = \Yii::$app->db->createCommand($sql)->queryOne();
if (!$raw) {
    $command = "CALL sys_add_report_drop('$id')";
    MyHelper::exec_sql($command);
    die("Don't have report script.");
}
$sql_sum = $raw['sql_sum'];
$sum_err = '';

try {

    $this->context->exec_sql("DROP PROCEDURE IF EXISTS hdc_sum_$id");

    $sp_sum = "CREATE PROCEDURE hdc_sum_$id()\r\n";
    $sp_sum.=" BEGIN \r\n";
    $sp_sum.= trim($sql_sum);
    $sp_sum.="; \r\n END";

    $this->context->exec_sql($sp_sum);

    $raw_sum = $this->context->call("hdc_sum_$id", NULL);
} catch (\yii\db\Exception $e) {
    $err_msg = $e->getMessage();
    $sum_err = 'none';
    if (!empty($sql_sum)) {
        echo " <a href=\"#\" onclick=\"show_err();\">err</a> ";
    }
    //return;
    //throw new \yii\web\ConflictHttpException('อยู่ระหว่างดำเนินการ');
}

if (empty($raw_sum)) {
    $raw_sum = ['data' => 'NULL'];
}
?>

<div id="show_err" style="display: none"><?= !empty($err_msg) ? $err_msg : '' ?></div>

<div><?= Html::a('SQL', ['/hdc/default/show-sql', 'id' => $id, 'rpt' => $rpt], ['target' => '_blank']) ?></div>

<div id="sum" style="display: <?= $sum_err ?>">
    <?php
    if (!empty($raw_sum[0])) {
        $cols_sum = array_keys($raw_sum[0]);
    }

    $dataProvider = new ArrayDataProvider([
        'allModels' => $raw_sum,
        'sort' => !empty($cols_sum) ? [ 'attributes' => $cols_sum] : FALSE,
        'pagination' => FALSE
    ]);
    $note_sum = Hdcsql::find()->where(['rpt_id' => $id])->one();
    $note_sum = $note_sum->note_sum;

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'responsiveWrap' => false,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'responsive' => false,
        'hover' => true,
        'panel' => [
            'type' => 'primary',
            'heading' => $rpt,
            'before' => $note_sum,
            'footer' => 'ตาราง : ' . $raw['tb_source']
        ],
        'export' => [
            'showConfirmAlert' => false,
            'target' => '_blank'
        ],
    ]);
    ?>
</div>


<?php
Pjax::begin();
$form = ActiveForm::begin([
            'method' => 'get',
            'action' => Url::to(['/hdc/default/report-id']),
            'options' => [
                'data-pjax' => 'true'
            ],
        ]);
?>
<div style="padding-bottom: 5px">
    <?php
    echo Html::hiddenInput('id', $id);
    echo Html::hiddenInput('rpt', $rpt);
    $itms_opt = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'fullname');
    $hospcode = \Yii::$app->request->get('hospcode');
    echo Html::dropDownList('hospcode', $hospcode, $itms_opt, ['prompt' => '- หน่วยบริการ -']);
    echo Html::submitButton(' ตกลง ');
    ActiveForm::end();
    ?>
</div>
<div id="indiv">
    <?php
    $sql_indiv = $raw['sql_indiv'];

    try {

        $this->context->exec_sql("DROP PROCEDURE IF EXISTS hdc_indiv_$id");

        $sp_indiv = "CREATE PROCEDURE hdc_indiv_$id()\r\n";
        $sp_indiv.=" BEGIN \r\n";
        $sp_indiv.= trim($sql_indiv);
        if(!MyHelper::user_can('Pm')){
            $hospcode = MyHelper::getUserHoscode(\Yii::$app->user->id);
        }
        if (!empty($hospcode)) {
            $sp_indiv.= " AND t.HOSPCODE in ($hospcode) ";
        }
        $sp_indiv.="; \r\n END";

        $this->context->exec_sql($sp_indiv);

        $raw_indiv = $this->context->call("hdc_indiv_$id", NULL);
    } catch (\yii\db\Exception $e) {
        echo $e->getMessage();
        //return;
        //throw new \yii\web\ConflictHttpException($e->getMessage());
    }

    if (empty($raw_indiv)) {
        $raw_indiv = ['data' => 'NULL'];
    }

    if (!empty($raw_indiv[0])) {
        $cols = array_keys($raw_indiv[0]);
    }
    $dataProvider = new ArrayDataProvider([
        'allModels' => $raw_indiv,
        'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
        'pagination' => [
            'pageSize' => 20
    ]]);

    $note_indiv = Hdcsql::find()->where(['rpt_id' => $id])->one();
    $note_indiv = $note_indiv->note_indiv;

    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
        'responsiveWrap'=>false,
        'hover' => true,
        'panel' => [
            'before' => $note_indiv,
            'type' => 'danger',
            'heading' => "$rpt (รายคน)"
        ],
        'export' => [
            'showConfirmAlert' => false,
            'target' => '_blank'
        ],
    ]);
    ?>
</div>

<?php
Pjax::end();
?>

<div>
    <h4> (HDC) ฟังก์ชั่น:<?= $proc ?> ตาราง :<?= $tb ?> </h4>
</div>
<?php
$js = <<<JS
        function show_err(){
            $('#show_err').toggle();
        }
JS;
$this->registerJs($js, \yii\web\View::POS_HEAD);
?>





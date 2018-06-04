<?php

use common\models\config\ChospitalAmp;
use yii\data\ArrayDataProvider;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use components\MyHelper;

$db = \Yii::$app->db;
?>

<div class='well'>
    <?php
    $skip_id = ['c10a2aa18f688027da4746eff598172b', 'eaf586ae6959ac7ef7d30513aa05a4d2'];

    $form = ActiveForm::begin([
                'method' => 'get',
                'action' => Url::to(['/hdcex/default/report-id']),
    ]);
    echo Html::hiddenInput('ex_id', $ex_id);
    echo Html::hiddenInput('title', $title);
    $itms_opt = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'fullname');   
    $hospcode = \Yii::$app->request->get('hospcode');
     if(!MyHelper::user_can('Pm')){
        $hospcode = MyHelper::getUserHoscode(\Yii::$app->user->id);
    }
    echo Html::dropDownList('hospcode', $hospcode, $itms_opt, ['prompt' => '- หน่วยบริการ -']);
    echo Html::submitButton(' ตกลง ', ['class' => 'btn btn-danger', 'style' => 'margin-left:5px']);
    if(MyHelper::user_can('Pm')){
    if (!in_array($ex_id, $skip_id)) {
        echo Html::a('ทั้งหมด', ['/hdcex/default/report-all', 'ex_id' => $ex_id, 'title' => $title, 'hospcode' => 'all'], ['class' => 'btn btn-warning', 'style' => 'margin-left:5px']);
    }
    }

    ActiveForm::end();
    ?>

</div>

<?php
$update = " UPDATE sys_config a set a.provincecode = (SELECT provcode from sys_config_main LIMIT 1) ";
$db->createCommand($update)->execute();

$sql = "select t.title,ex_sql from sys_data_exchange t where t.ex_id = '$ex_id'";

$raw = $db->createCommand($sql)->queryOne();
//$what = $raw['note1'];
$what = "t1.hospcode";
if ($ex_id == '12489be4fcf94dc14de42607aa2f7aa0') {
    //$what = "d.hospcode"; 
}

if ($hospcode <> 'all') {
    $ex_sql = str_replace('{exp_office}', "  and $what = '$hospcode'  ", $raw['ex_sql']);
} else {
    $ex_sql = str_replace('{exp_office}', "  ", $raw['ex_sql']);
}
$ex_sql = str_replace('tmp_export_exchange', "tmp_export_exchange_$ex_id", $ex_sql);
$ex_sql = str_replace('chospital', "chospital_amp", $ex_sql);


$ex_sql = "DROP TABLE IF EXISTS tmp_export_exchange_$ex_id;\r\n" . $ex_sql;



$this->context->exec_sql("DROP PROCEDURE IF EXISTS tmp_export_exchange_$ex_id;");

$sp = "CREATE PROCEDURE tmp_export_exchange_$ex_id()\r\n";
$sp.=" BEGIN \r\n";
$sp.= trim($ex_sql);
$sp.=" \r\n END";
$this->context->exec_sql($sp);

$this->context->exec_sql("call tmp_export_exchange_$ex_id");
?>


<?php
$sql = "select * from tmp_export_exchange_$ex_id limit 1";
$raw = $this->context->query_one($sql);
$sql = "select * from tmp_export_exchange_$ex_id ";

$raw = $this->context->query_all($sql);

$dataProvider = new ArrayDataProvider([
    'allModels' => $raw
        ]);
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'responsiveWrap' => false,
    'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => '-'],
    'panel' => [
        'heading' => $title
    ]
]);
?>


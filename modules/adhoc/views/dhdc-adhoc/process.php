<?php

use yii\helpers\Html;
use components\MyHelper;
use modules\adhoc\models\DhdcAdhoc;
use kartik\grid\GridView;
use yii\db\Exception;
use yii\data\ArrayDataProvider;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use common\models\config\ChospitalAmp;
use yii\helpers\ArrayHelper;

$this->title = 'ผลลัพธ์';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
$model = DhdcAdhoc::findOne($id);
$title = $model->title;
?>
<div class="sum">
    <?php
    $sql_sum = trim($model->sql_sum);
    

    try {
        $raw = MyHelper::createAndRunProc("dhdc_adhoc_sum_$id",$sql_sum);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $raw
        ]);
    } catch (Exception $e) {
        throw new \yii\web\ForbiddenHttpException($e->getMessage());
    }
    echo GridView::widget([
        'responsiveWrap' => false,
        'dataProvider' => $dataProvider,
        'panel' => ['type'=>'success','heading'=> $title,'before'=>$model->desc_sum]
    ]);
    ?>
</div>

<div class="indiv">
    <?php Pjax::begin(); ?>
    <?php
    $form = ActiveForm::begin([
                'method' => 'get',
                'action' => Url::to(['process']),
                'options' => [
                    'data-pjax' => 'true'
                ],
    ]);
    ?>
    <?php
    echo Html::hiddenInput('id', $id);
    //echo Html::hiddenInput('rpt', $rpt);
    $itms_opt = ArrayHelper::map(ChospitalAmp::find()->all(), 'hoscode', 'fullname');
    $select_hos = \Yii::$app->request->get('select_hos');
    echo Html::dropDownList('select_hos', $select_hos, $itms_opt, ['prompt' => '- หน่วยบริการ -']);
    echo Html::submitButton(' ตกลง ');
    ?>
    <?php
    ActiveForm::end();
    ?>

    <?php
    $sql_indiv = trim($model->sql_indiv);
    if (!MyHelper::user_can('Pm')) {
        $user_hos = MyHelper::getUserHoscode(\Yii::$app->user->id);
        $sql_indiv .= "  having HOSPCODE ='$user_hos'";
    }else{
        $sql_indiv .= "  having HOSPCODE ='$select_hos'";
    }

    try {
        $raw_indiv  = MyHelper::createAndRunProc("dhdc_adhoc_indiv_$id",$sql_indiv);
        if (empty($raw_indiv)) {
            $raw_indiv = ['data' => 'NULL'];
        }
        if (!empty($raw_indiv[0])) {
            $cols = array_keys($raw_indiv[0]);
        }
        $dataProviderIndiv = new ArrayDataProvider([
            'allModels' => $raw_indiv,
            'sort' => !empty($cols) ? [ 'attributes' => $cols] : FALSE,
            'pagination' => ['pageSize' => 20]
        ]);
    } catch (Exception $e) {
        throw new \yii\web\ForbiddenHttpException($e->getMessage());
    }
    echo GridView::widget([
        'responsiveWrap' => false,
        'dataProvider' => $dataProviderIndiv,
        'panel' => ['before' => $model->desc_indiv]
    ]);
    ?>

    <?php
    Pjax::end();
    ?>
</div>




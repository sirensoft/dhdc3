<?php

use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use kartik\grid\GridView;
use components\MyHelper;
use backend\modules\pluginsetup\models\SysDhdcPlugin;

$this->params['breadcrumbs'][] = ['label' => 'คลัง Script', 'url' => ['sqlscript/index']];

if (isset($_POST['script_name'])) {
    $this->params['breadcrumbs'][] = $_POST['script_name'];
}
?>


<a href="#" id="btn-collape">ย่อ-ขยาย</a>
<div id="frm-sql">
    <div class="alert alert-danger">กรุณาใส่เครื่องหมาย ; ปิดท้ายคำสั่ง ตัวอย่างเช่น select * from person limit 100;</div>
    <?php
    $route = Yii::$app->urlManager->createUrl('runquery/result');
    ?>

    <form method="POST" >
        <div style="margin-bottom: 3px">
            <textarea name="sql_code" id="sql_code" class="form-control" rows='6'><?= @$sql_code ?></textarea>
        </div>
        <div>
            <?php if (MyHelper::modIsOn()): ?>
                <?php if (MyHelper::user_can('Admin')): ?>
                    <button class="btn btn-danger"><i class="glyphicon glyphicon-refresh"></i> รันชุดคำสั่ง</button>
                    <button name="save" value="yes" class="btn btn-success"><i class="glyphicon glyphicon-floppy-disk"></i> จัดเก็บ</button>
                <?php endif; ?>
                <a href="<?= yii\helpers\Url::to(['sqlscript/index']) ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list-alt"></i> คลัง script</a>
            <?php else: ?>
                <label> ผู้ดูแลระบบปิดใช้งาน </label>
            <?php endif; ?>                    
        </div>
    </form>
</div>

<br>
<?php
if (isset($dataProvider))
//echo yii\grid\GridView::widget([
    echo \kartik\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        'formatter' => ['class' => 'yii\i18n\Formatter', 'nullDisplay' => ''],
        'responsiveWrap' => FALSE,
        'hover' => true,
        //'floatHeader' => true,
        'panel' => [
            'before' => '',
            'type' => \kartik\grid\GridView::TYPE_INFO

        //'after'=>''
        ],
        'export' => [
            'showConfirmAlert' => false,
            'target' => GridView::TARGET_BLANK
        ],
    ]);
?>


<?php
$script = <<< JS
$(function(){
    $("label[title='Show all data']").hide();
});  
        
$('#btn-collape').on('click', function(e) {
    
   $('#frm-sql').slideToggle();
});

JS;
$this->registerJs($script);
?>


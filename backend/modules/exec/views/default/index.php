<?php

use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Html;

$this->params['breadcrumbs'][] = 'การประมวลผล';
?>
<div style="margin-bottom: 15px">
    <button class="btn btn-brown btn-transform"><i class="glyphicon glyphicon-flash"></i> 1-TransForm</button>
    <button class="btn btn-deep-purple btn-qc" ><i class="glyphicon glyphicon-flash"></i> 2-Data QC</button>    
    <button class="btn btn-deep-orange btn-truncate pull-right"><i class="glyphicon glyphicon-flash"></i> 3-Truncate</button>

</div>
<?php
Pjax::begin();
echo Html::a('Refresh', ['index'], ['class' => 'refresh', 'style' => 'display:none']);

echo GridView::widget([
    'responsiveWrap' => FALSE,
    'dataProvider' => $dataProvider
]);
?>
<div class="alert alert-danger">
    <p>Transform Process : <?= Html::a($current_process, ['check-process', 'p' => $current_process], ['target' => '_blank']) ?> </p>
    <p>System Process :<span style="color: orangered"><?= $sys_process ?></span></p>
    <p>Start Time: <?= $time_process ?></p>

</div>
<?php Pjax::end(); ?>

<?php
$route_transform_exec = Url::to(['/exec/transform/exec']);
$route_qc_exec = Url::to(['/exec/qc/exec']);
$route_truncate_exec = Url::to(['/exec/qc/truncate']);
$js = <<<JS
   $(document).ready(function() {
        setInterval(function(){ $('.refresh').click(); }, 5000);
    });
        
    $('.btn-transform').click(function(){
        yii.confirm('Are you sure?',function(){
            $('.btn-transform').toggle();
        $.ajax({
            url: '$route_transform_exec',       
            success: function(data) {
                $('.btn-transform').toggle();
                alert(data);
            }
        });   
        });
        
    });
        
    $('.btn-qc').click(function(){
        yii.confirm('Are you sure?',function(){
         $('.btn-qc').toggle();
        $.ajax({
            url: '$route_qc_exec',       
            success: function(data) {
                $('.btn-qc').toggle();
                alert(data);
            }
        });
        });
        
    });
        
    $('.btn-truncate').click(function(){
        yii.confirm('ล้างข้อมูลทั้งหมด?',function(){
         $('.btn-truncate').toggle();
        $.ajax({
            url: '$route_truncate_exec',       
            success: function(data) {
                $('.btn-truncate').toggle();
                alert(data);
            }
        });
        });
        
    });
JS;
$this->registerJs($js);



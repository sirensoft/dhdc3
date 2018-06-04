<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use miloschuman\highcharts\HighchartsAsset;
HighchartsAsset::register($this)->withScripts(['highcharts-more','modules/solid-gauge',]);
$this->registerJsFile('@web/js/chart-donut.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->params['breadcrumbs'][] = "คุณภาพข้อมูลเชิงโครงสร้าง";
?>
<div class="container">
    <div class="row">
        <?php foreach ($models as $model) : ?>
            <div class="col-lg-4" style="text-align: center;">
                <?php
                $f = strtoupper($model->file_name);
                $q = $model->qc;
                $this->registerJs("
                        var obj_div=$('#$f');
                        gen_donut(obj_div,'$f',$q);
                    ");
                ?>           
                <div id="<?= $f ?>"  style="width: 300px; height: 200px; float: left;cursor: pointer" onclick="go(this.id)"></div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="pull-right" style="margin-top: -20px">
        <?php    
    echo LinkPager::widget([
        'pagination' => $pages,
        
    ]);    
    ?>
        </div>
    <?php
   echo Html::a('รายหน่วย', ['/qc/default/hos-sum-error'],['class'=>'btn btn-small btn-blue pull-left',])
    ?>
    
</div>

<?php
$route = Url::to(['data-error']);
$script = <<< JS

        function go(filename){
            window.location = '$route?filename='+filename
        }
        
JS;
$this->registerJs($script, yii\web\View::POS_HEAD);
?>


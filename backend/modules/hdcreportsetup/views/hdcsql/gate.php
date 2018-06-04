<?php
$this->title = 'ระบบจัดการข้อมูลเทียบเคียง HDC';

use yii\helpers\Html;
use yii\helpers\Url;

$sql =" select yearprocess from sys_config limit 1";
$res = \Yii::$app->db->createCommand($sql)->queryOne();

?>
<h3>ระบบประมวลผลรายงานเทียบเคียง HDC ปีงบ<?=$res['yearprocess']*1+543?></h3>
<div id="res" style="display: none" class="alert alert-danger">
    กำลังประมวลผล...
</div>

<?= Html::a("ตั้งค่าปีประมวลผล", ['/hdcsql/setyear'], ['class' => 'btn btn-material-red-300 btn-lg']) ?>


<?= Html::a('จัดการรายงาน', ['/hdcsql/index'], ['class' => 'btn btn-material-green btn-lg', 'target' => '_blank']) ?>

<a href="http://ftp2.plkhealth.go.th/rpt_update/" target="_blank" class="btn btn-material-lime btn-lg">
    <i class="glyphicon glyphicon-alert"></i>
    รายงานอัพเดท
</a>

<a class="btn btn-material-blue-300 btn-lg" onclick="hdc_exec()">
    ประมวลผลข้อมูลเทียบเคียง HDC
</a>

<?= Html::a("  ตั้งเวลา  ", ['/hdcsql/settime'], ['class' => 'btn btn-material-orange-300 btn-lg']) ?>


<?php
$link = Url::to(['hdcsql/exec']);
?>
<?php
$js = <<<JS
    function hdc_exec() {  
        $('#res').toggle();
        $.ajax({
            url: "$link",            
            success: function (data) {                
                 $('#res').toggle();    
                 if(data=='running'){
                    alert('ไม่สามารถดำเนินการได้ ระบบกำลังประมวลผล');
                 } 
            }
        });
    }

JS;
$this->registerJs($js, yii\web\View::POS_HEAD);
?>


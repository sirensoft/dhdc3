<?php

use yii\helpers\Html;
use common\models\config\SysConfigMain;

/* @var $this yii\web\View */
$this->title = 'เกียวกับ';
$this->params['breadcrumbs'][] = $this->title;
$sys = SysConfigMain::find()->one();
?>
<div class="site-about">
    <h1>ผู้ดูแลระบบ</h1>
    <h3>- <?= $sys->note1 ?></h3>
</div>
<hr>
<div class="site-about">
    <h3>โปรแกรม DHDC (District Health Data Checker)</h3>    
    <p>(2015) Project Manager : <a href="https://www.facebook.com/tehnnn" target="_blank">UTEHN</a></p>
    <p>(2015) Programmer : <a href="https://www.facebook.com/nakharin.knott" target="_blank">KNOTT</a></p>
    <p>(2015) Programmer : <a href="https://www.facebook.com/jub.wifi" target="_blank">JUB</a></p>
    <p>(2017) Programmer : <a href="https://www.facebook.com/red9love" target="_blank">Pond</a></p>
    
    
    <p>-&copy; สงวนลิขสิทธิ์ SOURCECODE ส่วนการทำงานนำเข้าไฟล์ 43 แฟ้ม</p>  
</div>
<div>
    <h2> 
        <?= Html::a('กลุ่ม Facebook DHDC', 'https://www.facebook.com/groups/1533692120236074/', ['target' => '_blank']) ?>
    </h2>
</div>




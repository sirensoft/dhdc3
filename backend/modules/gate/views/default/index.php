<?php

use yii\helpers\Html;
use yii\helpers\Url;


?>

<div class="container">
    <div class="panel panel-info">
        <div class="panel-heading"><h1 class="panel-title">Task </h1></div>

        <div class="panel-body">
            <div class="row">
                <div class="col-lg-4">
                    <div  style="width: 300px; height: 70px; float: left" >
                        <a href="<?= Url::to(['/setup/default/index']) ?>" class="btn btn-lg btn-purple"><i class="glyphicon glyphicon-globe"></i> ตั้งค่าอำเภอ</a>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div  style="width: 300px; height: 70px; float: left" >
                        <a href="<?= Url::to(['/exec/default/index']) ?>" class="btn btn-lg btn-deep-orange"><i class="glyphicon glyphicon-flash"></i> ประมวลผล</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div  style="width: 300px; height: 70px; float: left" >
                        <a target="_blank" href="<?= Url::to(['/hdcreportsetup/default/index']) ?>" class="btn btn-lg btn-blue"><i class="glyphicon glyphicon-check"></i> จัดการรายงาน</a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div  style="width: 300px; height: 70px; float: left" >
                        <a href="<?= Url::to(['/pluginsetup/plugin/index']) ?>" class="btn btn-lg btn-teal"><i class="glyphicon glyphicon-info-sign"></i> Plugins</a>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>
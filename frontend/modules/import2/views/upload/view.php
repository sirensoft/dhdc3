<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model frontend\models\UploadFortythree */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'รายการไฟล์ '), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="upload-fortythree-view">



    <p>
        <?= Html::a(Yii::t('app', '<span class="glyphicon glyphicon-upload"></span> Upload'), ['create'], ['class' => 'btn btn-success']) ?>

    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'nullDisplay' => '-',
        ],
        'attributes' => [
            //'id',
           // 'hospcode',
            'file_name',
            'file_size',
            'upload_date',
            'upload_time',
            'note1'
        ],
    ])
    ?>

    <?php if ($model->note2 === 'รอนำเข้า'): ?>

        <button class="btn btn-danger" id="btn_import">
            <span class="glyphicon glyphicon-play"></span> 
            นำเข้า
        </button>

    <?php else: ?>

        <div class="alert alert-danger">
            <?php
            if ($model->note2 === 'กำลังนำเข้า') {
                echo "กำลังนำเข้า";
            } else {
                //echo "นำเข้าแล้ว ";
                if ($model->note3 === "import all") {
                    echo Html::a('รายละเอียด', ['detail2',
                        'filename' => $model->file_name,
                    ]);
                } else {
                    echo Html::a('รายละเอียด', ['detail',
                        'filename' => $model->file_name,
                    ]);
                }
            }
            ?>
        </div>    

    <?php endif; ?>

    <div id="info" style="display: none">ระหว่างนำเข้าข้อมูล ท่านสามารถปิดหน้าจอนี้ได้</div>

    <?php
    $action_route = Url::to(['/import2/ajax/import']) ;

    $script = <<< JS
$('#btn_import').on('click', function(e) {
    
    $("html, body").animate({ scrollTop: $(document).height() }, "slow");
    $('#res').toggle();  
    $('#info').toggle(); 
    $('#btn_import').hide();
        
    $.ajax({
       url: "$action_route",
       data: {fortythree:"$model->file_name",upload_date:"$model->upload_date",upload_time:"$model->upload_time",id:"$model->id"},
       success: function(data) {
            $('#res').toggle(); 
            $('#info').toggle(); 
            alert(data);
            window.location.reload();
       }
    });
});

            
JS;
    $this->registerJs($script);
    ?>
    <div id="res" style="display: none">
        <img src="../../images/busy.gif">
    </div>
    <hr>
    <div class="alert alert-danger">&copy; สงวนลิขสิทธิ์ SOURCECODE ส่วนการทำงานนำเข้าไฟล์ 43 แฟ้ม</div>


</div>

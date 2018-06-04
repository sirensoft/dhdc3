<?php

use yii\bootstrap\Html;

$this->params['breadcrumbs'][] = "ระบบการตรวจสอบสิทธิด้วยบัตรประชาชน"
?>
<div class="smcread-default-index">
    <div style="margin-bottom: 5px">
        <img src="http://localhost:8080/smartcard/picture/" width="250" height="250"/>
    </div>
    <div class="input-group">
        <input type="text" class="form-control" placeholder="password" name="pass" id="pass">
        <span class="input-group-btn" style="width:0;">
            <button class="btn btn-default" type="button" id="btn-go">OK !</button>
        </span>
    </div>
</div>

<?php
$js = <<<JS
   
    $.ajaxSetup({
        async: false
    });
    var url = 'http://localhost:8080/smartcard/data/';
    $('#btn-go').click(function(e){
        var pass = $('#pass').val();
        var data = getCard(url);
        
        console.log(data.cid);
        
    });
    var getCard = function(url){   
        var data = null;
        $.getJSON(url, function( res ){
            data = res;
        });
        return data;
    };
JS;

$this->registerJs($js);

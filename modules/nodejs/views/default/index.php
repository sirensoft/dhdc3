<div class="data">
   
</div>

<?php
$js=<<<JS
     console.log('satrt');  
     $.get('http://localhost:3000/list',function(data){
        $('.data').html(JSON.stringify(data));
    });   
        
JS;
$this->registerJs($js)

?>

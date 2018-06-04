<?php

use yii\widgets\LinkPager;
?>
<div class="container">
    <div class="row" style="margin-top: 10px">
        <?php
        foreach ($raw as $val):
            ?>
            <div style="border:solid;text-align: center;padding-bottom: 15px;padding-top: 15px" class="col-lg-3" >
    <?= $val['HOUSE_ID'] ?><br>
                <img src="//api.qrserver.com/v1/create-qr-code/?size=140x140&data=http://61.19.22.108:40/<?= $val['HID'] ?>" />
                <br><b><?= $val['ADDR'] ?> ต.<?= $tambonname['tambonname'] ?></b>
            </div>
<?php endforeach; ?>
    </div>

    <div class="pull-left" >
        <?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>
    </div>
 
</div>


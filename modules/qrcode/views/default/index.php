<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use components\MyHelper;
use kartik\widgets\DepDrop;

$this->params['breadcrumbs'][] = 'สร้าง QR-CODE';
?>
<div>
    <?php
    $form = ActiveForm::begin([
                'method' => 'get',
                'action' => Url::to(['report']),
                'options' => [
                    'target' => "_blank"
                ]
    ]);
    $sql = " SELECT t.tambon,c.tambonname from (
SELECT DISTINCT concat(t.CHANGWAT,t.AMPUR,t.TAMBON) tambon FROM home t
) t  INNER JOIN ctambon c ON t.tambon = c.tamboncodefull ";
    $array = MyHelper::query_all($sql);
    $items = ArrayHelper::map($array, 'tambon', 'tambonname');
    ?>
    <div class="row" style="margin-bottom: 5px">
        <div class="col-md-4">
            ตำบล
            <?=
            Html::dropDownList('tambon', '', $items, [
                'id' => 'tambon',
                'class' => 'form-control',
                'prompt' => '--เลือก--'
            ]);
            ?>
        </div>
        <div class="col-md-2">
            หมู่บ้าน
            <?php
            echo DepDrop::widget([
                'name' => 'village',
                'options' => ['id' => 'village'],
                'pluginOptions' => [
                    'depends' => ['tambon'],
                    'placeholder' => '--เลือก--',
                    'url' => Url::to(['get-village'])
                ],
            ]);
            ?>
        </div>
        <div class="col-md-2">
            บ้านเลขที่
            <?=  Html::input('text', 'house', '', ['class'=>'form-control','placeholder'=>'207/1'])?>
        </div>
        <div class="col-md-2">
            <br>
            <?= Html::submitButton('ตกลง', ['class' => 'btn btn-red']) ?>
        </div>
        <?php
        ActiveForm::end();
        ?>
    </div>


</div>


<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\plugin\models\SysDhdcPlugin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'จัดการ Plugins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-dhdc-plugin-view">

    

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-blue']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-remove"></i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-red',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'mod_name',
            'route',
            'type',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>

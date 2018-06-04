<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use components\MyHelper;

/* @var $this yii\web\View */
/* @var $model modules\adhoc\models\DhdcAdhoc */


$this->title = 'รายละเอียด';
$this->params['breadcrumbs'][] = ['label' => 'รายการ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dhdc-adhoc-view">



    <p>
        <?php if (MyHelper::user_can('Admin')): ?>
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
    <?php endif; ?>
        <?= Html::a('<i class="glyphicon glyphicon-play"></i> ประมวลผล', ['process', 'id' => $model->id], ['class' => 'btn btn-green pull-right','target'=>'_blank']) ?>
    </p>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'sql_indiv:ntext',    
            'sql_sum:ntext',            
            'updated_at',
        ],
    ])
    ?>

</div>

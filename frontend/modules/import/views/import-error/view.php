<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\modules\import\models\SysDhdcImportError */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'รายการไฟล์', 'url' => ['/import/upload/index']];
$this->params['breadcrumbs'][] = ['label' => 'รายการข้อผิดพลาด', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sys-dhdc-import-error-view">

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'date_err',
            'err:ntext',
        ],
    ]) ?>

</div>

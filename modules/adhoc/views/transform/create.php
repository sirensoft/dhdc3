<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model modules\adhoc\models\Transform */

$this->title = 'Create Transform';
$this->params['breadcrumbs'][] = ['label' => 'Transforms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transform-create">

    

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

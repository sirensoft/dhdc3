<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Hdcsql */

$this->title = 'Create Hdcsql';
$this->params['breadcrumbs'][] = ['label' => 'Hdcsqls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hdcsql-create">

    

    <?= $this->render('_form', [
        'model' => $model,
        
    ]) ?>

</div>

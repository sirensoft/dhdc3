<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$this->params['breadcrumbs'][] = "การแจ้งเตือน";


?>
<div class="site-error">

    

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use components\MyHelper;

$this->params['breadcrumbs'][] = 'ระบบจัดการสิทธิใช้งาน';
?>

<ul>
    <?php if (MyHelper::user_can('Root')): ?>
        <li>
            <?= Html::a('จัดการ ROLE', ['/rbac/role']) ?>
        </li>
        <li>
            <?= Html::a('จัดการ RULE', ['/rbac/rule']) ?>
        </li>
        <li>
            <?= Html::a('จัดการ PERMISSION', ['/rbac/permission']) ?>
        </li>
    <?php endif; ?>
    <li>
        <?= Html::a('มอบหมายสิทธิ', ['/rbac/assignment']) ?>
    </li>
</ul>

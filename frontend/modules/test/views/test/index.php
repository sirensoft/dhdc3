<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use dektrium\user\models\User;
use components\MyHelper;

$hos = MyHelper::getUserHoscode(\Yii::$app->user->id);

if(MyHelper::user_can("Pm")){
echo "xxx";


}

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\test\models\TestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="test-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Test', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsiveWrap'=>FALSE,
        'panel'=>['before'=>''],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'birth:date',
            'age:integer',
            [
                'attribute'=>'created_by',
                'value'=>'user.username'
            ],
            
            // 'updated_by',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

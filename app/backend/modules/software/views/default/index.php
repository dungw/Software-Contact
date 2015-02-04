<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SoftwareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Softwares';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Software', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'cate_id',
            'manufacture_id',
            'picture',
            // 'description:ntext',
            // 'user_rating',
            // 'price_range',
            // 'os_support',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

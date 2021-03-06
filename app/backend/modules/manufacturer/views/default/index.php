<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ManufacturerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Nhà sản xuất';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'options' => [
                    'width' => '8%'
                ],
            ],
            'name',
//            [
//                'attribute' => 'logo',
//                'value' => function($model) {
//                        return '<img class="logo-list" src="' . Yii::$app->params['uploadUrl'] . $model->logo . '">';
//                    },
//                'format' => 'html',
//                'filter' => false,
//            ],
            'phone',
            [
                'attribute' => 'website',
                'value' => function($model) {
                        return '<a href="'. $model->website .'">' . $model->website . '</a>';
                    },
                'format' => 'html',
            ],
            'email:email',
            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => '8%',
                ],
            ],
        ],
    ]); ?>

</div>

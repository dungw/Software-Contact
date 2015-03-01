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

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                ]
            ],
            'name',
            [
                'attribute' => 'logo',
                'value' => function($model) {
                        return '<img class="logo-list" src="' . Yii::$app->params['uploadUrl'] . $model->logo . '">';
                    },
                'format' => 'html',
            ],
            'phone',
            'address',
            'website',
            'email:email',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>

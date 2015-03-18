<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\FeatureSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tính năng';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feature-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'options' => [
                    'width' => '5%',
                ]
            ],
            [
                'attribute' => 'id',
                'options' => [
                    'width' => '8%',
                ]
            ],
            'name',
            [
                'attribute' => 'status',
                'format' => 'text',
                'options' => [
                    'width' => '10%',
                ],
                'value' => function ($model) {
                        return $model->showStatus();
                    }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'options' => [
                    'width' => '8%'
                ]
            ],
        ],
    ]); ?>

</div>

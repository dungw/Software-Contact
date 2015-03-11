<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Danh mục phần mềm';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">

    <h4><?= Html::encode($this->title) ?></h4>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'cat_id',
                'format' => 'text',
                'options' => [
                    'width' => '8%',
//                    'style' => 'text-align: center; font-weight: bold;',
                ],
                'filter' => true,
            ],
            [
                'attribute' => 'cat_name',
                'format' => 'text',
                'options' => [
                    'width' => '25%',
                ]
            ],
            [
                'attribute' => 'cat_description',
                'format' => 'ntext',
            ],
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
    ]);
    ?>

</div>

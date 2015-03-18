<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\Category;
use common\models\Manufacturer;

$this->title = 'Phần mềm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-index">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'options' => [
                    'width' => '8%',
                ]
            ],
            'name',
            [
                'attribute' => 'cate_id',
                'format' => 'text',
                'value' => function($model) {
                        $category = Category::findOne($model->cate_id);
                        return $category->cat_name;
                    },
                'filter' => false,
            ],
            [
                'attribute' => 'manufacture_id',
                'format' => 'text',
                'value' => function($model) {
                        $manufacture = Manufacturer::findOne($model->manufacture_id);
                        return $manufacture->name;
                    },
                'filter' => false,
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'options' => [
                    'width' => '10%',
                ],
                'value' => function ($model) {
                        return $model->showStatus();
                    },
                'filter' => false,
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

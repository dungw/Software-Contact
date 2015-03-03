<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\CategorySearch;

/* @var $this yii\web\View */
/* @var $searchModel common\models\SoftwareSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Phần mềm';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-index">

    <h3><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Thêm mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
                'filter' => true,
                'value' => function($model) {
                        $categorySearch = new CategorySearch();
                        $category = array_shift($categorySearch->search(array('cat_id' => $model->cate_id))->getModels());
                        return $category->cat_name;
                    },
                'filter' => false,
            ],
            [
                'attribute' => 'manufacture_id',
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

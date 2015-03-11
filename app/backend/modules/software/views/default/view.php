<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Software */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Phần mềm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'cate_id',
            'manufacture_id',
            [
                'attribute' => 'picture',
                'value' => Html::img(Yii::$app->params['uploadUrl'] . $model->getThumbnail($model->picture)),
                'format' => 'html',
            ],
            [
                'attribute' => 'description',
                'value' => $model->description,
                'format' => 'html',
            ],
            'user_rating',
            'price_range',
            'os_support',
            'status',
        ],
    ]) ?>

</div>

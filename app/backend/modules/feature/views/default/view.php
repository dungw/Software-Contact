<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tính năng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feature-view">

    <h4><?= Html::encode($this->title) ?></h4>

    <p>
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa bản ghi này?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:ntext',
            'status',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhà sản xuất', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-view">

    <h3><?= Html::encode($this->title) ?></h3>

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

    <?php
    echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            [
                'attribute' => 'logo',
                'label' => 'Logo',
                'value' => '<img src="' . Yii::$app->params['uploadUrl'] . $model->logo . '">',
                'format' => 'html',
            ],
            'introduction:ntext',
            'address',
            'phone',
            'website',
            'email:email',
            'established',
        ],
    ]) ?>

</div>

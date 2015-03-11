<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */

$this->title = 'Cập nhật nhà SX: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Nhà sản xuất', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="manufacturer-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

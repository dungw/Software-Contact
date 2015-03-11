<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */

$this->title = 'Cập nhật tính năng: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tính năng', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="feature-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

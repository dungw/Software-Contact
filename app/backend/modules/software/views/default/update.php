<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Software */

$this->title = 'Cập nhật phần mềm: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Phần mềm', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="software-update">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'manufacturers' => $manufacturers,
        'slide' => $slide,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Category */

$this->title = 'Cập nhật danh mục: ' . $model->cat_name;
$this->params['breadcrumbs'][] = ['label' => 'Danh mục phần mềm', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->cat_name, 'url' => ['view', 'id' => $model->cat_id]];
$this->params['breadcrumbs'][] = 'Cập nhật';
?>
<div class="category-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

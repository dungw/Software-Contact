<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Software */

$this->title = 'Cập nhật phần mềm: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Phần mềm', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="software-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>

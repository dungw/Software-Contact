<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Feature */

$this->title = 'Thêm mới tính năng';
$this->params['breadcrumbs'][] = ['label' => 'Tính năng', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feature-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */

$this->title = 'Thêm mới nhà sản xuất';
$this->params['breadcrumbs'][] = ['label' => 'Nhà sản xuất', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="manufacturer-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Software */

$this->title = 'Thêm mới phần mềm';
$this->params['breadcrumbs'][] = ['label' => 'Phần mềm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$parseData = [
    'model' => $model,
    'categories' => $categories,
    'manufacturers' => $manufacturers,
    'errors' => isset($errors) ? $errors : [],
];
?>
<div class="software-create">

    <h4><?= Html::encode($this->title) ?></h4>

    <?= $this->render('_form', $parseData) ?>

</div>

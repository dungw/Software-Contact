<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Software */

$this->title = 'Thêm mới phần mềm';
$this->params['breadcrumbs'][] = ['label' => 'Phần mềm', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="software-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

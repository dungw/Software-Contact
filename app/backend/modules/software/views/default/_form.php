<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CategorySearch;

/* @var $this yii\web\View */
/* @var $model common\models\Software */
/* @var $form yii\widgets\ActiveForm */

$attributeLabels = $model->attributeLabels();
$categorySearch = new CategorySearch();
$categoryModels = $categorySearch->search(array())->getModels();
$categoryData = $categorySearch->prepareForSelect($categoryModels);
?>

<div class="software-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

<!--    --><?//= $form->field($model, 'cate_id')->textInput() ?>

    <div class="form-group">
        <label class="control-label"><?php echo $attributeLabels['cate_id'] ?></label><br>
        <?= Html::activeDropDownList($model, 'cate_id', $categoryData) ?>
    </div>

    <?= $form->field($model, 'manufacture_id')->textInput() ?>

    <?= $form->field($model, 'picture')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'user_rating')->textInput() ?>

    <?= $form->field($model, 'price_range')->textInput() ?>

    <?= $form->field($model, 'os_support')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <label class="control-label"><?php echo $attributeLabels['status'] ?></label><br>
        <?= Html::activeDropDownList($model, 'status', $model->_statusData) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

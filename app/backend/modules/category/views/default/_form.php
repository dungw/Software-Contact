<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Category;
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'cat_description')->textarea(['rows' => 6]) ?>

    <div class="form-group field-category-status has-success">
        <label class="control-label" for="category-status">Status</label>

        <?= Html::activeDropDownList($model, 'status', Category::$status) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

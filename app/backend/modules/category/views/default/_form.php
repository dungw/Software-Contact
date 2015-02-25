<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Category;

$attributeLabels = $model->attributeLabels();
?>

<div class="cu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'cat_description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <label class="control-label" for="category-status"><?php echo $attributeLabels['status'] ?></label><br>
        <?= Html::activeDropDownList($model, 'status', $model->_statusData) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

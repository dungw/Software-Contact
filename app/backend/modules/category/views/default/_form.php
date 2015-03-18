<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Category;
use moonland\tinymce\TinyMCE;
use common\models\Feature;
use common\components\helpers\Show;

// get attribute labels
$attributeLabels = $model->attributeLabels();

// get all features
$featureModel = Feature::getActiveRecords();

// active features
$activeFeatureIds = array();
if (isset($features)) {
    foreach ($features as $feature) {
        $activeFeatureIds[] = $feature['id'];
    }
}
?>

<div class="cu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cat_name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <label class="control-label" for="category-feature">Tính năng</label><br>
        <?= Html::listBox('list-feature', $activeFeatureIds, ArrayHelper::map($featureModel, 'id', 'name'), ['class' => 'form-listbox', 'multiple' => true]) ?>
    </div>

    <?= $form->field($model, 'cat_description')->widget(TinyMCE::className()) ?>

    <?= Show::activeDropDownList($model, 'status', $attributeLabels, $model->_statusData) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

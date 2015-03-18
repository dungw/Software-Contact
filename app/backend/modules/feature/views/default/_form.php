<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\components\helpers\Show;

$attributeLabels = $model->attributeLabels();
?>

<div class="feature-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= Show::activeDropDownList($model, 'status', $attributeLabels, $model->_statusData) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

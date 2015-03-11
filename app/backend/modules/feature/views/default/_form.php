<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Feature */
/* @var $form yii\widgets\ActiveForm */
$attributeLabels = $model->attributeLabels();
?>

<div class="feature-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <label class="control-label" for="feature-status"><?php echo $attributeLabels['status'] ?></label><br>
        <?= Html::activeDropDownList($model, 'status', $model->_statusData, ['class' => 'form-select']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

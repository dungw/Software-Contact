<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use moonland\tinymce\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Manufacturer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="manufacturer-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'logo')->fileInput() ?>

    <div class="form-group">
        <?php
        if ($model->logo && file_exists(Yii::$app->params['uploadPath'] . $model->getThumbnail($model->logo))) {
            echo Html::img(Yii::$app->params['uploadUrl'] . $model->getThumbnail($model->logo), ['class' => 'show-img']);
        }
        ?>
    </div>

    <?= $form->field($model, 'introduction')->widget(TinyMCE::className()) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 15]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'established')->textInput(['maxlength' => 30]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

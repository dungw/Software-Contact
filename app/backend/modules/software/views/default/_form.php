<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CategorySearch;
use moonland\tinymce\TinyMCE;

/* @var $this yii\web\View */
/* @var $model common\models\Software */
/* @var $form yii\widgets\ActiveForm */

$attributeLabels = $model->attributeLabels();
?>

<div class="software-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <label class="control-label"><?php echo $attributeLabels['cate_id'] ?></label><br>
        <?= Html::activeDropDownList($model, 'cate_id', $categories, ['class' => 'form-select']) ?>
    </div>

    <div class="form-group">
        <label class="control-label"><?php echo $attributeLabels['manufacture_id'] ?></label><br>
        <?= Html::activeDropDownList($model, 'manufacture_id', $manufacturers, ['class' => 'form-select']) ?>
    </div>


    <div class="form-group">
        <label class="control-label"><?php echo $attributeLabels['picture'] ?></label><br>
        <?= Html::input('file', 'picture', '', ['class' => 'form-file']) ?>
    </div>

    <div class="form-group">
        <?php
        if ($model->picture && file_exists(Yii::$app->params['uploadPath'] . $model->picture)) {
            echo Html::img(Yii::$app->params['uploadUrl'] . $model->picture, ['class' => 'show-img']);
        }
        ?>
    </div>

    <div class="form-group">
        <label class="control-label">Slide</label>
        <?php echo Html::input('file', 'slide[]', null, ['multiple' => true, 'class' => 'form-file']) ?>
    </div>

    <div class="form-group">
        <?php
        if (!empty($slide)) {
            foreach ($slide as $img) {
                if (file_exists(Yii::$app->params['uploadPath'] . $img['path'])) {
                    echo '<div id="slice-'. $img['id'] .'" class="float-l width-auto">';
                    echo Html::img(Yii::$app->params['uploadUrl'] . $model->getThumbnail($img['path']), ['class' => 'show-small-img']);
                    echo '<a data-id="'. $img['id'] .'" class="glyphicon glyphicon-remove remove-img"></a>';
                    echo '</div>';
                }
            }
        }
        ?>
    </div>

    <?= $form->field($model, 'description')->widget(TinyMCE::className()); ?>

    <?= $form->field($model, 'user_rating')->textInput() ?>

    <?= $form->field($model, 'price_range')->textInput() ?>

    <?= $form->field($model, 'os_support')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <label class="control-label"><?php echo $attributeLabels['status'] ?></label><br>
        <?= Html::activeDropDownList($model, 'status', $model->_statusData, ['class' => 'form-select']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Thêm mới' : 'Cập nhật', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    $('.remove-img').click(function() {
        if (confirm('Bạn chắc chắn muốn xóa ảnh này?')) {
            var id = parseInt($(this).attr('data-id'));
            $.ajax({
                type: 'POST',
                url: '/admin/software/default/remove-img',
                data: {
                    id: id
                },
                success: function(data) {

                    if (data == 'success') {
                        $('#slice-' + id).remove();
                    }
                }
            });
        }
    });
</script>

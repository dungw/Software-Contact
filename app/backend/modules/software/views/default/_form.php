<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use moonland\tinymce\TinyMCE;
use common\models\CategorySearch;
use common\models\Feature;
use common\components\helpers\Show;

$attributeLabels = $model->attributeLabels();
$attributeLabels['features'] = 'Tính năng';

// get features of current category
$featuresBox = '';
if ($model->cate_id > 0) {
    $activeFeatures = isset($activeFeatures) ? $activeFeatures : null;
    $featuresBox = Html::listBox('features-list', $activeFeatures, $categoryFeatures, ['class' => 'form-listbox', 'multiple' => true, 'id' => 'features-list']);
}
?>

<div class="software-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= Show::activeDropDownList($model, 'cate_id', $attributeLabels, $categories, ['class' => 'form-select'], $errors) ?>

    <div id="features-box" class="form-group">
        <label class="control-label"><?php echo $attributeLabels['features'] ?></label><br>
        <?php echo $featuresBox ?>
    </div>

    <?= Show::activeDropDownList($model, 'manufacture_id', $attributeLabels, $manufacturers, ['class' => 'form-select'], $errors) ?>

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

    <div class="form-group slice-box">
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

    <?= Show::activeDropDownList($model, 'status', $attributeLabels, $model->_statusData, ['class' => 'form-select']) ?>

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

    // load features by category
    $('#software-cate_id').change(function() {
        var category = parseInt($(this).val());
        $.ajax({
            type: 'POST',
            url: '/admin/feature/default/get-by-ajax',
            data: {
                category: category
            },
            success: function(data) {
                $('#features-box').find('#features-list').remove();
                $('#features-box').append(data);
            }
        });
    });
</script>

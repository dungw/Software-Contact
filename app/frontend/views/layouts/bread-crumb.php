<?php
use yii\widgets\Breadcrumbs;
use frontend\widgets\Alert;
?>

<?= Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
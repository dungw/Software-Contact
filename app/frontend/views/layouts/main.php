<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <?php $this->registerCssFile(Yii::$app->homeUrl . '/css/styles.css') ?>

</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">

        <?php echo $this->render('header') ?>

        <div class="container">
            <?php echo $this->render('bread-crumb') ?>
            <?php echo $content ?>
        </div>
    </div>

    <footer class="footer">
        <?php echo $this->render('footer') ?>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

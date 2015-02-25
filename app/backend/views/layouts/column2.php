<?php
use yii\widgets\Menu;

$this->beginContent('@backend/views/layouts/main.php'); ?>

    <div class="container">

        <div class="col-sm-2">
            <?php
            echo Menu::widget([
                'items' => [
                    // Important: you need to specify url as 'controller/action',
                    // not just as 'controller' even if default action is used.
                    ['label' => 'Guide', 'url' => ['site/index']],
                    ['label' => 'Create software', 'url' => ['product/index'], 'items' => [
                        /** sub-menu
                        ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                        ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
                         */
                    ]]
                ],
            ]);
            ?>
        </div>

        <div id="content" class="col-sm-10">
            <?php echo $content; ?>
        </div>

    </div>
<?php $this->endContent(); ?>
<?php

namespace backend\modules\category;

class Category extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\category\controllers';

    public $menus = [
        ['label' => 'Thêm mới danh mục', 'url' => '/admin/category/default/create'],
        ['label' => 'Danh sách danh mục', 'url' => '/admin/category/default/index'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

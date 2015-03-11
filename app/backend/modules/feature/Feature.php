<?php

namespace backend\modules\feature;

class Feature extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\feature\controllers';

    public $menus = [
        ['label' => 'Thêm mới tính năng', 'url' => '/admin/feature/default/create'],
        ['label' => 'Danh sách tính năng', 'url' => '/admin/feature/default/index'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

<?php

namespace backend\modules\manufacturer;

class Manufacturer extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\manufacturer\controllers';

    public $menus = [
        ['label' => 'Thêm mới NSX', 'url' => '/admin/manufacturer/default/create'],
        ['label' => 'Danh sách NSX', 'url' => '/admin/manufacturer/default/index'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

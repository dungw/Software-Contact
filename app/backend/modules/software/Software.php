<?php

namespace backend\modules\software;

class Software extends \yii\base\Module
{
    public $controllerNamespace = 'backend\modules\software\controllers';

    public $menus = [
        ['label' => 'Thêm mới phần mềm', 'url' => '/admin/software/default/create'],
        ['label' => 'Danh sách phần mềm', 'url' => '/admin/software/default/index'],
    ];

    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}

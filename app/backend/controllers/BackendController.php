<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;

class BackendController extends Controller {

    public $layout;

    public function init() {
        $id = Yii::$app->user->id;
        if (!$id) {
            $url = Url::toRoute(['/site/index']);
            $this->redirect($url);
        }
    }

}

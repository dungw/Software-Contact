<?php
namespace backend\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\UploadedFile;
use common\models\UploadForm;

class BackendController extends Controller {

    public $layout = '//column2';

    public function init() {
        $id = Yii::$app->user->id;
        $controllerId = $this->id;
        if (!$id && $controllerId != 'site') {
            $url = Url::toRoute(['/site/index']);
            $this->redirect($url);
        }

        // set path upload file
        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
        Yii::$app->params['uploadUrl'] = Yii::$app->urlManager->baseUrl . '/uploads/';
    }

}

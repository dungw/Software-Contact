<?php

namespace backend\modules\software\controllers;

use Yii;
use common\models\Software;
use common\models\SoftwareSearch;
use common\models\Manufacturer;
use common\models\Category;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BackendController;

/**
 * DefaultController implements the CRUD actions for Software model.
 */
class DefaultController extends BackendController {

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    // index action
    public function actionIndex()
    {
        $searchModel = new SoftwareSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    // view action
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // create new action
    public function actionCreate()
    {
        $model = new Software();

        // data to parse
        $parseData = ['model' => $model];

        // get categories
        $collections = Category::getActiveRecords();
        $categories = Category::_prepareDataSelect($collections, 'cat_id', 'cat_name');
        $parseData['categories'] = $categories;

        // get manufacturer
        $collections = Manufacturer::getActiveRecords();
        $manufacturers = Manufacturer::_prepareDataSelect($collections, 'id', 'name');
        $parseData['manufacturers'] = $manufacturers;

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // validate data
            if ($model->validate()) {
                $model->save();

                // get last id
                $softwareId = Yii::$app->db->getLastInsertID();

                // save features
                $this->saveFeature('features-list', $softwareId);

                // upload picture
                $picture = $model->uploadFile('picture', 'software');
                if ($picture) {
                    $model->picture = $picture;
                }

                // save slice picture
                $this->saveSlice('slide', 'slice', $softwareId);

                return $this->redirect(['index']);
            } else {

                // get the errors
                $errors = $model->getErrors();
                $parseData['errors'] = $errors;
            }
        }

        return $this->render('create', $parseData);
    }

    // update action
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // data to parse
        $parseData = ['model' => $model];

        // get the old picture
        $oldPicture = $model->picture;

        // get categories
        $collections = Category::getActiveRecords();
        $categories = Category::_prepareDataSelect($collections, 'cat_id', 'cat_name');
        $parseData['categories'] = $categories;

        // get manufacturer
        $collections = Manufacturer::getActiveRecords();
        $manufacturers = Manufacturer::_prepareDataSelect($collections, 'id', 'name');
        $parseData['manufacturers'] = $manufacturers;

        // get current slide image
        $currentSlide = $model->getSlide($id);
        $parseData['slide'] = $currentSlide;

        // get active features
        $features = $model->getFeatures($id);
        if (!empty($features)) {
            foreach ($features as $feature) {
                $parseData['activeFeatures'][] = $feature['id'];
            }
        }

        // get features of current category
        if ($model->cate_id > 0) {
            $collections = Category::getFeature($model->cate_id);
            $parseData['categoryFeatures'] = $model->_prepareDataSelect($collections, 'id', 'name', []);
        }

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // validate data
            if ($model->validate()) {

                // save features
                $this->saveFeature('features-list', $id);

                // change picture
                $newPicture = $model->uploadFile('picture', 'software');
                if ($newPicture) {
                    $model->picture = $newPicture;

                    // delete old file
                    $model->deleteImage(Yii::$app->params['uploadPath'] . $oldPicture);
                    $model->deleteImage(Yii::$app->params['uploadPath'] . $model->getThumbnail($oldPicture));

                } else {
                    $model->picture = $oldPicture;
                }

                $model->save();

                // save slice picture
                $this->saveSlice('slide', 'slice', $id);

                return $this->redirect(['index']);
            } else {

                // get the errors
                $errors = $model->getErrors();
                $parseData['errors'] = $errors;
            }
        }

        return $this->render('update', $parseData);
    }

    // save slice picture
    protected function saveSlice($inputName, $subFolder, $id) {

        // get model
        $model = $this->findModel($id);

        // upload slide image
        $slide = $model->uploadFiles($inputName, $subFolder);

        // insert to software_picture table
        if (!empty($slide)) {
            foreach ($slide as $img) {
                Yii::$app->db->createCommand()->insert('software_picture', [
                    'software_id' => $id,
                    'path' => $img,
                ])->execute();
            }
        }
    }

    // save feature
    protected function saveFeature($inputName, $id) {
        $features = Yii::$app->request->post($inputName);

        if (!empty($features) && $id > 0) {

            // get action
            $action = Yii::$app->controller->action->id;

            // delete old record if this is update action
            if ($action == 'update') {
                Yii::$app->db->createCommand()->delete('software_feature', [
                    'software_id' => $id,
                ])->execute();
            }

            // insert new features
            $data = array();
            foreach ($features as $feature) {
                $data[] = [$feature, $id];
            }
            Yii::$app->db->createCommand()
                ->batchInsert('software_feature', ['feature_id', 'software_id'], $data)
                ->execute();
        }
        return;
    }

    // remove image action
    public function actionRemoveImg() {
        if (Yii::$app->request->isAjax) {
            $id = intval(Yii::$app->request->post('id'));
            if ($id > 0) {
                $path = Yii::$app->db->createCommand("SELECT path FROM software_picture WHERE id = ". $id)
                    ->queryOne();

                if ($path['path']) {

                    // delete in db
                    Yii::$app->db->createCommand()->delete('software_picture', [
                        'id' => $id
                    ])->execute();

                    $fullPath = Yii::$app->params['uploadPath'] . $path['path'];
                    if (file_exists($fullPath)) {

                        // delete file
                        Software::deleteImage($fullPath);
                        Software::deleteImage(Software::getThumbnail($fullPath));
                    }
                    echo 'success';
                }
            }
        }
    }

    // delete action
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // find model
    protected function findModel($id)
    {
        if (($model = Software::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

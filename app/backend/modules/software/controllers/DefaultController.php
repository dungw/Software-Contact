<?php

namespace backend\modules\software\controllers;

use common\models\Category;
use Yii;
use common\models\Software;
use common\models\SoftwareSearch;
use common\models\Manufacturer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BackendController;

/**
 * DefaultController implements the CRUD actions for Software model.
 */
class DefaultController extends BackendController {

    public $layout = '//column2';

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

    /**
     * Lists all Software models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SoftwareSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Software model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Software model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Software();

        if (Yii::$app->request->isPost) {

            $model->load(Yii::$app->request->post());

            // upload picture
            $picture = $model->uploadFile('picture', 'software');
            if ($picture) {
                $model->picture = $picture;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Software model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPicture = $model->picture;

        // get categories
        $collections = Category::find()
            ->where(['status' => Category::STATUS_ACTIVE])
            ->all();
        $categories = Category::prepareForSelect($collections, 'cat_id', 'cat_name');

        // get manufacturer
        $collections = Manufacturer::find()
            ->where(['status' => Manufacturer::STATUS_ACTIVE])
            ->all();
        $manufacturers = Manufacturer::prepareForSelect($collections, 'id', 'name');

        // get current slide image
        $currentSlide = $model->getSlide($id);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

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

            // upload slide image
            $slide = $model->uploadFiles('slide', 'slide');

            // insert to software_picture table
            if (!empty($slide)) {
                foreach ($slide as $img) {
                    Yii::$app->db->createCommand()->insert('software_picture', [
                        'software_id' => $id,
                        'path' => $img,
                    ])->execute();

                    // return id
                    $lastId = Yii::$app->db->getLastInsertID();
                }
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
                'manufacturers' => $manufacturers,
                'slide' => $currentSlide,
            ]);
        }
    }

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

    /**
     * Deletes an existing Software model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Software model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Software the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Software::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

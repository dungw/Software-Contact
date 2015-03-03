<?php

namespace backend\modules\software\controllers;

use Yii;
use common\models\Software;
use common\models\SoftwareSearch;
use common\models\CategorySearch;
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
        $cateSearch = new CategorySearch();
        $cateModels = $cateSearch->search(array())->getModels();
        $categories = $cateSearch->prepareForSelect($cateModels);

        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            // change picture
            $newPicture = $model->uploadFile('picture', 'software');
            if ($newPicture) {
                $model->picture = $newPicture;
            } else {
                $model->picture = $oldPicture;
            }

            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'categories' => $categories,
            ]);
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

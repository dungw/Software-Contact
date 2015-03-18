<?php

namespace backend\modules\category\controllers;

use Yii;
use common\models\Category;
use common\models\CategorySearch;
use backend\controllers\BackendController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Category model.
 */
class DefaultController extends BackendController
{

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
     * Lists all Category models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Category model.
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
     * Creates a new Category model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Category();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // get return id
            $newId = Yii::$app->db->lastInsertID;

            // save features
            $this->saveFeature('list-feature', $newId);

            return $this->redirect(['index']);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    // save features of category function
    protected function saveFeature($inputName, $categoryId) {
        $features = Yii::$app->request->post($inputName);

        if (!empty($features) && $categoryId > 0) {

            // get action
            $action = Yii::$app->controller->action->id;

            // delete old record if this is update action
            if ($action == 'update') {
                Yii::$app->db->createCommand()->delete('category_feature', [
                    'category_id' => $categoryId,
                ])->execute();
            }

            // insert new features
            $data = array();
            foreach ($features as $feature) {
                $data[] = [$feature, $categoryId];
            }
            Yii::$app->db->createCommand()
                ->batchInsert('category_feature', ['feature_id', 'category_id'], $data)
                ->execute();
        }
        return;
    }

    /**
     * Updates an existing Category model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        // get feature of this category
        $features = $model->getFeature($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            // save features
            $this->saveFeature('list-feature', $id);

            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
                'features' => $features,
            ]);
        }
    }

    /**
     * Deletes an existing Category model.
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
     * Finds the Category model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Category the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Category::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

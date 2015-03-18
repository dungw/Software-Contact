<?php

namespace backend\modules\feature\controllers;

use Yii;
use common\models\Feature;
use common\models\FeatureSearch;
use common\components\helpers\Show;
use backend\controllers\BackendController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DefaultController implements the CRUD actions for Feature model.
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
     * Lists all Feature models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeatureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Feature model.
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
     * Creates a new Feature model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feature();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Feature model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feature model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    // find the model
    protected function findModel($id)
    {
        if (($model = Feature::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    // get features by ajax request
    public function actionGetByAjax() {
        if (Yii::$app->request->isAjax) {
            // get params
            $params = Yii::$app->request->post();

            // if category is integer
            if (isset($params['category']) && $params['category'] > 0) {
                $sql = "SELECT f.id, f.name
                        FROM feature f
                        INNER JOIN category_feature cf ON(cf.feature_id = f.id)
                        WHERE cf.category_id = ". $params['category'] ." AND f.status = ". Feature::STATUS_ACTIVE;

                $features = Yii::$app->db->createCommand($sql)->queryAll();
                print Show::multiSelect($features, 'id', 'name', ['id' => 'features-list']);
            }
        }

    }
}

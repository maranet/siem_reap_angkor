<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Allotment;
use frontend\models\AllotmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
/**
 * AllotmentController implements the CRUD actions for Allotment model.
 */
class AllotmentController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Allotment models.
     * @return mixed
     */
    public function actionIndex()
    {
        $tour_categories = \backend\models\TourCategory::find()->one();
        $searchModel = new AllotmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $categories = \backend\models\TourCategory::find()->one();

        return $this->render('index', [
            'tour_categories' => $tour_categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
        ]);
    }
    public function actionDependent()
    {
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->post('action') == 'get_rate_plan'){
                $from_date = Yii::$app->request->post('from_date');
                $adult = Yii::$app->request->post('adult');
                $child = Yii::$app->request->post('child');
                $number = $adult + $child;
                $item_id = Yii::$app->request->post('item_id');
                $rate_model_id = Yii::$app->request->post('rate_model_id');

                $allotment_data = Yii::$app->db->createCommand("SELECT * from allotment where date = '$from_date' and number >= $number and rate_set_up_id = $rate_model_id")->queryAll();
                if (empty($allotment_data)) {
                    $response = "";
                }else{
                    $response = Yii::$app->db->createCommand("SELECT *, name
                            FROM rate_plan_setup rps LEFT JOIN
                                 rate_plan r ON rps.id = r.rate_set_up_id where `date` = '$from_date' and rate_set_up_id in (SELECT id from rate_plan_setup where tour_item_id = $item_id) and rate_range_id IN (SELECT id FROM `rate_range` WHERE $number BETWEEN `from_person` AND `to_people`)
                                        ")->queryAll();

                    // $response = Yii::$app->db->createCommand("SELECT * from rate_plan where `date` = '$from_date' and rate_set_up_id in (SELECT id from rate_plan_setup where tour_item_id = $item_id) and rate_range_id IN (SELECT id FROM `rate_range` WHERE $number BETWEEN `from_person` AND `to_people`)")->queryAll();
                }
                // $response = \backend\models\RatePlan::find()->where(['rate_set_up_id'=>$item_id, 'date'=>$from_date, 'rate_range_id'=>$range_id])->asArray()->all();
                
                return json_encode($response);
            }
        }
    }
    public function actionItemDetail($id)
    {
        $item_id = $id;
        $tour_categories = \backend\models\TourCategory::find()->one();
        $searchModel = new AllotmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $item_details = \backend\models\TourItem::find()->where(['id'=>$id])->one();
        $item_galleries = \backend\models\TourItemGallery::find()->where(['tour_item_id'=>$id])->all();

        return $this->render('tour_item_detail', [
            'item_details' => $item_details,
            'item_galleries' => $item_galleries,
            'tour_categories' => $tour_categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'item_id' => $item_id,
        ]);
    }

    /**
     * Displays a single Allotment model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Allotment model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this -> layout = 'blankLayout';

        $model = new Allotment();

        $model->created_date =  date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->getId(); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Saved successful");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Allotment model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this -> layout = 'blankLayout';

        $model = $this->findModel($id);

        $model->updated_date =  date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->getId(); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Saved successful");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Allotment model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Allotment model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Allotment the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Allotment::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

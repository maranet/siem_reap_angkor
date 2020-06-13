<?php

namespace frontend\controllers;
use backend\models\TourItem;
use backend\models\TourItemSearch;

use Yii;
use frontend\models\TourCategory;
use frontend\models\TourCategorySearch;
use backend\models\AllotmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use yz\shoppingcart\ShoppingCart;
/**
 * TourCategoryController implements the CRUD actions for TourCategory model.
 */
class TourCategoryController extends Controller
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
     * Lists all TourCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        // =========Checkbox Category filter Item=========== 
        // check condition for ajax request from view
        if(Yii::$app->request->isAjax){

            // which type and action that ajax request
            if(Yii::$app->request->post('action') == 'get_item'){
                // ajax request by post id
                // create new variable name $zipId
                $category_id = Yii::$app->request->post('category_id');
                // query: if query by using active record must query must return One() row and also asArray()
                // else query: by create Command must use queryOne().
                $response = \backend\models\TourItem::find()->where(['category_id'=>$category_id,'status'=>1])->asArray()->all();
                // when ajax reques controller will return json_endcode(query) back *note: asArray()
                // view will get by syntax JSON.parse().
                return json_encode($response);
            }

        }

        $tour_items = TourItem::find()->all();
        $tour_categories = \backend\models\TourCategory::find()->one();
        $searchModel = new TourCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // echo "<pre>";
        // print_r($tour_items);
        // exit();
        return $this->render('index', [
            'tour_items' => $tour_items,
            'tour_categories' => $tour_categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
//Shopping cart
    public function actionAddToCart($id)
    {
        // $cart = new ShoppingCart();

        // $model = TourItem::findOne($id);
        // if ($model) {
        //     $cart->put($model, 1);
        //     $data = $cart->getPositions();
        //     return $this->render('cart',[
        //         'data' => $data,
        //     ]);
        // }
        // throw new NotFoundHttpException();
    }

//End Shopping cart 
    /**
     * Displays a single TourCategory model.
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
     * Creates a new TourCategory model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this -> layout = 'blankLayout';

        $model = new TourCategory();

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
     * Updates an existing TourCategory model.
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
     * Deletes an existing TourCategory model.
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
     * Finds the TourCategory model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TourCategory the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TourCategory::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

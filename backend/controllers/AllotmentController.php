<?php

namespace backend\controllers;

use Yii;
use backend\models\Allotment;
use backend\models\AllotmentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use backend\models\AllotmentNumber;
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
        $model = new Allotment();

        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->post('action') == 'get_year'){
                $year = Yii::$app->request->post('year');
                $response = \backend\models\YearList::find()->where(['id'=>$year])->asArray()->one()->name;
                return json_encode($response);
            }
        }

        $current_page = Yii::$app->controller->id."-index";
        $this->view->params['current_page'] = $current_page;
        
        $searchModel = new AllotmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $total_items = $dataProvider->getTotalCount();

        $page_size = array_values( Yii::$app->params['page_size'])[0];
        $page_size_cookie = $current_page.'_page_size';
        if(isset($_REQUEST["page_size"])){
            if(intval($_REQUEST["page_size"])>0){
                $page_size = intval($_REQUEST["page_size"]);
                $set_cookies = Yii::$app->response->cookies;
                $set_cookies->add(new Cookie([
                'name' => $page_size_cookie,
                'value' => $page_size,
                'expire' => time() + (86400 * 3),
                ]));
            }
        } else {
            $get_cookies = Yii::$app->request->cookies;
            if ($get_cookies->has($page_size_cookie)) {
                $page_size = $get_cookies->getValue($page_size_cookie);
            }
        }

        $page = 0;
        $page_cookie = $current_page.'_page';
        if(isset($_REQUEST["page"])){
            if(intval($_REQUEST["page"])>0){
                $page = intval($_REQUEST["page"])-1;
                $set_cookies = Yii::$app->response->cookies;
                $set_cookies->add(new Cookie([
                'name' => $page_cookie,
                'value' => $page,
                'expire' => time() + (86400 * 3),
                ]));
            }
        } else {
            $get_cookies = Yii::$app->request->cookies;
            if ($get_cookies->has($page_cookie)) {
                $page = $get_cookies->getValue($page_cookie);
            }
        }
        $max_page = ceil($total_items / $page_size);

        $decrease_page = 0;
        while($page + 1 > $max_page){
            $page=$page-1;
            $decrease_page = 1;
        }
        if($decrease_page==1){
            $set_cookies = Yii::$app->response->cookies;
            $set_cookies->add(new Cookie([
            'name' => $page_cookie,
            'value' => $page,
            'expire' => time() + (86400 * 3),
            ]));
        }

        $dataProvider->pagination->pageSize = $page_size;
        $dataProvider->pagination->page = $page;

        return $this->render('index', [
            'page_size' => $page_size,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
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
    public function actionCreate($month, $year, $search_item_rate_setup)
    {
        $id_month = \backend\models\MonthList::find()->where(['value'=>$month])->one()->id;
        $id_year = \backend\models\YearList::find()->where(['name'=>$year])->one()->id;

        $model = new Allotment();
        $model->created_date =  date('Y-m-d H:i:s');
        $updated_date =  date('Y-m-d H:i:s');
        $model->date =  date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->getId(); 
        $updated_by = Yii::$app->user->getId(); 
        $model->company_id = $_SESSION['company_id']; 
        $company_id = 1; 
        // $company_id = $_SESSION['company_id']; 
        if ($model->load(Yii::$app->request->post())) {
            $model->status = 1;
            Yii::$app->db->createCommand("DELETE from allotment
            where date BETWEEN '$model->from_date' AND '$model->to_date' AND rate_set_up_id = $model->rate_set_up_id")->execute();
                

                $str= "";
                for ($i=$model->from_date; $i <= $model->to_date; $i++) {
                        $str = "('$i', '$model->tour_item_id', $model->number, $model->rate_set_up_id, $company_id, '$updated_date', $updated_by)".",".$str;
                    }
                    $str = rtrim($str, ",");
                    $insert = "INSERT INTO allotment(date, tour_item_id, number, rate_set_up_id, company_id, updated_date, updated_by) VALUES". $str;
                    // print_r($insert);
                    // exit();
                    Yii::$app->db->createCommand($insert)->execute();
        }
        if($model->save()){
            Yii::$app->session->setFlash('success', "Saved successful");
            return $this->redirect('index.php?r=allotment%2Findex&AllotmentSearch%5Bmonth%5D='.$id_month.'&AllotmentSearch%5Byear%5D='.$id_year.'&AllotmentSearch%5Brate_set_up_id%5D='.$search_item_rate_setup.'');

            }else {
                echo "MODEL NOT SAVED";
                print_r($model->getAttributes());
                print_r($model->getErrors());
                exit;
            };
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

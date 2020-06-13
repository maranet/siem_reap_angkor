<?php

namespace backend\controllers;

use Yii;
use backend\models\RatePlan;
use backend\models\RatePlanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\RateRange;
use backend\models\RatePlanSetupRange;

/**
 * RatePlanController implements the CRUD actions for RatePlan model.
 */
class RatePlanController extends Controller
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
     * Lists all RatePlan models.
     * @return mixed
     */
    public function actionIndex()
    {
        $current_page = Yii::$app->controller->id."-index";
        $this->view->params['current_page'] = $current_page;
        
        $searchModel = new RatePlanSearch();
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


        // $rate_set_up_id = ArrayHelper::map(\backend\models\RatePlanSetup::find()
        //             ->where(['id' => $get_tour_id])
        //             ->all(), 'id', function($model){return $model->name;});
        $model = new RatePlan();

        return $this->render('index', [
            'page_size' => $page_size,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single RatePlan model.
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
     * Creates a new RatePlan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($month, $id, $year)
    {
        $get_tour_setup_id = $id;
        $rate_set_up_id = ArrayHelper::map(\backend\models\RatePlanSetup::find()
                    ->where(['id' => $get_tour_setup_id])
                    ->all(), 'id', function($model){return $model->name;});

        $model = new RatePlan();

        $model->created_date =  date('Y-m-d H:i:s');
        $created_date =  date('Y-m-d H:i:s');
        $created_by = Yii::$app->user->getId(); 
        $model->created_by = Yii::$app->user->getId(); 
        if ($model->load(Yii::$app->request->post())){
            $model->status = 1;
            $company_id = $_SESSION['company_id'];
            $from_date = $model->from_date;
            $to_date = $model->to_date;
            $rate_setup_range =  $model->rate_range_id;
            $range = RatePlanSetupRange::find()->where(['id'=>$rate_setup_range, 'tour_rate_setup_id'=>$get_tour_setup_id])->one();
            // echo "<pre>";
            // print_r($range);
            // exit();


            //===Start Compare value and sent to rate detail
            // Yii::$app->db->createCommand("DELETE from rate_plan
            // where date BETWEEN '$from_date' AND '$to_date' AND rate_set_up_id = $get_tour_setup_id")->execute();
            //====start get value form input
            $cost_adult = Yii::$app->request->post('cost_adult');
            $cost_child = Yii::$app->request->post('cost_child');
            $mark_up_adult = Yii::$app->request->post('mark_up_adult');
            $mark_up_child = Yii::$app->request->post('mark_up_child');
            $mark_up_type = Yii::$app->request->post('mark_up_type');
            $price_adult = Yii::$app->request->post('price_adult');
            $price_child = Yii::$app->request->post('price_child');
            //====end get value form input

            //===Start save to rate range
            $str_range= "";
            if (!empty($price_child)) {
            //     Yii::$app->db->createCommand("DELETE from rate_range
            // where month = $month and year = $year and rate_set_up_id = $id and rate_setup_range_id = $rate_setup_range")->execute();

            echo $range_arr_query = Yii::$app->db->createCommand("SELECT id from rate_range
            where month = $month and year = $year and rate_set_up_id = $id and rate_setup_range_id = $rate_setup_range")->queryScalar();
                
                foreach ($price_child as $key => $value) {
                    if (!empty($range_arr_query)) {
                        Yii::$app->db->createCommand("DELETE from rate_plan
                        where date BETWEEN '$from_date' AND '$to_date' AND rate_range_id = $range_arr_query and rate_set_up_id = $get_tour_setup_id")->execute();
                            $rate_range_id = $range_arr_query;
                            for ($i=$model->from_date; $i <= $model->to_date; $i++) 
                                {
                                    $model_rate_plan = new RatePlan();
                                    $model_rate_plan->rate_range_id = $rate_range_id;
                                    $model_rate_plan->date = $i;
                                    $model_rate_plan->rate_set_up_id = $get_tour_setup_id;
                                    $model_rate_plan->cost_adult = $cost_adult[$key];
                                    $model_rate_plan->cost_child = $cost_child[$key];
                                    $model_rate_plan->mark_up_adult = $mark_up_adult[$key];
                                    $model_rate_plan->mark_up_child = $mark_up_child[$key];
                                    $model_rate_plan->mark_up_type = $mark_up_type[$key];
                                    $model_rate_plan->price_adult = $price_adult[$key];
                                    $model_rate_plan->price_child = $price_child[$key];
                                    $model_rate_plan->company_id = $company_id;
                                    $model_rate_plan->created_date = $created_date;
                                    $model_rate_plan->created_by = $created_by;
                                    // echo "<pre>";
                                    // print_r($model_rate_plan);
                                    // exit();
                                    $model_rate_plan->save();
                                }
                        }else{
                            $model_rate_range = new RateRange();
                            $model_rate_range->rate_set_up_id = $get_tour_setup_id;
                            $model_rate_range->rate_setup_range_id = $rate_setup_range;
                            $model_rate_range->month = $month;
                            $model_rate_range->year = $year;
                            $model_rate_range->from_person = $range->range_from;
                            $model_rate_range->to_people = $range->range_to;
                            if ($model_rate_range->save()) {
                                $rate_range_id = $model_rate_range->id;
                                for ($i=$model->from_date; $i <= $model->to_date; $i++) 
                                {
                                    $model_rate_plan = new RatePlan();
                                    $model_rate_plan->rate_range_id = $rate_range_id;
                                    $model_rate_plan->date = $i;
                                    $model_rate_plan->rate_set_up_id = $get_tour_setup_id;
                                    $model_rate_plan->cost_adult = $cost_adult[$key];
                                    $model_rate_plan->cost_child = $cost_child[$key];
                                    $model_rate_plan->mark_up_adult = $mark_up_adult[$key];
                                    $model_rate_plan->mark_up_child = $mark_up_child[$key];
                                    $model_rate_plan->mark_up_type = $mark_up_type[$key];
                                    $model_rate_plan->price_adult = $price_adult[$key];
                                    $model_rate_plan->price_child = $price_child[$key];
                                    $model_rate_plan->company_id = $company_id;
                                    $model_rate_plan->created_date = $created_date;
                                    $model_rate_plan->created_by = $created_by;
                                    // echo "<pre>";
                                    // print_r($model_rate_plan);
                                    // exit();
                                    $model_rate_plan->save();
                                }

                            }else{
                                echo "Not save";
                                exit();
                            }
                        }
                }
            }
            $month_id = \backend\models\MonthList::find()->where(['value'=>$month])->one()->id;
           Yii::$app->session->setFlash('success', "Saved successful");
                    return $this->redirect('index.php?r=rate-plan%2Findex&RatePlanSearch%5Bmonth%5D='.$month_id.'&RatePlanSearch%5Byear%5D='.$year.'&RatePlanSearch%5Brate_set_up_id%5D='.$get_tour_setup_id.'');

        }

        return $this->render('create', [
            'model' => $model,
            'rate_set_up_id' => $rate_set_up_id,
            'month' => $month,
            'year' => $year,
            'get_tour_setup_id' => $get_tour_setup_id,
        ]);
       
    }
    public function actionYearlyCreate($month, $id, $year)
    {

        $month_value = $month;

        $get_tour_setup_id = $id;
        $rate_set_up_id = ArrayHelper::map(\backend\models\RatePlanSetup::find()
                    ->where(['id' => $get_tour_setup_id])
                    ->all(), 'id', function($model){return $model->name;});

        $model = new RatePlan();

        $model->created_date =  date('Y-m-d H:i:s');
        $created_date =  date('Y-m-d H:i:s');
        $created_by = Yii::$app->user->getId(); 
        $model->created_by = Yii::$app->user->getId(); 
        if ($model->load(Yii::$app->request->post())){
            $model->status = 1;
            $company_id = $_SESSION['company_id'];
            $from_date = $model->from_date;
            $to_date = $model->to_date;
            $rate_setup_range =  $model->yearly_rate_range_id;
            $range = RatePlanSetupRange::find()->where(['id'=>$rate_setup_range, 'tour_rate_setup_id'=>$get_tour_setup_id])->one();
            // echo "<pre>";
            // print_r($range);
            // exit();

            $start = $month = strtotime($from_date);
                $end = strtotime($to_date);
                $i= 1;
                while($month < $end)
                {
                    
                    $while_month_id = date('n', $month);
                    $while_month_value = date('m', $month);
                    $while_year_name = date('Y', $month);
                    $while_year_id = \backend\models\YearList::find()->where(['name'=>$while_year_name])->one()->id;
                    // start create
                $cost_adult = Yii::$app->request->post('cost_adult');
                    $cost_child = Yii::$app->request->post('cost_child');
                    $mark_up_adult = Yii::$app->request->post('mark_up_adult');
                    $mark_up_child = Yii::$app->request->post('mark_up_child');
                    $mark_up_type = Yii::$app->request->post('mark_up_type');
                    $price_adult = Yii::$app->request->post('price_adult');
                    $price_child = Yii::$app->request->post('price_child');
                    //====end get value form input

                    //===Start save to rate range
                    $str_range= "";
                    if (!empty($price_child)) {
                    // echo $while_year_id;    
                    // echo $while_year_id;    
                    // echo $id;    
                    // echo $rate_setup_range;    
                    // echo $while_month_id;
                        foreach ($price_child as $key => $value) 
                        {
                            $range_arr_query = Yii::$app->db->createCommand("SELECT id from rate_range where month = $while_month_id and year = $while_year_id and rate_set_up_id = $id and rate_setup_range_id = $rate_setup_range")->queryScalar();
                            if (!empty($range_arr_query)) {
                                Yii::$app->db->createCommand("DELETE from rate_plan
                                where date BETWEEN '$from_date' AND '$to_date' AND rate_range_id = $range_arr_query and rate_set_up_id = $get_tour_setup_id")->execute();
                                    $rate_range_id = $range_arr_query;
                                    //loop each month and each range id
                                        $day_from_date = date('d', strtotime($from_date));
                                        $new_from_date = $while_year_name."-".$while_month_value."-"."01";
                                        $new_end_date = date("Y-m-t", strtotime($new_from_date));

                                    
                                    //end


                                    for ($i=$new_from_date; $i <= $new_end_date; $i++) 
                                        {
                                            $model_rate_plan = new RatePlan();
                                            $model_rate_plan->rate_range_id = $rate_range_id;
                                            $model_rate_plan->date = $i;
                                            $model_rate_plan->rate_set_up_id = $get_tour_setup_id;
                                            $model_rate_plan->cost_adult = $cost_adult[$key];
                                            $model_rate_plan->cost_child = $cost_child[$key];
                                            $model_rate_plan->mark_up_adult = $mark_up_adult[$key];
                                            $model_rate_plan->mark_up_child = $mark_up_child[$key];
                                            $model_rate_plan->mark_up_type = $mark_up_type[$key];
                                            $model_rate_plan->price_adult = $price_adult[$key];
                                            $model_rate_plan->price_child = $price_child[$key];
                                            $model_rate_plan->company_id = $company_id;
                                            $model_rate_plan->created_date = $created_date;
                                            $model_rate_plan->created_by = $created_by;
                                            $model_rate_plan->save();

                                        }

                            }else{
                                $model_rate_range = new RateRange();
                                $model_rate_range->rate_set_up_id = $get_tour_setup_id;
                                $model_rate_range->rate_setup_range_id = $rate_setup_range;
                                $model_rate_range->month = $while_month_id;
                                $model_rate_range->year = $while_year_id;
                                $model_rate_range->from_person = $range->range_from;
                                $model_rate_range->to_people = $range->range_to;
                                if ($model_rate_range->save()) {
                                    $rate_range_id = $model_rate_range->id;
                                    
                                    //loop each month and each range id
                                        
                                        // first loop date

                                        // $day_from_date = date('d', strtotime($from_date));
                                        // $i == 1 ?  : $day_from_date = "01";
                                       $day_from_date = date('d', strtotime($from_date));
                                        $new_from_date = $while_year_name."-".$while_month_value."-"."01";
                                        $new_end_date = date("Y-m-t", strtotime($new_from_date));

                                        
                                        //end

                                    for ($i=$new_from_date; $i <= $new_end_date; $i++) 
                                        {
                                            $model_rate_plan = new RatePlan();
                                            $model_rate_plan->rate_range_id = $rate_range_id;
                                            $model_rate_plan->date = $i;
                                            $model_rate_plan->rate_set_up_id = $get_tour_setup_id;
                                            $model_rate_plan->cost_adult = $cost_adult[$key];
                                            $model_rate_plan->cost_child = $cost_child[$key];
                                            $model_rate_plan->mark_up_adult = $mark_up_adult[$key];
                                            $model_rate_plan->mark_up_child = $mark_up_child[$key];
                                            $model_rate_plan->mark_up_type = $mark_up_type[$key];
                                            $model_rate_plan->price_adult = $price_adult[$key];
                                            $model_rate_plan->price_child = $price_child[$key];
                                            $model_rate_plan->company_id = $company_id;
                                            $model_rate_plan->created_date = $created_date;
                                            $model_rate_plan->created_by = $created_by;
                                            $model_rate_plan->save();
                                        }

                                }else{
                                    echo "Not save";
                                    exit();
                                }

                            }      
                        }
                    }
                // end create
                     $month = strtotime("+1 month", $month);
                     $i++;
                }
                $month_id = \backend\models\MonthList::find()->where(['value'=>$month_value])->one()->id;
           Yii::$app->session->setFlash('success', "Saved successful");
                    return $this->redirect('index.php?r=rate-plan%2Findex&RatePlanSearch%5Bmonth%5D='.$month_id.'&RatePlanSearch%5Byear%5D='.$year.'&RatePlanSearch%5Brate_set_up_id%5D='.$get_tour_setup_id.'');
        }

        return $this->render('create', [
            'model' => $model,
            'rate_set_up_id' => $rate_set_up_id,
            'month' => $month,
            'year' => $year,
            'get_tour_setup_id' => $get_tour_setup_id,
        ]);
       
    }
    public function actionCrateYearlyRate($month, $id, $year) {
        echo "Month is: ". $month."<br>";
        echo "Month is: ". $id."<br>";
        echo "Month is: ". $year;
        exit();
    }

    /**
     * Updates an existing RatePlan model.
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
     * Deletes an existing RatePlan model.
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
     * Finds the RatePlan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RatePlan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RatePlan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

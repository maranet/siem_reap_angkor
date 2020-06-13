<?php

namespace backend\controllers;

use Yii;
use app\models\User;
use backend\models\CompanyUser;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    { 
        $current_page = Yii::$app->controller->id."-index";
        $this->view->params['current_page'] = $current_page;
        
        $searchModel = new UserSearch();
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
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();
        $signupForm = new \frontend\models\SignupForm();
        $signupForm->scenario = 'create';
        $signupForm->isNewRecord = true;
        if ($model->load(Yii::$app->request->post()) && $signupForm->load(Yii::$app->request->post())) {
            $signupForm->status = $model->status; 
            $signupForm->user_type_id = $model->user_type_id;
            $signupForm->employee_id = $model->employee_id; 
            if($signupForm->signup()){
                 // ========/// company  
                 $assign_user = Yii::$app->request->post('assign_to');
                 if((!empty($assign_user)) || ($assign_user != '')){ 
                 
                 foreach ($assign_user as $au) {
                     $assign = new CompanyUser();
                     $assign->user_id = $signupForm->employee_id;
                     $assign->company = $au; 
                     $assign->save(false);
                 }
             } 
                Yii::$app->session->setFlash('success', "Saved successful");
                return $this->redirect(Yii::$app->request->referrer);
            }else{ 
                print_r($signupForm->getErrors());
                exit();
            }
        }

        return $this->renderAjax('create', [
            'model' => $model,
            'signupForm' => $signupForm
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id); 
        $signupForm = new \frontend\models\SignupForm(); 
        $signupForm->username = $model->username;
        $signupForm->email = $model->email;
        $signupForm->id = $model->id;
        $signupForm->user_type_id = $model->user_type_id;
        $signupForm->employee_id = $model->employee_id;
        $signupForm->isNewRecord = false;

        if ($model->load(Yii::$app->request->post()) && $signupForm->load(Yii::$app->request->post())) {
            
            $signupForm->status = $model->status;
            $signupForm->user_type_id = $model->user_type_id;
            $signupForm->employee_id = $model->employee_id;
            if($signupForm->userUpdate()){
                  // ========/// company 

                $transaction_exception = Yii::$app->db->beginTransaction();
                  CompanyUser::deleteAll(['user_id'=>$model->employee_id]); 
                  $assign_user = Yii::$app->request->post('assign_to');
                  if((!empty($assign_user)) || ($assign_user != '')){
                    foreach ($assign_user as $au) {
                        $assign = new CompanyUser();
                        $assign->user_id = $model->employee_id;
                        $assign->company = $au;
                        if(!$assign->save()) throw new Exception("Failed to Assign User!");
                    }
                }

                $transaction_exception->commit();

                Yii::$app->session->setFlash('success', "Saved successful");

                return $this->redirect(Yii::$app->request->referrer);
            }else{
                print_r($signupForm->getErrors());
                exit();
            }
        }
        return $this->renderAjax('update', [
            'model' => $model,
            'signupForm' => $signupForm
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id); 
        $this->findModel($id)->delete();
        CompanyUser::deleteAll(['user_id'=>$model->employee_id]); 
        Yii::$app->session->setFlash('warning', "Deleted successful");



        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

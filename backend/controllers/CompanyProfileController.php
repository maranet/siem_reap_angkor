<?php

namespace backend\controllers;
use backend\models\EmployeeDepartment;
use backend\models\EmployeeDepartmentSearch;
use Yii;
use backend\models\CompanyProfile;
use backend\models\CompanyProfileSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use yii\web\UploadedFile;


/**
 * CompanyProfileController implements the CRUD actions for CompanyProfile model.
 */
class CompanyProfileController extends Controller
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
     * Lists all CompanyProfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        // $this -> layout = '_';


        // check condition for ajax request from view
        if(Yii::$app->request->isAjax){
            // which type and action that ajax request
            if(Yii::$app->request->post('action') == 'get_city'){
                // ajax request by post id
                // create new variable name $zipId
                $country_id = Yii::$app->request->post('country_id');
                // query: if query by using active record must query must return One() row and also asArray()
                // else query: by create Command must use queryOne().
                $reponse = \backend\models\City::find()->where(['country_id'=>$country_id])->asArray()->all();
                // when ajax reques controller will return json_endcode(query) back *note: asArray()
                // view will get by syntax JSON.parse().
                return json_encode($reponse);
            }

        }

        $current_page = Yii::$app->controller->id."-index";
        $this->view->params['current_page'] = $current_page;
        
        $searchModel = new CompanyProfileSearch();
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
     * Displays a single CompanyProfile model.
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
     * Creates a new CompanyProfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this -> layout = 'blankLayout';
        $model = new CompanyProfile();
        $base_url = Yii::$app->request->baseUrl;
        $date = date('YmdHis');
        
        if ($model->load(Yii::$app->request->post())) {
            $company_name = $model->name;
            $company_name = str_replace(' ', '_', strtolower($company_name));
            $model->created_by = Yii::$app->user->getId();
            $model->user_id = $model->created_by;
            $model->company_id = $_SESSION['company_id']; 
            $model->created_date =  date('Y-m-d H:i:s');
            $imageName = $model->name;
            $model->user_id = $model->created_by;
            $model->company_id = $_SESSION['company_id']; 
            if($model->file = UploadedFile::getInstance($model, 'file')) {
                    $controller = Yii::$app->controller->id;
                    $path = Yii::getAlias('@backend') . "/web/uploads/$company_name/$controller";
                    $path_image = $base_url . "/uploads/$company_name/$controller";
                    if (!is_dir($path)) {
                    \yii\helpers\FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
                    }
                    $model->file->saveAs($path.'/'  .$model->file->baseName.'_'.$date.'.'.$model->file->extension);
                    $model->feature_image = $path_image.'/'  .$model->file->baseName.'_'.$date. '.'.$model->file->extension;
                    $model->user_id = $model->created_by;
                    $model->company_id = $_SESSION['company_id']; 
            }
            if($model->file = UploadedFile::getInstance($model, 'service_agreement')) {
              
                $controller = Yii::$app->controller->id;
                $path = Yii::getAlias('@backend') . "/web/uploads/$company_name/$controller";
                $path_image = $base_url . "/uploads/$company_name/$controller";
                if (!is_dir($path)) {
                \yii\helpers\FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
                }
                $model->file->saveAs($path.'/'  .$model->file->baseName.'_'.$date.'.'.$model->file->extension);
                $model->service_agreement = $path_image.'/'  .$model->file->baseName.'_'.$date. '.'.$model->file->extension;
                $model->user_id = $model->created_by;
                $model->company_id = $_SESSION['company_id'];
            }
            if($model->save()){

                Yii::$app->session->setFlash('success', "Saved successful");
                return $this->redirect(Yii::$app->request->referrer);

            }else {
                echo "MODEL NOT SAVED";
                print_r($model->getAttributes());
                print_r($model->getErrors());
                exit;
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CompanyProfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionSetup()
    {
        $this -> layout = 'CompanyProfile';

        $model = $this->findModel($_SESSION['company_id'] );
        $searchModelEmployeeDepartment = new EmployeeDepartmentSearch();
        $dataProviderEmployeeDepartment = $searchModelEmployeeDepartment->search(Yii::$app->request->queryParams);


        if ($model->load(Yii::$app->request->post())) {
            $imageName = $model->name;
            if($model->file = UploadedFile::getInstance($model, 'file')) {
                $model->file->saveAs('uploads/' . $imageName. '.' .$model->file->extension);
                $model->feature_image = 'uploads/' . $imageName. '.' .$model->file->extension;
                $model->save();
            }
            $model->created_date =  date('Y-m-d H:i:s');
                $model->created_by = Yii::$app->user->getId();
                $model->user_id = $model->created_by;
                $model->company_id = $_SESSION['company_id'];;
                $model->save();
            Yii::$app->session->setFlash('success', "Saved successful");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('update_setup', [
            'model' => $model,
            'page_size' => 10,
            'searchModelEmployeeDepartment'=>$searchModelEmployeeDepartment,
            'dataProviderEmployeeDepartment'=>$dataProviderEmployeeDepartment
        ]);
    }

    public function actionUpdate($id)
    { 

        $model = $this->findModel($id);
        $model->user_id = $model->updated_by;
        $model->company_id = $_SESSION['company_id'];
        $base_url = Yii::$app->request->baseUrl;
        $date = date('YmdHis');
        $company_name = CompanyProfile::find()->where(['id' => $id])->one()->name; 
        $company_name = str_replace(' ', '_', strtolower($company_name));
        $model->user_id = $model->created_by;
        $model->company_id = $_SESSION['company_id']; 
        $model->updated_date =  date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->getId(); 
        $service_agreement = $model->service_agreement;
        if ($model->load(Yii::$app->request->post())) {
            $imageName = $model->name;
            if($model->file = UploadedFile::getInstance($model, 'file')) {
                $controller = Yii::$app->controller->id;
                $path = Yii::getAlias('@backend') . "/web/uploads/$company_name/$controller";
                $path_image = $base_url . "/uploads/$company_name/$controller";
                if (!is_dir($path)) {
                \yii\helpers\FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
                }
                $model->file->saveAs($path.'/'  .$model->file->baseName.'_'.$date.'.'.$model->file->extension);
                $model->feature_image = $path_image.'/'  .$model->file->baseName.'_'.$date. '.'.$model->file->extension;
                $model->user_id = $model->created_by;
                $model->company_id = $_SESSION['company_id']; 
            }
            if($model->file = UploadedFile::getInstance($model, 'service_agreement')) {
                $controller = Yii::$app->controller->id;
                $path = Yii::getAlias('@backend') . "/web/uploads/$company_name/$controller";
                $path_image = $base_url . "/uploads/$company_name/$controller";
                if (!is_dir($path)) {
                \yii\helpers\FileHelper::createDirectory($path, $mode = 0775, $recursive = true);
                }
                $model->file->saveAs($path.'/'  .$model->file->baseName.'_'.$date.'.'.$model->file->extension);
                $model->service_agreement_local_path = $path.'/'  .$model->file->baseName.'_'.$date.'.'.$model->file->extension;

                $model->service_agreement = $path_image.'/'  .$model->file->baseName.'_'.$date. '.'.$model->file->extension;
                $model->user_id = $model->created_by;
                $model->company_id = $_SESSION['company_id']; 
            }
            if($model->service_agreement == ""){
                $model->service_agreement = $service_agreement;
            }
            if($model->save()){
                
                Yii::$app->session->setFlash('success', "Saved successful");
                return $this->redirect(Yii::$app->request->referrer);

            }else {
                echo "MODEL NOT SAVED";
                print_r($model->getAttributes());
                print_r($model->getErrors());
                exit;
            }
             
           
                
            Yii::$app->session->setFlash('success', "Saved successful");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CompanyProfile model.
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
   
    public function actionDownload($id)
    { 
        $data  = CompanyProfile::findOne($id); 
        Yii::$app->response->sendFile($data->service_agreement_local_path);

    }
    /**
     * Finds the CompanyProfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyProfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyProfile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace backend\controllers;

use Yii;
use backend\models\Country;
use backend\models\CountrySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use yii\web\UploadedFile;
use backend\models\CompanyProfile;
/**
 * CountryController implements the CRUD actions for Country model.
 */
class CountryController extends Controller
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
     * Lists all Country models.
     * @return mixed
     */
    public function actionIndex()
    {

        $current_page = Yii::$app->controller->id."-index";
        $this->view->params['current_page'] = $current_page;
        
        $searchModel = new CountrySearch();
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
     * Displays a single Country model.
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
     * Creates a new Country model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this -> layout = 'blankLayout';

        $model = new Country();
        $base_url = Yii::$app->request->baseUrl;
        $date = date('YmdHis');
        $company_name = CompanyProfile::find()->where(['id' => $_SESSION['company_id'],'status'=>1])->one()->name; 
        $company_name = str_replace(' ', '_', strtolower($company_name));
        $model->user_id = $model->created_by;
        $model->company_id = $_SESSION['company_id']; 
        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->getId();
            $model->created_date =  date('Y-m-d H:i:s');
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
     * Updates an existing Country model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this -> layout = 'blankLayout';

        $model = $this->findModel($id);
        $model->user_id = $model->updated_by;
        $model->company_id = $_SESSION['company_id'];
        $base_url = Yii::$app->request->baseUrl;
        $date = date('YmdHis');
        $company_name = CompanyProfile::find()->where(['id' => $_SESSION['company_id'],'status'=>1])->one()->name; 
        $company_name = str_replace(' ', '_', strtolower($company_name));
        $model->user_id = $model->created_by;
        $model->company_id = $_SESSION['company_id']; 
        $model->updated_date =  date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->getId(); 
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
     * Deletes an existing Country model.
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
     * Finds the Country model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Country the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Country::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

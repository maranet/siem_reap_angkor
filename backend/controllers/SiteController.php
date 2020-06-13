<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\helpers\ArrayHelper;
use app\models\User;
use yii\db\Query;
use yii\data\ArrayDataProvider;
use backend\models\SaleTarget;
use backend\models\NewsSearch;
use backend\models\NewsDashboardSearch;
use backend\models\News;
use backend\models\Proposal;
use backend\models\Quotation;
use backend\models\Contract;
use backend\models\Project;
use backend\models\CustomerProfile;
use backend\models\Task;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionNotfound()
    {

    }
  
    public function actionIndex()
    {
        $userid  = Yii::$app->user->getId();
        // echo $userid;
        // $employee_id = User::find()->where(['id' => $userid])->one()->employee_id; 
        if (isset($_GET['property_id'])){
            $company_id = $_GET['property_id'];
        }else{
            $sql = "select b.id from company_user a INNER JOIN company_profile b on a.company = b.id";
            $company_id = Yii::$app->db->createCommand("$sql")->queryScalar();
        }
            $sql_condition = "select b.id from company_user a INNER JOIN company_profile b on a.company = b.id where b.id = $company_id";
            $condition = Yii::$app->db->createCommand("$sql_condition")->queryScalar();

        if($condition == ""){
            return $this->render('error',[
                'name'=>'Error',
                'message'=>'You are not authorized to access this page!'
            ]);
        }else{
            Yii::$app->session->set('company_id',$company_id);

        return $this->render('index',[
            // 'company_id' => $company_id, 
        ]);

        }
        
    }
  
    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        $this -> layout = 'loginLayout';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // && $model->login()
            // $user = \common\models\User::find()->where(['username' => $model->username])->one();
            // // if(!$user) return ;
            // // print_r($user);
            // var_dump(Yii::$app->security->validatePassword($model->password, $user->password_hash));
            // exit;
            // return $this->goBack();
            $user = \common\models\User::find()->where(['username' => $model->username])->one()->id;
           $company = \backend\models\CompanyUser::find()->where(['user_id' => $user])->one()->company;
            Yii::$app->session->set('company_id',1);
             return $this->redirect(['/company-profile/update', 'id' => 1]);
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}

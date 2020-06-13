<?php
namespace frontend\controllers;
use backend\models\TourItem;
use backend\models\TourItemSearch;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
// use frontend\models\TourCategorySearch;
use frontend\models\User;
use frontend\models\AllotmentSearch;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDependent()
    {
        if(Yii::$app->request->isAjax){
            if(Yii::$app->request->post('action') == 'image_gallery'){
                $id = Yii::$app->request->post('id');
                $response = \backend\models\GalleryImage::find()->select(['file_path', 'file_name'])->where(['gallery_id'=>$id])->asArray()->all();
                return json_encode($response);
            }
        }
    }
    public function actionIndex()
    {
        $company_profile = \backend\models\CompanyProfile::find()->all();
        $items_four = \backend\models\TourItem::find()->where(['show_home_page'=>1, 'status'=>1])->limit(4)->all();
        $categories = \backend\models\TourCategory::find()->where(['status'=>1])->all();
        $categories_get_two = \backend\models\TourCategory::find()->limit(2)->where(['status'=>1])->all();
        $slide_gallery = \backend\models\SlideGallery::find()->where(['slide_id'=>1])->all();
        $searchModel = new AllotmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->render('index',[
            'company_profile' =>  $company_profile,
            'items_four' => $items_four,
            'categories' => $categories,
            'categories_get_two' => $categories_get_two,
            'slide_gallery' => $slide_gallery,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,

        ]);
    }
    public function actionAllotmentIndex()
    {
        $tour_categories = \backend\models\TourCategory::find()->one();
        $searchModel = new AllotmentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/allotment/index', [
            'tour_categories' => $tour_categories,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionTour()
    {
        // $categories = \backend\models\TourCategory::find()->all();
        $tour_items = TourItem::find()->all();
        $tour_categories = \backend\models\TourCategory::find()->all();

        return $this->render('tour', [
            // 'categories' => $categories,
            'tour_items' => $tour_items,
            'tour_categories' => $tour_categories,
        ]);
    }

    public function actionTourItem($id)
    {
        $categories = \backend\models\TourCategory::find()->all();
        $tour_category = \backend\models\TourCategory::find()->where(['id'=>$id])->one();
        $tour_items = \backend\models\TourItem::find()->where(['category_id'=>$id])->all();
        return $this->render('tour_item', [
            'tour_items' => $tour_items,
            'tour_category' => $tour_category,
            'categories' => $categories,
        ]);
    }

    public function actionBlog()
    {
        $blogs = \backend\models\Blog::find()->all();
        $categories = \backend\models\TourCategory::find()->one();

        return $this->render('blog', [
            'blogs' => $blogs,
            'categories' => $categories,
        ]);
    }

    public function actionGallery()
    {   
        $tour_item =\backend\models\TourItem::find()->all();

        $tour_item_id =\backend\models\TourItem::find()->one()->id;

        $img_tour_item = \backend\models\TourItemGallery::find()->where(['tour_item_id' => $tour_item_id ])->all();
        return $this->render('gallery',[
            'img_tour_item' => $img_tour_item,
            'tour_item' => $tour_item,

        ]);
    }
    public function actionTestSubEmail()
    {
        return $this->render('test_sub_email');
    }
    public function actionTestEmailAdmin()
    {
        return $this->render('test_email_admin');
    }
    public function actionTestEmailClient()
    {
        return $this->render('test_email_client');
    }
// Subscribe Email 
    public function actionSubscribeEmail(){

        $admin_email = User::find()->where(['id'=>1])->one()->email;
        $this->layout = 'inner';
        $this->view->title = 'Mail Send';
        if (Yii::$app->request->isPost) {
            $email = Yii::$app->request->post('email');
            $body_sub_email_client = '
            <div>
                <div>
                    <div style="color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
                
                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word">
                                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="left" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%;word-break:break-word">
                                                        <img align="left" height="56" src="http://siemreap-angkor.com/backend/web/uploads/eocambo_technology/company-profile/logo-2_20200325105312.png" style="clear:both;display:inline;float:none;height:70px!important;max-width:100%;outline:none;text-decoration:none;width:auto" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 28px!important; font-weight: 500!important; line-height: 42px!important; margin: 0; padding: 0; text-align: left; vertical-align: top; word-break: break-word;">Thank you for your scription!</td></tr><tr><td height="16" style="height:16px">
                                                    </td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 16px!important; font-weight: 400!important; line-height: 24px!important; margin: 0; padding: 0; text-align: left; vertical-align: top; word-break: break-word;">Hi there,<br>
                                                        <br>You will be the first to know about the new releases giveaways and special promotion. <br> Stay Turnd.
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word"></td></tr><tr><td height="32" style="height:32px">  
                                                    </td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse:collapse!important;color:#1a2b49;font-family:GT Eesti,Arial,sans-serif;font-size:16px!important;font-weight:400!important;line-height:24px!important;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word">Best regards,
                                                        <br>The Siem Reap Angkor Adventure Team
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse:collapse!important;color:#b1b6bf!important;font-family:GT Eesti,Arial,sans-serif;font-size:14px!important;font-weight:400!important;line-height:18px!important;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word">If you have trouble viewing the above link, please copy the following web address into your browser address bar:<a style="text-decoration:none;color:#1593ff;font-weight:500" href="http://siemreap-angkor.com/frontend/web/index.php?r=tour-category%2Findex" target="_blank">http://siemreap-angkor.com/web/index.php?r=tour-category%2Findex</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            ';
            $body_sub_email_admin = '
            <div>
                <div>
                    <div style="color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
                
                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word">
                                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="left" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%;word-break:break-word">
                                                        <img align="left" height="56" src="http://siemreap-angkor.com/backend/web/uploads/eocambo_technology/company-profile/logo-2_20200325105312.png" style="clear:both;display:inline;float:none;height:70px!important;max-width:100%;outline:none;text-decoration:none;width:auto" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 28px!important; font-weight: 500!important; line-height: 42px!important; margin: 0; padding: 0; text-align: left; vertical-align: top; word-break: break-word;">Congratulation you get subscriber.</td></tr><tr><td height="16" style="height:16px">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            ';

            //To Admin
            Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo($admin_email)
            // ->setBcc('nanamey457@gmail.com')
            ->setSubject('SAA | Receive subscription')
            ->setHtmlBody($body_sub_email_admin)
            ->send();

            //To Client
            Yii::$app->mailer->compose()
            ->setFrom($admin_email)
            ->setTo($email)
            // ->setBcc('nanamey457@gmail.com')
            ->setSubject('SAA | Confirm your subscription')
            ->setHtmlBody($body_sub_email_client)
            ->send();

            // if ($sent_mail->send()) {
            Yii::$app->session->setFlash('success', "Message sent successfully");
            return $this->redirect(Yii::$app->request->referrer);

            // }else{
            //     Yii::$app->session->setFlash('Fail', "Message not send");
            //     return "failed";
            //         return $this->redirect(Yii::$app->request->referrer);
            // }
        }
    }
//End Subscribe Email
// Send Email Home/Contact Us
    public function actionSendEmailContact(){
        $info_email = \backend\models\CompanyProfile::find()->one()->general_email;
        $admin_email = User::find()->where(['id'=>1])->one()->email;
        $this->layout = 'inner';
        $this->view->title = 'Mail Send';
        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post('name');
            $email = Yii::$app->request->post('e-mail');
            $phone = Yii::$app->request->post('phone');
            $message = Yii::$app->request->post('message');

            $body_contact_admin = '
            <div>
                <div>
                    <div style="color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
                
                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word">
                                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="left" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%;word-break:break-word">
                                                        <img align="left" height="56" src="http://siemreap-angkor.com/backend/web/uploads/eocambo_technology/company-profile/logo-2_20200325105312.png" style="clear:both;display:inline;float:none;height:70px!important;max-width:100%;outline:none;text-decoration:none;width:auto" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 28px!important; font-weight: 500!important; line-height: 42px!important; margin: 0; padding: 0; text-align: center; vertical-align: top; word-break: break-word;">Guest Information</td></tr><tr><td height="16" style="height:16px">
                                                    </td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 16px!important; font-weight: 400!important; line-height: 24px!important; margin: 0; padding: 0; text-align: left; vertical-align: top; word-break: break-word;">
                                                        <br>Name : '.$name.'
                                                        <br>Email : '.$email.'
                                                        <br>Phone number : '.$phone.'
                                                        <br>Message : '.$message.'
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <hr>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            ';
            $body_contact_client = '
            <div>
                <div>
                    <div style="color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
                
                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word">
                                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="left" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%;word-break:break-word">
                                                        <img align="left" height="56" src="http://siemreap-angkor.com/backend/web/uploads/eocambo_technology/company-profile/logo-2_20200325105312.png" style="clear:both;display:inline;float:none;height:70px!important;max-width:100%;outline:none;text-decoration:none;width:auto" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 28px!important; font-weight: 500!important; line-height: 42px!important; margin: 0; padding: 0; text-align: center; vertical-align: top; word-break: break-word;">Thank you for your email, Our teams will contact you back.</td></tr><tr><td height="16" style="height:16px">
                                                    </td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 16px!important; font-weight: 400!important; line-height: 24px!important; margin: 0; padding: 0; text-align: center; vertical-align: top; word-break: break-word;">Our Support<br>
                                                        <br>Email: '.$info_email.'
                                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$admin_email.'
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse:collapse!important;color:#1a2b49;font-family:GT Eesti,Arial,sans-serif;font-size:16px!important;font-weight:400!important;line-height:24px!important;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word">Best regards,
                                                        <br>The SAA Team
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse:collapse!important;color:#b1b6bf!important;font-family:GT Eesti,Arial,sans-serif;font-size:14px!important;font-weight:400!important;line-height:18px!important;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word">Visit Us : <a style="text-decoration:none;color:#1593ff;font-weight:500" href="http://siemreap-angkor.com/frontend/web/index.php?r=site%2Findex" target="_blank">http://siemreap-angkor.com/frontend/web/index.php?r=site%2Findex</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            ';

            // $body_contact_admin = '<b>Name : </b>'.' '.$name.'<br>'.'<b> Email : </b>'.$email.'<br>'.'<b>Phone number: </b>'.' '.$phone.'<br>'.'<b>Message :</b>'.'<br>'.$message;

            //To Admin
            Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo($admin_email)
            // ->setBcc('nanamey457@gmail.com')
            ->setSubject('SAA | Guest Information')
            ->setHtmlBody($body_contact_admin)
            ->send();

            //To Client
            Yii::$app->mailer->compose()
            ->setFrom($admin_email)
            ->setTo($email)
            // ->setBcc('nanamey457@gmail.com')
            ->setSubject('SAA | SAA Information')
            ->setHtmlBody($body_contact_client)
            ->send();

            // if ($sent_mail->send()) {
            Yii::$app->session->setFlash('success', "Message sent successfully");
            return $this->redirect(Yii::$app->request->referrer);

            // }else{
            //     Yii::$app->session->setFlash('Fail', "Message not send");
            //     return "failed";
            //         return $this->redirect(Yii::$app->request->referrer);
            // }
        }
    }
//End Send Email

// Send Email Contact Us 
    public function actionSendEmailContactUs(){

        $info_email = \backend\models\CompanyProfile::find()->one()->general_email;
        $admin_email = User::find()->where(['id'=>1])->one()->email;
        $this->layout = 'inner';
        $this->view->title = 'Mail Send';
        if (Yii::$app->request->isPost) {
            $name = Yii::$app->request->post('name');
            $email = Yii::$app->request->post('email');
            $comments = Yii::$app->request->post('comments');

            $body_contact_admin = '
            <div>
                <div>
                    <div style="color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
                
                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word">
                                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="left" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%;word-break:break-word">
                                                        <img align="left" height="56" src="http://siemreap-angkor.com/backend/web/uploads/eocambo_technology/company-profile/logo-2_20200325105312.png" style="clear:both;display:inline;float:none;height:70px!important;max-width:100%;outline:none;text-decoration:none;width:auto" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 28px!important; font-weight: 500!important; line-height: 42px!important; margin: 0; padding: 0; text-align: center; vertical-align: top; word-break: break-word;">Guest Information</td></tr><tr><td height="16" style="height:16px">
                                                    </td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 16px!important; font-weight: 400!important; line-height: 24px!important; margin: 0; padding: 0; text-align: left; vertical-align: top; word-break: break-word;">
                                                        <br>Name : '.$name.'
                                                        <br>Email : '.$email.'
                                                        <br>Comment : '.$comments.'
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <hr>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            ';
            $body_contact_client = '
            <div>
                <div>
                    <div style="color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;min-width:100%;padding:0;text-align:left;width:100%!important">
                
                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;height:100%;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%">
                            <tbody>
                                <tr style="padding:0;text-align:left;vertical-align:top">
                                    <td align="center" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:center;vertical-align:top;word-break:break-word">
                                        <table bgcolor="#FFFFFF" style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr>
                                                    <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td align="left" style="border-collapse:collapse!important;color:#222;font-family:Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;line-height:19px;margin:0;padding:0;text-align:left;vertical-align:top;width:100%;word-break:break-word">
                                                        <img align="left" height="56" src="http://siemreap-angkor.com/backend/web/uploads/eocambo_technology/company-profile/logo-2_20200325105312.png" style="clear:both;display:inline;float:none;height:70px!important;max-width:100%;outline:none;text-decoration:none;width:auto" >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="border-collapse:collapse;border-spacing:0;margin:0 auto;padding:0;text-align:inherit;vertical-align:top;width:580px">
                                            <tbody>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 28px!important; font-weight: 500!important; line-height: 42px!important; margin: 0; padding: 0; text-align: center; vertical-align: top; word-break: break-word;">Thank you for your email, Our teams will contact you back.</td></tr><tr><td height="16" style="height:16px">
                                                    </td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse: collapse!important; color: #1a2b49; font-family: GT Eesti,Arial,sans-serif; font-size: 16px!important; font-weight: 400!important; line-height: 24px!important; margin: 0; padding: 0; text-align: center; vertical-align: top; word-break: break-word;">Our Support<br>
                                                        <br>Email: '.$info_email.'
                                                        <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$admin_email.'
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse:collapse!important;color:#1a2b49;font-family:GT Eesti,Arial,sans-serif;font-size:16px!important;font-weight:400!important;line-height:24px!important;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word">Best regards,
                                                        <br>The SAA Team
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td height="16" style="height:16px"></td>
                                                </tr>
                                                <tr style="padding:0;text-align:left;vertical-align:top">
                                                    <td style="border-collapse:collapse!important;color:#b1b6bf!important;font-family:GT Eesti,Arial,sans-serif;font-size:14px!important;font-weight:400!important;line-height:18px!important;margin:0;padding:0;text-align:left;vertical-align:top;word-break:break-word">Visit Us : <a style="text-decoration:none;color:#1593ff;font-weight:500" href="http://siemreap-angkor.com/frontend/web/index.php?r=site%2Findex" target="_blank">http://siemreap-angkor.com/frontend/web/index.php?r=site%2Findex</a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="32" style="height:32px"></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            ';

            //To Admin
            Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo($admin_email)
            // ->setBcc('nanamey457@gmail.com')
            ->setSubject('SAA | Guest Information')
            ->setHtmlBody($body_contact_admin)
            ->send();

            //To Client
            Yii::$app->mailer->compose()
            ->setFrom($admin_email)
            ->setTo($email)
            // ->setBcc('nanamey457@gmail.com')
            ->setSubject('SAA | SAA Information')
            ->setHtmlBody($body_contact_client)
            ->send();


            // if ($sent_mail->send()) {
            Yii::$app->session->setFlash('success', "Message sent successfully");
            return $this->redirect(Yii::$app->request->referrer);

            // }else{
            //     Yii::$app->session->setFlash('Fail', "Message not send");
            //     return "failed";
            //         return $this->redirect(Yii::$app->request->referrer);
            // }
        }
    }
//End Send Email
    public function actionContact()
    {
        // $model = new ContactForm();
        // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        //     if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
        //         Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
        //     } else {
        //         Yii::$app->session->setFlash('error', 'There was an error sending your message.');
        //     }

        //     return $this->refresh();
        // } else {
        $company_profile = \backend\models\CompanyProfile::find()->one();
            return $this->render('contact', [
                // 'model' => $model,
                'company_profile' => $company_profile,
            ]);
        //}
    }

    public function actionAboutUs()
    {
        $categories = \backend\models\TourCategory::find()->one();
        $about_us = \backend\models\AboutUs::find()->where(['status'=>1])->all();
        $chose_us = \backend\models\ChoseUs::find()->where(['status'=>1])->limit(6)->all();
            return $this->render('aboutus', [
                'about_us' => $about_us,
                'chose_us' => $chose_us,
                'categories' => $categories,
            ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}

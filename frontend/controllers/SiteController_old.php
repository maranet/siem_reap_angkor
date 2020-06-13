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
use common\models\User;
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
    public function actionIndex()
    {
        return $this->render('index');
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

    public function actionDependent()
    {
        if(Yii::$app->request->isAjax){ 

            // Get Item
            if(Yii::$app->request->post('action') =='get_item'){
                $id = Yii::$app->request->post('id');
                $response = \backend\models\TourItem::find()->where(['category_id'=>$id])->asArray()->all();
                return json_encode($response);
            }
            
        }

    }

    public function actionTour()
    {
        $tour_items = TourItem::find()->all();
        $tour_categories = \backend\models\TourCategory::find()->all();

        return $this->render('tour', [
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
    public function actionItemDetail($id)
    {
        // $tour_item = \backend\models\TourItem::find()->where(['id'=>$id])->one();
        // // menu tour item in detail

        // $tour_items_menu = \backend\models\TourItem::find()->where(['id'=>$id])->all();

        // $tour_category = \backend\models\TourCategory::find()->where(['id'=>$tour_item->category_id])->one()->name;
        $item_details = \backend\models\TourItem::find()->where(['id'=>$id])->one();
        $item_galleries = \backend\models\TourItemGallery::find()->where(['tour_item_id'=>$id])->all();
        
        return $this->render('tour_item_detail', [
            'item_details' => $item_details,
            // 'tour_category' => $tour_category,
            // 'tour_item' => $tour_item,
            // 'tour_items_menu' => $tour_items_menu,
            'item_galleries' => $item_galleries,
        ]);
    }

    public function actionBlog()
    {
        $blogs = \backend\models\Blog::find()->all();
        return $this->render('blog', [
            'blogs' => $blogs,
        ]);
    }
    public function actionBlogDetail($id)
    {

        $blog_details = \backend\models\Blog::find()->where(['id'=>$id])->one();
        $created_by = User::find()->where(['id'=>$blog_details->created_by])->one();
        $blog_recents = \backend\models\Blog::find()->all();
        return $this->render('blog_detail', [
            'blog_details' => $blog_details,
            'created_by' => $created_by,
            'blog_recents' => $blog_recents,
        ]);
    }

    public function actionGallery()
    {
        return $this->render('gallery');
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
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

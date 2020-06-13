<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $confirm_password;
    public $status, $user_type_id, $employee_id, $id;
    public $isNewRecord;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            // ['username', 'unique', 
            //     'targetClass' => '\common\models\User', 
            //     'message' => 'This username has already been taken.',
            //     'when' => function($model, $attribute){
            //         return static::check_unique($model, $attribute);
            //     }
            // ],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.', 'on' => 'create'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            // ['email', 'unique', 
            //     'targetClass' => '\common\models\User', 
            //     'message' => 'This email address has already been taken.',
            //     'when' => function($model, $attribute){
            //         return static::check_unique($model, $attribute);
            //     }
            // ],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.', 'on' => 'create'],

            [['password', 'confirm_password' ], 'required', 'on' => 'create'],
            ['password', 'string', 'min' => 6],

            [['status'], 'required'],
            ['confirm_password', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],

            [['status','user_type_id', 'employee_id', 'id'], 'integer'],
            [['isNewRecord'], 'boolean']
        ];
    }

        public static function check_unique($model, $attribute) {
            if ($model->isNewRecord) {
                $user = \common\models\User::findOne([$attribute => $model->{$attribute}]); 
                return $user ? true : false;
            }else{
                $user = \common\models\User::findOne(['id' => $model->id]);
                if ($user->{$attribute} == $model->{$attribute}) {
                    return false;
                }else{
                    $user = \common\models\User::findOne([$attribute => $model->{$attribute}]); 
                    return $user ? true : false;
                }
            }
        }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->user_type_id = $this->user_type_id;
        $user->employee_id = $this->employee_id;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save();

    }

    public function userUpdate()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = \common\models\User::findOne($this->id);
        if (!$user) {
            return null;
        }

        if (!empty($this->password) && !$user->validatePassword($this->password, $user->password_hash)) {
            $user->setPassword($this->password);
        }

        $user->username = $this->username;
        $user->email = $this->email;
        $user->status = $this->status;
        $user->user_type_id = $this->user_type_id;
        $user->employee_id = $this->employee_id;
        
        return $user->save() ? $user : null;
    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "booking".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $updated_date
 * @property int|null $updated_by
 * @property string|null $created_date
 * @property int|null $created_by
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $email
 * @property string|null $confirm_email
 * @property string|null $contact_phone
 * @property int|null $country_id
 * @property string|null $description
 * @property float|null $total
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public static function tableName()
    {
        return 'booking';
    }

    /**
     * {@inheritdoc}
     */
    public $reCaptcha, $credit_card_number, $card_name, $expired_month, $expired_year, $card_security_code; 
    public function rules()
    {
        return [
            [['updated_date', 'created_date', 'expired_month', 'expired_year'], 'safe'],
            [['updated_by', 'created_by', 'status', 'company_id', 'user_id', 'country_id'], 'integer'],
            [['description', 'card_name'], 'string'],
            [['total', 'credit_card_number', 'card_security_code'], 'number'],
            [['title', 'first_name', 'last_name', 'email', 'confirm_email', 'contact_phone'], 'string', 'max' => 255],
            [['title', 'first_name', 'last_name', 'email', 'confirm_email', 'contact_phone', 'country_id'],'required', 'message' => 'Please fill the field'],
            [['reCaptcha'], \himiklab\yii2\recaptcha\ReCaptchaValidator2::className(),
                'secret' => '6LcVV-gUAAAAAAXWMHBw1-T9HKYw5RM_mM_L09aY', // unnecessary if reСaptcha is already configured
                'uncheckedMessage' => 'Please confirm that you are not a bot.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'status' => 'Status',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'confirm_email' => 'Confirm Email',
            'contact_phone' => 'Contact Phone',
            'country_id' => 'Country ID',
            'description' => 'Description',
            'total' => 'Total',
        ];
    }
}

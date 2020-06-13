<?php

namespace backend\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "company_profile".
 *
 * @property int $id
 * @property string $name
 * @property string|null $address
 * @property int|null $country_id
 * @property int|null $city_id
 * @property int|null $code
 * @property int|null $invoice
 * @property int|null $receipt
 * @property int|null $expense
 * @property int|null $proposal
 * @property int|null $quotation
 * @property int|null $contract
 * @property int|null $internet_public_ip_address
 * @property string|null $postal_code
 * @property string|null $contact_person
 * @property string|null $description
 * @property string|null $general_email
 * @property string|null $invoice_email
 * @property string|null $mobile_number_invoice
 * @property string|null $main_phone_1
 * @property string|null $main_phone_2
 * @property string|null $website_url
 * @property int|null $company_type
 * @property int|null $number_of_user
 * @property string|null $sale_date
 * @property string|null $service_agreement
 * @property string|null $fee
 * @property int $status
 * @property int|null $company_status 1=lived , 2 = Inprocesing , 0 = Deactived
 * @property int|null $created_by
 * @property string|null $created_date
 * @property string|null $updated_date
 * @property int|null $updated_by
 * @property int|null $passed_by
 * @property int|null $handle_by
 * @property string|null $deactivated_at
 * @property string|null $deactivated_reason
 * @property string|null $deactivated_requested_by
 * @property string|null $deactivated_requested_contact_detail
 * @property int|null $deactivated_by
 * @property string|null $lived_date
 */
class CompanyProfile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_profile';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['name', 'company_type','city_id', 'country_id'], 'required'],
            [['file', 'service_agreement'], 'file'],
            [['address', 'deactivated_reason', 'deactivated_requested_contact_detail','description','service_agreement_local_path', 'invoice', 'receipt', 'proposal', 'quotation', 'contract', 'internet_public_ip_address', 'expense' ], 'string'],
            [['country_id', 'city_id', 'company_type', 'number_of_user', 'status', 'company_status', 'created_by', 'updated_by', 'passed_by', 'handle_by', 'deactivated_by', 'user_id', 'company_id', 'code','rate_currency_id'], 'integer'],
            [['sale_date', 'created_date', 'updated_date', 'deactivated_at', 'lived_date'], 'safe'],
            [['name', 'postal_code', 'contact_person', 'general_email', 'invoice_email', 'mobile_number_invoice', 'main_phone_1', 'main_phone_2', 'website_url', 'service_agreement', 'fee', 'deactivated_requested_by', 'feature_image','link_facebook', 'link_instagram', 'link_twitter', 'link_linkedin'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file' => 'Image',
            'name' => 'Company Name',
            'user_id' => 'User ID',
            'company_id' => 'Company ID',
            'address' => 'Address',
            'code' => 'Code',
            'country_id' => 'Country',
            'city_id' => 'City',
            'feature_image' => 'Logo',
            'postal_code' => 'Postal Code',
            'contact_person' => 'Contact Person',
            'general_email' => 'General Email',
            'invoice_email' => 'Invoice Email',
            'mobile_number_invoice' => 'Mobile Number Invoice',
            'main_phone_1' => 'Main Phone',
            'main_phone_2' => 'Second Phone',
            'website_url' => 'Website Url',
            'company_type' => 'Company Type',
            'number_of_user' => 'Number Of User',
            'sale_date' => 'Sale Date',
            'service_agreement' => 'Service Agreement',
            'fee' => 'Fee',
            'invoice' => 'Invoice',
            'receipt' => 'Receipt',
            'proposal' => 'Proposal',
            'quotation' => 'Quotation',
            'expense' => 'Expense',
            'contract' => 'Contract',
            'internet_public_ip_address' => 'Internet Public IP Address',
            'description' => 'Description',
            'status' => 'Status',
            'company_status' => 'Company Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
            'passed_by' => 'Passed By',
            'handle_by' => 'Handle By',
            'deactivated_at' => 'Deactivated At',
            'deactivated_reason' => 'Deactivated Reason',
            'deactivated_requested_by' => 'Deactivated Requested By',
            'deactivated_requested_contact_detail' => 'Deactivated Requested Contact Detail',
            'deactivated_by' => 'Deactivated By',
            'lived_date' => 'Lived Date',
            'link_facebook' => 'Fackbook Link',
            'link_instagram' => 'Instagram Link',
            'link_twitter' => 'Twitter Link',
            'link_linkedin' => 'LinkedIn Link',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getCompanyStatus()
    {
        return $this->hasOne(CompanyStatus::className(), ['id' => 'company_status']);
    }
    public function getCompanyTypeMe()
    {
        return $this->hasOne(CompanyType::className(), ['id' => 'company_type']);
    }
    public function getRateCurrency()
    {
        return $this->hasOne(RateCurrency::className(), ['id' => 'rate_currency_id']);
    }
}

<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_booking".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $pick_up_location
 * @property string|null $date
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $description
 * @property int|null $country_id
 */
class CustomerBooking extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_booking';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'expired_month'], 'safe'],
            [['description', 'expired_year', 'booking_code'], 'string'],
            [['country_id'], 'integer'],
            [['name', 'email', 'credit_card_number', 'credit_card_name', 'credit_card_security_code', 'pick_up_location'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_code' => 'Booking Code',
            'pick_up_location' => 'Pick Up Location',
            'name' => 'Name',
            'credit_card_number' => 'Card Number',
            'credit_card_name' => 'Card Name',
            'credit_card_security_code' => 'Security Code',
            'expired_month' => 'Expired Month',
            'expired_year' => 'Expired Year',
            'date' => 'Date',
            'email' => 'Email',
            'phone_number' => 'Phone Number',
            'description' => 'Description',
            'country_id' => 'Country ID',
        ];
    }
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    
}

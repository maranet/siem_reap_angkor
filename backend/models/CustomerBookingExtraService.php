<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_booking_extra_service".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $customer_booking_id
 * @property int|null $adult
 * @property float|null $adult_price
 * @property int|null $child
 * @property float|null $child_price
 * @property string|null $description
 * @property string|null $policy
 * @property float|null $extra_amount
 */
class CustomerBookingExtraService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_booking_extra_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_booking_id', 'adult', 'child'], 'integer'],
            [['adult_price', 'child_price', 'extra_amount'], 'number'],
            [['description', 'policy'], 'string'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'customer_booking_id' => 'Customer Booking ID',
            'adult' => 'Adult',
            'adult_price' => 'Adult Price',
            'child' => 'Child',
            'child_price' => 'Child Price',
            'description' => 'Description',
            'policy' => 'Policy',
            'extra_amount' => 'Extra Amount',
        ];
    }
}

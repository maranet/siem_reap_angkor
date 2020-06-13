<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "customer_booking_item".
 *
 * @property int $id
 * @property int|null $customer_booking_id
 * @property int|null $tour_item_id
 * @property string|null $name
 * @property string|null $description
 * @property float|null $price
 * @property float|null $duration
 * @property string|null $starting_time
 * @property int|null $recommended 0= not recommended, 1= recommended
 * @property int|null $duration_type 1= day, 2= hour
 */
class CustomerBookingItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer_booking_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['customer_booking_id', 'tour_item_id', 'recommended', 'duration_type', 'adult', 'child'], 'integer'],
            [['description'], 'string'],
            [['price', 'duration'], 'number'],
            [['starting_time'], 'safe'],
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
            'customer_booking_id' => 'Customer Booking ID',
            'tour_item_id' => 'Tour Item',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'duration' => 'Duration',
            'starting_time' => 'Starting Time',
            'recommended' => 'Recommended',
            'duration_type' => 'Duration Type',
        ];
    }
    public function getTourItem()
    {
        return $this->hasOne(TourItem::className(), ['id' => 'tour_item_id']);
    }
}

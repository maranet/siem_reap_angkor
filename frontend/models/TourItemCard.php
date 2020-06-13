<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tour_item_card".
 *
 * @property int $id
 * @property int|null $tour_item_id
 * @property int|null $company_id
 * @property string|null $name
 * @property string|null $feature_image
 * @property string|null $description
 * @property float|null $amount
 * @property float|null $duration
 * @property string|null $starting_time
 * @property string|null $tip_note
 * @property int|null $recommended 0= not recommended, 1= recommended
 * @property int|null $duration_type 1= day, 2= hour
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $status
 * @property int|null $show_home_page 1 = show, 0 = no show
 * @property int|null $created_by
 * @property string|null $created_date
 */
class TourItemCard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_item_card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_item_id', 'company_id', 'recommended', 'duration_type', 'updated_by', 'status', 'show_home_page', 'created_by'], 'integer'],
            [['description', 'tip_note'], 'string'],
            [['amount', 'duration', 'adult', 'child', 'cost', 'price_adult', 'price_child'], 'number'],
            [['starting_time', 'updated_date', 'created_date', 'timestamp', 'from_date', 'to_date'], 'safe'],
            [['name', 'session_id'], 'string', 'max' => 250],
            [['feature_image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'price_adult' => 'Price Adult',
            'price_child' => 'Price Child',
            'cost' => 'Cost',
            'tour_item_id' => 'Tour Item',
            'from_date' => 'From',
            'to_date' => 'To',
            'company_id' => 'Company ID',
            'timestamp' => 'Expired Time',
            'name' => 'Name',
            'feature_image' => 'Feature Image',
            'description' => 'Description',
            'amount' => 'Amount',
            'duration' => 'Duration',
            'starting_time' => 'Starting Time',
            'tip_note' => 'Tip Note',
            'recommended' => 'Recommended',
            'duration_type' => 'Duration Type',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
            'show_home_page' => 'Show Home Page',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }
}

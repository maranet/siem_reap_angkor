<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "allotment".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $tour_item_id
 * @property int|null $rate_set_up_id
 * @property string|null $date
 * @property string|null $starting_time
 * @property int|null $number
 * @property string|null $description
 * @property int|null $updated_by
 * @property int|null $status 1= active, 0= stop_sell
 * @property string|null $updated_date
 * @property int|null $created_by
 * @property string|null $created_date
 */
class Allotment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allotment';
    }

    /**
     * {@inheritdoc}
     */
    public $adult, $child, $from_date, $to_date, $tour_category_id;
    public function rules()
    {
        return [
            [['company_id', 'rate_set_up_id', 'tour_item_id', 'number', 'updated_by', 'status', 'created_by', 'adult', 'child', 'tour_category_id'], 'integer'],
            [['date', 'starting_time', 'updated_date', 'created_date', 'from_date', 'to_date'], 'safe'],
            [['description'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from_date' => 'From Date',
            'tour_item_id' => 'Tour Item',
            'to_date' => 'To Date',
            'adult' => 'Adult',
            'child' => 'Child', 
            'company_id' => 'Company ID',
            'rate_set_up_id' => 'Tour Item ID',
            'date' => 'Date',
            'starting_time' => 'Starting Time',
            'number' => 'Number',
            'description' => 'Description',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'updated_date' => 'Updated Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }
    public function getTourItem()
    {
        return $this->hasOne(TourItem::className(), ['id' => 'tour_item_id']);
    }

    public function getRatePlan()
    {
        return $this->hasOne(\backend\models\RatePlan::className(), ['id' => 'rate_set_up_id']);
    }
    public function getRatePlanSetup()
    {
        return $this->hasOne(\backend\models\RatePlanSetup::className(), ['id' => 'rate_set_up_id']);
    }
}

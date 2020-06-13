<?php

namespace backend\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "rate_plan_setup".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $tour_item_id
 * @property string|null $starting_time
 * @property string|null $description
 * @property int|null $created_by
 * @property string|null $created_date
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $status
 */
class RatePlanSetup extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_plan_setup';
    }

    /**
     * {@inheritdoc}
     */
    public $range_from, $range_to;
    public function rules()
    {
        return [
            [['tour_item_id', 'created_by', 'updated_by', 'status', 'company_id'], 'integer'],
            [['starting_time', 'created_date', 'updated_date'], 'safe'],
            [['description'], 'string'],
            [['name', 'tour_item_id', 'starting_time'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'range_from' => 'From',
            'range_to' => 'To',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'tour_item_id' => 'Tour Item ID',
            'starting_time' => 'Starting Time',
            'description' => 'Description',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
        ];
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getTourItem()
    {
        return $this->hasOne(TourItem::className(), ['id' => 'tour_item_id']);
    }
    public function getRange()
    {
        return $this->hasOne(RatePlanSetupRange::className(), ['id' => 'tour_rate_setup_id']);
    }

}

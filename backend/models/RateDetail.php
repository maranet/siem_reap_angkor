<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rate_detail".
 *
 * @property int $id
 * @property float|null $cost_adult
 * @property float|null $cost_child
 * @property float|null $price_adult
 * @property float|null $price_child
 * @property float|null $mark_up
 * @property int|null $mark_up_type 1= amount, 0= percentage
 * @property string|null $date
 * @property int|null $updated_by
 * @property int|null $status 1= active, 0= inactive
 * @property string|null $updated_date
 * @property int|null $created_by
 * @property string|null $created_date
 */
class RateDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_detail';
    }

    /**
     * {@inheritdoc}
     */
    public $month, $year;
    public function rules()
    {
        return [
            [['cost_adult', 'cost_child', 'price_adult', 'price_child', 'mark_up_adult', 'mark_up_child'], 'number'],
            [['mark_up_type', 'updated_by', 'status', 'created_by', 'tour_item_id', 'rate_range_id', 'month', 'year'], 'integer'],
            [['date', 'updated_date', 'created_date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'month' => 'Month',
            'year' => 'Year',
            'rate_range_id' => 'Rate Range',
            'tour_item_id' => 'Tour Item',
            'cost_adult' => 'Cost Adult',
            'cost_child' => 'Cost Child',
            'price_adult' => 'Price Adult',
            'price_child' => 'Price Child',
            'mark_up_adult' => 'Mark Up Adult',
            'mark_up_child' => 'Mark Up Child',
            'mark_up_type' => 'Mark Up Type',
            'date' => 'Date',
            'updated_by' => 'Updated By',
            'status' => 'Status',
            'updated_date' => 'Updated Date',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }
}

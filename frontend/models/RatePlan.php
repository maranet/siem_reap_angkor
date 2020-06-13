<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "rate_plan".
 *
 * @property int $id
 * @property float|null $cost_adult
 * @property int|null $company_id
 * @property int|null $tour_item_id
 * @property int|null $rate_range_id
 * @property float|null $cost_child
 * @property float|null $price_adult
 * @property float|null $price_child
 * @property float|null $mark_up_adult
 * @property float|null $mark_up_child
 * @property int|null $mark_up_type 1= amount, 2= percentage
 * @property string|null $date
 * @property int|null $updated_by
 * @property int|null $status 1= active, 0= inactive
 * @property string|null $updated_date
 * @property int|null $created_by
 * @property string|null $created_date
 */
class RatePlan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_plan';
    }

    /**
     * {@inheritdoc}
     */
    public $adult, $child;
    public function rules()
    {
        return [
            [['cost_adult', 'cost_child', 'price_adult', 'price_child', 'mark_up_adult', 'mark_up_child'], 'number'],
            [['company_id', 'rate_set_up_id', 'rate_range_id', 'mark_up_type', 'updated_by', 'status', 'created_by'], 'integer'],
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
            'cost_adult' => 'Cost Adult',
            'company_id' => 'Company ID',
            'rate_set_up_id' => 'Rate Setup',
            'rate_range_id' => 'Rate Range ID',
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
    public function getRatePlanSetup()
    {
        return $this->hasOne(backend\models\RatePlanSetup::className(), ['id' => 'rate_set_up_id']);
    }
}

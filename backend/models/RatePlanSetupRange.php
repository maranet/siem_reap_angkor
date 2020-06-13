<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rate_plan_setup_range".
 *
 * @property int $id
 * @property int|null $tour_rate_setup_id
 * @property int|null $range_from
 * @property int|null $range_to
 */
class RatePlanSetupRange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_plan_setup_range';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_rate_setup_id', 'range_from', 'range_to'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_rate_setup_id' => 'Tour Rate Setup ID',
            'range_from' => 'From Person',
            'range_to' => 'To People',
        ];
    }
}

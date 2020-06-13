<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "rate_range".
 *
 * @property int $id
 * @property int|null $rate_set_up_id
 * @property int|null $rate_setup_range_id
 * @property int|null $month
 * @property int|null $year
 * @property int|null $from_person
 * @property int|null $to_people
 */
class RateRange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_range';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rate_set_up_id', 'month', 'year', 'from_person', 'to_people', 'rate_setup_range_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'rate_setup_range_id' => 'Range',
            'rate_set_up_id' => 'Tour Item ID',
            'month' => 'Month',
            'year' => 'Year',
            'from_person' => 'From Person',
            'to_people' => 'To People',
        ];
    }
}

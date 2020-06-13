<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "allotment_number".
 *
 * @property int $id
 * @property int|null $tour_item_id
 * @property int|null $allotment_id
 * @property int|null $month
 * @property int|null $year
 * @property string|null $from_date
 * @property string|null $to_date
 * @property string|null $date
 * @property int|null $number
 * @property int|null $day_01
 * @property int|null $day_02
 * @property int|null $day_03
 * @property int|null $day_04
 * @property int|null $day_05
 * @property int|null $day_06
 * @property int|null $day_07
 * @property int|null $day_08
 * @property int|null $day_09
 * @property int|null $day_10
 * @property int|null $day_11
 * @property int|null $day_12
 * @property int|null $day_13
 * @property int|null $day_14
 * @property int|null $day_15
 * @property int|null $day_16
 * @property int|null $day_17
 * @property int|null $day_18
 * @property int|null $day_19
 * @property int|null $day_20
 * @property int|null $day_21
 * @property int|null $day_22
 * @property int|null $day_23
 * @property int|null $day_24
 * @property int|null $day_25
 * @property int|null $day_26
 * @property int|null $day_27
 * @property int|null $day_28
 * @property int|null $day_29
 * @property int|null $day_30
 * @property int|null $day_31
 */
class AllotmentNumber extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'allotment_number';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tour_item_id', 'allotment_id', 'month', 'year', 'number', 'day_01', 'day_02', 'day_03', 'day_04', 'day_05', 'day_06', 'day_07', 'day_08', 'day_09', 'day_10', 'day_11', 'day_12', 'day_13', 'day_14', 'day_15', 'day_16', 'day_17', 'day_18', 'day_19', 'day_20', 'day_21', 'day_22', 'day_23', 'day_24', 'day_25', 'day_26', 'day_27', 'day_28', 'day_29', 'day_30', 'day_31'], 'integer'],
            [['from_date', 'to_date', 'date'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tour_item_id' => 'Tour Item ID',
            'allotment_id' => 'Allotment ID',
            'month' => 'Month',
            'year' => 'Year',
            'from_date' => 'From Date',
            'to_date' => 'To Date',
            'date' => 'Date',
            'number' => 'Number',
            'day_01' => 'Day 01',
            'day_02' => 'Day 02',
            'day_03' => 'Day 03',
            'day_04' => 'Day 04',
            'day_05' => 'Day 05',
            'day_06' => 'Day 06',
            'day_07' => 'Day 07',
            'day_08' => 'Day 08',
            'day_09' => 'Day 09',
            'day_10' => 'Day 10',
            'day_11' => 'Day 11',
            'day_12' => 'Day 12',
            'day_13' => 'Day 13',
            'day_14' => 'Day 14',
            'day_15' => 'Day 15',
            'day_16' => 'Day 16',
            'day_17' => 'Day 17',
            'day_18' => 'Day 18',
            'day_19' => 'Day 19',
            'day_20' => 'Day 20',
            'day_21' => 'Day 21',
            'day_22' => 'Day 22',
            'day_23' => 'Day 23',
            'day_24' => 'Day 24',
            'day_25' => 'Day 25',
            'day_26' => 'Day 26',
            'day_27' => 'Day 27',
            'day_28' => 'Day 28',
            'day_29' => 'Day 29',
            'day_30' => 'Day 30',
            'day_31' => 'Day 31',
        ];
    }
}

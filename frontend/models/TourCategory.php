<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "tour_category".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $updated_by
 * @property string|null $feature_image
 * @property string|null $updated_date
 * @property int|null $status
 * @property int|null $created_by
 * @property string|null $created_date
 */
class TourCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $from_date, $to_date, $adult, $child;
    public static function tableName()
    {
        return 'tour_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'updated_by', 'status', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['updated_date','from_date','to_date', 'created_date', 'adult', 'child'], 'safe'],
            [['name'], 'string', 'max' => 250],
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
            'company_id' => 'Company ID',
            'name' => 'Name',
            'description' => 'Description',
            'updated_by' => 'Updated By',
            'feature_image' => 'Feature Image',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }
}

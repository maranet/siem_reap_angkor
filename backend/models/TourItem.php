<?php

namespace backend\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "tour_item".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $company_id
 * @property string|null $name
 * @property string|null $feature_image
 * @property string|null $description
 * @property float|null $price
 * @property float|null $duration
 * @property string|null $starting_time
 * @property string|null $tip_note
 * @property string|null $show_home_page
 * @property int|null $duration_type 1= day, 2= hour
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $status
 * @property int|null $recommended
 * @property int|null $created_by
 * @property string|null $created_date
 */
class TourItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tour_item';
    }

    /**
     * {@inheritdoc}
     */
    public $file, $file_name, $file_path;
    public function rules()
    {
        return [
            [['category_id', 'company_id', 'duration_type', 'updated_by', 'status', 'recommended', 'created_by', 'show_home_page'], 'integer'],
            [['tip_note', 'file_path'], 'string'],
            [['file'], 'file'],
            [['name', 'category_id','price'], 'required'],
            [['file_name'], 'file', 'maxFiles' => 10],
            [['price', 'duration'], 'number'],
            [['starting_time', 'updated_date', 'created_date'], 'safe'],
            [['name'], 'string', 'max' => 250],
            [['feature_image'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 315],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_home_page' => 'Is Show',
            'category_id' => 'Category ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'recommended' => 'Recommended',
            'file' => 'File',
            'filename' => 'File Name',
            'feature_image' => 'Feature Image',
            'description' => 'Short Description',
            'price' => 'Starting Price',
            'duration' => 'Duration',
            'starting_time' => 'Starting Time',
            'tip_note' => 'Description',
            'duration_type' => 'Duration Type',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getTourCategory()
    {
        return $this->hasOne(TourCategory::className(), ['id' => 'category_id']);
    }
}

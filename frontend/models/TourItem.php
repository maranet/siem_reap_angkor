<?php

namespace frontend\models;

use Yii;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

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
 * @property int|null $recommended 0= not recommended, 1= recommended
 * @property int|null $duration_type 1= day, 2= hour
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $status
 * @property int|null $created_by
 * @property string|null $created_date
 */
class TourItem extends \yii\db\ActiveRecord implements CartPositionInterface
{
    /**
     * {@inheritdoc}
     */
// Shopping cart
    use CartPositionTrait;

    public function getPrice()
    {
        return $this->price;
    }

    public function getId()
    {
        return $this->id;
    }

// End Shopping cart

    public static function tableName()
    {
        return 'tour_item';
    }

    /**
     * {@inheritdoc}
     */
    public $from_date, $to_date, $adult, $child;
    public function rules()
    {
        return [
            [['category_id', 'company_id', 'recommended', 'duration_type', 'updated_by', 'status', 'created_by'], 'integer'],
            [['description', 'tip_note'], 'string'],
            [['price', 'duration'], 'number'],
            [['updated_date', 'created_date','from_date','to_date', 'adult', 'child'], 'safe'],
            [['name'], 'string', 'max' => 250],
            ['starting-time', 'format' => 'php:H:i'],
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
            'category_id' => 'Category ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'feature_image' => 'Feature Image',
            'description' => 'Description',
            'price' => 'Price',
            'duration' => 'Duration',
            'starting_time' => 'Starting Time',
            'tip_note' => 'Tip Note',
            'recommended' => 'Recommended',
            'duration_type' => 'Duration Type',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }
    public function getTourCategory()
    {
        return $this->hasOne(TourCategory::className(), ['id' => 'category_id']);
    }
}

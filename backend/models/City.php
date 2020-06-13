<?php

namespace backend\models;

use Yii;
use app\models\User;
/**
 * This is the model class for table "city".
 *
 * @property int $id
 * @property int|null $company_id
 * @property int|null $country_id
 * @property int|null $user_id
 * @property string $code
 * @property string $name
 * @property string|null $description
 * @property string|null $feature_image
 * @property string|null $video_link
 * @property string|null $latitude
 * @property string|null $longitude
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property bool $status
 * @property int|null $created_by
 * @property string|null $created_date
 *
 * @property Country $country
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;
    public static function tableName()
    {
        return 'city';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'country_id', 'user_id', 'updated_by', 'created_by'], 'integer'],
            [['name','country_id'], 'required'],
            [['description'], 'string'],
            [['file'], 'file'],
            [['updated_date', 'created_date'], 'safe'],
            [['status'], 'boolean'],
            [['code'], 'string', 'max' => 100],
            [['name', 'feature_image', 'video_link'], 'string', 'max' => 250],
            [['latitude', 'longitude'], 'string', 'max' => 200],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Company',
            'country_id' => 'Country',
            'user_id' => 'User',
            'code' => 'Code',
            'file' => 'Image',
            'name' => 'City Name',
            'description' => 'Description',
            'feature_image' => 'Feature Image',
            'video_link' => 'Video Link',
            'latitude' => 'Latitude',
            'longitude' => 'Longitude',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}

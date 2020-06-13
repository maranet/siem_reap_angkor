<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property int $id_area
 * @property int|null $user_id
 * @property int|null $company_id
 * @property string $name
 * @property string $code
 * @property string $description
 * @property string $feature_image
 * @property string $video_link
 * @property string $latitude
 * @property string $longitude
 * @property int $updated_by
 * @property string $updated_date
 * @property int $status
 * @property int $created_by
 * @property string $created_date
 *
 * @property City[] $cities
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $file;

    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required','message'=>'Please fill the field'],
            [['id_area', 'user_id', 'company_id', 'updated_by', 'status', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['updated_date', 'created_date'], 'safe'],
            [['name', 'feature_image', 'video_link'], 'string', 'max' => 250],
            [['code'], 'string', 'max' => 100],
            [['latitude', 'longitude'], 'string', 'max' => 200],
            [['file'], 'file'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_area' => 'Id Area',
            'user_id' => 'User ID',
            'company_id' => 'Company ID',
            'name' => 'Name',
            'file' => 'Image',
            'code' => 'Code',
            'description' => 'Description',
            // 'feature_image' => 'Feature Image',
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
    public function getCities()
    {
        return $this->hasMany(City::className(), ['id_country' => 'id']);
    }
}

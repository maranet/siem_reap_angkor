<?php

namespace backend\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "tour_category".
 *
 * @property int $id
 * @property int|null $company_id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $updated_by
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
    public static function tableName()
    {
        return 'tour_category';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['company_id', 'updated_by', 'status', 'created_by'], 'integer'],
            [['description'], 'string'],
            [['file'], 'file'],
            [['name'], 'required'],
            [['updated_date', 'created_date'], 'safe'],
            [['name'], 'string', 'max' => 250],
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
            'name' => 'Name',
            'file' => 'Image',
            'description' => 'Description',
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
}

<?php

namespace backend\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "slide".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $feature_image
 * @property string|null $updated_date
 * @property int|null $updated_by
 * @property string|null $created_date
 * @property int|null $created_by
 * @property int|null $status
 * @property int|null $company_id
 * @property int|null $user_id
 */
class Slide extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'slide';
    }

    /**
     * {@inheritdoc}
     */
    public $file, $file_name, $file_path;

    public function rules()
    {
        return [
            [['updated_date', 'created_date'], 'safe'],
            [['updated_by', 'created_by', 'status', 'company_id', 'user_id'], 'integer'],
            [['name', 'feature_image'], 'string', 'max' => 255],
            [['name'],'required','message'=>'Please fill the field'],
            [['file_name'], 'file', 'maxFiles' => 10],
            [['file_path'], 'string'],
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
            'name' => 'Name',
            'feature_image' => 'Feature Image',
            'updated_date' => 'Updated Date',
            'updated_by' => 'Updated By',
            'created_date' => 'Created Date',
            'created_by' => 'Created By',
            'status' => 'Status',
            'company_id' => 'Company ID',
            'user_id' => 'User ID',
        ];
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}

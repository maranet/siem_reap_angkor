<?php

namespace backend\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "extra_service".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $company_id
 * @property int|null $adult
 * @property float|null $adult_price
 * @property int|null $child
 * @property float|null $child_price
 * @property string|null $feature_image
 * @property string|null $description
 * @property string|null $policy
 * @property float|null $extra_amount
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $status
 * @property int|null $created_by
 * @property string|null $created_date
 */
class ExtraService extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'extra_service';
    }

    /**
     * {@inheritdoc}
     */
    public $file;
    public function rules()
    {
        return [
            [['company_id', 'adult', 'child', 'updated_by', 'status', 'created_by'], 'integer'],
            [['adult_price', 'child_price', 'extra_amount'], 'number'],
            [['description', 'policy'], 'string'],
            [['file'], 'file'],
            [['updated_date', 'created_date'], 'safe'],
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
            'name' => 'Name',
            'company_id' => 'Company ID',
            'adult' => 'Adult',
            'file' => 'Image',
            'adult_price' => 'Adult Price',
            'child' => 'Child',
            'child_price' => 'Child Price',
            'feature_image' => 'Feature Image',
            'description' => 'Description',
            'policy' => 'Booking Policy',
            'extra_amount' => 'Total Amount',
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

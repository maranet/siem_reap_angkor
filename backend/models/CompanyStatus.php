<?php

namespace backend\models;
use app\models\User;


use Yii;

/**
 * This is the model class for table "company_status".
 *
 * @property int $id
 * @property string $name
 * @property string|null $css_class
 * @property int|null $order_by
 * @property int|null $updated_by
 * @property string|null $updated_date
 * @property int|null $status
 * @property int|null $created_by
 * @property string|null $created_date
 */
class CompanyStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['order_by', 'updated_by', 'status', 'created_by'], 'integer'],
            [['updated_date', 'created_date'], 'safe'],
            [['name', 'css_class', 'description'], 'string', 'max' => 255],
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
            'css_class' => 'Css Class',
            'order_by' => 'Order By',
            'updated_by' => 'Updated By',
            'updated_date' => 'Updated Date',
            'status' => 'Status',
            'created_by' => 'Created By',
            'created_date' => 'Created Date',
            'description' => 'Description',
        ];
    }
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
}

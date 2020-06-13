<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "company_type".
 *
 * @property int $id
 * @property string|null $name
 * @property bool|null $status
 */
class CompanyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'boolean'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namex' => 'Namex',
            'status' => 'Status',
            'description' => 'Description',
        ];
    }
}

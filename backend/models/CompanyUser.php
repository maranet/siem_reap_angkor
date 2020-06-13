<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $company
 */
class CompanyUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'company'], 'required'],
            [['user_id', 'company'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'company' => 'Company',
        ];
    }
}

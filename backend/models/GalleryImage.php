<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "slide_gallery".
 *
 * @property int $id
 * @property string|null $file_path
 * @property string|null $file_name
 * @property int|null $company_id
 * @property int|null $slide_id
 */
class GalleryImage extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_image';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'gallery_id'], 'integer'],
            [['file_path', 'file_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'file_path' => 'File Path',
            'file_name' => 'File Name',
            'company_id' => 'Company ID',
            'gallery_id' => 'Gallery ID',
        ];
    }
}

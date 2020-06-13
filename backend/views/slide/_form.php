<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\SlideGallery;

/* @var $this yii\web\View */
/* @var $model backend\models\Slide */
/* @var $form yii\widgets\ActiveForm */

$validationUrl = ['slide/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}

?>

<div class="slide-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data'],
        'validationUrl' => $validationUrl
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?php
                        $model->status = $model->isNewRecord ? 1 : $model->status;
                        echo $form->field($model, 'status')->radioList(['1' => 'Active', '0' => 'Inactive'], ['unselect' => false, 'default' => 1]);
                    ?>
                </div>
            </div>
            <div class="col-md-12">
                <h3>Photo Gallery <hr></h3><br>
                <?= $form->field($model, 'file_name[]')->fileInput(['multiple' => true, 'accept' => 'image/*',])->label(false) ?>
            </div>
            <div class="col-md-12">
                <?php 
                    if (!$model->isNewRecord) {
                        $slide_gallery = SlideGallery::find()->where(['slide_id' => $model->id])->all();
                    }else{
                        $slide_gallery = [];
                    }
                ?>
                <?php
                    foreach ($slide_gallery as $row_gallery) {   
                ?>
                    <figure class="col-md-4">
                        <img id= "<?= $row_gallery['id'] ;?>" alt="picture" src="<?= $row_gallery['file_path'].$row_gallery['file_name'] ;?>" class="img-fluid">
                        <?= Html::a('<i class="fa fa-close icon-flat"></i>', ['delete-image', 'id' => $row_gallery->id], ['class' => 'remove-image', 'data' => [
                                        'confirm' => 'Are you sure want to delete it?',
                                        'method' => 'post',
                                    ],]) ?>
                    </figure>
                <?php 
                    }   
                ?>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<style>
    img.img-fluid {
        width: 100%;
        height: 280px;
        object-fit: cover;
        border: 1px solid #afa8a8;
    }
    i.fa.fa-close.icon-flat {
        position: absolute;
        top: 6px;
        right: 15px;
        background: #ded8d880;
        padding: 10px;
    }
</style>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Blog */
/* @var $form yii\widgets\ActiveForm */
$base_url = Yii::getAlias('@web');
$this->registerJsFile(
    '@web/plugins/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$validationUrl = ['blog/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data'],
        'validationUrl' => $validationUrl
    ]); ?>

    <div class="row"> 
        <div class="col-md-12">
            <div class="col-md-3">
                <label class="control-label">Feature Image</label>
                <div style="display: block">
                    <?= $form->field($model, 'file')->fileInput(['multiple' => false, 'accept' => 'image/*',])->label(false) ?>
                </div>
                <div class="wr_img">
                    <?php if ($model->feature_image == "" || $model->isNewRecord ){ ?>
                        <label for = 'blog-file'>
                            <img id ='feature_images' src="<?php $base_url?>images/default-image.png" class='img-responsive'>
                        </label>
                    <?php } else {?>
                        <label for="blog-file">
                            <img id="feature_images" src="<?= $model->feature_image;?>" class="img-responsive" onError="this.onerror=null;this.src='<?= $base_url.'/backend/uploads/empty-avatar.png' ?>';">
                        </label>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12">
                        <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'description')->textArea(['class'=>"editor_area"]) ?>
                    </div>

                    <div class= "col-md-6">
                        <?php
                            $model->status = $model->isNewRecord ? 1 : $model->status;
                            echo $form->field($model, 'status')->radioList(['1' => 'Active', '0' => 'Inactive'], ['unselect' => false, 'default' => 1]);
                        ?>
                    </div>
                </div>
                

            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php

$script = <<< JS

    $(function () {
        $("#blog-file").change(function () {
            readURL(this);
        });
        $("#blog-file").hide();
    });

        function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                x= e.target.result;
                $("#feature_images").attr("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    } 


    var base_url = "$base_url";

    $('.editor_area').each(function(e){
        CKEDITOR.replace( this.id, { customConfig: base_url + '/plugins/ckeditor/config.js' });
    });


JS;
$this->registerJS($script);
?>

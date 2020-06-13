<?php

use backend\models\CompanyStatus;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProfile */
/* @var $form yii\widgets\ActiveForm */
$base_url = Yii::getAlias('@web');

$validationUrl = ['company-profile/validation'];
if (!$model->isNewRecord) {
    $validationUrl['id'] = $model->id;
}
$date_template = '{label}</br><div class="input-group">
            <span style="width: 50px;line-height: 0rem;padding: 9px;" class="input-group-addon"><i class="fa fa-calendar"></i></span> {input} </div>{error}{hint}';
            ?>

<div class="company-profile-form">
    <?php $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'options' => ['enctype' => 'multipart/form-data'],
                'validationUrl' => $validationUrl,
            ]);?>
        <div class="row" style="background: white;padding: 10px;">
            <div class="col-lg-12">
                <div class="col-md-3">
                        <label class="control-label">Company Logo</label>
                        <div style="display: block">
                            <?=$form->field($model, 'file')->fileInput(['multiple' => false, 'accept' => 'image/*'])->label(false)?>
                        </div>
                        <div class="wr_img">
                            <?php if ($model->feature_image == "" || $model->isNewRecord) {?>
                                <label for = 'companyprofile-file'>
                                    <img id ='feature_images' src="<?php $base_url?>images/default-image.png" class='img-responsive'>
                                </label>
                            <?php } else {?>
                                <label for="companyprofile-file">
                                    <img id="feature_images" src="<?=$model->feature_image;?>" class="img-responsive" onError="this.onerror=null;this.src='<?=$base_url . '/backend/uploads/empty-avatar.png'?>';">
                                </label>
                            <?php }?>
                        </div>
                    </div>

                    <div class="col-md-9">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="col-lg-6">
                                <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
                            </div>
                            <div class="col-lg-6">
                                <div class= "row">
                                    <div class= "col-lg-12">
                                        <div class="col-lg-6">
                                            <?php
                                            $country_defaule = ArrayHelper::map(\backend\models\CountryDefault::find()
                                                ->where(['status' => 1])
                                                ->all(), 'id', function ($model) {return $model->name;});
                                                ?>
                                                <?=$form->field($model, 'country_id')->widget(Select2::classname(), [
                                                    'data' => $country_defaule,
                                                    'id' => 'country_id',
                                                    'theme' => Select2::THEME_DEFAULT,
                                                    'language' => 'eg',
                                                    'options' => ['placeholder' => 'Select country'],
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                    ],
                                                ]);
                                                ?>
                                            </div>
                                            <div class="col-lg-6">
                                                <?php 
                                                if (!$model->isNewRecord) {
                                                    $validation['id'] = $model->id;
                                                    $city_default = ArrayHelper::map(\backend\models\CityDefault::find()
                                                    ->where(['status' => 1])
                                                    ->all(), 'id', function ($model) {return $model->name;});
                                                    }else{
                                                        $city_default =[];
                                                    }
                                                 ?>
                                                    <?=$form->field($model, 'city_id')->widget(Select2::classname(), [
                                                        'data' => $city_default,
                                                        'theme' => Select2::THEME_DEFAULT,
                                                        'language' => 'eg',
                                                        'options' => ['placeholder' => 'Select city'],
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                        ],
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6">
                                    <?php
                                    $company_status = ArrayHelper::map(\backend\models\CompanyStatus::find()
                                        ->where(['status' => 1])
                                        ->all(), 'id', function ($model) {return $model->name;});
                                        ?>
                                        <?=$form->field($model, 'company_status')->widget(Select2::classname(), [
                                            'data' => $company_status,
                                            'theme' => Select2::THEME_DEFAULT,
                                            'language' => 'eg',
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                            ],
                                        ]);

                                        if ($model->company_status == 4 ){
                                            $terminate_status = "";
                                        }else{
                                            $terminate_status = "display: none";
                                        } 
                                        ?>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                $company_type = ArrayHelper::map(\app\models\CompanyType::find()
                                    ->where(['status' => 1])
                                    ->all(), 'id', function ($model) {return $model->name;});
                                    ?>
                                    <?=$form->field($model, 'company_type')->widget(Select2::classname(), [
                                        'data' => $company_type,
                                        'theme' => Select2::THEME_DEFAULT,
                                        'language' => 'eg',
                                        'pluginOptions' => [
                                            'allowClear' => true,
                                        ],
                                    ]);
                                    ?>
                            </div>
                            <div class="col-lg-6">
                                <?=$form->field($model, 'postal_code')->textInput(['maxlength' => true])?>
                            </div>
                            <div class="col-lg-6">
                                <?=$form->field($model, 'website_url')->textInput(['maxlength' => true])?>
                            </div>
                            <div class="col-lg-6">
                                    <?=$form->field($model, 'address')->textInput(['maxlength' => true])?>
                            </div>
                            <div class="col-md-6">
                                        <?=$form->field($model, 'internet_public_ip_address')->textInput(['maxlength' => true])?>
                                    </div>
                            <div class= "col-lg-6">
                                <?php
                                $model->status = $model->isNewRecord ? 1 : $model->status;
                                echo $form->field($model, 'status')->radioList(['1' => 'Active', '0' => 'Inactive'], ['unselect' => false, 'default' => 1]);
                                ?>
                            </div>
                        </div> 
            </div>
            <div class="col-md-12 v-space"></div>
            <!-- start tab -->
            <div class= "col-lg-12">
                <ul class="nav nav-tabs">
                    <li class= "active"><a data-toggle="tab" href="#sale">Sale</a></li>
                    <li><a data-toggle="tab" href="#contact">Contact</a></li>
                    <li><a data-toggle="tab" href="#term">Term & Condition</a></li>
                    <li class= "deactivate-tab" style= "<?=$terminate_status;?>"><a data-toggle="tab" href="#deactivate-info">Deactivate Info</a></li>
                    <li><a data-toggle="tab" href="#document-format">Document Format</a></li>

                </ul>   
                <!-- content -->
                <div class="tab-content">
                    <!-- ==========tap 1======== -->
                        <div id="contact" class="tab-pane fade in"><br>
                            <div class= "row">
                                <div class= "col-lg-12">
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'contact_person')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'general_email')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'main_phone_1')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'main_phone_2')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'invoice_email')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'mobile_number_invoice')->textInput(['maxlength' => true])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ==========end tap1======== -->
                        <!-- ==========start tap3======== -->
                        <div id="term" class="tab-pane fade in"><br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-3">
                                        <label class="control-label">Service and Agreement</label>
                                                <?php 
                                                $base_url = Yii::getAlias('@web');
                                                if($model->service_agreement_local_path != ""){
                                            ?>
                                                    <a href="<?= $base_url ?>/index.php?r=company-profile/download&id=<?=$model->id;?>"> | Download File <i style="color: gray;" class="fa fa-download"></i></a>
                                            <?php }?>
                                                        <div style="display: block">
                                                            <?= $form->field($model, 'service_agreement')->fileInput(['multiple' => false, 'accept' => 'image/*',])->label(false) ?>
                                                        </div>
                                                        <div class="wr_img">
                                                            <?php if ($model->service_agreement == "" || $model->isNewRecord ){ ?>
                                                            <label for = 'companyprofile-service_agreement'>
                                                                <img id ='service_agreement' src="<?php $base_url?>images/default-image.png" class='img-responsive'>
                                                            </label>
                                                            <?php } else {?>
                                                            <label for="companyprofile-service_agreement">
                                                            <img id="service_agreement" src="<?= $model->service_agreement;?>" class="img-responsive" onError="this.onerror=null;this.src='<?= $base_url.'/backend/uploads/empty-avatar.png' ?>';">
                                                            </label>
                                                            <?php } ?>
                                                        </div>

                                        
                                    </div>
                                  
                                    <div class="col-lg-9">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-lg-12">
                                                    <?=$form->field($model, 'fee')->textInput(['maxlength' => true])?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <?=$form->field($model, 'number_of_user')->textInput(['maxlength' => true])?>
                                                </div>
                                                <div class="col-lg-12">
                                                    <?=$form->field($model, 'code')->textInput(['maxlength' => true])?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ==========end tap3======== -->
                        <!-- ==========start tap4======== -->
                        <div id="sale" class="tab-pane fade in active"><br>
                            <div class= "row">
                                <div class= "col-lg-12">
                                    <div class="col-lg-6">
                                        <?= $form->field($model, 'sale_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?= $form->field($model, 'lived_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?php
                                        $passed_by = ArrayHelper::map(\backend\models\EmployeeProfile::find()
                                            ->where(['status' => 1])
                                            ->all(), 'id', function ($model) {return $model->first_name ." " .$model->last_name;});
                                            ?>
                                            <?=$form->field($model, 'passed_by')->widget(Select2::classname(), [
                                                'data' => $passed_by,
                                                'theme' => Select2::THEME_DEFAULT,
                                                'language' => 'eg',
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                ],
                                            ]);
                                            ?>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <?php
                                        $handle_by = ArrayHelper::map(\backend\models\EmployeeProfile::find()
                                            ->where(['status' => 1])
                                            ->all(), 'id', function ($model) {return $model->first_name ." " .$model->last_name;});
                                            ?>
                                            <?=$form->field($model, 'handle_by')->widget(Select2::classname(), [
                                                'data' => $handle_by,
                                                'theme' => Select2::THEME_DEFAULT,
                                                'language' => 'eg',
                                                'pluginOptions' => [
                                                    'allowClear' => true,
                                                ],
                                            ]);
                                            ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ==========end tap4======== -->
                        <!-- ==========start tap5======== -->
                        <div style= "<?=$terminate_status;?>" id= "deactivate-info" class="tab-pane fade in deactivate-content"><br>
                            <div class= "row">
                                <div class= "col-lg-12">
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'deactivated_by')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'deactivated_at')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'deactivated_reason')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'deactivated_requested_by')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-lg-6">
                                        <?=$form->field($model, 'deactivated_requested_contact_detail')->textInput(['maxlength' => true])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ==========end tap5======== -->
                        <!-- ==========start tap6======== -->
                        <div id="document-format" class="tab-pane fade in"><br>
                            <div class= "row">
                                <div class= "col-md-12">
                                    <div class="col-md-4">
                                        <?=$form->field($model, 'invoice')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-md-4">
                                        <?=$form->field($model, 'receipt')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-md-4">
                                        <?=$form->field($model, 'expense')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-md-4">
                                        <?=$form->field($model, 'proposal')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-md-4">
                                        <?=$form->field($model, 'quotation')->textInput(['maxlength' => true])?>
                                    </div>
                                    <div class="col-md-4">
                                        <?=$form->field($model, 'contract')->textInput(['maxlength' => true])?>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <!-- ==========end tap6======== -->





                        <div class="form-group">
                <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
            </div>
                </div>
                <!-- ===============end div-->
               
            </div>
            <!-- end tab -->
           
        </div>
    <?php ActiveForm::end();?> 

</div>



<?php
$script = <<< JS
    $(function () {
        $("#companyprofile-file").change(function () {
            readURL(this);
        });
        $("#companyprofile-file").hide();
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

    $(function () {
        $("#companyprofile-service_agreement").change(function () {
            readURL(this);
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        x= e.target.result;
                        $("#service_agreement").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        });
        $("#companyprofile-service_agreement").hide();
    });

    $('#companyprofile-sale_date, #companyprofile-lived_date').datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
 
    
    var base_url = "$base_url";

    $('.editor_area').each(function(e){
        CKEDITOR.replace( this.id, { customConfig: base_url + '/plugins/ckeditor/config.js' });
    });

    // =========city country===========

    $("#companyprofile-country_id").change(function(){ 
        var id = $(this).val();
        $.ajax({
            url: base_url+'/index.php?r=company-profile/index',
            type: 'post',
            data: {
                country_id: id,
                action: 'get_city'
            },
            success: function(response){ 
                var data = JSON.parse(response);
                var str = "";
                $.each(data,function(key,value){
                    str = str + '<option value="'+value.id+'">'+value.name+'</option>';
                });
                $('#companyprofile-city_id').html(str);
            }
        });

    });

JS;

$this->registerJs($script);

?>
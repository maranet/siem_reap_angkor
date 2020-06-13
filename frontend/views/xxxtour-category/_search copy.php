<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model frontend\models\TourCategorySearch */
/* @var $form yii\widgets\ActiveForm */
$date_template = '
    {label}
    </br>
    <div class="input-group">
        <span style="width: 40px" class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span> 
        {input} 
    </div>
    {error}{hint}';
?>

<div class="tour-category-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-2">
                <?php
                    $tour_category_name = ArrayHelper::map(\backend\models\TourCategory::find()
                    ->where(['status'=>1, 'company_id' => 1])
                    ->all(), 'id', function($model){return $model->name;});
                ?>
                 
                <?=$form->field($model, 'name')->dropDownList($tour_category_name, ['prompt' => 'Select Tour Category']);?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'class'=>'date_picker form-control DateFrom', 'placeholder' => 'From']) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true,'class'=>'date_picker form-control', 'placeholder' => 'To']) ?>
            </div>
            <div class="col-md-2">
                <?php 
                    $adult_value = ['1' => '1 adult', '2' => '2 adults', '3' => '3 adults', '4' => '4 adults', '5' => '5 adults'];
                 ?>
                <?=$form->field($model, 'adult')->dropDownList($adult_value);?>
            </div>
            <div class="col-md-2">
                <?php 
                    $child_value = ['0' => '0 child', '1' => '1 child', '2' => '2 children', '3' => '3 children', '4' => '4 children', '5' => '5 children'];
                 ?>
                <?=$form->field($model, 'child')->dropDownList($child_value);?>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <?=Html::submitButton('Filter', ['class' => 'btn btn-primary'])?>
                    <?= Html::a('Reset',['index'],['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

</div>
<style>
    .search-bd{
        background: whitesmoke;
        height: 100px; 
        padding: 15px;  
        margin-top: 20px;
        margin-bottom: 20px;
    }
    .btn-primary {
        color: #fff;
        background-color: #3f5773;
        border-color: #3f5773; 
        margin-top: 30px;
    }

    .date_picker {
        padding: 5px;
    }
    .form-control{
        background: white!important;
    }
    .input-group{
        width: 100%;
    }
    .form-group button, .form-group a {
        margin-top: 23px;
    }

</style>
<?php
    $script = <<< JS
        // =========Datepicker===========

        $('.date_picker').datepicker({
            format: 'yyyy-mm-dd',
            changeMonth: true,
            changeYear: true,
            autoclose: true,
        });

        // ========= Select Datepicker Value===========
        
        $("#tourcategorysearch-from_date").change(function(){
            var get_start_date = $('#tourcategorysearch-from_date').datepicker('getDate', '+2d');
            get_start_date.setDate(get_start_date.getDate()+2);
            $('#tourcategorysearch-to_date').datepicker('setDate', get_start_date);

                $('#tourcategorysearch-to_date').datepicker('setStartDate', $(this).val());

                if(Date.parse($(this).val()) > Date.parse($('#tourcategorysearch-to_date').val())){
                    $('#tourcategorysearch-to_date').datepicker('setDate', $(this).val());
                }

            });
        // ===============Select Min Date========================
        
        $("#tourcategorysearch-from_date").datepicker('setDate', '+7d');
        $("#tourcategorysearch-from_date").datepicker('setStartDate', new Date());

        
 
    JS;
    $this->registerJS($script);
?>
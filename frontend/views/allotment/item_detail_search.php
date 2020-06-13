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
 <!-- search secion -->
     <style>
        button.btn.btn-primary.check {
            margin-top: 20px;
            padding: 5px;
        }
        .search-bd{
            background: whitesmoke;
            height: auto; 
            padding: 15px;  
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 3px;
        }
        .btn-primary:hover{
            color: #fff;
            background-color: #ff0825;
            border-color: #ff0625 !important;
        }
        .btn-primary{
            color: #fff;
            background-color: #ff0825 !important;
            border-color: none !important;
            margin-top: 30px;
            padding: 5px 40px;
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
        .search-fieldx{
            position: absolute;
            top: -65px;
            z-index: 999; 
        }
        select {
            margin-top: 20px;
        }

    </style>
     <?php
        $item_model = \backend\models\TourItem::find()->where(['id'=>$item_id])->one();
     ?>
    <div class="tour-category-search">
        <div class="col-md-12 search-bd">
            <?php $form = ActiveForm::begin([
                'action' => ['allotment/item-detail', 'id'=>31],
                'method' => 'get',
            ]); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'class'=>'date_picker form-control DateFrom'])->label(false);?>
                    </div>
                    <?php 
                        // 1 = day, 2 = hour
                        if ($item_model->duration_type == 2) {
                            $hidden = "";
                        }else if($item_model->duration_type == 1 && $item_model->duration == 1) {
                            $hidden = "";
                        }else{
                           $hidden = ""; 
                        }
                     ?>
                    <div <?= $hidden ;?> class="col-md-2">
                        <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true,'class'=>'date_picker form-control', 'placeholder' => 'To'])->label(false);?>
                    </div>
                    <div class="col-md-2">
                        <?php 
                            $adult_value = ['1' => '1 adult', '2' => '2 adults', '3' => '3 adults', '4' => '4 adults', '5' => '5 adults'];
                         ?>
                        <?=$form->field($model, 'adult')->dropDownList($adult_value)->label(false);?>
                    </div>
                    <div class="col-md-2">
                        <?php 
                            $child_value = ['1' => '1 child', '2' => '2 children', '3' => '3 children', '4' => '4 children', '5' => '5 children'];
                         ?>
                        <?=$form->field($model, 'child')->dropDownList($child_value)->label(false);?>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <?=Html::submitButton('Check Availability', ['class' => 'btn btn-primary check'])?>
                            <!-- <?= Html::a('Reset',['index'],['class' => 'btn btn-primary']) ?> -->
                        </div>
                    </div>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
 <!-- end search secion -->

<style>
    button.btn.btn-primary.check {
        margin-top: 20px;
        padding: 5px;
    }
    .search-bd{
        background: whitesmoke;
        height: auto; 
        padding: 15px;  
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 3px;
    }
    .btn-primary:hover{
        color: #fff;
        background-color: #ff0825;
        border-color: #ff0625 !important;
    }
    .btn-primary{
        color: #fff;
        background-color: #ff0825 !important;
        border-color: none !important;
        margin-top: 30px;
        padding: 5px 40px;
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
    .search-fieldx{
        position: absolute;
        top: -65px;
        z-index: 999; 
    }
    select {
        margin-top: 20px;
    }

</style>
<?php
 $base_url = Yii::getAlias('@web');
 $from_date = "";
$script = <<< JS
var from_date = "$from_date";
var base_url = "$base_url";
// =========Datepicker===========

    $('.date_picker').datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    // ========= Select Datepicker Value===========
    
    $("#allotmentsearch-from_date").change(function(){
        var get_start_date = $('#allotmentsearch-from_date').datepicker('getDate', '+2d');
        get_start_date.setDate(get_start_date.getDate()+2);
        $('#allotmentsearch-to_date').datepicker('setDate', get_start_date);

            $('#allotmentsearch-to_date').datepicker('setStartDate', $(this).val());

            if(Date.parse($(this).val()) > Date.parse($('#allotmentsearch-to_date').val())){
                $('#allotmentsearch-to_date').datepicker('setDate', $(this).val());
            }

        });
    // ===============Select Min Date========================
    
    // $("#allotmentsearch-from_date").datepicker('setDate', '+7d');
    $("#allotmentsearch-from_date").datepicker('setDate', new Date());
    $("#allotmentsearch-from_date").datepicker('setStartDate', new Date());
JS;
$this->registerJS($script);
?>
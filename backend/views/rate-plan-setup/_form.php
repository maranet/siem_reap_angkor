<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm; 
use yii\helpers\ArrayHelper; 
use kartik\select2\Select2;
use backend\models\TourItem;
use backend\models\RatePlanSetupRange;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlanSetup */
/* @var $form yii\widgets\ActiveForm */
$base_url = Yii::getAlias('@web');
$this->registerJsFile(
    '@web/plugins/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$time_template = '
    {label}
    </br>
    <div class="input-group">
        <span style="width: 40px" class="input-group-addon">
            <i class="demo-pli-clock"></i>
        </span> 
        {input} 
    </div>
    {error}{hint}';

$validationUrl = ['rateplansetup/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}
?>
<style>
    .btn_remove{
        color: red;
        font-size: 40px;
        cursor: pointer;
    }
    .add_more{
        margin-top: 33px;
        color: blue;
        font-size: 40px;
        cursor: pointer;
    }
</style>
<div class="rate-plan-setup-form">

    <?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data'],
        'validationUrl' => $validationUrl
    ]); ?>

    <div class="row">
           <div class="col-md-12">
                <div class="col-md-4">
                    <?=$form->field($model, 'name')->textInput(['maxlength' => true])?>
                </div>
                <div class="col-md-4">
                    <?php
                        $tour_item_id = ArrayHelper::map(\backend\models\TourItem::find()
                        ->where(['id' => $_SESSION['tour_item_id']])
                        ->all(), 'id', function($model){return $model->name;});
                    ?>
                    <?= $form->field($model, 'tour_item_id')->widget(Select2::classname(), [
                            'data' => $tour_item_id,
                            'theme' => Select2::THEME_DEFAULT,
                            'language' => 'eg',
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                    ?> 
                </div>
                <div class="col-md-4">
                    <?php
                    $model->starting_time = $model->isNewRecord ? '5:00' : $model->starting_time;
                     ?>
                    <?= $form->field($model, 'starting_time', [
                        'template'=>$time_template,
                        'options' => ['placeholder' => 'Time'],
                        'inputOptions' => [
                            'value' => \Yii::$app->formatter->asTime($model->starting_time, 'php:h:i')]])->textInput(['class'=>'date_picker']) 
                    ?>  
                </div>
           </div>
            <div class="col-md-12">
                <div class="add-range">
                    <?php 
                        if ($model->isNewRecord) {
                            $count_range_arr = 1;
                            ?>
                                <div class="row row_line" data-id= "1" id= "row_line_1">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <p>From</p>
                                            <input type="number" name="from[]" value="0" class="form-control from" data-id="from_1"
                                                        id="from_1" required>
                                        </div>
                                        <div class="col-md-2">
                                            <p>To</p>
                                            <input type="number" name="to[]" value="0" class="form-control from" data-id="to_1"
                                                        id="to_1" required>
                                        </div>
                                        <div class="col-md-2">
                                            <i id=  "add_more" data-id= "1" style="margin-top: 33px; color: blue; font-size: 40px; cursor: pointer;" class="ion-plus-circled add_more"></i>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                </div>
                            <?php
                                }else{
                                    $range_data = RatePlanSetupRange::find()->where(['tour_rate_setup_id' => $model->id])->all();
                                    $count_range_arr = count($range_data);
                                    $k = 0;
                                    foreach ($range_data as $key => $value) {
                                        $k++;
                                        
                            ?>
                             <div class="row row_line" style="margin-top: 10px;" data-id= "<?= $k;?>" id= "row_line_<?= $k;?>">
                                    <div class="col-md-12">
                                        <div class="col-md-2">
                                            <?= $k == 1 ? "<p>From</p>" : ""; ?>
                                            <input type="number" name="from[]" value="<?= $value->range_from?>" class="form-control from" data-id="from_<?= $k;?>"
                                                        id="from_<?= $k;?>" required>
                                        </div>
                                        <div class="col-md-2">
                                            <?= $k == 1 ? "<p>To</p>" : ""; ?>
                                            <input type="number" value="<?= $value->range_to?>" name="to[]" class="form-control from" data-id="to_<?= $k;?>"
                                                        id="to_<?= $k;?>" required>
                                        </div>
                                        <div class="col-md-2">
                                            <i id=  "add_more" data-id= "<?= $k;?>" class="<?= $k == 1 ? "ion-plus-circled add_more" : "ion-minus-circled btn_remove"; ?>"></i>
                                        </div>
                                        <div class="col-md-6"></div>
                                    </div>
                                </div>
                                
                            <?php 
                                    } // end foreach
                                } // end else
                             ?>
                </div>
                <div class="col-md-12">
                    <br>
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
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
    var base_url = "$base_url";
    var count_range_arr = "$count_range_arr";

    $('.editor_area').each(function(e){
        CKEDITOR.replace( this.id, { customConfig: base_url + '/plugins/ckeditor/config.js' });
    });
    $('#rateplansetup-starting_time').datetimepicker({
        timepicker: true,
        datepicker: false,
        format: 'H:i',
        hours24: true,
    });
    // ===start append calculate item===
        var data_i = $(document).find('.amount[data-id]:last').attr('data-id');
        var i = count_range_arr;

        var index = 1;
        $(".add_more").unbind('click');
        $(".add_more").bind('click', function(e){
            var item = $('#from_['+i+']').val();
            if(item ==''){
                alert("Value can not null!");
                return false;
            }
            e.preventDefault();
            i++;
            index++;
            var string ="<div class='row row_line' style= 'margin-top: 10px;' data-id= '"+i+"' id= 'row_line_"+i+"'>" +
                            "<div class='col-md-12'>" +
                                "<div class='col-md-2'>" +
                                    "<input type='number' name='from[]' min='0' value= '0' class='form-control from' data-id='from_"+i+"' id='from_"+i+"'/>" +
                                "</div>" +
                                "<div class='col-md-2'>" +
                                    "<input type='number' name='to[]' min='0' value= '0' class='form-control from' data-id='to_"+i+"' id='to_"+i+"' /> " +
                                "</div>" +
                                "<div class='col-md-2'>" +
                                    "<i id=  'add_more' data-id= '"+i+"' style='color: red; font-size: 40px; cursor: pointer;' class='ion-minus-circled btn_remove'></i>" +
                                "</div>" +
                                "<div class='col-md-6'>" +
                                "</div>" +
                            "</div>" +
                        "</div>"
                        ;

            $(".add-range").append(string);
            $(".ion-minus-circled").remove(string);

        });
        // ===end append calculate item====
        // ===Remove item row====
        $(document).on('click', '.btn_remove', function() {
            var id = $(this).attr('data-id');
            $('#row_line_'+ id).remove();
        });
        // ===end Remove item row====




    
JS;
$this->registerJS($script);
?>
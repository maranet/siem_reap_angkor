<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\YearList;
use backend\models\MonthList;
use backend\models\RateRange;
use backend\models\RatePlan;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlan */
/* @var $form yii\widgets\ActiveForm */
$base_url = Yii::getAlias('@web');
$base_color = "#2b3d51";
$year_name = YearList::find()->where(['id'=>$year])->one()->name;
$total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year_name);
$month_id = MonthList::find()->where(['value'=>$month])->one()->id;
$rate_range_id = RateRange::find()->where(['month'=>$month_id,'year'=>$year, 'rate_set_up_id'=>$get_tour_setup_id])->all();
$rate_range_count = RateRange::find()->where(['month'=>$month_id,'year'=>$year, 'rate_set_up_id'=>$get_tour_setup_id])->count();
// echo $rate_plan_max_date = Yii::$app->db->createCommand("SELECT *, MAX(date) FROM rate_plan where rate_set_up_id = $get_tour_setup_id;")->queryOne();

$this->registerJsFile(
    '@web/plugins/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);

$validationUrl = ['rate-plan/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}

$date_template = '{label}</br><div class="input-group">
            <span style="width: 50px;line-height: 0rem;padding: 9px;" class="input-group-addon"><i class="fa fa-calendar"></i></span> {input} </div>{error}{hint}';
?>

<div class="rate-plan-form">

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
                <?= $form->field($model, 'rate_set_up_id')->widget(Select2::classname(), [
                        'data' => $rate_set_up_id,
                        'theme' => Select2::THEME_DEFAULT,
                        'language' => 'eg',
                        'pluginOptions' => [
                            'allowClear' => true,
                            'disabled' => true,
                        ],
                    ]);
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
            </div>
        </div>

        <!-- Rate Detail section -->
        <div class="col-md-12">
            <div class="panel panel-bordered panel-dark" style="margin: 10px;">
                <div class="panel-heading" style="color: white; background-color: <?= $base_color ;?>; border-color: <?= $base_color ;?>;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-1">
                                <p>From</p>
                            </div>
                            <div class="col-md-1">
                                <p>To</p>
                            </div>
                            <div class="col-md-1">
                                <p>Cost Adult</p>
                            </div>
                            <div class="col-md-1">
                                <p>Cost Child</p>
                            </div>
                            <div class="col-md-1">
                                <p>M-Up Adult</p>
                            </div>
                            <div class="col-md-1">
                                <p>M-Up Child</p>
                            </div>
                            <div class="col-md-2">
                                <p>M-Up Type</p>
                            </div>
                            <div class="col-md-1">
                                <p>Price Adult</p>
                            </div>
                            <div class="col-md-1">
                                <p>Price Child</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body calculate_item">

                    <!-- ===== start first add item====== -->
                    <?php 
                    $data_i = 0;
                        foreach ($rate_range_id as $key => $value) {
                            $data_i++;
                     ?>
                     <div class="row row_line" data-id= "<?= $data_i; ?>" id= "row_line_<?= $data_i; ?>" style="margin: 10px;">
                        <div class="col-md-1">
                            <input type="number" name="from[]" min="0" value= "<?= $value->from_person ;?>" class="form-control from" data-id="<?= $data_i ;?>"
                            id="from_1" />
                        </div>
                        <div class="col-md-1">
                            <input type="number" name="to[]" min="0" value= "<?= $value->to_people ;?>" class="form-control to" data-id="<?= $data_i ;?>"
                            id="to_1" />
                        </div>
                        <?php
                            // $rate_plan_data = RatePlan::find()->where(['rate_range_id'=>$value->id,'rate_set_up_id'=>$get_tour_setup_id])->distinct()->all();
                        $rate_plan_data = Yii::$app->db->createCommand("SELECT *, COUNT(DISTINCT rate_range_id) FROM rate_plan where rate_range_id = $value->id;")->queryAll();
                            
                            foreach ($rate_plan_data as $row) {
                         ?>
                            <div class="col-md-1">
                                <input type="number" name="cost_adult[]" min="0" value= "<?= $row['cost_adult'];?>" class="form-control to" data-id="<?= $data_i ;?>"
                                        id="cost_adult_1" />
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="cost_child[]" min="0" value= "<?= $row['cost_child'];?>" class="form-control cost_child" data-id="<?= $data_i ;?>"
                                    id="cost_child_1" />
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="mark_up_adult[]" min="0" value= "<?= $row['mark_up_adult'] ;?>" class="form-control mark_up_adult" data-id="<?= $data_i ;?>"
                                    id="mark_up_adult_1" />
                            </div>
                            <div class="col-md-1">
                                <input type="number" name="mark_up_child[]" min="0" value= "<?= $row['mark_up_child'] ;?>" class="form-control to" data-id="<?= $data_i ;?>"
                                    id="mark_up_child_1" />
                            </div>
                            <div class="col-md-2">
                                <select class="form-control mark_up_type" name="mark_up_type[]" data-id="<?= $data_i ;?>"
                                    id="mark_up_type_1">
                                    <option value="1">amount</option>
                                    <option value="2">%</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <input type="float" name="price_adult[]" min="0" value= "<?= $row['price_adult'] ;?>" class="form-control price_adult" data-id="<?= $data_i ;?>"
                                    id="price_adult_1" />
                            </div>
                            <div class="col-md-1">
                                <input type="float" name="price_child[]" min="0" value= "<?= $row['price_child'] ;?>" class="form-control price_child" data-id="<?= $data_i ;?>"
                                    id="price_child_1" />
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-1">
                                <i id=  "remove_row_<?= $data_i;?>" data-id= "<?= $data_i;?>" style="color: <?= $data_i == 1 ? $base_color : "red" ;?>; font-size: 40px; cursor: pointer;" class="<?= $data_i == 1 ? "ion-plus-circled add_more" : "ion-minus-circled btn_remove" ;?>"></i>
                            </div>
                         <?php 
                            } #end query rate plan by range id
                         ?>
                    </div>
                     <?php 
                        }
                      ?>
                    <!-- ===== end first add item====== -->
                </div>
            </div>
        </div>
    </div>
    <div class="form-group" style="margin: 10px;">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php

$script = <<< JS
    
      var base_url = "$base_url";
        var number_day = "$total_days";
        var controller_id = "allotment";
        var year = "$year_name";
        var month = "$month";
        var rate_range_count = "$rate_range_count";
        var base_color = "$base_color";
        $("#rateplan-from_date, #rateplan-to_date").datepicker({
            format: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
            autoclose: true,
        });
// ===start append calculate item===
        var data_i = $(document).find('.amount[data-id]:last').attr('data-id');
        var i = rate_range_count;

        var index = 1;
        $(".add_more").unbind('click');
        $(".add_more").bind('click', function(e){
            var item = $('.price_child[data-id='+i+']').val();
            if(item ==''){
                alert("Value can not null!");
                return false;
            }
            e.preventDefault();
            i++;
            index++;
            var string = "<div class='row row_line' data-id= "+i+" id= 'row_line_"+i+"' style='margin: 10px;'>" +
                "<div class='col-md-1'>" +
                    "<input type='number' name='from[]' min='0' class='form-control from' data-id="+i+" id='from_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='number' name='to[]' min='0' class='form-control to' data-id="+i+" id='to_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='number' name='cost_adult[]' min='0' class='form-control cost_adult' data-id="+i+" id='cost_adult_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='number' name='cost_child[]' min='0' class='form-control cost_child' data-id="+i+" id='cost_child_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='number' name='mark_up_adult[]' min='0' class='form-control mark_up_adult' data-id="+i+" id='mark_up_adult_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='number' name='mark_up_child[]' min='0' class='form-control mark_up_child' data-id="+i+" id='mark_up_child_"+i+"' />" +
                "</div>" +
                "<div class='col-md-2'>" +
                    "<select class='form-control mark_up_type' name='mark_up_type[]' data-id="+i+" id='mark_up_type_"+i+"'>" +
                        "<option value='1'>amount</option>" +
                        "<option value='2'>%</option>" +
                    "</select>" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='float' name='price_adult[]' min='0' class='form-control price_adult' data-id="+i+" id='price_adult_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'>" +
                    "<input type='float' name='price_child[]' min='0' class='form-control price_child' data-id="+i+" id='price_child_"+i+"' />" +
                "</div>" +
                "<div class='col-md-1'></div>" +
                "<div class='col-md-1'>" +
                    "<i id=  'remove_row_"+i+"' data-id= "+i+" style='color: red; font-size: 40px; cursor: pointer;' class='ion-minus-circled btn_remove'></i>" +
               "</div>" +
            "</div>"
            ;

            $(".calculate_item").append(string);
            $(".ion-minus-circled").remove(string);
            calculateNumber();

        });
        // ===end append calculate item====

        // ===Remove item row====
        $(document).on('click', '.btn_remove', function() {
            var id = $(this).attr('data-id');
            $('#row_line_'+ id).remove();
        });
        // ===end Remove item row====

        // ===start From Date to Date====
        $("#rateplan-from_date").change(function(){
            $("#rateplan-to_date").datepicker("setStartDate", $(this).val());
        });
        // ===end From Date to Date====

        // ===start calculate mark-up type====
        function calculateNumber(){
            var sum = 0;
            $(".calculate_item .row_line").each(function(){
                var id = $(this).data('id');
                var cost_adult = $("#cost_adult_"+id).val();
                var cost_child = $("#cost_child_"+id).val();
                var from = $("#from_"+id).val();
                var to = $("#to_"+id).val();



                var mark_up_adult = $("#mark_up_adult_"+id).val();
                var mark_up_child = $("#mark_up_child_"+id).val();
                var mark_up_type = $("#mark_up_type_"+id).val();

                if(parseInt(mark_up_type) == 1){
                    var price_adult = parseFloat(cost_adult) +parseFloat(mark_up_adult);
                    $("#price_adult_"+id).val(price_adult);

                    var price_child = parseFloat(cost_child) +parseFloat(mark_up_child);
                    $("#price_child_"+id).val(price_child);
                }else{
                    var price_adult = (parseFloat(mark_up_adult)/100)*parseFloat(cost_adult)+parseFloat(cost_adult);
                    $("#price_adult_"+id).val(price_adult);

                    var price_child = (parseFloat(mark_up_child)/100)*parseFloat(cost_child)+parseFloat(cost_child);
                    $("#price_child_"+id).val(price_child);

                }

                // function on change mark-up-type to calculate value
                $("#mark_up_type_"+id).change(function(){
                    var mark_up_type = $("#mark_up_type_"+id).val();

                    if(parseInt(mark_up_type) == 1){
                        var price_adult = parseFloat(cost_adult) +parseFloat(mark_up_adult);
                        $("#price_adult_"+id).val(parseFloat(price_adult).toFixed(2));

                        var price_child = parseFloat(cost_child) +parseFloat(mark_up_child);
                        $("#price_child_"+id).val(parseFloat(price_child).toFixed(2));
                    }else{
                        var price_adult = (parseFloat(mark_up_adult) - parseFloat(cost_adult))*100;
                        $("#price_adult_"+id).val(parseFloat(price_adult).toFixed(2));

                        var price_child = (parseFloat(mark_up_child) - parseFloat(cost_child))*100;
                        $("#price_child_"+id).val(parseFloat(price_child).toFixed(2));

                    }
                });
            });

        }

        // ===end calculate mark-up type====


        // ===start calculate price adult and child====
        $(".calculate_item :input[type=number], .calculate_item, .cost_adult, .cost_child, .mark_up_adult, .mark_up_child").keyup(function(){
            calculateNumber();
        });
            
        // ===end calculate price adult and child====

        // ===start Display only a month====

        $(document).ready(function(){
            $("#rateplan-to_date").datepicker("setDate", new Date(year, month-1, 1));

            // start and end month only

            $("#rateplan-from_date").datepicker("setDate", new Date(year, month-1, 1));
            $("#rateplan-from_date").datepicker("setEndDate", new Date(year, month-1, number_day));
            $("#rateplan-to_date").datepicker("setEndDate", new Date(year, month-1, number_day));
        });
        $("#rateplan-from_date").change(function(){
            $("#rateplan-to_date").datepicker("setStartDate", $(this).val());
            $("#rateplan-from_date").datepicker("setStartDate", new Date(year, month-1, 1));
            if(Date.parse($(this).val()) > Date.parse($("allotment-to_date").val())){
                $("#rateplan-to_date").datepicker("setDate", $(this).val());
            }

        });
        // ===end Display only a month====    


JS;
$this->registerJS($script);
?>


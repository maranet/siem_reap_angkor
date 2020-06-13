<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use kartik\select2\Select2;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
$base_url = Yii::getAlias('@web');


/* @var $this yii\web\View */
/* @var $searchModel backend\models\AllotmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Allotments';
$this->params['breadcrumbs'][] = $this->title;
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

$validationUrl = ['allotment/validation'];
if (!$model->isNewRecord) {
    $validationUrl['id'] = $model->id;
}
$date_template = '{label}</br><div class="input-group">
            <span style="width: 50px;line-height: 0rem;padding: 9px;" class="input-group-addon"><i class="fa fa-calendar"></i></span> {input} </div>{error}{hint}';
?>
<style>
    td {
    padding: 7px;
}
    td, th { 
    border: solid black 1px;
    text-align: center;
}
button.btn.btn-success.btn-submit {
    float: left;
    margin-top: 15px;
}
th.Sat {
    background: #ff00008f;
}
th.Sun {
    background: #ff00008f;
}
td.Sat {
    background: #79ff585e;
}
td.Sun {
    background: #79ff585e;
}
#content {
  height: 800px;
  width: 2000px;
  background-color: coral;
}
#myDIV {
  height: auto;
  width: 100%;
  overflow: auto;
}
</style>
    <?php 
$workdays = array();
$type = CAL_GREGORIAN;
$month_new = date('n'); // Month ID, 1 through to 12.
$year_new = date('Y'); // Year in 4 digit 2009 format.
$day_count = cal_days_in_month($type, $month_new, $year_new); // Get the amount of days

?>

<div class="allotment-index">
<h5><?= Html::encode($this->title) ?></h5>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php
        if ($searchModel->year && $searchModel->month && $searchModel->rate_set_up_id) {
        $year =  \backend\models\YearList::find()->where(['id'=>$searchModel->year])->one();
        $month =  \backend\models\MonthList::find()->where(['id'=>$searchModel->month])->one()->value;
        $rate_plan =  \backend\models\RatePlanSetUp::find()->where(['id'=>$searchModel->rate_set_up_id])->one()->name;
        $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year->name);
        $hidden = "";
        $item_id = \backend\models\RatePlanSetUp::find()->where(['id'=>$searchModel->rate_set_up_id])->one()->tour_item_id;
        $rate_setup_id = $searchModel->rate_set_up_id;

    }else{
        return $this->render('_search', ['model' => $searchModel]);
        $total_days = 0;
        $rate_plan = "";
        $hidden = "hidden";
    }
    ?>

</div>
<div class="panel <?=$hidden;?>"> 
    <div class="panel-body">  
    <?php $form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'action' =>['/allotment/create','id'=>$model->id, 'month'=>$month, 'year'=>$year->name, 'search_item_rate_setup'=>$searchModel->rate_set_up_id],
    'options' => ['enctype' => 'multipart/form-data'],
    'validationUrl' => $validationUrl
]); ?>
<br>
        <div class="row" style="padding-top: 20px;">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
            </div>
            <div class="col-md-2">
                <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
            </div>
            
            <div class="col-md-2">
                <?=$form->field($model, 'number')->textInput(['maxlength' => true])?>
            </div>
            <div class="col-md-2">
                <!-- hidden default filter value -->
                <?=$form->field($model, 'month')->hiddenInput(['maxlength' => true, 'value'=>$searchModel->month])->label(false);?>
                <?=$form->field($model, 'year')->hiddenInput(['maxlength' => true, 'value'=>$searchModel->year])->label(false);?>
                <?=$form->field($model, 'tour_item_id')->hiddenInput(['maxlength' => true, 'value'=>$item_id])->label(false);?>
                <?=$form->field($model, 'rate_set_up_id')->hiddenInput(['maxlength' => true, 'value'=>$searchModel->rate_set_up_id])->label(false);?>
                
                <div class="form-group">
                    <?=Html::submitButton('Submit', ['class' => 'btn btn-success btn-submit'])?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
        <br>
        <div class="data-table" id="myDIV" onscroll="myFunction()">
    <table>
        <thead>
            <th>
                Days
            </th>
            <?php
            $month_year = $year->name."-".$month;
            $first_day = $month_year."-01";
            $query = "SELECT * 
                        from allotment
                        where Date BETWEEN '$first_day' AND LAST_DAY('$first_day')";
            $get_allotment = Yii::$app->db->createCommand($query)->queryAll();
            for ($i = 1; $i <= $total_days; $i++) 
                {
                    $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                    echo "<th class= '<?= $day ;?>'>".$i."<br>".$day."</th>";
                }
             ?>
        </thead>

        <tbody>
            <tr>
                <td>
                    <?= $rate_plan ;?>

                </td>
                <?php
            for ($i = 1; $i <= $total_days; $i++) 
                {
                    switch ($i){
                        case 1: 
                        $day = "01";
                        break;

                        case 2: 
                        $day = "02";
                        break;

                        case 3: 
                        $day = "03";
                        break;

                        case 4: 
                        $day = "04";
                        break;

                        case 5: 
                        $day = "05";
                        break;

                        case 6: 
                        $day = "06";
                        break;

                        case 7: 
                        $day = "07";
                        break;

                        case 8: 
                        $day = "08";
                        break;

                        case 9: 
                        $day = "09";
                        break;

                        case $i: 
                        $day = $i;
                        break;

                    }
                    $date = $year->name."-".$month."-".$day;
                    $sql = "SELECT number from allotment where date= '$date' and rate_set_up_id= $rate_setup_id and tour_item_id = $item_id ";
                    $number = Yii::$app->db->createCommand($sql)->queryScalar();
                    $get_number = empty($number) ? "0" : $number;
                    $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                    echo "<td class= '<?= $day ;?>'>".$get_number."</td>"; 
                }
             ?>
            </tr>
        </tbody>
    </table>
</div>
    </div>
</div>

<?php
$this->registerJs('
    var base_url = "$base_url";
    var total_day = "$total_days";
    var controller_id = "allotment";

        $("#select_page_size").change(function(){
            var page_size = $("#select_page_size").val();
            var url = window.location.pathname;
                window.location.replace(url+"?r="+controller_id+"/index&page_size="+page_size);
        });

        $(document).on("click","#modalButton",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })

        });

        $(document).on("click","#modalButtonView",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });
        

        $(document).on("click","#modalButtonUpdate",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

        $("#allotmentsearch-year").change(function(){
                var year = $(this).val();
                var month = $("#allotmentsearch-month").val();
            });

        $(document).ready(function(){
            var year = $("#allotmentsearch-year option:selected").text();
            var month = $("#allotmentsearch-month").val();
            $("#allotment-to_date").datepicker("setDate", new Date(year, month-1, 1));

            // get month and total day
            var getDaysInMonth = function(month,year) {
             return new Date(year, month, 0).getDate();
            };
            var number_day = getDaysInMonth(month, year);

            // start and end month only

            $("#allotment-from_date").datepicker("setDate", new Date(year, month-1, 1));
            $("#allotment-from_date").datepicker("setEndDate", new Date(year, month-1, number_day));
            $("#allotment-to_date").datepicker("setEndDate", new Date(year, month-1, number_day));
        });
        $("#allotment-from_date").change(function(){
            var month = $("#allotmentsearch-month").val();
            $("#allotment-to_date").datepicker("setStartDate", $(this).val());
            var year = $("#allotmentsearch-year option:selected").text();
            $("#allotment-from_date").datepicker("setStartDate", new Date(year, month-1, 1));
            if(Date.parse($(this).val()) > Date.parse($("allotment-to_date").val())){
                $("#allotment-to_date").datepicker("setDate", $(this).val());
            }

        });
    $("#allotment-from_date, #allotment-to_date").datepicker({
        format: "yyyy-mm-dd",
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });

    $("#allotment-starting_time").datetimepicker({
        timepicker: true,
        datepicker: false,
        format: "H:i",
        hours24: false,
    });

    ')
;

?>
<script>
function myFunction() {
  var elmnt = document.getElementById("myDIV");
  var x = elmnt.scrollLeft;
  var y = elmnt.scrollTop;
}
</script>

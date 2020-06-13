<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\RateRange;
use yii\widgets\ActiveForm;
use backend\models\RatePlan;
use backend\models\MonthList;
use backend\models\RatePlanSetupRange;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\RatePlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->registerJsFile(
    '@web/plugins/ckeditor/ckeditor.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$base_url = Yii::getAlias('@web');
$base_color = "#2b3d51";

$validationUrl = ['rate-plan/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}
$date_template = '{label}</br><div class="input-group">
            <span style="width: 50px;line-height: 0rem;padding: 9px;" class="input-group-addon"><i class="fa fa-calendar"></i></span> {input} </div>{error}{hint}';
$this->title = 'Rate Plans';
$this->params['breadcrumbs'][] = $this->title;

 $monthly_active = "";
 $yearly_active = "active";
?>


<style>
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
    td {
    padding: 7px;
}
    td, th { 
    border: solid #0000000f 1px;
    text-align: center;
}
#myDIV {
  height: auto;
  width: 100%;
  overflow: auto;
}
button.btn.btn-success.save-btn {
    margin-top: 0px;
    background-color: red;
}
input#rateplan-from_date {
    border: 1px solid #80808040;
    width: 100%
}
input#rateplan-to_date {
    border: 1px solid #80808040;
    width: 100%;
}
</style>
<head>
<link rel="stylesheet" type="text/css" href="rate_style.css">
</head>
<!-- <?php

$date = new DateTime('2020-05-01');
$thisMonth = $date->format('m');
while ($date->format('m') === $thisMonth) {
    $get_day = $date->format('d'). "\n";
     echo $get_day;
        $date->modify('next Sunday');    
}
 ?> -->
<div class="rate-plan-index">
<h5><?= Html::encode($this->title) ?></h5>
    <ul class="nav nav-tabs">
        <li class= "<?= $monthly_active ;?>"><a data-toggle="tab" href="#month">Monthly Rate Plan Update</a></li>
        <li class= "<?= $yearly_active ;?>"><a data-toggle="tab" href="#year">Yearly Rate Plan Update</a></li>
    </ul>   
        <!-- content -->
        <!-- month section -->
    <div class="tab-content">
        <div id="month" class="tab-pane fade in <?= $monthly_active ;?>"> <br>
             <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php
                if ($searchModel->year && $searchModel->month && $searchModel->rate_set_up_id) {
                $year =  \backend\models\YearList::find()->where(['id'=>$searchModel->year])->one();
                $year_name =  \backend\models\YearList::find()->where(['id'=>$searchModel->year])->one()->name;
                $month =  \backend\models\MonthList::find()->where(['id'=>$searchModel->month])->one()->value;
                $item =  \backend\models\RatePlanSetUp::find()->where(['id'=>$searchModel->rate_set_up_id])->one();
                $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year->name);
                $rate_range = RatePlanSetupRange::find()
                    ->orderBy(['range_from'=>SORT_ASC])
                    ->where(['tour_rate_setup_id'=>$searchModel->rate_set_up_id])->all();

                $hidden = "";
            }else{
                return $this->render('_search', ['model' => $searchModel]);
                $total_days = 0;
                $item = "";
                $hidden = "hidden";
            }
            ?>
            <div class="rate-plan-form">
                    <?php $form = ActiveForm::begin([
                        'id' => $model->formName(),
                        'enableAjaxValidation' => false,
                        'action' => ['rate-plan/create', 'id'=>$item->id, 'month'=>$month, 'year'=>$year->id],
                        'enableClientValidation' => true,
                        'options' => ['enctype' => 'multipart/form-data'],
                        'validationUrl' => $validationUrl
                    ]); ?>

                   <div class="row">
                        <div class="col-md-12">
                            <br>
                            <div class="col-md-3"></div>
                            <div class="col-md-3">
                                <?php
                                    $rate_setup_range_id = ArrayHelper::map(\backend\models\RatePlanSetupRange::find()
                                    ->where(['tour_rate_setup_id' => $searchModel->rate_set_up_id])
                                    ->all(), 'id', function($model){return $model->range_from." - ".$model->range_to;});
                                ?>
                                <?= $form->field($model, 'rate_range_id')->widget(Select2::classname(), [
                                        'data' => $rate_setup_range_id,
                                        'theme' => Select2::THEME_DEFAULT,
                                        'language' => 'eg',
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                ?> 
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
                            </div>
                            <div class="col-md-3">
                                <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;']) ?>
                            </div>
                        </div>

                        <!-- Rate Detail section -->
                        
                        <div class="col-md-12">
                            <div class="panel panel-bordered panel-dark">
                                <div class="panel-heading" style="color: white; background-color: <?= $base_color ;?>; border-color: <?= $base_color ;?>;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <p>Cost Adult</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>Cost Child</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>M-Up Adult</p>
                                            </div>
                                            <div class="col-md-2">
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
                                     <div class="row row_line" step="0.01" data-id= 1 id= "row_line_1" style="margin: 10px;">
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="cost_adult[]" min="0" class="form-control input_monthly to" data-id=1
                                                id="cost_adult_1" required/>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="cost_child[]" min="0" class="form-control input_monthly cost_child" data-id=1
                                                id="cost_child_1" required/>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="mark_up_adult[]" value="0" min="0" class="form-control input_monthly mark_up_adult" data-id=1
                                                id="mark_up_adult_1" required/>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="mark_up_child[]" value="0" min="0" class="form-control input_monthly to" data-id=1
                                                id="mark_up_child_1" required/>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control input_monthly mark_up_type" name="mark_up_type[]" data-id=1
                                                id="mark_up_type_1">
                                                <option value="1">amount</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" step="0.01" name="price_adult[]" min="0" class="form-control input_monthly price_adult" data-id=1
                                                id="price_adult_1" required/>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" step="0.01" name="price_child[]" min="0" class="form-control input_monthly price_child" data-id=1
                                                id="price_child_1" required/>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <!-- ===== end first add item====== -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" style="margin: 10px;">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success save-btn']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
            </div>
            <div class="panel <?=$hidden;?>"> 
                <div class="panel-body">

                    <div class="data-table" id="myDIV">
                        <br>
                        <table style="font-size: 12px;">
                            <thead>
                                <tr>
                                    <!-- Rate Days -->
                                    <th>Days</th>
                                <?php 
                                    for ($i=1; $i <= $total_days ; $i++) { 
                                        $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                                       echo "<th class= '<?= $day ;?>' colspan= 2>".$i."<br>".$day."</th>";
                                    }
                                ?>
                                </tr>
                                <tr>
                                    <!-- month section -->
                                    <td>Range</td>
                                    <?php 
                                        for ($i=1; $i <= $total_days ; $i++) { 
                                            $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                                           echo "<td class= '<?= $day ;?>'>Adult</td>";
                                           echo "<td class= '<?= $day ;?>'>Child</td>";
                                        }
                                     ?>
                                </tr>
                                <?php
                                    foreach ($rate_range as $row) 
                                    {
                                        ?>
                                            <tr>
                                                <td><?= $row->range_from."-".$row->range_to ;?></td>
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
                                                            $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                                                            $month_id = \backend\models\MonthList::find()->where(['value'=>$month])->one()->id;
                                                            $range_id = RateRange::find()->where(['rate_setup_range_id'=>$row->id, 'month'=>$month_id, 'year'=>$year])->one();
                                                            if (!empty($range_id)) {
                                                                $range_row_id = $range_id->id;
                                                                $price = "SELECT price_adult from rate_plan where date= '$date' and rate_range_id = $range_row_id";
                                                                $adult = Yii::$app->db->createCommand($price)->queryScalar();
                                                                $price_adult = empty($adult) ? "0" : $adult;

                                                                $price_child = "SELECT price_child from rate_plan where date= '$date' and rate_range_id = $range_row_id";
                                                                $child = Yii::$app->db->createCommand($price_child)->queryScalar();
                                                                $price_child = empty($child) ? "0" : $child;


                                                                echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                                echo "<td class= '<?= $day ;?>'>".$price_child."</td>";

                                                            }else{
                                                                $price_adult = "0";
                                                                $price_child = "0";


                                                                echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                                echo "<td class= '<?= $day ;?>'>".$price_child."</td>";

                                                            }
                                                            
                                                        }
                                                     ?>
                                            </tr>
                                        <?php
                                    }
                                    
                                 ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- end form -->
                    <div class="row">
                        <div class="col-md-12 <?= !empty($rate_range) ? "" : "hidden";?>">
                            <div class="pull-right">
                                <br>
                                <?= Html::a('Update <i class="fa fa-plus-square go-right"></i>', ['rate-plan/create','id'=>$item->id, 'month'=>$month, 'year'=>$year->id], ['class' => 'btn btn-danger']) ?>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Row Data -->
                </div>
            </div>
        </div>
<!-- ========================================================================================================================================================================================================================================================================================================================================================================================= -->
        <!-- year section -->
        <div id="year" class="tab-pane fade in <?= $yearly_active ;?>">
            <?php $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => false,
                'action' => ['rate-plan/yearly-create', 'id'=>$item->id, 'month'=>$month, 'year'=>$year->id],
                'enableClientValidation' => true,
                'options' => ['enctype' => 'multipart/form-data'],
                'validationUrl' => $validationUrl
            ]); ?>

           <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="col-sm-3">
                        <?php
                        $rate_plan_arr = ArrayHelper::map(\backend\models\RatePlanSetUp::find()
                        ->where(['id' => $searchModel->rate_set_up_id])
                        ->all(), 'id', function($model){return $model->name;});
                    ?>
                        <?= $form->field($model, 'rate_set_up_id')->widget(Select2::classname(), [
                                'data' => $rate_plan_arr,
                                'theme' => Select2::THEME_DEFAULT,
                                'language' => 'eg',
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'disabled' => true
                                ],
                            ]);
                        ?> 
                    </div>
                    <div class="col-md-3">
                                <?php
                                    $rate_setup_range_id = ArrayHelper::map(\backend\models\RatePlanSetupRange::find()
                                    ->where(['tour_rate_setup_id' => $searchModel->rate_set_up_id])
                                    ->all(), 'id', function($model){return $model->range_from." - ".$model->range_to;});
                                ?>
                                 <?= $form->field($model, 'yearly_rate_range_id')->widget(Select2::classname(), [
                                        'data' => $rate_setup_range_id,
                                        'theme' => Select2::THEME_DEFAULT,
                                        'language' => 'eg',
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                ?> 
                            </div>
                    
                    <div class="col-md-3">
                        <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;', 'class'=>'yearly_from_date']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true, 'style'=>'background: #fff !important;', 'class'=>'yearly_to_date']) ?>
                    </div>
                </div>
                <!-- panel panel-bordered panel-dark -->

                <!-- Rate Detail section -->
                <div class="row">
                        <!-- Rate Detail section -->
                        <div class="col-md-12">
                            <div class="days" style="margin: 15px;">
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Mon', 'uncheck' => 0]) ?>
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Tue', 'uncheck' => 0]) ?>
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Wed', 'uncheck' => 0]) ?>
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Thur', 'uncheck' => 0]) ?>
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Fri', 'uncheck' => 0]) ?>
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Sat', 'uncheck' => 0]) ?>
                                <?= Html::checkbox('rate_set_up_id', false, ['label' => 'Sun', 'uncheck' => 0]) ?>
                            </div>

                            <div class="panel panel-bordered panel-dark" style="margin: 20px;">
                                <div class="panel-heading" style="color: white; background-color: <?= $base_color ;?>; border-color: <?= $base_color ;?>;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-2">
                                                <p>Cost Adult</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>Cost Child</p>
                                            </div>
                                            <div class="col-md-2">
                                                <p>M-Up Adult</p>
                                            </div>
                                            <div class="col-md-2">
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
                                     <div class="row row_line" data-id= 1 id= "row_line_1" style="margin: 10px;">
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="cost_adult[]" min="0" class="form-control input_number to" data-id=1
                                                id="cost_adult" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="cost_child[]" min="0" class="form-control input_number cost_child" data-id=1
                                                id="cost_child" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="mark_up_adult[]" value="0" min="0" class="form-control input_number mark_up_adult" data-id=1
                                                id="mark_up_adult" required>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" step="0.01" name="mark_up_child[]" value="0" min="0" class="form-control input_number to" data-id=1
                                                id="mark_up_child" required>
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control input_number mark_up_type" name="mark_up_type[]" data-id=1
                                                id="mark_up_type">
                                                <option value="1">amount</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" step="0.01" name="price_adult[]" min="0" class="form-control input_number price_adult" data-id=1
                                                id="price_adult" required>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="number" step="0.01" name="price_child[]" min="0" class="form-control input_number price_child" data-id=1
                                                id="price_child" required>
                                        </div>
                                        <div class="col-md-1"></div>
                                    </div>
                                    <!-- ===== end first add item====== -->
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="form-group" style="margin: 10px;">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success save-btn']) ?>
            </div>
            <?php ActiveForm::end(); ?>
            <div class="panel <?=$hidden;?>"> 
                <div class="panel-body">

                    <div class="data-table" id="myDIV">
                        <br>
                        <table style="font-size: 12px;">
                            <?php
                                $MonthList = MonthList::find()->all();
                                
                                foreach ($MonthList as $month_name) {
                                $number_of_days = cal_days_in_month(CAL_GREGORIAN, $month_name->id, $year->name);
                             ?>
                            <thead style="border-top: 5px solid #11486d;">
                                <tr>
                                    <th><?= $month_name->name ;?>-<?= $year->name;?></th>
                                <?php 
                                    for ($i=1; $i <= $number_of_days ; $i++) { 
                                        $day = substr(date( 'l', strtotime( $month_name->id . '/' . $i ) ), 0, 3);
                                       echo "<th class= '<?= $day ;?>' colspan= 2>".$i."<br>".$day."</th>";
                                    }
                                ?>
                                </tr>
                                <tr>
                                    <td>Range</td>
                                    <?php 
                                        for ($i=1; $i <= $number_of_days ; $i++) { 
                                            $day = substr(date( 'l', strtotime( $month_name->id . '/' . $i ) ), 0, 3);
                                           echo "<td class= '<?= $day ;?>'>Adult</td>";
                                           echo "<td class= '<?= $day ;?>'>Child</td>";
                                        }
                                     ?>
                                </tr>
                                <?php
                                    foreach ($rate_range as $row) 
                                    {
                                        ?>
                                            <tr>
                                                <td><?= $row->range_from."-".$row->range_to ;?></td>
                                                <?php 
                                                    for ($i = 1; $i <= $number_of_days; $i++) 
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
                                                            $date = $year->name."-".$month_name->id."-".$day;
                                                            $day = substr(date( 'l', strtotime( $month_name->id . '/' . $i ) ), 0, 3);
                                                            $month_id = \backend\models\MonthList::find()->where(['value'=>$month])->one()->id;
                                                            $range_id = RateRange::find()->where(['rate_setup_range_id'=>$row->id, 'month'=>$month_name->id, 'year'=>$year])->one();
                                                            if (!empty($range_id)) {
                                                                $range_row_id = $range_id->id;
                                                                $price = "SELECT price_adult from rate_plan where date= '$date' and rate_range_id = $range_row_id";
                                                                $adult = Yii::$app->db->createCommand($price)->queryScalar();
                                                                $price_adult = empty($adult) ? "0" : $adult;

                                                                $price_child = "SELECT price_child from rate_plan where date= '$date' and rate_range_id = $range_row_id";
                                                                $child = Yii::$app->db->createCommand($price_child)->queryScalar();
                                                                $price_child = empty($child) ? "0" : $child;


                                                                echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                                echo "<td class= '<?= $day ;?>'>".$price_child."</td>";

                                                            }else{
                                                                $price_adult = "0";
                                                                $price_child = "0";


                                                                echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                                echo "<td class= '<?= $day ;?>'>".$price_child."</td>";

                                                            }
                                                            
                                                        }
                                                     ?>
                                            </tr>
                                        <?php
                                    }
                                    
                                 ?>
                            </tbody>
                            <?php 
                                } // end loop month name
                             ?>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- end create year rate plan section -->
    </div>
</div>

<?php
 
$this->registerJs('
var controller_id = "rate-plan";
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


    ');

?>

<!-- form -->

<?php

$script = <<< JS
    
      var base_url = "$base_url";
        var number_day = "$total_days";
        var controller_id = "allotment";
        var year = "$year_name";
        var month = "$month";
        var base_color = "$base_color";
        $("#rateplan-from_date, #rateplan-to_date").datepicker({
            format: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
            autoclose: true,
        });

        // ===start From Date to Date====
        $("#rateplan-from_date").change(function(){
            $("#rateplan-to_date").datepicker("setStartDate", $(this).val());
        });
        // ===end From Date to Date====

        // ===start calculate mark-up type====
        function calculateNumber(){
            var sum = 0;
            $(".calculate_item .row_line").change(function(){
                var cost_adult = $("#cost_adult_1").val();
                var cost_child = $("#cost_child_1").val();
                var from = $("#from_1").val();
                var to = $("#to_1").val();



                var mark_up_adult = $("#mark_up_adult_1").val();
                var mark_up_child = $("#mark_up_child_1").val();
                var mark_up_type = $("#mark_up_type_1").val();

                if(parseInt(mark_up_type) == 1){
                    var price_adult = parseFloat(cost_adult) +parseFloat(mark_up_adult);
                    $("#price_adult_1").val(price_adult);

                    var price_child = parseFloat(cost_child) +parseFloat(mark_up_child);
                    $("#price_child_1").val(price_child);
                }else{
                    var price_adult = parseFloat(cost_adult)+(parseFloat(cost_adult)*parseFloat(mark_up_adult)/100);
            var price_child = parseFloat(cost_child)+(parseFloat(cost_child)*parseFloat(mark_up_child)/100);
                    $("#price_adult_1").val(price_adult);
                    $("#price_child_1").val(price_child);

                }
            });

        }

        // ===end calculate mark-up type====


        // ===start calculate price adult and child====
        $(".calculate_item :input[type=number], .input_montyly").keyup(function(){
            calculateNumber();
        });
        $("#mark_up_type_1").keyup(function(){
            calculateNumber();
        });
            
        // ===end calculate price adult and child====

        // ===start Display only a month====

        $(document).ready(function(){
            $("#rateplan-to_date").datepicker("setDate", new Date(year, month-1, number_day));

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
        // ===Date yearly====

        // $(document).ready(function(){
        //     $(".yearly_from_date").datepicker("setDate", new Date(year, 0, 01));
        //     $(".yearly_from_date").datepicker("setStartDate", new Date(year, 0, 01));
        //     $(".yearly_to_date").datepicker("setDate", new Date(year, 11, number_day));

        // });
        // $(".yearly_from_date").change(function(){
        //     var get_year = new Date($(this).val())
        //     var year_name = (get_year.getFullYear());
        //     $(".yearly_to_date").datepicker("setDate", new Date(year_name, 11, 31));
        //     $(".yearly_to_date").datepicker("setStartDate", new Date(year_name, 11, 31));
        // });

        $(document).ready(function(){
            $(".yearly_to_date").datepicker("setDate", new Date(year, month-1, number_day));

            // start and end month only

            $(".yearly_from_date").datepicker("setDate", new Date(year, month-1, 1));
            $(".yearly_from_date").datepicker("setEndDate", new Date(year, month-1, number_day));
            $(".yearly_to_date").datepicker("setStartDate", new Date(year, 01, 01));
            $(".yearly_to_date").datepicker("setDate", new Date(year, 11, 31));
            $(".yearly_to_date").datepicker("setEndDate", new Date(year, 11, 31));
        });
        $(".yearly_from_date").change(function(){
            $(".yearly_to_date").datepicker("setStartDate", $(this).val());
            $(".yearly_from_date").datepicker("setStartDate", new Date(year, month-1, 1));
            if(Date.parse($(this).val()) > Date.parse($("allotment-to_date").val())){
                $(".yearly_to_date").datepicker("setDate", $(this).val());
            }

        });


    $(".calculate_item :input[type=number], .input_number").change(function() {
        var cost_adult = $("#cost_adult").val();
        var cost_child = $("#cost_child").val();
        var mark_up_adult = $("#mark_up_adult").val();
        var mark_up_child = $("#mark_up_child").val();
        var mark_up_type = $("#mark_up_type").val();

        if(parseInt(mark_up_type) == 1){
            var price_adult = parseFloat(cost_adult) +parseFloat(mark_up_adult);
            $("#price_adult").val(price_adult);

            var price_child = parseFloat(cost_child) +parseFloat(mark_up_child);
            $("#price_child").val(price_child);
        }else{
            var price_adult = parseFloat(cost_adult)+(parseFloat(cost_adult)*parseFloat(mark_up_adult)/100);
            var price_child = parseFloat(cost_child)+(parseFloat(cost_child)*parseFloat(mark_up_child)/100);
            $("#price_adult").val(price_adult);
            $("#price_child").val(price_child);

        }
    });

JS;
$this->registerJS($script);
?>


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
    border: solid black 1px;
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
</style>
<head>
<link rel="stylesheet" type="text/css" href="rate_style.css">
</head>
<div class="rate-plan-index">
<h5><?= Html::encode($this->title) ?></h5>
    <ul class="nav nav-tabs">
        <li class= "active"><a data-toggle="tab" href="#month">Monthly Rate Plan Update</a></li>
        <li><a data-toggle="tab" href="#year">Yearly Rate Plan Update</a></li>
    </ul>   
        <!-- content -->
    <div class="tab-content">
        <div id="month" class="tab-pane fade in active"> <br>
             <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php
                if ($searchModel->year && $searchModel->month && $searchModel->rate_set_up_id) {
                $year =  \backend\models\YearList::find()->where(['id'=>$searchModel->year])->one();
                $year_name =  \backend\models\YearList::find()->where(['id'=>$searchModel->year])->one()->name;
                $month =  \backend\models\MonthList::find()->where(['id'=>$searchModel->month])->one()->value;
                $item =  \backend\models\RatePlanSetUp::find()->where(['id'=>$searchModel->rate_set_up_id])->one();
                $total_days = cal_days_in_month(CAL_GREGORIAN, $month, $year->name);
                $rate_range = RateRange::find()->where(['month'=>$month, 'year'=>$year->id, 'rate_set_up_id'=>$item->id])->all();

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
                                    <?php 
                                        if ($model->isNewRecord) {
                                     ?>
                                     <div class="row row_line" data-id= 1 id= "row_line_1" style="margin: 10px;">
                                        <div class="col-md-2">
                                            <input type="number" name="cost_adult[]" min="0" class="form-control to" data-id=1
                                                id="cost_adult_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="cost_child[]" min="0" class="form-control cost_child" data-id=1
                                                id="cost_child_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="mark_up_adult[]" min="0" class="form-control mark_up_adult" data-id=1
                                                id="mark_up_adult_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="mark_up_child[]" min="0" class="form-control to" data-id=1
                                                id="mark_up_child_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control mark_up_type" name="mark_up_type[]" data-id=1
                                                id="mark_up_type_1">
                                                <option value="1">amount</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="float" name="price_adult[]" min="0" class="form-control price_adult" data-id=1
                                                id="price_adult_1" />
                                        </div>
                                        <div class="col-md-1">
                                            <input type="float" name="price_child[]" min="0" class="form-control price_child" data-id=1
                                                id="price_child_1" />
                                        </div>
                                        <div class="col-md-1"></div>
                                        <!-- <div class="col-md-1">
                                            <i id=  "btn-add-rate" style="color: <?=$base_color; ?>; font-size: 40px; cursor: pointer;" class="ion-plus-circled add_more"></i>
                                        </div> -->
                                    </div>
                                    <?php
                                        }else{
                                            $data_i = 0;
                                            foreach ($model_rate_detail as $key => $value) {
                                                $data_i++
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
                                                <div class="col-md-1">
                                                    <input type="number" name="cost_adult[]" min="0" value= "<?= $value->cost_adult ;?>" class="form-control to" data-id="<?= $data_i ;?>"
                                                        id="cost_adult_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="number" name="cost_child[]" min="0" value= "<?= $value->cost_child ;?>" class="form-control cost_child" data-id="<?= $data_i ;?>"
                                                        id="cost_child_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="number" name="mark_up_adult[]" min="0" value= "<?= $value->mark_up_adult ;?>" class="form-control mark_up_adult" data-id="<?= $data_i ;?>"
                                                        id="mark_up_adult_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="number" name="mark_up_child[]" min="0" value= "<?= $value->mark_up_child ;?>" class="form-control to" data-id="<?= $data_i ;?>"
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
                                                    <input type="float" name="price_adult[]" min="0" value= "<?= $value->price_adult ;?>" class="form-control price_adult" data-id="<?= $data_i ;?>"
                                                        id="price_adult_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="float" name="price_child[]" min="0" value= "<?= $value->price_child ;?>" class="form-control price_child" data-id="<?= $data_i ;?>"
                                                        id="price_child_1" />
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1">
                                                    <i id=  "btn-add-rate" style="color: <?= $data_i == 1 ? $base_color : "red" ;?>; font-size: 40px; cursor: pointer;" class="<?= $data_i == 1 ? "ion-plus-circled add_more" : "ion-minus-circled btn_remove" ;?>"></i>
                                                </div>
                                            </div>

                                           <?php
                                            }
                                        }
                                     ?>
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

                    <div class="data-table" id="myDIV" onscroll="myFunction()">
                        <br>
                        <table>
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
                                                <td><?= $row->from_person."-".$row->to_people ;?></td>
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

                                                            $price = "SELECT price_adult from rate_plan where date= '$date' and rate_range_id = $row->id";
                                                            $adult = Yii::$app->db->createCommand($price)->queryScalar();
                                                            $price_adult = empty($adult) ? "0" : $adult;

                                                            $price_child = "SELECT price_child from rate_plan where date= '$date' and rate_range_id = $row->id";


                                                            $child = Yii::$app->db->createCommand($price_child)->queryScalar();
                                                            $price_child = empty($child) ? "0" : $child;

                                                            echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                            echo "<td class= '<?= $day ;?>'>".$price_child."</td>";
                                                            
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
        <!-- year section -->
        <div id="year" class="tab-pane fade in">
            <?php $form = ActiveForm::begin([
                'id' => $model->formName(),
                'enableAjaxValidation' => false,
                'action' => ['rate-plan/create-yearly-rate', 'id'=>$item->id, 'month'=>$month, 'year'=>$year->id],
                'enableClientValidation' => true,
                'options' => ['enctype' => 'multipart/form-data'],
                'validationUrl' => $validationUrl
            ]); ?>

           <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="col-md-3">
                        <?php
                                $rate_set_up = ArrayHelper::map(\backend\models\RatePlanSetup::find()
                                ->where(['status' => 1])
                                ->all(), 'id', function($model){
                                    $rate_setup_name = \backend\models\TourItem::find()->where(['id'=>$model->tour_item_id])->one()->name;
                                    return $rate_setup_name." ( ".$model->name." ) ";
                                });
                            ?>
                            <?= $form->field($model, 'rate_set_up_id')->widget(Select2::classname(), [
                                    'data' => $rate_set_up,
                                    'theme' => Select2::THEME_DEFAULT,
                                    'language' => 'eg',
                                    'pluginOptions' => [
                                        'allowClear' => true
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
                <br>
                    <div class="col-md-6" style="margin: 10px;">
                        <input class= "day-name" type="radio" name= "mon" checked> Mon 
                        <input class= "day-name" type="radio" name= "tue" checked> Tue 
                        <input class= "day-name" type="radio" name= "wed" checked> Wed 
                        <input class= "day-name" type="radio" name= "thu" checked> Thu 
                        <input class= "day-name" type="radio" name= "fri" checked> Fri 
                        <input class= "day-name" type="radio" name= "sat"> Sat 
                        <input class= "day-name" type="radio" name= "sun"> Sun 
                    </div>

                <!-- Rate Detail section -->
                <div class="row">
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
                                    <?php 
                                        if ($model->isNewRecord) {
                                     ?>
                                     <div class="row row_line" data-id= 1 id= "row_line_1" style="margin: 10px;">
                                        <div class="col-md-2">
                                            <input type="number" name="cost_adult[]" min="0" class="form-control to" data-id=1
                                                id="cost_adult_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="cost_child[]" min="0" class="form-control cost_child" data-id=1
                                                id="cost_child_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="mark_up_adult[]" min="0" class="form-control mark_up_adult" data-id=1
                                                id="mark_up_adult_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" name="mark_up_child[]" min="0" class="form-control to" data-id=1
                                                id="mark_up_child_1" />
                                        </div>
                                        <div class="col-md-2">
                                            <select class="form-control mark_up_type" name="mark_up_type[]" data-id=1
                                                id="mark_up_type_1">
                                                <option value="1">amount</option>
                                                <option value="2">%</option>
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <input type="float" name="price_adult[]" min="0" class="form-control price_adult" data-id=1
                                                id="price_adult_1" />
                                        </div>
                                        <div class="col-md-1">
                                            <input type="float" name="price_child[]" min="0" class="form-control price_child" data-id=1
                                                id="price_child_1" />
                                        </div>
                                        <div class="col-md-1"></div>
                                        <!-- <div class="col-md-1">
                                            <i id=  "btn-add-rate" style="color: <?=$base_color; ?>; font-size: 40px; cursor: pointer;" class="ion-plus-circled add_more"></i>
                                        </div> -->
                                    </div>
                                    <?php
                                        }else{
                                            $data_i = 0;
                                            foreach ($model_rate_detail as $key => $value) {
                                                $data_i++
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
                                                <div class="col-md-1">
                                                    <input type="number" name="cost_adult[]" min="0" value= "<?= $value->cost_adult ;?>" class="form-control to" data-id="<?= $data_i ;?>"
                                                        id="cost_adult_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="number" name="cost_child[]" min="0" value= "<?= $value->cost_child ;?>" class="form-control cost_child" data-id="<?= $data_i ;?>"
                                                        id="cost_child_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="number" name="mark_up_adult[]" min="0" value= "<?= $value->mark_up_adult ;?>" class="form-control mark_up_adult" data-id="<?= $data_i ;?>"
                                                        id="mark_up_adult_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="number" name="mark_up_child[]" min="0" value= "<?= $value->mark_up_child ;?>" class="form-control to" data-id="<?= $data_i ;?>"
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
                                                    <input type="float" name="price_adult[]" min="0" value= "<?= $value->price_adult ;?>" class="form-control price_adult" data-id="<?= $data_i ;?>"
                                                        id="price_adult_1" />
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="float" name="price_child[]" min="0" value= "<?= $value->price_child ;?>" class="form-control price_child" data-id="<?= $data_i ;?>"
                                                        id="price_child_1" />
                                                </div>
                                                <div class="col-md-1"></div>
                                                <div class="col-md-1">
                                                    <i id=  "btn-add-rate" style="color: <?= $data_i == 1 ? $base_color : "red" ;?>; font-size: 40px; cursor: pointer;" class="<?= $data_i == 1 ? "ion-plus-circled add_more" : "ion-minus-circled btn_remove" ;?>"></i>
                                                </div>
                                            </div>

                                           <?php
                                            }
                                        }
                                     ?>
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

                    <div class="data-table" id="myDIV" onscroll="myFunction()">
                        <br>
                        <table>
                            <thead>
                                <tr>
                                    <th>Jun-2020</th>
                                <?php 
                                    for ($i=1; $i <= $total_days ; $i++) { 
                                        $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                                       echo "<th class= '<?= $day ;?>' colspan= 2>".$i."<br>".$day."</th>";
                                    }
                                ?>
                                </tr>
                                <tr>
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
                                                <td><?= $row->from_person."-".$row->to_people ;?></td>
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

                                                            $price = "SELECT price_adult from rate_plan where date= '$date' and rate_range_id = $row->id";
                                                            $adult = Yii::$app->db->createCommand($price)->queryScalar();
                                                            $price_adult = empty($adult) ? "0" : $adult;

                                                            $price_child = "SELECT price_child from rate_plan where date= '$date' and rate_range_id = $row->id";


                                                            $child = Yii::$app->db->createCommand($price_child)->queryScalar();
                                                            $price_child = empty($child) ? "0" : $child;

                                                            echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                            echo "<td class= '<?= $day ;?>'>".$price_child."</td>";
                                                            
                                                        }
                                                     ?>
                                            </tr>
                                        <?php
                                    }
                                    
                                 ?>
                            </tbody>
                            <thead>
                                <tr>
                                    <th>July-2020</th>
                                <?php 
                                    for ($i=1; $i <= $total_days ; $i++) { 
                                        $day = substr(date( 'l', strtotime( $month . '/' . $i ) ), 0, 3);
                                       echo "<th class= '<?= $day ;?>' colspan= 2>".$i."<br>".$day."</th>";
                                    }
                                ?>
                                </tr>
                                <tr>
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
                                                <td><?= $row->from_person."-".$row->to_people ;?></td>
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

                                                            $price = "SELECT price_adult from rate_plan where date= '$date' and rate_range_id = $row->id";
                                                            $adult = Yii::$app->db->createCommand($price)->queryScalar();
                                                            $price_adult = empty($adult) ? "0" : $adult;

                                                            $price_child = "SELECT price_child from rate_plan where date= '$date' and rate_range_id = $row->id";


                                                            $child = Yii::$app->db->createCommand($price_child)->queryScalar();
                                                            $price_child = empty($child) ? "0" : $child;

                                                            echo "<td class= '<?= $day ;?>'>".$price_adult."</td>";
                                                            echo "<td class= '<?= $day ;?>'>".$price_child."</td>";
                                                            
                                                        }
                                                     ?>
                                            </tr>
                                        <?php
                                    }
                                    
                                 ?>
                            </tbody>
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
        $("#rateplan-, #rateplan-to_date").datepicker({
            format: "yyyy-mm-dd",
            changeMonth: true,
            changeYear: true,
            autoclose: true,
        });
// ===start append calculate item===
        var data_i = $(document).find('.amount[data-id]:last').attr('data-id');
        var i = 1;

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
            range_number();
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

        function range_number()
        {
            var from_1 = $("#from_1").val();
            var from_2 = $("#from_2").val();
            var from_3 = $("#from_3").val();
            var to_1 = $("#to_1").val();
            var to_2 = $("#to_2").val();
            var to_3 = $("#to_3").val();
                if(from_2 <= to_1){
                    alert("Value can not rather than "+to_1);
                    $("#from_2").val(parseInt(to_1)+1);
                }else if(to_2 <= from_2){
                    alert("Value can not rather than "+from_2);
                    $("#to_2").val(parseInt(from_2)+1);
                }

                else if(from_3 <= to_2){
                    alert("Value can not rather than "+to_2);
                    $("#from_3").val(parseInt(to_2)+1);
                }else if(to_3 <= from_3){
                    alert("Value can not rather than "+from_3);
                    $("#to_3").val(parseInt(from_3)+1);
                }
        }
        


JS;
$this->registerJS($script);
?>


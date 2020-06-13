<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RatePlanSearch */
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

<div class="rate-plan-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-2">
                    <?= $form->field($model, 'date', ['template'=>$date_template])->textInput(['readonly' => true, 'class'=>'date_picker form-control DateFrom', 'placeholder' => 'From'])->label(false);?>
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
<style>
.search-bd{
    background: whitesmoke;
    height: 100px; 
    padding: 15px;  
}
.btn-primary {
    color: #fff;
    background-color: #3f5773;
    border-color: #3f5773; 
    margin-top: 30px;
}
</style>
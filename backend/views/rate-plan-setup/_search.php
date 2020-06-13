<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\TourItem;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlanSetupSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-plan-setup-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
   <div class="row">
        <div class= "col-sm-12">
            <div class="col-sm-3">
                <?=$form->field($model, 'name')->textInput(['placeholder' => 'Enter the city']);?>
            </div>
            <div class="col-sm-3">
                <?=$form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive'], ['prompt' => 'Select status']);?>
            </div>
            <div class="col-sm-3">
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
}
.btn-primary {
    color: #fff;
    background-color: #3f5773;
    border-color: #3f5773; 
    margin-top: 30px;
}
</style>
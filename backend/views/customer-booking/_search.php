<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model backend\models\CustomerBookingSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="customer-booking-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class= "col-sm-12">
            <div class="col-sm-3">
                <?php
                    $country_name = ArrayHelper::map(\backend\models\Country::find()
                    ->where(['company_id' => $_SESSION['company_id']])
                    ->all(), 'id', function($model){return $model->name;});
                ?>
                <?= $form->field($model, 'country_id')->widget(Select2::classname(), [
                        'data' => $country_name,
                        'theme' => Select2::THEME_DEFAULT,
                        'language' => 'eg',
                        'options' => ['placeholder' => 'Select country'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?> 
            </div>
            <div class="col-sm-3">
                <?=$form->field($model, 'name')->textInput(['placeholder' => 'Customer name']);?>
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
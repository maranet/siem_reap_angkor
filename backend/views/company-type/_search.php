<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyTypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-type-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="col-md-3">
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Enter name']) ?>
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
    <div class="col-md-3"></div>

 
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
    width: 30%;
    margin-top: 30px;
}
</style>
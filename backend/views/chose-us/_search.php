<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ChoseUsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chose-us-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
               <?= $form->field($model, 'name') ?> 
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'status')->dropDownList(['1' => 'Active', '0' => 'Inactive'],['prompt'=>'Select status']);?> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
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
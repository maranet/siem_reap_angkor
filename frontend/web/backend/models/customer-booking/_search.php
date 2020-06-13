<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'phone_number') ?>

    <?php // echo $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'country_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Reset',['index'], ['class' => 'btn btn-outline-secondary']) ?>
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
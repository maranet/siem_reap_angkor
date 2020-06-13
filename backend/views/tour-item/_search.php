<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\TourItemSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tour-item-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class= "col-sm-12">
            <div class="col-sm-3">
                <?=$form->field($model, 'name')->textInput(['placeholder' => 'Enter Item']);?>
            </div>
            <div class="col-md-3">
                <?php
                    $category_name = ArrayHelper::map(\backend\models\TourCategory::find()
                    ->where(['status'=>1, 'company_id' => $_SESSION['company_id']])
                    ->all(), 'id', function($model){return $model->name;});
                ?>
                <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' => $category_name,
                        'theme' => Select2::THEME_DEFAULT,
                        'options' => ['placeholder' => 'Select Category'],
                        'language' => 'eg',
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?> 
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
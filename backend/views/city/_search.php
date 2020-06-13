<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use backend\models\Country;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CitySearch */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="city-search">
    <div class="col-md-12 search-bd">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]);?>
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



    <?php ActiveForm::end();?>
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
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\CompanyStatus;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProfileSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="company-profile-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
    <div class="col-lg-12">
        <div class="col-sm-2">
            <?=$form->field($model, 'name')->textInput(['placeholder' => 'Enter the company']);?>
        </div>
        <div class="col-lg-2">
            <?php
            $city = ArrayHelper::map(\backend\models\City::find()
                ->where(['status' => 1])
                ->all(), 'id', function ($model) {return $model->name;});
                ?>
                <?=$form->field($model, 'city_id')->widget(Select2::classname(), [
                    'data' => $city,
                    'theme' => Select2::THEME_DEFAULT,
                    'language' => 'eg',
                    'options' => ['placeholder' => 'Select city'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
        </div>
        <div class="col-lg-2">
            <?php
            $company_type = ArrayHelper::map(\app\models\CompanyType::find()
                ->where(['status' => 1])
                ->all(), 'id', function ($model) {return $model->name;});
                ?>
                <?=$form->field($model, 'company_type')->widget(Select2::classname(), [
                    'data' => $company_type,
                    'theme' => Select2::THEME_DEFAULT,
                    'language' => 'eg',
                    'options' => ['placeholder' => 'Select Company Type'],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]);
                ?>
        </div>
        <div class= "col-sm-2">
            <?php
                $company_status = ArrayHelper::map(\backend\models\CompanyStatus::find()
                ->all(), 'id', function($model){return $model->name;});
            ?>
            <?= $form->field($model, 'company_status')->widget(Select2::classname(), [
                    'data' => $company_status,
                    'theme' => Select2::THEME_DEFAULT,
                    'language' => 'eg',
                    'options' => ['placeholder' => 'Select status'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?>
        </div>

        <div class="col-sm-2">
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
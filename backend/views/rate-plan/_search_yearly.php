<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\MonthList;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-plan-search">
    <div class="col-md-12 search-bd"> 

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-md-2">
            <?php
                    $month = ArrayHelper::map(\backend\models\MonthList::find()
                    ->all(), 'id', function($model){return $model->name;});
                ?>
                <?= $form->field($model, 'month')->widget(Select2::classname(), [
                        'data' => $month,
                        'theme' => Select2::THEME_DEFAULT,
                        'language' => 'eg',
                        'options' => ['placeholder' => 'Select month'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?> 
        </div>
        <div class="col-md-2">
            <?php
                    $year = ArrayHelper::map(\backend\models\YearList::find()
                    ->all(), 'id', function($model){return $model->name;});
                ?>
                <?= $form->field($model, 'year')->widget(Select2::classname(), [
                        'data' => $year,
                        'theme' => Select2::THEME_DEFAULT,
                        'language' => 'eg',
                        'options' => ['placeholder' => 'Select year'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?> 
        </div>
        <div class="col-md-4">
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
                        'options' => ['placeholder' => 'Select tour item'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]);
                ?> 
        </div>
        <div class="col-md-3">
            <div class="form-group">
                    <?=Html::submitButton('Filter', ['class' => 'btn btn-primary'])?>
                    <?= Html::a('Reset',['index'],['class' => 'btn btn-primary']) ?>
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
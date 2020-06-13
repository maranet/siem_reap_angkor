<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RatePlan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rate-plan-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cost_adult')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_id')->textInput() ?>

    <?= $form->field($model, 'tour_item_id')->textInput() ?>

    <?= $form->field($model, 'rate_range_id')->textInput() ?>

    <?= $form->field($model, 'cost_child')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_adult')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price_child')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark_up_adult')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark_up_child')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mark_up_type')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'updated_date')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'created_date')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

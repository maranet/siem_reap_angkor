<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\UserType;

/* @var $this yii\web\View */
/* @var $model backend\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */

// $employee_profile = Yii::$app->db->createCommand("
//     SELECT id, CONCAT(prefix, ' ', first_name, ' ', last_name) as name
//     FROM employee_profile
//     WHERE status = 1
// ")
// ->queryAll();
if(!$model->isNewRecord){
    $model_employee = \app\models\EmployeeProfile::findOne($model->employee_id);
    $employee_name = $model_employee->id_prefix . ' ' . $model_employee->first_name . ' ' . $model_employee->last_name;
    array_push($employee_profile, ['id'=>$model->employee_id, 'name'=>$employee_name]);
}

// $employee_profile = ArrayHelper::map($employee_profile, 'id', 'name');

$user_type = ArrayHelper::map(UserType::find()
->where(['status' =>1])
->all(), 'id', 'user_type_name'); 

?>
<div class="user-search">
    <div class="col-md-12 search-bd"> 
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
    <div class="col-md-3">
        <?= $form->field($model, 'username')->textInput(['placeholder'=>'Enter the name']);?>

    </div>
    <div class="col-md-3">
        <?= $form->field($model, 'user_type_id')->widget(Select2::classname(), [
                'data' => $user_type,
                'theme' => Select2::THEME_DEFAULT,
                'language' => 'eg',
                'options' => ['placeholder' => 'Select user type'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
        ?> 

    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('Filter', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Reset',['index'],['class' => 'btn btn-primary']) ?>
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
    width: 30%;
    margin-top: 30px;
}
</style>
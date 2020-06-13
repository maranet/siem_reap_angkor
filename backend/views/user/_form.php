<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use backend\models\UploadedFile;
use app\models\User;
use app\models\UserType;
use app\models\EmployeeProfile;
use app\models\CompanyProfile;
$base_url = Yii::getAlias('@web');
$company_list = ArrayHelper::map(\backend\models\CompanyProfile::find()
    ->where(['status'=>1, 'id' => 1])
    ->all(), 'id', function($model){return $model->name;});
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
$validationUrl = ['user/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}


$user_type = ArrayHelper::map(UserType::find()
->where(['status' =>1])
->all(), 'id', 'user_type_name'); 


// $employee_profile = Yii::$app->db->createCommand("
//     SELECT id, CONCAT(prefix, ' ', first_name, ' ', last_name) as name
//     FROM employee_profile
//     WHERE id NOT IN (SELECT employee_id FROM `user` WHERE NULLIF(employee_id, ' ') IS NOT NULL)
//     AND status = 1
// ")
// ->queryAll();
// if(!$model->isNewRecord){
//     $model_employee = \backend\models\EmployeeProfile::findOne($model->employee_id);
//     $employee_name = $model_employee->prefix . ' ' . $model_employee->first_name . ' ' . $model_employee->last_name;
//     array_push($employee_profile, ['id'=>$model->employee_id, 'name'=>$employee_name]);
// }

// $employee_profile = ArrayHelper::map($employee_profile, 'id', 'name');

?>

<div class="user-form">

<?php $form = ActiveForm::begin([
    'id' => $model->formName(),
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'options' => ['autocomplete' => 'off'],
    'validationUrl' => $validationUrl
]); ?>

<div class="row">
    
    <div class="col-md-4">
         <?= $form->field($signupForm, 'username')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-4">
    <?= $form->field($model, 'user_type_id')->widget(Select2::classname(), [
                    'data' => $user_type,
                    'theme' => Select2::THEME_DEFAULT,
                    'language' => 'eg',
                    'options' => ['placeholder' => 'Select'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]);
            ?> 
         
    </div>

    </div>
    <div class="row">
    <div class="col-md-4">    
    <?= $form->field($signupForm, 'email')->textInput(['maxlength' => true]) ?>


    </div>
    <div class="col-md-4"> 
         <?= $form->field($signupForm, 'password')->passwordInput(['maxlength' => true]) ?>

        
    </div>
    <div class="col-md-4"> 
         <?= $form->field($signupForm, 'confirm_password')->passwordInput(['maxlength' => true]) ?>

    </div>

    </div>
    <div class="row">
    <div class="col-md-12"> 
            <?php 
                if(!$model->isNewRecord){
                    $company_arr = \backend\models\CompanyUser::find()
                        ->select('company')
                        ->where(['company'=>$model->id])
                        ->asArray()
                        ->all(); 
                    $row = [];
                    if(!empty($company_arr)){
                        foreach($company_arr as $d){
                            $row[]=$d['company'];
                        }
                    }
                }else{
                    $row = [];
                }
            ?>
            <label>Company</label>
            <?= Select2::widget([
                    'name' => 'assign_to[]',
                    'data' => $company_list,
                    'value'=>$row,
                    'theme' => Select2::THEME_DEFAULT,
                    'language' => 'eg',
                    'options' => ['placeholder' => ' Company', 'multiple' => true, 'id'=>'company'],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            <div class="line15"></div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12" style="margin-top: 10px;">
        <?php $model->isNewRecord ? $model->status = 10: $model->status = $model->status;?>
        <?php if ($model->status != 10) { $model->status = 0;} ?>
        <?= $form->field($model, 'status')->radioList(['10' => 'Active', '0' => 'Inactive']) ?>
        </div>

    </div>
    <div class="col-md-12 form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div> 
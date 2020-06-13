
<?php 
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use backend\models\Customer; 
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url; 
use backend\models\SystemSetting;


$this->beginContent('@app/views/layouts/main.php');
// $customer_list = ArrayHelper::map(\backend\models\customerProfile::find()
//     ->all(), 'id', function($model){return $model->id_prefix . ' '. $model->first_name . ' ' . $model->last_name;}); 
    $request = Yii::$app->request;
    $smMenu = 1;
    $id_customer_profiles = $request->get('id',0);
    if($id_customer_profiles !=0){
        $id_customer_profile = $id_customer_profiles;
    }else{
        $id_customer_profile = $request->get('id_customer_profile');
    }
    $controllerName = Yii::$app->controller->id;
    $actionName = Yii::$app->controller->action->id; 

?> 
<style>
.panel-eo {
    border-color: #f87232;
} 
</style>

<div class="row"> 
    <div class="col-md-2 col-sm-3">
        <div class="panel">
            <div class="panel-heading panel-eo">
            <h3 class="panel-title" style="font-weight: 500;padding: 10px;">Menu </h3>
            </div>
            <div class="panel-body" style="padding: 20px !important;min-height: 500px;">
                <!--Link Items-->
                <!--===================================================-->
                <div class="list-group"> 
                    <a class="list-group-item emNavActiveOnAction_company-profile" href="<?= Url::toRoute('company-profile/setup') ?>">Profile</a>  
                    <a class="list-group-item emNavActiveOnAction_product" href="<?= Url::toRoute('product/index') ?>">Products</a> 
                    <a class="list-group-item emNavActiveOnAction_product-type" href="<?= Url::toRoute('product-type/index') ?>">Product Types</a> 
                    <a class="list-group-item emNavActiveOnAction_proposal-template" href="<?= Url::toRoute('proposal-template/index') ?>">Proposal Theme</a> 
                    <a class="list-group-item emNavActiveOnAction_quotation-template" href="<?= Url::toRoute('quotation-template/index') ?>">Quotation Theme</a> 
                    <a class="list-group-item emNavActiveOnAction_contract-template" href="<?= Url::toRoute('contract-template/index') ?>">Contract Theme</a> 
                    <a class="list-group-item emNavActive_employee-department" href="<?= Url::toRoute('employee-department/index') ?>">Emp Department</a>
                    <a class="list-group-item emNavActive_employee-position" href="<?= Url::toRoute('employee-position/index') ?>">Emp Position</a>
                    <a class="list-group-item emNavActive_country" href="<?= Url::toRoute('country/index') ?>">Country</a>
                    <a class="list-group-item emNavActive_city" href="<?= Url::toRoute('city/index') ?>">City</a>
                    
                </div>
                <!--===================================================-->

            </div>
        </div>
    </div>
    <div class="col-md-10 col-sm-9" style="background: #FFF;border-left: 10px solid #f5f8fa;"> 
        <div class="panel">
            <div class="panel-heading panel-eo">
                <h3 class="panel-title" style="font-weight: 500;"><?=$this->title;?></h3>
            </div>
            <div class="panel-body" style="padding: 10px !important;">
                <?= $content;?>
            </div>
        </div>   
    </div>
</div> 
<?php $this->endContent(); ?> 
<style>
.wrapper {
    padding-top: 120px;
    background: #f5f5f5 !important;
    padding-bottom: 20px;
}
.wrapper .container {
    /* background: #f5f5f5 !important; */
    padding: 0px;
}
</style>  
<style media="screen">
 a.list-group-item.emNavActiveOnAction_<?=$controllerName;?>{
    color: #f87232 !important;
    font-weight: 500;
 }
 a.list-group-item.emNavActive_<?=$controllerName;?>{
    color: #f87232 !important;
    font-weight: 500;
 }
 .panel-title {
    margin-top: 0;
    margin-bottom: 0;
    font-size: 16px;
    color: inherit;
    padding: 10px;
}
.search-bd {
    background: #f5f8fa;
    height: 100px;
    padding: 15px;
    margin-top: 20px;
}
.footer .container {
  background: #fff !important;
}
 </style>
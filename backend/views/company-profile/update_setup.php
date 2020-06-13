<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProfile */

$this->title = 'Company Profile' ;
// $this->params['breadcrumbs'][] = ['label' => 'Company Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => Url::toRoute(['company-profile/setup'])];

$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-profile-update">
    <?= $this->render('_form_setup', [
        'model' => $model,
    ]) ?>

</div>

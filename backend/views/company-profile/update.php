<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProfile */

$this->title = 'Update Company Profile: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-profile-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProfile */

$this->title = 'Create Company Profile';
$this->params['breadcrumbs'][] = ['label' => 'Company Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-profile-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

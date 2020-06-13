<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyStatus */

$this->title = 'Update Company Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="company-status-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

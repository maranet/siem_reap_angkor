<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyStatus */

$this->title = 'Create Company Status';
$this->params['breadcrumbs'][] = ['label' => 'Company Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-status-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

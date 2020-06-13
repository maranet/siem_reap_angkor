<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlan */

$this->title = 'Update Rate Plan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rate Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rate-plan-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

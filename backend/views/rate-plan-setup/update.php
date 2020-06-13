<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlanSetup */

$this->title = 'Update Rate Plan Setup: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rate Plan Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rate-plan-setup-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

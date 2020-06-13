<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlanSetup */

$this->title = 'Create Rate Plan Setup';
$this->params['breadcrumbs'][] = ['label' => 'Rate Plan Setups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-plan-setup-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

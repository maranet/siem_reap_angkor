<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlan */

$this->title = 'Create Rate Plan';
$this->params['breadcrumbs'][] = ['label' => 'Rate Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-plan-create">


    <?= $this->render('_form', [
        'model' => $model,
        'rate_set_up_id' => $rate_set_up_id,
        'month' => $month,
        'year' => $year,
        'get_tour_setup_id' => $get_tour_setup_id,
    ]) ?>

</div>

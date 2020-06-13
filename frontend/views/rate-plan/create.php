<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\RatePlan */

$this->title = 'Create Rate Plan';
$this->params['breadcrumbs'][] = ['label' => 'Rate Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rate-plan-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerBooking */

$this->title = 'Update Customer Booking: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Customer Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="customer-booking-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerBooking */

$this->title = 'Create Customer Booking';
$this->params['breadcrumbs'][] = ['label' => 'Customer Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-booking-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

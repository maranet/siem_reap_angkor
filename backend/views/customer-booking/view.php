<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CustomerBooking */

$this->title =  $model->name." (Code : ".$model->booking_code.")";
$this->params['breadcrumbs'][] = ['label' => 'Customer Bookings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$country_name = \backend\models\Country::findOne($model->country_id)->name;

?>
<div class="customer-booking-view">
    <h2 style="margin: 0px 10px 0px 10px; color: #4a5663;">Detail Information</h2>
    <div style="margin: 5px;" class="panel-header">
        <div class="row">
            <div class="col-md-12" style="margin: 40px auto;">
                <div class="list-group">
                    <a class="list-group-item" style="background: #2b3d50c4; color: white">Customer Information</a>
                    <a class="list-group-item">Booking code : <?= $model->booking_code?> </a>
                    <a class="list-group-item">Name : <?= $model->name?></a>
                    <a class="list-group-item">Email : <?= $model->email?></a>
                    <a class="list-group-item">Phone number : <?= $model->phone_number?></a>
                    <a class="list-group-item">Country : <?= $country_name?></a>
                    <a class="list-group-item">Pick Up Location : <?= $model->pick_up_location?></a>
                    <a class="list-group-item">Date booking : <?= $model->date?></a>
                    <a class="list-group-item">Description : <?= $model->description?></a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="list-group">
                    <a class="list-group-item" style="background: #2b3d50c4; color: white">Booking Item Detail</a>
                    <a class="list-group-item">Item Name : <?= $booking_item->tourItem->name?> </a>
                    <a class="list-group-item">Item Service Name : <?= $booking_item->name?> </a>
                    <a class="list-group-item">Duration :  <?= $booking_item->duration?> <?= $booking_item->duration_type == 1 ? "Day" : "Hour"?> </a>
                    <a class="list-group-item">Starting time : <?= $booking_item->starting_time?></a>
                    <a class="list-group-item">Price : <?= $booking_item->price?> US$</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="list-group">
                    <?php 
                        if (!empty($extra_booking)) {
                           ?>
                           <a class="list-group-item" style="background: #2b3d50c4; color: white">Booking Extra Service Detail</a>
                        <a class="list-group-item">Name : <?= $extra_booking->name?> </a>
                        <a class="list-group-item">Adult : <?= $extra_booking->adult?> | Price : <?= $extra_booking->adult_price?> US$</a>
                        <a class="list-group-item">Child : <?= $extra_booking->child?> | Price : <?= $extra_booking->child_price?> US$</a>
                        <a class="list-group-item">Total : <?= $extra_booking->extra_amount?> US$ </a>
                           <?php
                        }
                     ?>
                    
                </div>
            </div>
        </div>   
    </div>
</div>

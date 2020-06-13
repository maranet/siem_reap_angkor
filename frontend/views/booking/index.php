<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookings';
// $this->params['breadcrumbs'][] = $this->title;

?>
<div class="row">
    <div class="col-md-12 wrap_book">

        <div class="container">
            <div id="box-vile" class="container-fluid box-shadow">
                <div class="minus">
                    <span><i class="fa fa-minus" aria-hidden="true"></i></span>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12">
                    <a href="#"><img src="/dropbox/siem_reap_angkor/backend/web/uploads/siem_reap_angkor_adventures/tour-item/preah_ko_20200328113318.jpg" alt="" class="img-item"></a>
                    <!-- <img src="img/01.jpg" class="img-item" alt="Tour Category" /> -->
                </div>

                <div class="col-lg-9 col-md-9 col-sm-12 wrap_des"><br>
                    <a class="read-more" href="#">
                        <h4 >Temple Gala Dinner</h4>
                    </a> 
                    <label for="">Category: Most Popular Tours Sightseeing</label>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <div class="col-md-4">
                        <input type="text" name="" class="date_picker form-control" id= "from-date" maxlength="128" value="" placeholder="From" >
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="" class="date_picker form-control" id= "to-date" maxlength="128" value="" placeholder="To">  
                    </div>
                    <div class="col-md-4">
                        <select name="title" id="title" class="form-control">
                            <option value="0" selected="selected">Select adult</option>
                            <option class="" value="mr">1 adult</option>
                            <option class="" value="mrs">2 adults</option>
                            <option class="" value="ms">3 adults</option>
                            <option class="" value="dr">4 adults</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="book-page">
                <div class="form">
                    <form class="book-form">
                        <div class="col-md-2">
                            <select name="title" id="title" class="form-control">
                                <option value="0" selected="selected">Select title</option>
                                <option class="" value="mr">Mr.</option>
                                <option class="" value="mrs">Mrs.</option>
                                <option class="" value="ms">Ms.</option>
                                <option class="" value="dr">Dr.</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="First Name"/>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Last Name"/>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Email "/>   
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Confirm Email "/>
                        </div>
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Phone Number "/>
                        </div>
                        <div class="col-md-12">
                            <select name="country" id="country" class="form-control">
                                <option value="0" selected="selected">Select Country</option>
                                <option class="" value="">Cambodia</option>
                                <option class="" value="">Korea</option>
                                <option class="" value="">USA</option>
                                <option class="" value="">Japan</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <textarea class="form-control" rows="5" id="comment" placeholder="Additional comments"></textarea> 
                        </div>
                        <button>Book</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .book-page {
      /*width: 360px;*/
      /*padding: 80px 145px;
      margin: auto;*/
      border:1px solid #dfd8d8;
      margin-top: -20px;
    }
    .book-page .form {
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      width: 100%;
      /*margin: 0 auto 100px;*/
      padding: 45px;
      text-align: center;
      box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.08), 0 5px 3px 0 rgba(0, 0, 0, 0.1);
    }
    .book-page .form input, .book-page .form select, .book-page .form textarea{
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
    }
    .book-page .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #c71e32e8;
        width: 12%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
        position: relative;
        left: 450px;
    }
    .book-page .form button:hover,.book-page .form button:active,.book-page .form button:focus {
      background: #c71e32;
    }
    #box-vile {
        border: 1px solid #e0d9d9;
        margin-bottom: 20px;
    }
    img.img-item {
        object-fit: cover;
        width: 100%;
        height: 180px;
        margin-top: 27px;
        margin-bottom: 27px;
    }
    .wrap_des label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 400;
        color: #9d9d9d;
    }
    .wrap_des p {
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
    .wrap_book .container {
        margin: 50px auto;
    }
    .wrap_des a{
        text-decoration: none;
    }
    .wrap_des h4{
        font-weight: bold;
        color: red;
    }
    .minus{
        width: 46px;
        height: 35px;
        position: absolute;
        right: 173px;
        top: 57px;
        border: 1px solid #c71e32;
        z-index: 1;
    }
    .minus span i{
        font-size: 20px;
        padding: 7px 15px;
        color: #c71e32;
        position: relative;
        top: 1px;
    }
</style>
<?php
$script = <<< JS
    // =========Datepicker===========

    $('#from-date, #to-date').datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });

JS;
$this->registerJS($script);
?>

<!-- <script>
    $(document).ready(function(){
        $("#from-date").datepicker({
                defaultDate: "+1w",
                onClose: function (selectedDate) {
                    $("#to-date").datepicker("option", "minDate", selectedDate);
                }
        });
        $("#to-date").datepicker({
            defaultDate: "+1w",
            stepMonths: 0,
            onClose: function (selectedDate) {
                $("#from-date").datepicker("option", "maxDate", selectedDate);
            }
        });
    });
</script> -->

<?php 
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use backend\models\TourItem;
use backend\models\TourCategory;
use frontend\models\Allotment;
use frontend\models\AllotmentSearch;

use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use kartik\select2\Select2;
$base_url = Yii::getAlias('@web');
$this->title = 'Tour Item';
$date_template = '
    {label}
    </br>
    <div class="input-group">
        <span style="width: 40px" class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span> 
        {input} 
    </div>
    {error}{hint}';
 ?>
<style type="text/css">
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    
img.img-responsive.center {
    height: 500px;
    width: 100%;
    object-fit: cover;
}
/*------Maranet change-------*/
.navigation__item span {
    /*color: black;*/
}
.navigation__item span:hover{
    /*color: red;*/
}
/*------End Maranet change-------*/
a:focus, a:hover {
    color: red;
    /*text-decoration: none;*/
}
.btn.btn-primary.book-now {
    border-radius: 16px;
    padding-right: 50px;
    padding-left: 50px;
    position: absolute;
    outline: none;
    left: 50%;
    top: 12%;
}
.price-area {
    padding: 10px;
    border-top: 5px solid #337ab7;
    box-shadow: 0px 3px 8px 5px #88888847;
}
#owl-demo .item{
    margin: 3px;
}
#owl-demo .item img{
  display: block;
  width: 100%;
  height: auto;
}
i#go-next {
    position: absolute;
    top: 35%;
    font-size: 50px;
    padding: 20px;
    background: #ffffff6b;
    right: 5px;
}
i#go-prev {
    position: absolute;
    top: 35%;
    font-size: 50px;
    padding: 20px;
    background: #ffffff6b;
    left: 5px;
}
.owl-stage{
  transition: 1.5s!important;
}
button.btn.btn-primary.check {
        margin-top: 20px;
        padding: 5px;
    }
   
    img.img-item {
        object-fit: cover;
        width: 100%;
        height: 180px;
        margin-top: 27px;
        margin-bottom: 27px;
    }
    img.img-responsive.center {
        height: 400px;
        width: 100%;
        object-fit: cover;
    }
    .price {
        text-align: left;
        bottom: 10px;
        right: 25px;
        color: #c71e32;
    }
    .price-detail {
        float: right;
        text-align: left;
        position: absolute;
        bottom: 10px;
        right: 25px;
        color: #c71e32;
    }

    #box-vile{
        border: 1px solid #e0d9d9;
        margin-bottom: 20px;
    }
    .list-group {
        padding-top: 20px;
    }
    .read-more:hover{
        text-decoration: none;
    }
    .list-view .summary, .pagination li a{
        font-size: 13px;
        font-weight: 200;
    }
    .list-view .pagination{
        margin: 7px auto;
    }
    .list-view .pagination li a{
        color: #a7a7a7;
        padding: 3px 8px;
    }
    .list-view .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
        background-color: #2e3d51 !important;
        border-color: #2e3d51 !important;
        color: white;
        font-size: 13px;
        font-weight: 200;
    }
    .pagination>.disabled>a, .pagination>.disabled>a :focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>s pan:hover {
        color: #ccc7c7;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
        font-size: 13px;
        font-weight: 200;
        padding: 3px 8px;
    }
    .short_des{
        font-weight: 300;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    .view_more{
        border: none;
        font-size: small;
        padding: 0;
        color: #2103039c;
        outline: none;
    }
    #w2-collapse{
        height: auto;
    }
    #w2-collapse #w3 {
        margin: 17px auto;
    }
    #w2-collapse #w3 li{
        font-weight: 400;
    }
    .search-bd{
        background: whitesmoke;
        height: auto; 
        padding: 15px;  
        margin-top: 20px;
        margin-bottom: 20px;
        border-radius: 3px;
    }
    .btn-primary:hover{
        color: #fff;
        background-color: #ff0825;
        border-color: #ff0625 !important;
    }
    .btn-primary{
        color: #fff;
        background-color: #ff0825 !important;
        border-color: none !important;
        margin-top: 30px;
        padding: 5px 40px;
    }

    .date_picker {
        padding: 5px;
    }
    .form-control{
        background: white!important;
    }
    .input-group{
        width: 100%;
    }
    .form-group button, .form-group a {
        margin-top: 23px;
    }
    .search-fieldx{
        position: absolute;
        top: -65px;
        z-index: 999; 
    }
    select {
        margin-top: 20px;
    }
    label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 400;
        color: #9d9d9d;
    }
    .add_to_cart{
        position: absolute;
        top: 20px;
        right: 20px;
    }
    .btn-info{
        font-size: 12px;
        outline: none;
        padding: 6px;
        background: white;
        color: #095167;
    }
    .btn-info:hover, .btn-info:focus, .btn-info:active {
        background: white;
        color: #095167;
        outline: none;
    }
    .btn-info.active.focus, .btn-info.active:focus, .btn-info.active:hover, .btn-info:active.focus, .btn- info:active:focus, .btn-info:active:hover, .open>.dropdown-toggle.btn-info.focus, .open>.dropdown-toggle.btn- info:focus, .open>.dropdown-toggle.btn-info:hover {
        background: white;
        color: #095167;
        outline: none;
    }
    .modal-title {
        color: #08630b;
        font-size: 20px;
    }
    .modal-body p, li{
        font-weight: 300;
        font-size: 14px;
    }
    .modal-body ul{
        list-style: decimal;
    }
    .modal-body p strong{
        color: #822929;
        font-size: 15px;
        font-weight: 500;
    }
    .modal-body table{
        width: 70%;
        text-align: center;
        margin: 20px auto;
        margin-bottom: 0px;
    }
    .modal-body table tr td{
        padding: 10px;
        font-size: 15px;
        color: #dc0d0d;
    }
    .modal-body table tr:nth-of-type(odd){
        background: #dad9d975;
    }
    .modal-body table tr:nth-of-type(even){
        border-bottom: 1px solid #73717187;
    }
    .ui-datepicker{
        top: 700px;
        position: absolute;
        left: 500px;
    }
    /*------Maranet change--------*/
    .wrap{
        padding: 0;
    }
    /*------End Maranet change--------*/

</style>
<div class="boday-content">
    <div class="container">
        <div class="row row-no-gutters">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme">
                    <?php 
                        foreach ($item_galleries as $item_gallery) {
                    ?>
                    <div class="item container">
                        <img class="img-responsive center"  src="<?= $item_gallery->file_path. $item_gallery->file_name?>">
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
  <br>
  <div class="tour_item-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <h4><?= $item_details->name; ?></h4>
          <p><?= $item_details->tip_note; ?></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
          <div class="price-area">
            <p>From</p>
            <h3 class="price"><?= "US$ ".$item_details->price; ?></h3>
            <p>Per person</p>
            <hr>
            <button class="book-now btn btn-primary add-cart">Book now</button>
          </div>

        </div>
      </div>
      <h4>Acitity</h4>
      <hr>
        <i class="fa fa-clock-o"></i> Duration: <?= $item_details->duration. ($item_details->duration_type == 1 ? " Day" : " Hour");?><br>
        <?= $item_details->recommended == 1 ? " <i class='fa fa-check-circle'></i> Recommended" : ""; ?><br>

    </div>
    <!-- Check availability section -->
<?= Html::csrfMetaTags() ?>
<div id="scroll"></div>
<div class="boday-content">
  <div class="category-listing">
    <div class="container">
        <p id="scroll-element"></p>
     <?php
        $item_model = TourItem::find()->where(['id'=>$item_id])->one();
        $model = new Allotment;
     ?>
    <div class="tour-category-search">
        <div class="col-md-12 search-bd">
            <?php $form = ActiveForm::begin([
                'action' => 'javascript:void(0)',
            ]); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-2">
                        <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'class'=>'date_picker form-control DateFrom', 'placeholder' => 'From'])->label(false);?>
                    </div>
                    <?php 
                        // 1 = day, 2 = hour
                        if ($item_model->duration_type == 2) {
                            $hidden = "hidden";
                        }else if($item_model->duration_type == 1 && $item_model->duration == 1) {
                            $hidden = "hidden";
                        }else{
                           $hidden = ""; 
                        }
                     ?>
                    <div <?= $hidden ;?> class="col-md-2">
                        <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true, 'class'=>'date_picker form-control DateFrom', 'placeholder' => 'To'])->label(false);?>
                    </div>
                    <div class="col-md-2">
                        <?php 
                            $adult_value = ['1' => '1 adult', '2' => '2 adults', '3' => '3 adults', '4' => '4 adults', '5' => '5 adults'];
                         ?>
                        <?=$form->field($model, 'adult')->dropDownList($adult_value)->label(false);?>
                    </div>
                    <div class="col-md-2">
                        <?php 
                            $child_value = ['0' => '0 child', '1' => '1 child', '2' => '2 children', '3' => '3 children', '4' => '4 children', '5' => '5 children'];
                         ?>
                        <?=$form->field($model, 'child')->dropDownList($child_value)->label(false);?>
                    </div>
                    <div class="col-md-2">
                <div class="form-group">
                    <button id= "check-rate" class="btn btn-primary rounded">Check Availability</button>
                </div>
            </div>
                    
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
 <!-- end search secion -->
</div><br>
<?php $form = ActiveForm::begin([
                'action' => 'javascript:void(0)',
                'method' => 'get',
            ]); ?>
    <div class="rate-section">
    </div>
    <br>
<?php ActiveForm::end(); ?>
<?php
    $query = \backend\models\TourItem::find()->where(['id'=>$item_id])->one();
    $message = "No item available";
    $rate_model_id = \backend\models\RatePlanSetup::find()->where(['tour_item_id'=>$item_id])->one();
        empty($rate_model_id) ? $rate_plan_setup_id = "" : $rate_plan_setup_id = $rate_model_id->id;
    $rate_model =\backend\models\RatePlanSetup::find()->where(['tour_item_id'=>$item_id])->one();

    $item_name = $query->name;
    $category_name = $query->tourCategory->name;
    // $category_name = \backend\models\TourCategory::find()->where(['id'=>$query->category_id])->one();
    $item_price = $query->price;
    $from_date = "";
    $duration_type = $item_model->duration_type;
$script = <<< JS
var duration_type = "$duration_type";
var base_url = "$base_url";
var item_id = "$item_id";
var category_name = "$category_name";
var rate_model_id = "$rate_plan_setup_id";
var item_name = "$item_name";
var item_price = "$item_price";
var from_date = "$from_date";
    // =========Duration Type===========
    $("#allotment-from_date").change(function(){
        if(duration_type == 2){
            $("#allotment-to_date").datepicker('setDate', new Date($(this).val()));
        }else{
            var get_start_date = $('#allotment-from_date').datepicker('getDate', '+2d');
            get_start_date.setDate(get_start_date.getDate()+2);
            $('#allotment-to_date').datepicker('setDate', get_start_date);

            $('#allotment-to_date').datepicker('setStartDate', $(this).val());

            if(Date.parse($(this).val()) > Date.parse($('#allotment-to_date').val())){
                $('#allotment-to_date').datepicker('setDate', $(this).val());
            }
        }
       
    });

    // =========End Duration Type===========

    // =========Datepicker===========

    $('.date_picker').datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });
    $("#check-rate").click(function(){
        if(rate_model_id == ""){
             $( ".rate-plan" ).remove();
                    $( ".n-a" ).remove();
                    $(".rate-section").append("<div class='container n-a'>" +
                                                    "<p class='text-danger'>Not available. Please select another date</p>" +
                                                "</div>");
        }
        var from_date = $("#allotment-from_date").val();
        var to_date = $("#allotment-to_date").val();
        var adult = $("#allotment-adult").val();
        var child = $("#allotment-child").val();

        $.ajax({
            url: base_url+'/index.php?r=allotment/dependent',
            type: 'post',
            data: {
                from_date: from_date,
                adult: adult,
                child: child,
                item_id: item_id,
                rate_model_id: rate_model_id,
                action: 'get_rate_plan'
            },
            success: function(response){ 
                var data = JSON.parse(response);
                if(data == ""){
                    $( ".rate-plan" ).remove();
                    $( ".n-a" ).remove();
                    $(".rate-section").append("<div class='container n-a'>" +
                                                    "<p class='text-danger'>Not available. Please select another date</p>" +
                                                "</div>");
                }else{
                    $(".n-a").remove();
                    var str = "";
                $.each(data,function(key,value){
                    console.log(data);
                    var price_adult = parseFloat(value.price_adult);
                    var price_child = parseFloat(value.price_child);
                    var mark_up_adult = parseFloat(value.mark_up_adult);
                    var mark_up_child = parseFloat(value.mark_up_child);

                    if(value.mark_up_type == 1){
                        var after_mark_up_adult = price_adult;
                        var after_mark_up_child = price_child;
                    }else{
                        var after_mark_up_child = (mark_up_child/100)*price_child + price_child;
                        var after_mark_up_adult = (mark_up_adult/100)*price_adult + price_adult;
                    }
                    str = str + '<div class="container rate-plan">' +
                                     '<div class="box-price" style="border: 1px solid #bbb6b6; padding: 10px; margin-bottom: 10px;">' +
                                        '<div class="row">' +
                                        '<input name="adult[]" type="hidden" value="'+adult+'">' +
                                        '<input name="rate_set_up_id[]" type="hidden" value="'+value.rate_set_up_id+'">' +
                                        '<input name="child[]" type="hidden" value="'+child+'">' +
                                        '<input name="price_adult[]" type="hidden" value="'+after_mark_up_adult+'">' +
                                        '<input name="price_child[]" type="hidden" value="'+after_mark_up_child+'">' +
                                        '<input name="item_id[]" type="hidden" value="'+item_id+'">' +
                                        '<input name="from_date[]" type="hidden" value="'+from_date+'">' +
                                        '<input name="to_date[]" type="hidden" value="'+to_date+'">' +
                                        '<input name="price[]" type="hidden" value="'+((after_mark_up_adult*adult)+(after_mark_up_child*child)).toFixed(2)+'">' +


                                            '<div class="col-md-12">' +
                                                '<div class="col-md-6">' +
                                                    '<p style="color: #c71e32;">Rate Plan Name: '+value.name+'</p>' +
                                                    '<p>Tour Item Name: '+item_name+'</p>' +
                                                    '<p>Category Name: '+category_name+'</p>' +
                                                '</div>' +
                                                '<div class="col-md-6">' +
                                                    '<div class="row">' +
                                                        '<div class="col-md-6">' +
                                                           '<p>Price</p>' +
                                                        '</div>' +
                                                        '<div class="col-md-6">' +
                                                            '<h4 style="color: #c71e32;">US$ '+((after_mark_up_adult*adult)+(after_mark_up_child*child)).toFixed(2)+'</h4>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<hr>' +
                                            '</div>' +
                                            '<div class="col-md-12">' +
                                                '<div class="col-md-6">' +
                                                    '<p>Starting Time</p>' +
                                                    '<p>'+value.starting_time+'</p>' +
                                                '</div>' +
                                                '<div class="col-md-6">' +
                                                    '<p>Price Detail</p>' +
                                                    '<hr style= "margin-top: 0px; margin-bottom: 10px;">' +
                                                    '<div class="row">' +
                                                        '<div class="col-md-6">' +
                                                            '<p>Adult '+adult+' x US$ '+after_mark_up_adult.toFixed(2)+'</p>' +
                                                        '</div>' +
                                                        '<div class="col-md-6">' +
                                                            '<p>US$ '+(after_mark_up_adult*adult).toFixed(2)+'</p>' +
                                                        '</div>' +
                                                    '</div>' +

                                                    '<hr style= "margin-top: 0px; margin-bottom: 10px;">' +
                                                    '<div class="row">' +
                                                        '<div class="col-md-6">' +
                                                            '<p>Child '+child+' x US$ '+after_mark_up_child.toFixed(2)+'</p>' +
                                                        '</div>' +
                                                        '<div class="col-md-6">' +
                                                            '<p>US$ '+(after_mark_up_child*child).toFixed(2)+'</p>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</div>' +
                                            '</div>' +
                                            '<hr>' +
                                            '<div class="col-md-2">' +
                                                '<div class="form-group container">' +
                                                    '<a style= "padding: 10px; color: white; background: #f50000;" href="'+base_url+'/index.php?r=booking/add-to-cart&id='+value.id+'&adult='+adult+'&child='+child+'&price_adult='+after_mark_up_adult+'&price_child='+after_mark_up_child+'&item_id='+item_id+'&rate_set_up_id='+value.rate_set_up_id+'&to_date='+to_date+'&price='+((after_mark_up_adult*adult)+(after_mark_up_child*child)).toFixed(2)+'&from_date='+from_date+'">Add to cart</a>' +
                                                '</div>' +
                                            '</div>' +
                                        '</div>' +
                                     '</div>' +
                                 '</div>';
                                console.log(str);
                });
                $( ".rate-plan" ).remove();
                $(".rate-section").append(str);
                }
            }
        });
    });

JS;
$this->registerJS($script);
  
?>

<script src="<?= $base_url ;?>/js/jquery-1.12.4.js"></script>
<script src="<?= $base_url ;?>/js/owl.carousel.js"></script>
<script>
  $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    autoplay:false,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    navText: ["<i id= 'go-prev' class='fa fa-angle-left'></i>", "<i id='go-next' class='fa fa-angle-right'></i>"],
    items:5,
    singleItem: true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
  });

  $(".add-cart").click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#scroll-element").offset().top
        }, 500);
    });
</script>

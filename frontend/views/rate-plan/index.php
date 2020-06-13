<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RatePlanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rate Plans';
$this->params['breadcrumbs'][] = $this->title;
?>
<style type="text/css">
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

</style>
<style type="text/css">
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    .product{
        margin: 50px 0px;
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
    .text-title {
        position: absolute;
        top: 50%;
        left: 50%;
        color: white;
        border-top: 4px solid #fff;
        border-bottom: 4px solid;
        width: 50%;
        padding: 20px;
        text-align: center;
        background: #00000085;
        transform: translate(-50%, -50%);
    }
    .text-title h2{
        font-size: 53px;
    }
    @media only screen and (max-width: 600px) {
      .text-title {
        position: absolute;
        top: 50%;
        left: 50%;
        color: white;
        border-top: 4px solid #fff;
        border-bottom: 4px solid;
        width: 200px;
        padding: 20px;
        text-align: center;
        background: #00000085;
        transform: translate(-50%, -50%);
      }
    }
    .price {
        float: right;
        text-align: left;
        position: absolute;
        bottom: 10px;
        right: 25px;
        color: #c71e32;
    }
    .row.item-listing {
        /*padding: 20px;*/
        /*padding-left: 0px;*/
    }

    #box-vile{
        border: 1px solid #e0d9d9;
        margin-bottom: 20px;
    }
    /*#box-vile :hover{
      box-shadow: 0px 3px 8px 5px #888888;
    }*/
    .price-area {
        padding: 10px;
        border-top: 5px solid #337ab7;
        box-shadow: 0px 3px 8px 5px #88888847;
    }
    .list-group {
        padding-top: 20px;
    }
    .read-more:hover{
        text-decoration: none;
    }
    /*.wrap_des p{
        overflow: hidden;
       text-overflow: ellipsis;
       display: -webkit-box;
       -webkit-box-orient: vertical;
       -webkit-line-clamp: 3; /* number of lines to show 
    }*/
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
    .wrap_des{
        /*height: 170px;
        overflow: hidden;*/
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
</style>
<div class="rate-plan-index">
<h5><?= Html::encode($this->title) ?></h5>


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container-fluid">
                <div class="row item-listing">
                    <?=
                        ListView::widget([
                            'dataProvider' => $dataProvider,
                            'pager' => [
                                'firstPageLabel' => 'First',
                                'lastPageLabel' => 'Last',
                                // 'nextPageLabel' => 'next',
                                // 'prevPageLabel' => 'previous',
                                'maxButtonCount' => 3,
                            ],
                            'itemView' => function ($model, $key, $index, $widget){
                    ?> 
                    <div id="box-vile" class="container-fluid box-shadow" style="position: relative;">
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <a href="<?= Url::toRoute(['allotment/item-detail', 'id' => $model->tourItem->id ]) ?>" title="View Detail">
                                <img src="<?= $model->tourItem->feature_image; ?>" alt='' class="img-item">   
                            </a>
                        </div>
                        <h3 class="price"><?= "US$ ".$model->tourItem->price; ?></h3>
                        <div class="col-lg-8 col-md-8 col-sm-12 wrap_des"><br>
                            <a href="<?= Url::toRoute(['allotment/item-detail', 'id' => $model->tourItem->id ]) ?>" title="View Detail" class= "read-more">
                                <h4 style="color: #c71e32;"><?php echo $model->tourItem->name ?></h4>
                            </a>

                            <label for="">Category: <?= $model->tourItem->tourCategory->name;?>
                                
                            </label><br>
                            <p class="short_des">
                                <?= $model->tourItem->description ;?>  
                            </p>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class = "view_more" data-toggle="modal" data-target=".<?= $model->tourItem->id?>">View More...</button><br>

                            <!-- Modal -->
                            <div class="modal fade <?= $model->tourItem->id?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="container-fluid">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Detail Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?= $model->tourItem->tip_note ;?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <i class="fa fa-clock-o" style="margin: 11px auto;"></i> Duration: <?= $model->tourItem->duration. ($model->tourItem->duration_type == 1 ? " Day" : " Hour");?><br>
                            <?= $model->tourItem->recommended == 1 ? " <i class='fa fa-check-circle'></i> Recommended" : ""; ?>
                             
                        </div>
                    </div>
                    <?php
                            }
                        ]);
                    ?>

                </div>
            </div>
        </div>
      </div>
</div>

<?php
 
$this->registerJs('
var controller_id = "rate-plan";
        $("#select_page_size").change(function(){
            var page_size = $("#select_page_size").val();
            var url = window.location.pathname;
                window.location.replace(url+"?r="+controller_id+"/index&page_size="+page_size);
        });


        $(document).on("click","#modalButton",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })

        });

        $(document).on("click","#modalButtonView",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

        $(document).on("click","#modalButtonUpdate",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

    ');

?>

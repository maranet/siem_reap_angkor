<?php
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;
use frontend\models\TourItem;
use frontend\models\TourItemSearch;
use backend\models\TourCategory;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\TourCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tour Categories';
// $this->params['breadcrumbs'][] = $this->title;

$base_url = Yii::getAlias('@web');
$this->title = 'Tour';
$model = new TourCategory;
if(isset($searchModel->from_date)){
    // 'have filter';
    $from_date = $searchModel->from_date ;
    Yii::$app->session->set('from_date',$from_date); 

    $to_date = $searchModel->to_date ;
    Yii::$app->session->set('to_date',$to_date); 

    $adult = $searchModel->adult ;
    Yii::$app->session->set('adult',$adult); 

    $child = $searchModel->child ;
    Yii::$app->session->set('child',$child); 
}else{
    //if not filter and get default:
    $from_date = strtotime("+7 day");
    $from_date =  date('Y-m-d', $from_date); 
    Yii::$app->session->set('from_date',$from_date);  

    $to_date = strtotime("+9 day");
    $to_date =  date('Y-m-d', $to_date); 
    Yii::$app->session->set('to_date',$to_date); 

    Yii::$app->session->set('adult',1);   
    Yii::$app->session->set('child',0); 

}

?>
<?= Html::csrfMetaTags() ?>

<div class="boday-content">
  <div class="container-fluids">
    <div class="row">
      <div class="col-ld-12 col-md-12 col-sm-12">
        <img src="https://cdn.cnn.com/cnnnext/dam/assets/180501104811-lazy-beach-cambodia.jpg" alt="banner tour" class="img-responsive center"/>
        <!-- <div class="text-title">
          <h2>TOUR</h2>
        </div> -->
      </div>
    </div>
  </div>
  <div class="category-listing">
    <div class="container">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

      <h3>Tour Categories</h3>
      <?php 
        Yii::$app->session->set('category_id',$searchModel->name); 
       ?>       
       <hr>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="container-fluid">
                <div class="row item-listing">
                    <?php 
                        $searchModelTourItem = new TourItemSearch();
                        $dataProvider = $searchModelTourItem->search(Yii::$app->request->queryParams); 

                    ?>
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
                            <a href="<?= Url::toRoute(['site/item-detail', 'id' => $model->id ]) ?>" title="View Detail">
                                <img src="<?= $model->feature_image ;?>" alt='' class="img-item">   
                            </a>

                        </div>
                            <h3 class="price"><?= "US$ ".$model->price; ?></h3>
                        <div class="col-lg-8 col-md-8 col-sm-12 wrap_des"><br>
                            <a href="<?= Url::toRoute(['site/item-detail', 'id' => $model->id ]) ?>" title="View Detail" class= "read-more">
                                <h4 style="color: #c71e32;"><?php echo $model->name ?></h4>
                            </a>

                            <label for="">Category: <?= TourCategory::find()->where(['id' => $model->category_id])->one()->name;?>
                                
                            </label><br>
                            <p class="short_des">
                                <?= $model->description ;?>  
                            </p>
                            <!-- Trigger the modal with a button -->
                            <button type="button" class = "view_more" data-toggle="modal" data-target=".<?= $model->id?>">View More...</button><br>

                            <!-- Modal -->
                            <div class="modal fade <?= $model->id?>" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="container-fluid">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Detail Information</h4>
                                            </div>
                                            <div class="modal-body">
                                                <?= $model->tip_note ;?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <i class="fa fa-clock-o" style="margin: 11px auto;"></i> Duration: <?= $model->duration. ($model->duration_type == 1 ? " Day" : " Hour");?><br>
                            <!-- <?= $model->recommended == 1 ? " <i class='fa fa-check-circle'></i> Recommended" : ""; ?> -->
                           
                            <?= Html::a('Add To Cart',['booking/add-to-cart', 'id' => $model->id , 'from_date' =>$_SESSION['from_date'], 'to_date' =>$_SESSION['to_date'], 'adult' =>$_SESSION['adult'], 'child' =>$_SESSION['child']], ['class' => 'add_to_cart btn btn-success']) ?>
                             
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
  </div>
</div><br><br>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
<?php
    $base_url = Yii::getAlias('@web');
    $from_date = $from_date;
    $script = <<< JS
    var from_date = "$from_date";


    var base_url = "$base_url";
    var from_date = "$from_date";

    // =========Checkbox Category filter Item===========
    

    $(".category_id").click(function(){ 
       
        var id = $(this).val();
        // alert(id);
        var url = base_url+'/index.php?r=tour-category/index';

        $.ajax({
            url: url,
            type: 'post',
            data: {
                category_id: id,
                action: 'get_item'
            },
            success: function(response){ 
                alert(response);
                 
            }
        });

    });
    // $(".add_to_cart").click(function(){
    //     if(from_date == ""){
    //         alert("Please filter the date");
    //         return false;
    //     }
    // });

    JS;
    $this->registerJS($script);
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
        width: 350px;
        padding: 43px;
        text-align: center;
        background: #00000085;
        transform: translate(-50%, -50%);
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
        height: 100%!important;
    }
    #w2-collapse #w3 {
        margin: 17px auto;
    }
    #w2-collapse #w3 li{
        font-weight: 400;
    }
</style>
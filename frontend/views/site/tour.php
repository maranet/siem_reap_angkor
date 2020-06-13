<?php 
use backend\models\TourItem;
use yii\helpers\Html;

$base_url = Yii::getAlias('@web');
$this->title = 'Tour';
 ?>
 <?= Html::csrfMetaTags() ?>
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
}
.row.item-listing {
    padding: 20px;
    padding-left: 0px;
}

#box-vile{
  border: 1px solid #e0d9d9;
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
</style>
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
      <h3>Tour Categories</h3>
      <hr>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
          <ul class="list-group">
              <li style="background: red; color: white; text-align: center;" id="get-id" class="list-group-item"><b>Menu</b></li>
              <?php 
                foreach ($tour_categories as $tour_category) 
                {
               ?>
              <li id="get-id" value="<?= $tour_category->id?>" class="list-group-item"> <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike"> <?= $tour_category->name ?></label></li>
              <?php 
                }
               ?>
          </ul>
        </div>
        <div class="col-lg-8 col-md-8 col-sm-12">
          <div class="container-fluid">
            <?php 
              foreach ($tour_items as $item) {
            ?>
            <div class="row item-listing">
              <div id="box-vile" class="container-fluid box-shadow">
                <div class="col-lg-4 col-md-4 col-sm-12">
                  <img src="<?= $item->feature_image == "" || null ? $base_url."/img/empty_img.png" : $item->feature_image ;?>" class="img-item" alt="Tour Category" />
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12"><br>
                  <?= Html::a('<h4 style= "color: red">'.$item->name.'</h4>', ['site/item-detail', 'id' => $item->id], ['class'=>'read-more']) ?>
                  <p><?= $item->tip_note; ?></p>

                  <i class="fa fa-clock-o"></i> Duration: <?= $item->duration. ($item->duration_type == 1 ? " Day" : " Hour");?><br>
                  <?= $item->recommended == 1 ? " <i class='fa fa-check-circle'></i> Recommended" : ""; ?>
                  <h3 class="price"><?= "US$ ".$item->price; ?></h3>

                </div>
              </div>
            </div>
            <?php 
              }
             ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div><br><br>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
<?php
$base_url = Yii::getAlias('@web');
$script = <<< JS
var base_url = "$base_url";

$(document).ready(function(){
  $("li").click(function() {
     var id = $(this).val();
     console.log(id);
     $.ajax({
          url: base_url+'/index.php?r=site/dependent',
          type: 'post',
          data: {
              id: id,
              action: 'get_item'
          },
          success: function(response){ 
              var data = JSON.parse(response);
              console.log(data);
          }
      });
    });
  });

JS;
$this->registerJS($script);
?>

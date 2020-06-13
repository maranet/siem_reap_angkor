<?php 
use yii\helpers\Html;
use backend\models\TourItem;
$base_url = Yii::getAlias('@web');
$this->title = 'Blog Post Detail';
 ?>
<style type="text/css">
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    .product{
        margin: 50px 0px;
    }
    img.img-tour_item {
    object-fit: cover;
    width: 100%;
    height: 250px;
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
    width: 500px;
    padding: 43px;
    text-align: center;
    background: #00000085;
    transform: translate(-50%, -50%);
}
.row.no-pad {
  margin-right:0;
  margin-left:0;
  background-color: #dcdcdc;
}
.row.no-pad > [class*='col-'] {
  padding-right:0;
  padding-left:0;
}
.cover-col {
    color: black;
    text-align: center;
}
span {
    color: black;
}
span:hover{
    color: red;
}
a:focus, a:hover {
    color: red;
    text-decoration: none;
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
button.btn.btn-primary.book-now {
    border-radius: 16px;
    padding-right: 50px;
    padding-left: 50px;
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
/*#ffffff6b*/
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
</style>
<div class="boday-content">
  <div class="containers">
    <div class="row">
    <div class="col-ld-12 col-md-12 col-sm-12">
      <img src="<?= $blog_details->feature_image == "" || null ? $base_url."/img/empty_img.png" : $blog_details->feature_image ;?>" class="img-responsive center" alt="Tour Category" />
      <!-- <div class="text-title">
      <h2>Blog Post</h2>
      </div> -->
    </div>
  </div>
  </div><br>
  <div class="tour_item-listing">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
          <h4><?= $blog_details->name; ?></h4>
          <p style="color: red;"><?= "Post on ".$blog_details->created_date. " By ". $created_by->username; ?></p>
          <p><?= $blog_details->description; ?></p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <ul class="list-group">
              <li style="background: #ff0000b3; color: white; text-align: center;" id="get-id" class="list-group-item"><b>Recent Post</b></li>
              <?php 
              foreach ($blog_recents as $blog_recent) {
                ?>
                <li style="color: black;" id="get-id" class="list-group-item"><?= Html::a($blog_recent->name, ['site/blog-detail', 'id' => $blog_recent->id], ['class'=>'read-more']) ?></li>
              <?php 
                }
               ?>
            </ul>
        </div>
      </div>
    </div>
</div><br><br>
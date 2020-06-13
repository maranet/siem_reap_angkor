<?php 
use yii\helpers\Html;
use backend\models\TourItem;

$base_url = Yii::getAlias('@web');
$this->title = 'Tour Item';
 ?>
<style type="text/css">
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    .snip1369 {
      font-family: 'Raleway', Arial, sans-serif;
      position: relative;
      overflow: hidden;
      margin: auto;
      min-width: 230px;
      max-width: 315px;
      width: 100%;
      background: #000000bd;
      text-align: left;
      color: #ffffff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      font-size: 16px;
      display: inline-block;
    }
    .snip1369 * {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-transition: all 0.3s ease-out;
      transition: all 0.3s ease-out;
    }
    .snip1369 > img,
    .snip1369 .image img {
      -webkit-transform: scale(1.05);
      transform: scale(1.05);
      max-width: 100%;
    }
    .snip1369 > img {
      vertical-align: top;
      position: relative;
      /*-webkit-filter: blur(5px);*/
      /*filter: blur(5px);*/
      opacity: 0.6;
    }
    .snip1369 figcaption,
    .snip1369 .image {
      -webkit-transition-delay: 0.2s;
      transition-delay: 0.2s;
    }
    .snip1369 .image {
      position: absolute;
      top: 0;
      bottom: 25%;
      right: 0;
      left: 0;
      overflow: hidden;
      box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.1), 0px 1px 0 rgba(255, 255, 255, 0.2);
    }
    .snip1369 .image img {
      position: absolute;
      top: 0;
    }
    .snip1369 figcaption {
      position: absolute;
      top: 75%;
      bottom: 46px;
      left: 20px;
      right: 20px;
      border-bottom: 2px solid #ffffff;
      padding-top: 20px;
      z-index: 1;
    }
    .snip1369 h3,
    .snip1369 p {
      margin: 0;
    }
    .snip1369 h3 {
      font-weight: 700;
      margin-bottom: 5px;
      text-transform: uppercase;
    }
    .snip1369 p {
      font-size: 0.9em;
      letter-spacing: 1px;
      font-weight: 400;
      opacity: 0;
    }
    .snip1369 .read-more {
      display: block;
      opacity: 0;
      -webkit-transform: translateX(-20px);
      transform: translateX(-20px);
      line-height: 48px;
      text-transform: lowercase;
      letter-spacing: 1px;
      padding: 0 20px;
      color: #ffffff;
      right: 0;
      bottom: 0;
      font-weight: 500;
      position: absolute;
    }
    .snip1369 a {
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      position: absolute;
      z-index: 1;
    }
    .snip1369:hover .read-more,
    .snip1369.hover .read-more,
    .snip1369:hover figcaption,
    .snip1369.hover figcaption {
      opacity: 1;
      -webkit-transform: translateX(0px);
      transform: translateX(0px);
    }
    .snip1369:hover figcaption,
    .snip1369.hover figcaption,
    .snip1369:hover .image,
    .snip1369.hover .image {
      -webkit-transition-delay: 0s;
      transition-delay: 0s;
    }
    .snip1369:hover figcaption,
    .snip1369.hover figcaption {
      top: 50%;
    }
    .snip1369:hover .image,
    .snip1369.hover .image {
      bottom: 50%;
    }
    .snip1369:hover p,
    .snip1369.hover p {
      opacity: 1;
      -webkit-transition-delay: 0.2s;
      transition-delay: 0.2s;
    }
    .product{
        margin: 50px 0px;
    }
    img.img-tour_item {
    object-fit: cover;
    width: 100%;
    height: 250px;
  }
img.img-responsive.center {
    height: 300px;
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
</style>
<div class="boday-content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <img src="https://cdn.cnn.com/cnnnext/dam/assets/180501104811-lazy-beach-cambodia.jpg" alt="banner tour" class="img-responsive center"/>
        <div class="text-title">
          <h2>TOUR ITEM</h2>
        </div>
      </div>
    </div>
  </div>
  <div class="tour_item-listing">
    <div class="container">
      <h3>Tour Details</h3>
      <hr>
        <div class="row no-pad">
          <div class="col-lg-6 col-md-6 col-sm-12">
            <img style="width: 100%;" src="<?= $tour_category->feature_image == "" || null ? $base_url."/img/empty_img.png" : $tour_category->feature_image ;?>" alt="Tour Feature Image" class="rounded">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="cover-col">
                <h3><?= $tour_category->name ;?> Description</h3>
                <i class="ion-minus-round"></i><i class="ion-minus-round"></i>
                <p><?= $tour_category->description ;?></p>
            </div>
          </div>
        </div>
      <h3>Items</h3>
      <hr>
      <div class="row">
      <?php 
        foreach ($tour_items as $tour_item) {
        ?>
          <div class="col-lg-3 col-md-4 col-sm-6">
            <figure class="snip1369 green">
                  <img src="<?= $tour_item->feature_image == "" || null ? $base_url."/img/empty_img.png" : $tour_item->feature_image ;?>" class="img-tour_item" alt="Tour tour_item" />
                  <div class="image">
                      <img src="<?= $tour_item->feature_image == "" || null ? $base_url."/img/empty_img.png" : $tour_item->feature_image ;?>" class="img-tour_item" alt="Tour tour_item" />
                  </div>
                  <figcaption>
                      <span style="color: white;"><?= $tour_item->name ;?></span>
                  </figcaption>
                    <?= Html::a('<span class="read-more">Read Mores <i class="fa fa-arrow-right"></i>
                      </span>', ['site/item-detail', 'id' => $tour_item->id], ['class'=>'read-more']) ?>
              </figure>
          </div>
        <?php
          }
        ?>
      </div>
      <div class="col-lg-12 col-md-4 col-sm-12">
    <!-- Tour Menu -->
        <h3>Tour Categories</h3>
        <div class="customer-sevice">
            <nav class="desktop-nav">
                <ul id="menu-menu-3" class="menu-list">
                  <?php 
                    foreach ($categories as $category) {
                    ?>
                      <i class="ion-chevron-right"></i> <?= Html::a('<span>'.$category->name.'
                    </span>', ['site/tour-item', 'id' => $category->id], ['class'=>'tour-acive active']) ?> <br>
                    <?php
                      }
                    ?>
                </ul>
            </nav>             
        </div>
    <!-- end tour item -->
  </div>
    </div>
  </div>
</div><br><br>
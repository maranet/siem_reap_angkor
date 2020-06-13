<?php
use yii\widgets\ListView;
use common\models\GlobalFunction;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use backend\models\NewsLetterDashboardSearch;



/* @var $this yii\web\View */

$this->title = 'SAA Tour';

// echo $_SESSION['company_id'];
?>

<div class="site-index">
    <div class="body-content">
        <!-- Home-Slide -->
        <!-- <h5 class="title">Based on Florin-pop's tutorial https://www.florin-pop.com/blog/2019/03/full-page-slider/</h5> -->
        <div class="slider">
            <div class="slider-container">
                <?php 

                    foreach ( $slide_gallery as $key => $value) {
                        if ($key == 0) {
                            $active = "active";
                        }else{
                            $active ="";
                        }

                ?>
                <div class="slide <?= $active?>" style="background-image: url('<?php echo $value['file_path']. $value['file_name']  ?>');">
                    <!-- <div class="info">
                        <h1>Sultanahmet</h1>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum.</p>
                    </div> -->
                </div>
                <?php
                    } 
                ?>
                
            </div>
            <div class="eraser"></div>
            <div class="buttons-container">
                <button id="previous"><i class="fa fa-angle-left" style="font-size: 17px;"></i></i></button>
                <button id="next"><i class="fa fa-angle-right" style="font-size: 17px;"></i></button>
            </div>
        </div>
        <!-- End Home-Slide -->
        <!-- Search Form -->
        <div class="search-form">
            <div class="container">
                <div class="search-field ">
                    <form name="myform" method="GET" action="http://siemreap-angkor.com/">
                        <div class="col-md-3">
                            <select name="product_cat" id="product_cat" class="cate-dropdown hidden-xs form-control">
                                <option value="0" selected="selected">All Categories</option>
                                <option class="level-0 form-control" value="tonle-sap">Tonle Sap</option>
                                <option class="level-0 form-control" value="gala-lunch">Gala Lunch</option>
                                <option class="level-0 form-control" value="tour">Tour</option>
                                <option class="level-0 form-control" value="jungle-trek">Jungle Trek</option>
                                <option class="level-0 form-control" value="temples">Temples</option>
                                <option class="level-0 form-control" value="sunset-cocktails">Sunset Cocktails</option>
                                <option class="level-0 form-control" value="gala-dinner">Gala Dinner</option>
                                <option class="level-0 form-control" value="sunrise-breakfast">Sunrise Breakfast</option>
                                <option class="level-0 form-control" value="sunrise">Sunrise</option>
                                <option class="level-0 form-control" value="festivals">Festivals</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="s" class="form-control" maxlength="128" value="" placeholder="Search Tour Here...">
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="" class="date_picker form-control" id= "from-date" maxlength="128" value="" placeholder="From" >
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="" class="date_picker form-control" id= "to-date" maxlength="128" value="" placeholder="To">  
                        </div>
                        <!-- <input type="hidden" value="product" name="post_type"> -->
                        <div class="col-md-2" style="line-height: 1;">
                            <button type="submit" title="Search" class="search-btn-bg form-control" >Search</button>     
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Search Form -->
        <!-- About us -->
        <div class="about-us" style="padding-top: 20px;">
            <div class="container">
                <div class="head-text">
                    <h4>Siem Reap Adventure Tour</h4>
                    <div style="width: 50px; height: 2px; background-color: #ed008c; margin: 0 auto;"></div>
                </div>  
                <?php 
                    foreach ($company_profile as $key => $value) {
                    
                ?>
                <div class="the-content about-sumary-home">
                    <p><?php echo $value['description']; ?></p>
                </div>
                <?php 
                    }
                ?>
            </div>
        </div>
        <!-- End About us -->
        <!-- Product Listing -->
        <h2>Everybody's Talking</h2>
        <div class="product container-fluid"> 
            <div class="row">
                <div class="col-md-12">
                    <?php 
                        foreach ($items_four as $key => $value) {   
                     ?>
                    <div class="col-md-3 col-xs-6">
                        <figure class="snip1369 green">
                            <img src="<?= $value['feature_image'] ?>" alt="pr-sample15" />
                            <div class="image">
                                <img src="<?= $value['feature_image'] ?>" alt="pr-sample15" />
                            </div>
                            <figcaption>
                                <h3><?= $value['name'] ?></h3>
                                <div class="wrap_tip_note">
                                    <p><?= $value['tip_note'] ?></p>
                                </div>
                            </figcaption>
                                <span class="read-more">Read More <i class="fa fa-arrow-right"></i>
                                </span>
                            <a href="<?= Url::toRoute(['tour-category/index']) ?>"></a>
                        </figure>
                    </div>
                    <?php  
                        }
                     ?>
                </div>
            </div>    
        </div>
        
        <!-- End Product Listing -->
        <!-- Tour Package -->
        <div class="container">
            <section class="city-getaways-container">
                <h2>Most Popular Tours</h2>
                <p >Discover unique experiences in the places everyone wants to visit.</p>
                <div class="wrap-tour-package">
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                                $i = 0;
                                foreach ($categories_get_two as $key => $value) {
                                    $i = $i + 1;
                                    if($i == 2){
                                        $pull_right = "pull-right";
                                    } else{
                                        $pull_right = '';
                                    };
                                
                            ?>
                            <div class="col-md-6 <?=$pull_right;?>">
                                <div class="grid">
                                    <div class="grid__item">
                                        <div class="card">
                                            <img class="card__img" src="<?php echo $value['feature_image'] ?>" alt="Snowy Mountains">
                                            <div class="card__content">
                                                <h3><?php echo $value['name'] ?></h3>
                                                <p class="card__text"><?php echo $value['description'] ?></p>
                                                <a href="<?= Url::toRoute(['tour-category/index']) ?>"><button class="card__btn">See all <span>&rarr;</span></button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-md-6 pull-left">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php 
                                            $items = \backend\models\TourItem::find()->where(['category_id'=>$value['id']])->limit(4)->all();
                                            foreach ($items as $key => $value) {

                                         ?>
                                        <div class="col-md-6">
                                            <figure class="snip1518">
                                                <div class="image"><img src="<?php echo $value['feature_image'] ?>" alt="sample101" /></div>
                                                    <figcaption>
                                                        <h5><?php echo $value['name'] ?></h5>
                                                        <div class="wrap_des">
                                                            <p><?php echo $value['tip_note'] ?></p>    
                                                        </div>
                                                        <footer>
                                                            <div class="date">October 30, 2015</div>
                                                            <div class="icons">
                                                                <div class="views"><i class="fa fa-eye" aria-hidden="true"></i>2,907</div>
                                                                <div class="love"><i class="fa fa-heart" aria-hidden="true"></i></i>623</div>
                                                            </div>
                                                        </footer>
                                                    </figcaption>
                                                    <a href="<?= Url::toRoute(['tour-category/index']) ?>"></a>
                                            </figure>
                                        </div>
                                        <?php 
                                            }
                                         ?>

                                    </div>
                                </div>
                            </div>
                             <?php 
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- End Tour Package -->
        <!-- Visit category -->
        <div class="wrapper">
          <div class="row"> 
            <a href="<?= Url::toRoute(['tour-category/index']) ?>" class="btn-grey">Visit on category</a>
          </div>
        </div>
        <!-- End Visit category -->
        <!-- Keep things flexible -->
        <section class="banner-wide teal has-negative-margin">
            <div class="container">
                <h3 class="title-ktf">Keep things flexible</h3>
                <p class="sub">In case plans change, you can cancel most bookings for free up to 24 hours before they start. If you ever need us, customer service is available 24/7 in multiple languages.</p>
            </div>
        </section>
        <!-- End Keep things flexible -->
        <!-- Map & Contact -->
        <div class="wrap-map-contact">
            <div class="container">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13249.247068040606!2d151.20960562674117!3d-33.8816236491114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1spt-BR!2sbr!4v1468899355787" width="100%" height="650px" frameborder="0" style="border:0; height: 302px;" allowfullscreen></iframe>
                </div>
                <div class="contact-form">
                    <h1 class="title-contact">Contact Us</h1>
                    <form action="">
                        <input type="text" class="form-control" name="name" placeholder="Your Name" />
                        <input type="email" class="form-control" name="e-mail" placeholder="Your E-mail Adress" />
                        <input type="tel" class="form-control" name="phone" placeholder="Your Phone Number"/>
                        <textarea name="text" class="form-control" id="" rows="8" placeholder="Your Message" style="height: 80px;"></textarea>
                        <button class="btn-send form-control">Get a Call Back</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Map & Contact -->
        <!-- Subscript Email-->
        <div class="subcript" style="background-image: url('http://siemreap-angkor.com/wp-content/uploads/2020/03/wine-1952051_960_720.jpg');">
            <div class="overlay-background">
                <div class="container">
                    <div class="wrap-newletters">
                        <h4>Whis you are there</h4>
                        <p>Signup for our newsletter and discover travel experiences you'll really want to try.</p>
                        <div class="tnp tnp-subcription subcript-box">
                        <form method="post" action="http://localhost/getsiemreaptour/?na=s" onsubmit="return newsletter_check(this)">
                            <input type="hidden" name="nlang" value="">
                            <div class="custom-submit">
                                <div class="tnp-field tnp-field-email">
                                    <input class="tnp-email email" type="email" placeholder="Email" name="ne" required="">
                                </div>
                                <div class="tnp-field tnp-field-button">
                                    <input class="tnp-submit subcript-button" type="submit" value="Subscript">
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
        <!-- End Subscript Email-->

    </div>
</div>
<style type="text/css">
    /*.wrap .container{
        padding: 0!important;
        margin: 0;
        width: 100%;
    }*/
    .wrap_des {
        height: 49px;
        overflow: hidden;
    }
    .wrap_tip_note {
        height: 100px;
        overflow: hidden;
    }
    .card__content h3{
        color: #324f9a;
        font-size: 21px !important;
        text-align: center;
    }
    .news_img{
        /*height: 200px;*/
        position: relative;
        margin-bottom: 20px;
    }
    .news_img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .wr-summary-news,.wr-summary-sale{
        list-style: none;
        padding-left: 0px;
    }
    .wr-summary-sale li, a label{
        font-size: 15px;
        color: #2b3d50;
        font-weight: 700;
    }
    .wr-summary-news i{
        color: #505354;
        font-size: 15px;
        float: right;
        margin-top: 6px;
    }
    a label,img {
        cursor: pointer;
    }
    .wr-list-news .content{
        display: block;/* or inline-block */
        text-overflow: ellipsis;
        word-wrap: break-word;
        overflow: hidden;
        max-height: 10.6em;
        line-height: 1.8em;

    }
    .text-semibold, .text-sm {
        width: auto;
    }
    .progress {
        height: 15px;
    }
    .panel {
        margin-bottom: 0px;
    }
    .wr-list-news{
        padding-bottom: 10px;
        border-bottom: 8px solid #f5f8fa;
        margin-bottom: 15px;
    }
    .wrapper .container{
        padding:0 !important;
    }
    .nav-tabs{
        margin-top: 18px;
    }
    h3 {
        font-size: 18px !important;
    }
    ul.nav.nav-tabs li {
        width: 150px;
        text-align: center;
    }
/*--------Home-slide------*/
    @import url('https://fonts.googleapis.com/css?family=Raleway');

    * {
        box-sizing: border-box;
    }

    /*body {
        font-family: 'Raleway';
        margin: 0;
    }*/

    .title {
        background: rgba(255, 255, 255, 0.7);
        color: #333;
        position: fixed;
        text-align: right;
        top: 0;
        right: 0;
        padding: 10px 15px;
        margin: 0;
        z-index: 100;
    }

    .slider {
        position: relative;
        overflow: hidden;
        height: 80vh;
        width: 100%;
    }

    .slide {
        background-position: center center;
        background-size: cover;
        position: absolute;
        top: 0;
        left: 100%;
        height: 100%;
        width: 100%;
    }

    .slide.active {
        transform: translateX(-100%);
    }

    .slide .info {
        background-color: rgba(255, 255, 255, 0.7);
        color: #333;
        padding: 20px 15px;
        position: absolute;
        opacity: 0.1;
        top: 80px;
        left: 40px;
        text-align: center;
        width: 300px;
        max-width: 100%;
    }

    .slide.active .info{
        opacity: 1;
        transform: translateY(-40px);
        transition: all 0.5s ease-in-out 0.8s;
    }

    .slide .info h1 {
        margin: 10px 0;
    }

    .slide .info p {
        letter-spacing: 1px;
    }

    .eraser {
        background: #f5f5f5;
        position: absolute;
        transition: transform 0.5s ease-in-out;
      opacity: 0.95;
        top: 0;
        left: 100%;
        height: 100%;
        width: 100%;
        z-index: 100;
    }

    .eraser.active {
        transform: translateX(-100%);
    }

    .buttons-container {
        position: absolute;
        bottom: 50px;
        right: 60px;
    /*   display: flex; */
      
    }

    .buttons-container button {
        border: 2px solid #fff;
        background-color: transparent;
        color: #fff;
        cursor: pointer;
        padding: 8px 30px;
      margin-right: 10px;
    }

    .buttons-container button:hover {
        background-color: #fff;
        color: #A9A9A9;
      opacity: 0.9;
    }


    @media (max-width: 400px) {
        .slide .info {
            top: 100px;
            left: 8px;
        }
    } 
/*--------End Home-slide------*/
/*----------Search Form-------*/
    .search-form {
        width: 100%;
        position: relative;
        text-align: center;
    }
    .search-form .search-field {
        position: relative;
        top: -30px;
        text-align: center;
        width: 85%;
        background-color: #ffffffd1;
        padding: 25px;
        box-shadow: 1px 4px 11px -3px #ddd;
        margin: 0 auto;
        border-radius: 6px;
        z-index: 100;
        min-height: 85px;
    }
    .search-form .search-field .cate-dropdown {
        padding: 7px !important;
        border-radius: 4px;
        color: #4f4e4e;
    }
    .search-form .search-field .cate-dropdown .level-0 {
        padding: 6px 0 !important;
        font-size: 15px;
        color: #5f5f5f;
        margin: 6px 0;
        font-family: "Frank Ruhl Libre",serif;
        background-color: #efefef;
    }
    .search-form .search-field .searchbox {
        padding: 5px;
        border-radius: 4px;
        color: #4f4e4e;
        width: 320px;
        margin: 0 20px;
        border: 1px solid #ccc;
    }
    .search-form .search-field .search-btn-bg {
        padding: 11px 25px;
        border-radius: 4px;
        color: #fff;
        background-color: #c71e32;
        border: none;
        font-size: 14px;
        /*width: 100%;*/
        padding: 5px;
    }
/*---------End Search Form----*/
/*---------About us-----------*/
    .about-us {
        padding: 10px 0;
    }
    .about-us .container{
        max-width: 960px;
        margin: auto;
    }
    .head-text {
        margin: 0 auto;
        text-align: center;
        padding-bottom: 24px;
    }
    .head-text h4 {
        width: fit-content;
        padding: 4px 12px;
        border-bottom: 1px solid #c71e32;
        margin: 0 auto;
        font-size: 25px;
        margin-bottom: 1px;
    }
    .the-content {
        padding-top: 25px;
    }
    .about-us .about-sumary-home p {
        text-align: center;
        margin-bottom: 0;
        font-size: 14px;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 5;
    }
    .the-content p {
        font-size: 16px;
        line-height: 27px;
        font-weight: 200;
    }
/*---------End About us-------*/
/*-------Product Listing------*/
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    .snip1369 {
      font-family: 'Raleway', Arial, sans-serif;
      position: relative;
      overflow: hidden;
      margin: auto;
      /*min-width: 230px;
      max-width: 315px;*/
      width: 100%;
      background: #0a212f;
      text-align: left;
      color: #ffffff;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
      font-size: 16px;
      display: inline-block;
      height: 401px;
      width: 100%;
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
        -webkit-filter: blur(5px);
        filter: blur(5px); 
        opacity: 0.6;
        object-fit: cover;
        width: 100%;
        height: 393px;
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
        object-fit: cover;
        width: 100%;
        height: 100%;
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
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 1;
    }
    .snip1369 p {
        font-size: 0.9em;
        letter-spacing: 1px;
        font-weight: 400;
        opacity: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
    .snip1369 .read-more {
      display: block;
      opacity: 0;
      -webkit-transform: translateX(-20px);
      transform: translateX(-20px);
      line-height: 48px;
      text-transform: uppercase;
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
    .product, .wrap-tour-package{
        margin: 50px 0px;
    }
    .product .col-xs-6{
        margin: 11px auto;
    }
    h2{
        text-align: center;
        font-family: inherit;
        color: #555555;
        font-size: 35px;
    }
/*-----End Product Listing----*/
/*---------Tour Package-----------*/

    .city-getaways-container p{
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
    }
    .wrap-tour-package{

    }
    .wrap-tour-package .pull-right{
        /*padding: 0;*/
    }
    .pull-left .col-md-12{
        padding: 0;
    }
    @media (max-width: 60em) {
      body {
        padding: 3rem;
      }
    }
    .grid {
      display: grid;
      /*width: 114rem;*/
      grid-gap: 6rem;
      grid-template-columns: repeat(auto-fit, minmax(30rem, 1fr));
      grid-auto-rows: auto;
      align-items: start;
      margin: 20px 0;
    }
    @media (max-width: 60em) {
      .grid {
        grid-gap: 3rem;
      }
    }
    .grid__item {
      background-color: #fff;
      border-radius: 0.4rem;
      overflow: hidden;
      box-shadow: 0 3rem 6rem rgba(0, 0, 0, 0.1);
      cursor: pointer;
      transition: 0.2s;
    }
    .grid__item .card{
        height: 596px;
    }
    /*.grid__item:hover {
      transform: translateY(-0.5%);
      box-shadow: 0 4rem 8rem rgba(0, 0, 0, 0.2);
    }*/
    .card__img {
      display: block;
      width: 100%;
      height: 38rem;
      object-fit: cover;
      /*margin: 20px 0;*/
    }
    .card__content {
      padding: 4rem 3rem;
    }
    .card__content a{
      text-decoration: none;
    }
    .card__header {
      font-size: 3rem;
      font-weight: 500;
      color: #0d0d0d;
      margin-bottom: 1.5rem;
    }
    .card__text {
        font-size: 1.5rem;
        letter-spacing: 0.1rem;
        line-height: 1.7;
        color: #3d3d3d;
        /*margin-bottom: 2.5rem;*/
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    .card__btn {
        display: block;
        width: 100%;
        padding: 1.5rem;
        font-size: 2rem;
        text-align: center;
        color: #3363ff;
        background-color: #e6ecff;
        border: none;
        border-radius: 0.4rem;
        transition: 0.2s;
        cursor: pointer;
        margin-top: 14px;
    }
    .card__btn span {
      margin-left: 1rem;
      transition: 0.2s;
    }
    .card__btn:hover, .card__btn:active {
      background-color: #dce4ff;
    }
    .card__btn:hover span, .card__btn:active span {
      margin-left: 1.5rem;
    }
    @import url(https://fonts.googleapis.com/css?family=Lato);
    @import url(https://fonts.googleapis.com/css?family=Oswald);
    @import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    .snip1518 {
      font-family: 'Lato', Arial, sans-serif;
      position: relative;
      overflow: hidden;
      /*min-width: 263px;
      max-width: 310px;*/
      width: 100%;
      background-color: #ffffff;
      color: #2B2B2B;
      text-align: center;
      font-size: 16px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
      margin: 20px 0;
      height: 278px;
    }

    .snip1518 * {
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
    }

    .snip1518 img {
        max-width: 100%;
        vertical-align: top;
        position: relative;
        object-fit: cover;
        width: 100%;
        height: 124px;
    }
    .snip1518 figcaption {
      padding: 3%;
      padding-bottom: calc(25%);
      background-color: #ffffff;
    }

    .snip1518 p {
        font-family: 'Oswald';
        text-transform: uppercase;
        font-size: 15px!important;
        font-weight: 400;
        line-height: 24px;
        margin: 3px 0;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2; /* number of lines to show */
    }

    .snip1518 h5 {
      font-weight: 400;
      margin: 0;
      text-transform: uppercase;
      color: #888;
      letter-spacing: 1px;
    }

    .snip1518 footer {
      border-top: 1px solid rgba(0, 0, 0, 0.065);
      padding: 0 20px;
      font-size: 13px;
      line-height: 50px;
      text-align: left;
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
    }

    .snip1518 footer .icons {
      position: absolute;
      right: 20px;
      top: 0;
    }

    .snip1518 footer .icons > div {
      display: inline-block;
      margin-left: 8px;
    }

    .snip1518 footer .icons i {
      display: inline-block;
      margin-right: 5px;
      font-size: 1em;
    }

    .snip1518 a {
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      position: absolute;
      z-index: 1;
    }

/*--------End Tour Package-------*/
/*---------Visit category--------*/
    html .wrapper, body .wrapper {
        width: 100%;
        margin: 0 auto;
        text-align: center;
    }

    html .wrapper .row, body .wrapper .row {
        margin: 32px auto 86px;
    }

    html .wrapper .btn-grey, body .wrapper .btn-grey {
        position: relative;
        border: 6px solid #232323;
        z-index: 2;
        padding: 12px 22px;
        margin: 0 10px;
        box-sizing: border-box;
        font-size: 26px;
        font-weight: 600;
        text-transform: uppercase;
        text-decoration: none;
        color: #232323;
    }

    html .wrapper .btn-grey:hover:before, body .wrapper .btn-grey:hover:before {
        top: 0;
        left: 0;
        width: 102%;
        height: 100%;
    }

    html .wrapper .btn-grey:active:before, body .wrapper .btn-grey:active:before {
        top: -10px;
        left: 18px;
        width: 102%;
        height: 100%;
    }

    html .wrapper .btn-grey:before, body .wrapper .btn-grey:before {
        content: '';
        position: absolute;
        z-index: -1;
        top: 12px;
        left: -14px;
        width: calc(100% + 6px);
        height: calc(100% + 6px);
        background-color: #f9d159;
        transition: all .3s ease;
    }

    html .wrapper .btn-grey:before, body .wrapper .btn-grey:before {
        background-color: #a8a8a1;
    }

/*----------End Visit category---*/
/*-----Keep things flexible------*/
    .banner-wide.has-negative-margin {
        margin-top: -28px;
    }
    .banner-wide.teal {
        background: #4d4e50;
        color: #ffffff;
        margin: 20px 0 65px;
    }
    .banner-wide .container {
        padding: 34px 24px 64px;
        max-width: 1000px;
        text-align: center;
    }
    .banner-wide .container .title-ktf {
        font-size: 66px!important;
        line-height: 7.6rem;
        margin: 1.2em 0 .6em;
    }
    .banner-wide .container .sub {
        font-size: 1.6rem;
        line-height: 2rem;
        font-weight: 500;
        font-weight: 400 !important;
    }
/*---End Keep things flexible----*/
/*--------Map & Contact----------*/
    @import 'https://fonts.googleapis.com/css?family=Libre+Franklin:400,700';

    .wrap-map-contact .container {
        background: #F8F8F8;
        /*width: 900px;*/
        height: 302px;
        margin: 5% auto;
        box-shadow: 0px 0px 10px #C8C7D9;
        position: relative;
        padding: 0;
    }

    .wrap-map-contact .container .map {
        width: 45%;
        float: left;
    }

    .wrap-map-contact .container .contact-form {
        width: 53%;
        /*margin-left: 2%;*/
        float: left;
    }

    .wrap-map-contact .container .contact-form .title-contact {
        font-size: 33px;
        font-family: "Libre Franklin", sans-serif;
        font-weight: 500;
        color: #242424;
        margin: 1% 5%;
    }

    .wrap-map-contact .container .contact-form .subtitle {
        font-size: 1.2em;
        font-weight: 400;
        margin: 0 4% 5% 8%;
        text-align: left;
    }

    .wrap-map-contact .container .contact-form input,
    .wrap-map-contact .container .contact-form textarea {
        width: 330px;
        padding: 1%;
        margin: 1% 6%;
        color: #242424;
        /*border: 1px solid #B7B7B7;*/
        height: 33px;
    }

    .wrap-map-contact .container .contact-form input::placeholder,
    .wrap-map-contact .container .contact-form textarea::placeholder {
        color: #242424;
    }

    .wrap-map-contact .container .contact-form .btn-send {
        background: #313340;
        width: 130px;
        height: 39px;
        color: #F8F8F8;
        font-weight: 400;
        margin: 1% 6%;
        border: none;
    }
/*--------End Map & Contact------*/
/*------Subcript Email----------*/
    .subcript {
        width: 100%;
        height: 360px;
        background-attachment: fixed;
        background-position: bottom;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .subcript .overlay-background {
        padding: 110px;
        width: 100%;
        height: 100%;
        background-color: #00000021;
    }
    .overlay-background .container{
        max-width: 1140px;
        margin: auto;
    }
    .subcript .overlay-background .wrap-newletters {
        text-align: center;
    }
    .subcript .overlay-background .wrap-newletters h4 {
        color: #fff;
        font-family: "Frank Ruhl Libre",serif;
        font-size: 26px;
    }
    .subcript .overlay-background .wrap-newletters p {
        color: #fff;
        font-size: 13px;
    }
    .subcript .overlay-background .wrap-newletters .subcript-box {
        text-align: left;
    }
    .tnp-subcription {
        font-size: 13px;
        display: block;
        margin: 15px auto;
        max-width: 500px;
        width: 100%;
    }
    .subcript .overlay-background .wrap-newletters .subcript-box .custom-submit {
        display: inline-flex;
    }
    .tnp-subcription div.tnp-field {
        margin-bottom: 10px;
        border: 0;
        padding: 0;
    }
    .subcript .overlay-background .wrap-newletters .subcript-box .custom-submit .email {
        width: 378px;
        height: unset;
        padding: 12px;
        font-size: 16px;
        border: 1px;
        line-height: normal;
        border-radius: 3px;
    }
    .tnp-subcription div.tnp-field {
        margin-bottom: 10px;
        border: 0;
        padding: 0;
    }
    .subcript .overlay-background .wrap-newletters .subcript-box .custom-submit .subcript-button {
        margin-left: 20px;
        padding: 12px 30px;
        font-size: 16px;
        color: #fff;
        background-color: #c71e32;
        border: 1px;
        line-height: normal;
        border-radius: 3px;
    }
/*-----End Subcript Email----------*/

    @media only screen and (max-width: 600px) {
        .slider {
            position: relative;
            overflow: hidden;
            height: 50vh;
            width: 100%;
        }
        .buttons-container {
            position: absolute;
            bottom: 50px;
            right: 28px;
            /* display: flex; */
        } 
        .hidden-xs {
             display: block !important; 
        }   
        .snip1369 {
            font-family: 'Raleway', Arial, sans-serif;
            position: relative;
            overflow: hidden;
            width: 100%;
            background: #0a212f;
            text-align: left;
            color: #ffffff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            display: inline-block;
            margin: 15px auto;
            height: 210px;
        }
        .snip1369 > img {
            vertical-align: top;
            position: relative;
            -webkit-filter: blur(5px);
            filter: blur(5px);
            opacity: 0.6;
            object-fit: cover;
            width: 100%;
            height: 210px;
        }
        .snip1369 h3 {
            font-weight: 700;
            margin-bottom: 5px;
            text-transform: uppercase;
            font-size: 10px!important;
        }
        .snip1369 p {
            font-size: 0.9em;
            letter-spacing: 1px;
            font-weight: 400;
            opacity: 0;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            font-size: 8px;
        }
        .snip1369 .read-more {
            display: block;
            opacity: 0;
            -webkit-transform: translateX(-20px);
            transform: translateX(-20px);
            line-height: 48px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #ffffff;
            right: 25px;
            bottom: -5px;
            font-weight: 500;
            position: absolute;
            font-size: 9px;
            padding: 0;
        }
        .snip1369:hover figcaption, .snip1369.hover figcaption {
            top: 44%;
        }
        .snip1369 figcaption {
            position: absolute;
            /*top: 75%;*/
            bottom: 40px;
            left: 19px;
            right: 20px;
            border-bottom: none;
            padding-top: 20px;
            z-index: 1;
        }
        .product, .wrap-tour-package {
            margin: 50px 0px;
            padding: 0;
        }
        .grid {
            grid-gap: 0;
            display: grid;
            grid-template-columns: none;
        }
        .card__img {
            display: block;
            width: 100%;
            height: 23rem;
            object-fit: cover;
            /* margin: 20px 0; */
        }
        .grid__item .card {
            height: 460px;
        }
        .card__content {
            padding: 2rem 2rem;
        }
        html .wrapper .btn-grey, body .wrapper .btn-grey {
            position: relative;
            border: 6px solid #232323;
            z-index: 2;
            padding: 12px 22px;
            margin: 0 10px;
            box-sizing: border-box;
            font-size: 20px;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none;
            color: #232323;
        }
        .banner-wide .container .title-ktf {
            font-size: 28px!important;
            line-height: 7.6rem;
            margin-top: 0;
        }
        .subcript {
            width: 100%;
            height: 244px;
            background-attachment: fixed;
            background-position: bottom;
            background-repeat: no-repeat;
            background-size: cover;
        }
        .subcript .overlay-background {
            padding: 0; 
            width: 100%;
            height: 100%;
            background-color: #00000021;
        }
        .subcript .overlay-background .wrap-newletters h4 {
            color: #fff;
            font-family: "Frank Ruhl Libre",serif;
            font-size: 29px;
        }
        .subcript .overlay-background .wrap-newletters p {
            color: #fff;
            font-size: 18px;
        }
        .subcript .overlay-background .wrap-newletters .subcript-box .custom-submit .email {
            width: 283px;
            height: unset;
            padding: 10px;
            font-size: 16px;
            border: 1px;
            line-height: normal;
            border-radius: 3px;
        }
        .subcript .overlay-background .wrap-newletters .subcript-box .custom-submit .subcript-button {
            margin-left:0;
            padding: 12px 30px;
            font-size: 16px;
            color: #fff;
            background-color: #c71e32;
            border: 1px;
            line-height: normal;
            border-radius: 3px;
            position: relative;
            top: 48px;
            right: 206px;
        }
        .wrap-map-contact .container .contact-form .title-contact {
            font-size: 17px;
            font-family: "Libre Franklin", sans-serif;
            font-weight: 500;
            color: #242424;
            margin: 6px 9px;
        }
        .wrap-map-contact .container .contact-form input, .wrap-map-contact .container .contact-form textarea {
            width: 146px;
            padding: 4px;
            margin: 7px 9px;
            color: #242424;
            /* border: 1px solid #B7B7B7; */
            height: 23px;
            font-size: 10px;
        }
        .wrap-map-contact .container .contact-form .btn-send {
            background: #313340;
            width: 107px;
            height: 29px;
            color: #F8F8F8;
            font-weight: 400;
            margin: 9px 11px;
            border: none;
            font-size: 11px;
        }
        .banner-wide.teal {
            background: #4d4e50;
            color: #ffffff;
            margin: 10px 0 35px;
        }
        .wrap-map-contact .container {
            background: #F8F8F8;
            /* width: 900px; */
            height: 302px;
            box-shadow: 0px 0px 10px #C8C7D9;
            position: relative;
            padding: 0;
            margin: 35px auto;
        }
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
<script type="text/javascript">
    const slides = document.querySelectorAll('.slider-container .slide'); // get all the slides
    const eraser = document.querySelector('.eraser'); // the eraser
    const prev = document.getElementById('previous'); // previous button
    const next = document.getElementById('next'); // next button
    const intervalTime = 6000; // time until nextSlide triggers in miliseconds
    const eraserActiveTime = 500; // time to wait until the .eraser goes all the way
    let sliderInterval; // variable used to save the setInterval and clear it when needed


    const nextSlide = () => {
      // Step 1. Add the .active class to the eraser - this will trigger the eraser to move to the left.
        eraser.classList.add('active');
       // Step 2. Set a timeout that will allow the eraser to move all the way to the left. This is where we'll use the eraserActiveTime - it has to be the same as the CSS value we mentioned above.
        setTimeout(() => {
        // Step 3. Get the active .slide and toggle the .active class on it (in this case, remove it).
            const active = document.querySelector('.slide.active');
            active.classList.toggle('active');
        // Step 4. Check to see if the .slide has a next element sibling available. If it has, add the .active class to it.
            if(active.nextElementSibling) {
                active.nextElementSibling.classList.toggle('active');
            } else {
          // Step 5. If it's the last element in the list, add the .active class to the first slide (the one with index 0).
                slides[0].classList.toggle('active');
            }
        // Step 6.Remove the .active class from the eraser - this will trigger the eraser to move back to the right. It also waits 200 ms before doing this (just to give enough time for the next .slide to move in place).
            setTimeout(() => {
                eraser.classList.remove('active');
            }, 180);
        }, eraserActiveTime);
    }

    //Button functionality
    const prevSlide = () => {
        eraser.classList.add('active');
        setTimeout(() => {
            const active = document.querySelector('.slide.active');
            active.classList.toggle('active');
        // The *changed* part from the nextSlide code
            if(active.previousElementSibling) {
                active.previousElementSibling.classList.toggle('active');
            } else {
                slides[slides.length-1].classList.toggle('active');
            }
        // End of the changed part
            setTimeout(() => {
                eraser.classList.remove('active');
            }, 180);
        }, eraserActiveTime);
    }

    next.addEventListener('click', () => {
        nextSlide();
        clearInterval(sliderInterval);
        sliderInterval = setInterval(nextSlide, intervalTime);
    });

    prev.addEventListener('click', () => {
        prevSlide();
        clearInterval(sliderInterval);
        sliderInterval = setInterval(nextSlide, intervalTime);
    });

    sliderInterval = setInterval(nextSlide, intervalTime);

    // Initial slide
    setTimeout(nextSlide, 500);

    /* Demo purposes only */
    $(".hover").mouseleave(
      function () {
        $(this).removeClass("hover");
      }
    );

</script>



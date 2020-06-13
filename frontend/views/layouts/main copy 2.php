<!-- frontend views/layouts/main.php -->


<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   
<!-- Navigation --> 
    <?php
    NavBar::begin([
        'brandLabel' => '',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Our Distination', 'url' => ['/country/index']],
        ['label' => 'Travel Style', 'url' => ['/travel-style-cagetory/index']],
        ['label' => 'Inspire', 'url' => ['/inspiration/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        // $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?> 

<!-- End Navigation -->
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div> 
<!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="footer-head-text">
                        <h5>Contact Us</h5>
                    </div>
                    <div class="contact-info">
                        <div class="address">
                            <p>Street 13, Treang Village, Slor Kram Commune, Krong Siem Reap, Cambodia</p>
                        </div>
                    </div>
                    <div class="social-wrapper">
                        <div class="social">
                             <a href=""><i class="fa fa-facebook"></i></a>
                             <a href=""><i class="fa fa-instagram"></i></a>
                             <a href=""><i class="fa fa-twitter"></i></a>
                             <a href=""><i class="fa fa-linkedin"></i></a>
                        </div>  
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-head-text">
                        <h5>Cusomer Service</h5>
                    </div>
                    <div class="contact-info">
                        <div class="phone">
                            <p style="margin-bottom: 4px;">Call</p>
                                <a href="tel:(+855) 90 49 39 90">
                                (+855) 90 49 39 90
                                </a>
                                <a href="tel:(+855) 12 22 33 44">
                                (+855) 12 22 33 44
                                </a>
                        </div>
                        <div class="email">
                            <p style="margin-bottom: 4px;">Email</p>
                            <a href="mailto:sainangreall99@gmail.con">
                                sainangreall99@gmail.con
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="footer-head-text">
                        <h5>Usefull link</h5>
                    </div>
                    <div class="customer-sevice">
                        <nav class="desktop-nav">
                            <ul id="menu-menu-3" class="menu-list">
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-22 current_page_item menu-item-105"><a href="#" aria-current="page">Home</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112"><a href="#">Tour</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-106"><a href="#">About Us</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-109"><a href="#">Contact Us</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-136"><a href="#">Blog</a>
                                </li>
                                <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-301"><a href="#">Gallery</a>
                                </li>
                            </ul>
                        </nav>             
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- End Footer -->
</div>
<!-- <?php $this->endBody() ?> -->
</body>
</html>
<?php $this->endPage() ?>
<style type="text/css">
    .header .container{
        width: 1170px;
        margin: auto;
    }
    .header {
        padding: 4px 0;
        z-index: 990;
        width: 100%;
        position: sticky;
        left: 0;
        top: 0;
        background-color: #fff;
        box-shadow: 0px 0px 16px -5px #d3d3d3;
    }
    .header .logo img {
        width: 100%;
        height: 70px;
        object-fit: contain;
    }
    .header .menu {
        padding: 22px 0;
    }
    .header .menu ul {
        margin: 0;
        padding: 0;
        display: inline-flex;
        list-style-type: none;
    }
    .header .menu ul li {
        padding: 4px 6px;
    }
    .header .menu ul .current_page_item a {
        color: #c71e32;
    }
    .header .menu ul li a {
        padding: 4px 18px;
        text-decoration: none;
        color: #282828;
        font-size: 15px;
    }
    .footer {
        padding: 50px 0;
        background-color: #fff;
        box-shadow: 0px 0px 16px -5px #d3d3d3;
    }
    .footer-head-text {
        padding-bottom: 16px;
        padding-top: 35px;
    }
    .footer-head-text h5{
        color: #282828;
        font-weight: 300;
        font-size: 22px;
    }
    .footer .contact-info .address p {
        font-size: 13px;
        color: #434343;
        margin-bottom: 6px;
    }
    .footer .contact-info .phone a {
        font-size: 13px;
        color: #434343;
        text-decoration: none;
        display: block;
        margin-bottom: 6px;
    }
    .footer .contact-info .email a {
        font-size: 13px;
        color: #434343;
        text-decoration: none;
        margin-bottom: 6px;
    }
    .footer .contact-info .email a::before {
        content: "";
        font-family: "fontawesome";
        padding-right: 12px;
        font-size: 16px;
    }
    .footer .contact-info .phone a::before {
        content: "";
        font-family: "fontawesome";
        padding-right: 12px;
        font-size: 16px;
    }
    .footer .contact-info .address p::before {
        content: "\f041";
        font-family: "fontawesome";
        padding-right: 12px;
        font-size: 16px;
    }
    .footer .social-wrapper {
        width: 100%;
        text-align: left;
        padding: 12px 0;
    }
    .footer .social-wrapper .social {
        display: inline-flex;
    }
    .footer .social-wrapper .social a:first-child {
        padding-left: 0;
        margin-left: 0;
    }
    .footer .social-wrapper .social a {
        color: #434343;
        padding: 4px;
        font-size: 20px;
        text-decoration: none;
        margin: 0 6px;
    }
    .footer .customer-sevice ul {
        margin: 0;
        padding: 0;
        list-style-type: none;
    }
    li,p,a {
        font-family: "Roboto",sans-serif;
        font-size: 15px;
    }
    .footer .customer-sevice ul li a {
        color: #434343;
        text-decoration: none;
        font-size: 13px;
        transition: .5s;
    }
    .footer .customer-sevice ul li a::before {
        content: "";
        font-family: "fontawesome";
        padding-right: 12px;
        font-size: 16px;
    }
    * h5{
        font-family: "Frank Ruhl Libre",serif;
    }
    .open-nav-icon{
        display: none;
    }

</style>

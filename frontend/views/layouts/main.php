<?php
 
Yii::$app->log->targets['debug'] = null;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use frontend\models\TourItemCard;

$base_url =  Yii::getAlias('@web');
$backend_url = [];
$company_info = backend\models\CompanyProfile::find()->where(['id' => 1])->one();
AppAsset::register($this);

$count_tour_item = TourItemCard::find()->where(['session_id'=>session_id()])->count();

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web')?>/img/fav.png" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<style>
#mc_embed_signup form{padding:0px !important; }
} 
@media only screen and (max-width: 600px) {
  .navbar-brand>img {
    display: block;
    position: absolute;
    padding: 10px;
    left: 0px;
    width: 200px;
    top: 0;
    }
}

</style>
<body>
<?php $this->beginBody() ?>
<?php 
    $company_info = \backend\models\CompanyProfile::find()->where(['id'=>1])->one();
    $base_url = Yii::getAlias('@web')."/";

    $company_profile = \backend\models\CompanyProfile::find()->where(['id'=>1])->all();
 ?>

<div class="wrap ">
        <?php
        NavBar::begin([
            'brandLabel' => '<img src="'.$company_info->feature_image.'" class= "img-logo" alt="logo">',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'Tour', 'url' => ['/allotment/index']],
            ['label' => 'About Us', 'url' => ['/site/about-us']],
            ['label' => 'Contact Us', 'url' => ['/site/contact']],
            ['label' => 'Gallery', 'url' => ['/site/gallery']],
            ['label' => 'Cart', 'url' => ['/booking/index']],
            ['label' => 'Blog', 'url' => ['/site/blog']],
            // ['label' => 'Book', 'url' => ['/booking/index']],
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
        if ($count_tour_item != 0) {
            echo "<span class='number-cart'>".$count_tour_item."</span>";        
        }
        NavBar::end();
        ?> 

    <div class="wr-content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<!-- Footer -->

<!-- <div class="footer">
    <div class="container">
        <div class="row">
            <?php 
                foreach ($company_profile as $key => $value) {
                    
            ?>
            <div class="col-md-4">

                <div class="footer-head-text">
                    <h5>Contact Us</h5>
                </div>
                <div class="contact-info">
                    <div class="address">
                        <p><?= $value['address']?></p>
                    </div>
                </div>
                <div class="social-wrapper">
                    <div class="social">
                         <a href="<?= $value['link_facebook'] ?>" target = "_blank"><i class="fa fa-facebook"></i></a>
                         <a href="<?= $value['link_instagram'] ?>" target = "_blank"><i class="fa fa-instagram"></i></a>
                         <a href="<?= $value['link_twitter'] ?>" target = "_blank"><i class="fa fa-twitter"></i></a>
                         <a href="<?= $value['link_linkedin'] ?>" target = "_blank"><i class="fa fa-linkedin"></i></a>
                    </div>  
                </div>
            </div>
            <div class="col-md-4">
                <div class="footer-head-text">
                    <h5>Customer Service</h5>
                </div>
                <div class="contact-info">
                    <div class="email">
                        <p style="margin-bottom: 4px;">Email</p>
                        
                        <a href="">
                            <?= $value['general_email']?>
                        </a>

                    </div>
                </div>
            </div>
            <?php 
                }

            ?>
            <div class="col-md-4">
                <div class="footer-head-text">
                    <h5>Useful link</h5>
                </div>
                <div class="customer-sevice">
                    <nav class="desktop-nav">
                        <ul id="menu-menu-3" class="menu-list">
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-22 current_page_item menu-item-105"><a href="<?php echo $base_url ?> " aria-current="page">Home</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-112"><a href="<?php echo $base_url ?>index.php?r=tour-category">Tour</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-106"><a href="<?php echo $base_url ?>index.php?r=site/about-us">About Us</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-109"><a href="<?php echo $base_url ?>index.php?r=site/contact">Contact Us</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-136"><a href="<?php echo $base_url ?>index.php?r=site/blog">Blog</a>
                            </li>
                            <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-301"><a href="<?php echo $base_url ?>index.php?r=site/gallery">Gallery</a>
                            </li>
                        </ul>
                    </nav>             
                </div>
            </div>
        </div>
    </div>
</div> -->

<!-- End Footer -->

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left col-md-6 col-xs-12">&copy; Siem Reap Angkor - Adventures 2019 - <?= date('Y') ?></p>

        <p class="pull-right col-md-6 col-xs-12">Powered By: <a href="http://eocambo.com" target="_blank">eOcambo Technology</a></p>
    </div>
</footer> -->

<!-- Footer getyourguide -->
<div class="page-footer">
    <div class="page-footer__content">
        <nav class="navigation page-footer__navigation">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <form class="navigation__item navigation__item-section_preferences">
                                <fieldset title="Select Language" class="navigation__item-selector-container navigation__item-selector--language">
                                    <label for="footer-language-selector" class="navigation__item-label"> Language </label> 

                                    <div id="google_translate_element"></div>
                                    <svg style = "top: 68%;" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="navigation__item-selector-arrow icon svg-inline--fa fa-chevron-down fa-w-16"><path fill="currentColor" d="M22.5 11.67l-8 8q-.22.2-.5.2t-.48-.2l-8-8q-.2-.2-.2-.5t.2-.48L7.3 8.9q.2-.2.5-.2t.47.2L14 14.65l5.73-5.73q.2-.2.48-.2t.5.2l1.8 1.8q.2.2.2.48t-.2.5z" class=""></path></svg>
                                </fieldset> 
<!--                                 <fieldset title="Select Currency" class="navigation__item-selector-container navigation__item-selector--currency">
                                    <label for="footer-currency-selector" class="navigation__item-label"> Currency </label> 
                                    <div class="navigation__item-selector-select-field">
                                        <select id="footer-currency-selector" name="footer-currency-selector" class="navigation__item-selector">
                                            <option value="AED">UAE Dirham (د.إ)
                                            </option><option value="ARS">
                                                Argentine Peso (AR$)
                                            </option><option value="AUD">
                                                Australian Dollar (A$)
                                            </option><option value="BGN">
                                                Bulgarian Lev (лв)
                                            </option><option value="CAD">
                                                Canadian Dollar (C$)
                                            </option><option value="CHF">
                                                Swiss Franc (CHF)
                                            </option><option value="CLP">
                                                Chilean Peso (CL$)
                                            </option><option value="CNY">
                                                Chinese Yuan (RMB¥)
                                            </option><option value="COP">
                                                Colombian Peso (COL$)
                                            </option><option value="CZK">
                                                Czech Koruna (Kč)
                                            </option><option value="DKK">
                                                Danish Krone (DKK)
                                            </option><option value="EGP">
                                                Egyptian Pound (E£)
                                            </option><option value="EUR">
                                                Euro (€)
                                            </option><option value="GBP">
                                                British Pound (£)
                                            </option><option value="HKD">
                                                Hong Kong Dollar (HK$)
                                            </option><option value="HRK">
                                                Croatian Kuna (kn)
                                            </option><option value="HUF">
                                                Hungarian Forint (Ft)
                                            </option><option value="IDR">
                                                Indonesian Rupiah (Rp)
                                            </option><option value="ILS">
                                                Israeli New Shekel (₪)
                                            </option><option value="INR">
                                                Indian Rupee (₹)
                                            </option><option value="JPY">
                                                Japanese Yen (¥)
                                            </option><option value="KRW">
                                                South Korean Won (₩)
                                            </option><option value="MAD">
                                                Moroccan Dirham (د.م)
                                            </option><option value="MXN">
                                                Mexican Peso (MXN)
                                            </option><option value="MYR">
                                                Malaysian Ringgit (RM)
                                            </option><option value="NOK">
                                                Norwegian Krone (NOK)
                                            </option><option value="NZD">
                                                New Zealand Dollar (NZ$)
                                            </option><option value="PHP">
                                                Philippine Peso (₱)
                                            </option><option value="PLN">
                                                Polish Złoty (zł)
                                            </option><option value="RON">
                                                Romanian Leu (lei)
                                            </option><option value="RUB">
                                                Russian Ruble (₽)
                                            </option><option value="SEK">
                                                Swedish Krona (SEK)
                                            </option><option value="SGD">
                                                Singapore Dollar (S$)
                                            </option><option value="THB">
                                                Thai Baht (฿)
                                            </option><option value="TRY">
                                                Turkish Lira (₺)
                                            </option><option value="UAH">
                                                Ukrainian Hryvnia (₴)
                                            </option><option selected="selected" value="USD">
                                                U.S. Dollar (US$)
                                            </option><option value="UYU">
                                                Uruguayan Peso ($U)
                                            </option><option value="VND">
                                                Vietnamese Dong (₫)
                                            </option><option value="ZAR">
                                                South African Rand (R)
                                            </option>
                                        </select> 
                                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="navigation__item-selector-arrow icon svg-inline--fa fa-chevron-down fa-w-16"><path fill="currentColor" d="M22.5 11.67l-8 8q-.22.2-.5.2t-.48-.2l-8-8q-.2-.2-.2-.5t.2-.48L7.3 8.9q.2-.2.5-.2t.47.2L14 14.65l5.73-5.73q.2-.2.48-.2t.5.2l1.8 1.8q.2.2.2.48t-.2.5z" class=""></path></svg>
                                    </div>
                                </fieldset> -->
                            </form>

                        </div>
                        <div class="col-md-3">
                            <div class="navigation__item navigation__item-section_support">
                                 
                                <label for="navigation__item-section_support-trigger" class="navigation__item-label"> Contact Us </label> 
                                <input type="checkbox" id="navigation__item-section_support-trigger" class="navigation__item-trigger navigation__item-section_support-trigger"> 
                                <?php
                                    foreach ($company_profile as $key => $value) {
                                ?>
                                <ul class="navigation__item-list">
                                    <li class="navigation__item-list-item">
                                        <div class="email">
                                            <a href="">
                                                 <i class="fa fa-chevron-right"></i> Email: <?= $value['general_email']?>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="navigation__item-list-item">
                                        <div class="address">
                                            <p><i class="fa fa-chevron-right"></i> Address: <?= $value['address']?></p>
                                        </div>
                                    </li> 
                                </ul>
                                <?php 
                                    }
                                ?>
                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="navigation__item navigation__item-section_company">
                                <label for="navigation__item-section_company-trigger" class="navigation__item-label"> Company </label> 
                                <input type="checkbox" id="navigation__item-section_company-trigger" class="navigation__item-trigger navigation__item-section_company-trigger"> 
                                <ul class="navigation__item-list">
                                    <li class="navigation__item-list-item">
                                        <a href="<?php echo $base_url ?> " aria-current="page"> Home </a>
                                    </li> 
                                    <li class="navigation__item-list-item">
                                        <a href="<?php echo $base_url ?>index.php?r=allotment"> Tour </a>
                                    </li> 
                                    <li class="navigation__item-list-item">
                                        <a href="<?php echo $base_url ?>index.php?r=site/about-us"> About Us </a>
                                    </li> 
                                    <li class="navigation__item-list-item">
                                        <a href="<?php echo $base_url ?>index.php?r=site/contact"> Contact Us </a>
                                    </li> 
                                    <li class="navigation__item-list-item">
                                        <a href="<?php echo $base_url ?>index.php?r=site/blog"> Blog</a>
                                    </li> 
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="navigation__item navigation__item-section_work_with_us">

                                <div class="navigation__item-section_ways_you_can_pay">
                                    <label for="navigation__item-section_ways_you_can_pay" class="navigation__item-label"> Ways You Can Pay 
                                    </label> 
                                    <div class="navigation__item-section_ways_you_can_pay-images">
                                        <div>
                                            <img alt="Paypal" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/paypal_border.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/paypal_border.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Mastercard" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/mastercard.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/mastercard.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Visa" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/visa.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/visa.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="maestro" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/maestro.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/maestro.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="American Express" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/amex.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/amex.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Bancontact" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/bancontact.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/bancontact.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Jcb" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/jcb.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/jcb.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Discover" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/discover.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/discover.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Sofort" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/sofort.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/sofort.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Klarna" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/klarna.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/klarna.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Google Pay" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/googlepay.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/googlepay.svg" lazy="loaded">
                                        </div>
                                        <div>
                                            <img alt="Apple Pay" class="navigation__item-section_ways_you_can_pay-image" data-src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/applepay.svg" src="https://cdn.getyourguide.com/tf/assets/static/payment-methods/applepay.svg" lazy="loaded">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="container" style="margin-top: 20px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <p class="navigation__item navigation__item-section_copyright">
                                <span> © <time> 2019 </time> – <time> <?= date('Y') ?> </time> Siem Reap Angkor - Adventures. Power By <a href="http://eocambo.com" target="_blank">eOcambo Technology</a>.</span>
                            </p> 
                        </div>
                        <div class="col-md-6">
                            <?php 
                                foreach ($company_profile as $key => $value) {
                                    
                            ?>
                            <div class="navigation__item navigation__item-section_social_media">
                                <a href="<?= $value['link_facebook'] ?>" target = "_blank" title="Facebook" class="navigation__item-section_social_media-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="facebook" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="icon svg-inline--fa fa-facebook fa-w-16"><path fill="currentColor" d="M21 5.78h-4c-.47 0-1 .62-1 1.46v2.88h5v4.12h-5V26.6h-4.72V14.24H7v-4.12h4.28V7.7c0-3.47 2.4-6.3 5.72-6.3h4v4.38z" class=""></path></svg>

                                <!-- Facebook -->
                                </a> 
                                <a href="<?= $value['link_instagram'] ?>" target = "_blank" title="Instagram" class="navigation__item-section_social_media-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="instagram" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="icon svg-inline--fa fa-instagram fa-w-16"><path fill="currentColor" d="M24.77 28H3.23C1.45 28 0 26.55 0 24.77V3.23C0 1.45 1.45 0 3.23 0h21.54C26.55 0 28 1.45 28 3.23v21.54c0 1.78-1.45 3.23-3.23 3.23zM14 8.62c-2.97 0-5.38 2.4-5.38 5.38s2.4 5.38 5.38 5.38 5.38-2.4 5.38-5.38c0-2.97-2.4-5.38-5.38-5.38zm10.77-4.3c0-.6-.48-1.1-1.08-1.1h-3.26c-.6 0-1.08.5-1.08 1.1v3.22c0 .6.5 1.08 1.08 1.08h3.23c.6 0 1.07-.5 1.07-1.08V4.3zm0 7.53h-2.44c.18.68.28 1.4.28 2.15 0 4.76-3.82 8.62-8.6 8.62S5.4 18.76 5.4 14c0-.74.1-1.47.3-2.15H3.22V23.7c0 .6.48 1.07 1.08 1.07h19.4c.6 0 1.07-.48 1.07-1.08V11.82z" class=""></path></svg>
                                <!-- Instagram -->
                                </a> 
                                <a href="<?= $value['link_twitter'] ?>" target = "_blank" title="Twitter" class="navigation__item-section_social_media-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="twitter" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="icon svg-inline--fa fa-twitter fa-w-16"><path fill="currentColor" d="M26.88 6c-.95.43-1.97.7-3.04.84 1.1-.65 1.93-1.7 2.33-2.92-1.02.6-2.16 1.05-3.36 1.28-.9-1.03-2.3-1.67-3.8-1.67-2.9 0-5.3 2.37-5.3 5.3 0 .4.1.8.2 1.2C9.5 9.8 5.6 7.7 3 4.5c-.46.78-.7 1.7-.7 2.66 0 1.83.9 3.45 2.33 4.4a5.22 5.22 0 01-2.4-.67c0 2.53 1.83 4.7 4.24 5.2-.44.1-.9.2-1.4.2-.33 0-.66-.08-1-.1.7 2.1 2.64 3.6 4.95 3.62-1.8 1.4-4.1 2.26-6.56 2.26-.43 0-.85-.03-1.26-.08 2.34 1.5 5.12 2.36 8.1 2.36 9.72 0 15.04-8.05 15.04-15v-.7c1-.7 1.9-1.67 2.6-2.7z" class=""></path></svg>
                                <!-- Twitter -->
                                </a> 
                                <a href="<?= $value['link_linkedin'] ?>" target = "_blank" title="LinkedIn" class="navigation__item-section_social_media-icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="linkedin" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 28 28" class="icon svg-inline--fa fa-linkedin fa-w-16"><path fill="currentColor" d="M7.1 4.27c0 1.5-1.1 2.7-2.9 2.7-1.7 0-2.8-1.2-2.8-2.7 0-1.52 1.13-2.7 2.87-2.7s2.8 1.18 2.84 2.7zM1.55 26.42V9.1h5.4v17.3h-5.4zm8.6-11.8c0-2.16-.06-3.97-.13-5.53h4.7l.24 2.4h.1c.7-1.15 2.45-2.8 5.36-2.8 3.54 0 6.2 2.36 6.2 7.46V26.4h-5.4v-9.6c0-2.22-.77-3.75-2.72-3.75-1.5 0-2.37 1.03-2.76 2.02-.15.36-.18.85-.18 1.35v10h-5.4v-11.8z" class=""></path></svg>
                                <!-- LinkedIn -->
                                </a>
                            </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>

                </div>
            </div>

        </nav>
    </div>
</div>
<!-- End  Footer getyourguide-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<style type="text/css">
    .goog-logo-link{
        display: none;
    }
    .goog-te-gadget{
        color: #c72034;
        height: 40px;
        overflow: hidden;
    }
    .number-cart {
        color: white;
        position: absolute;
        right: 18%;
        top: 26%;
        background: #c71e32;
        padding: 0px 5px;
        border-radius: 10px;
        font-size: 10px;
    }
    .navbar-toggle {
        background: #333333ab;
    }
    .navbar-brand>img{
        display: block;
        width: 250px;
        bottom: 12px;
        position: relative;
    }
    .wr-content{
        margin-top: 85px;
    }
    .footer .pull-right{
        text-align: right;
    }
    @media only screen and (max-width: 600px) {
        .footer .pull-right {
            text-align: left;
        }
        .navbar-brand>img {
            display: block;
            width: 250px;
            bottom: 61px;
            right: 60px;
            position: relative;
        }
        .page-footer .navigation__item-section_social_media {
            width: 100%!important;
            bottom: 142px!important;
        }
        .page-footer .navigation__item-label {
            margin-top: 13px;
        }
        .number-cart {
            color: white;
            position: absolute;
            right: 290px;
            top: 324px;
            background: #c71e32;
            padding: 0px 5px;
            border-radius: 10px;
            font-size: 10px;
        }
    }
/* Footer getyourguide */
    .page-footer {
        background-color: #c71f33;
        width: 100%;
        margin-top: 5%;
    }
    .page-footer__content {
        padding-left: 96px;
        padding-right: 96px;
        display: block;
        min-width: 320px;
        padding: 0 16px;
    }
    .page-footer .navigation {
        padding: 40px 16px;
        width: 100%;
    }
    .page-footer .navigation__item-selector-container, .page-footer .navigation__item-selector-select-field {
        position: relative;
        width: 100%;
    }
    .page-footer .navigation__item-selector-container {
        border: 0;
        padding: 0;
    }
    /*------Maranet change-----------*/
    .page-footer .navigation__item-label {
        font-size: 16px;
        line-height: 1.5rem;
        display: block;
        font-weight: 500;
        margin-bottom: 8px;
        color: white;
        text-shadow: none;
    }
    /*------End Maranet change-----------*/

    .page-footer .navigation__item-selector, .goog-te-gadget .goog-te-combo {
        font-size: 13px;
        line-height: 1.5rem;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background: #fff;
        border-radius: 0;
        border: 0;
        color: #1a2b49;
        display: block;
        font-weight: 500;
        height: 40px;
        padding: 8px;
        position: relative;
        width: 100%;
    }
    .svg-inline--fa, svg:not(:root).svg-inline--fa {
        overflow: visible;
    }
    .page-footer .navigation__item-selector-arrow {
        font-size: 16px;
        line-height: 1.5rem;
        color: #1a2b49;
        position: absolute;
        right: 8px;
        top: 50%;
        -webkit-transform: translateY(-50%);
        transform: translateY(-50%);
    }
    .svg-inline--fa.fa-w-16 {
        width: 1em;
    }
    .svg-inline--fa {
        display: inline-block;
        font-size: inherit;
        height: 1em;
        vertical-align: -.125em;
    }
    .fa-chevron-down:before {
        content: "\f078";
    }
    .page-footer .navigation__item-selector-container:not(:first-child) {
        margin-top: 16px;
    }
    .page-footer .navigation__item-trigger {
        display: none;
    }
    .page-footer .navigation__item-list {
        margin-top: 16px;
        display: block;
        list-style: none;
        padding:0;
    }
    .page-footer .navigation__item-list-item:not(:last-child) {
        margin-bottom: 8px;
    }
    .page-footer .navigation__item-list-item {
        font-size: .875rem;
        line-height: 16px;
        font-weight: 400;
    }
    /*--------Maranet add-------------*/
    .page-footer .navigation__item-list-item a:hover{
        text-decoration: underline;
    }
    .navigation__item span a:hover{
        text-decoration: underline;
    }
    /*--------End Maranet add-------------*/

    /*--------Maranet change-----------*/
    .page-footer, .page-footer a, .page-footer p {
        color: #fff;
        font-size: 13px;
        text-shadow: none;
    }
    /*-------End Maranet change----------*/
    .page-footer .navigation__item-section_ways_you_can_pay {
        /*margin-top: 16px;*/
    }
    .page-footer .navigation__item-section_ways_you_can_pay-images {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -ms-flex-direction: row;
        flex-direction: row;
        width: 62%;
    }
    .page-footer .navigation__item-section_ways_you_can_pay-image {
        height: 20px;
        width: 31px;
        margin: 4px;
    }
    .page-footer .navigation__item-section_copyright {
        line-height: 16px;
        text-align: left;
        font-size: 14px;
        margin: 58px 0px 22px;
    }
    .page-footer .navigation__item-section_social_media {
        margin: 0 0 0 auto;
        padding-right: 0;
        text-align: left;
        width: 48%;
        position: relative;
        bottom: 66px;
    }
    .page-footer .navigation__item-section_social_media-icon svg {
        font-size: 17px;
        line-height: 1.5rem;
        margin: 10px;
    }
    .fa-facebook-f:before, .fa-facebook:before {
        content: "\f09a";
    }
    .navigation__item-section_social_media a{
        text-decoration: none;
    }
    .alert {
        position: absolute;
        right: 1% !important;
        z-index: 999;
        width: 200px;
        top: 15%;
    }
    .navbar-fixed-top{
        position: fixed!important;
    }

/* Footer getyourguide */
</style>
<script>
    $(".alert").delay(3000).fadeOut("slow");

</script>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
    }
    $('#:0.targetLanguage').text('');
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<style>
    .goog-te-banner-frame.skiptranslate {
    display: none !important;
    } 
body {
    top: 0px !important; 
    }

</style>
<script>
$(window).load(function () {
    $(".goog-te-gadget").html().replace('&nbsp;&nbsp;Powered by ', '')
});
</script>
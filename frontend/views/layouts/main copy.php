<?php
 
Yii::$app->log->targets['debug'] = null;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
$base_url =  Yii::getAlias('@web');
$backend_url = [];
$company_info = [];
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
<style>
#mc_embed_signup form{padding:0px !important; }
}  

</style>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
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

    <div class="wr-content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>
<div class="top-footer">
  <div class="container">
    
    <div class="col-md-8">
      <div class="col-md-4">
        <h4>
          About Us</h4>
        <ul>
          <li> 
            <a href="<?=$base_url;?>/site/why-choose-us">Why Choose Us</a>
          </li>
          <li>
            <a href="<?=$base_url;?>/site/about">Who we are</a>
          </li> 
          <li>
            <a href="<?=$base_url;?>/site/mission-and-vision">Mission & Vision</a>
          </li> 
          <li>
            <a href="<?=$base_url;?>/site/responsible">Responsible</a> 
          </li> 
          <li>
           <a href="<?=$base_url;?>/site/our-offer">Our Offer</a>  
          </li> 
          <li>
           <a href="<?=$base_url;?>/meet-and-trade/index?MeetAndTradeSearch%5Bstatus%5D=2">Meet & trade</a>   
          </li> 
        </ul>
      </div>
      <div class="col-md-4">
        <h4>Our Office</h4>
        <ul>
          <li> 
            <a href="<?=$base_url;?>/site/contact">Join Us</a>  
          </li>
          <li>
          <a href="<?=$base_url;?>/site/term-of-use">Term Of Use</a>   
          </li>
          <li> 
          <a href="<?=$base_url;?>/site/privacy-policy">Privacy Policy</a>  

          </li>
          <li> 
          <a href="<?=$base_url;?>/site/booking-condition">Booking Condition</a>  

          </li> 
          <li>
          <a href="<?=$base_url;?>/site/contact">Contact Us</a>  
          </li>  
        </ul>
      </div>
      <div class="col-md-4">
        <h4>Follow Us</h4>
       
      </div>

    </div>
    <div class="col-md-4">
      <h4 style="
    color: #ffffff;
    border-bottom: 2px solid;
    padding-bottom: 10px;
    text-align: right;
    ">
    Get a new updating every day. Delivered to your inbox!</h4>
      <p>
        <!-- =======signup========= -->
        <!-- Begin Mailchimp Signup Form -->
<link href="//cdn-images.mailchimp.com/embedcode/slim-10_7.css" rel="stylesheet" type="text/css">
<style type="text/css">
    #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
    /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
       We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
</style>
<div id="mc_embed_signup">
<form action="https://ekvoyages.us3.list-manage.com/subscribe/post?u=ea9d211212064b8ee1b313398&amp;id=bea9cf10d8" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate="" style="
    background: #444444;
">
    <div id="mc_embed_signup_scroll">
    <label for="mce-EMAIL"></label>
    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required style="width: 100%;">
    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
    <div style="position: absolute; left: -5000px;" aria-hidden="true">
    <input type="text" name="b_ea9d211212064b8ee1b313398_bea9cf10d8" tabindex="-1" value=""></div>
    <div class="clear">
    <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button" style="width: 100%;background:#9c0212;"></div>
    </div>
</form>
</div>

<!--End mc_embed_signup-->
      </p>
    </div>
  </div>
  
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; ek voyages 2003 - <?= date('Y') ?></p>

        <p class="pull-right">Powered By: <a href="http://eocambo.com" target="_blank">eOcambo Technology</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
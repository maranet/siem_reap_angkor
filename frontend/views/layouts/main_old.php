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
$company_info = backend\models\CompanyProfile::find()->where(['id' => 1])->one();
AppAsset::register($this);
    $base_url = Yii::getAlias('@web')."/";

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= $base_url."/img/fav.png" ;?>" type="image/x-icon" />
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
button.navbar-toggle.collapsed {
    background: black;
}

</style>
<body>
<?php $this->beginBody() ?>
<?php 
    $company_info = \backend\models\CompanyProfile::find()->where(['id'=>1])->one();
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
            ['label' => 'Tour', 'url' => ['/site/tour']],
            ['label' => 'About Us', 'url' => ['/site/about']],
            ['label' => 'Contact Us', 'url' => ['/site/contact']],
            ['label' => 'Blog', 'url' => ['/site/blog']],
            ['label' => 'Gallery', 'url' => ['/site/gallery']],
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Siem Reap Angkor - Adventures 2019 - <?= date('Y') ?></p>

        <p class="pull-right">Powered By: <a href="http://eocambo.com" target="_blank">eOcambo Technology</a></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
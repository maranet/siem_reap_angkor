<?php
defined('YII_DEBUG') or define('YII_DEBUG', false);
/* @var $this \yii\web\View */
/* @var $content string */
use backend\assets\DashboardAsset;
use yii\helpers\Html;
use yii\helpers\Url; 
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs; 
use common\widgets\Alert;
use app\models\User;
use app\models\CompanyProfile;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
Yii::$app->log->targets['debug'] = null;
DashboardAsset::register($this);
if(!Yii::$app->user->isGuest){
    $userid  = Yii::$app->user->getId();
    $username = User::find()->where(['id' => $userid])->one()->username; 
    $employee_id = User::find()->where(['id' => $userid])->one()->employee_id; 
    
  }else{
    $username = "";

  }
?>
<?php $this->beginPage() ?>
<style>
button#check-out {
    margin: 15px;
    padding: 7px !important;
}

button#check-in {
    margin: 15px;
    padding: 7px !important;
}
</style>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <?= Html::csrfMetaTags() ?>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web')?>/uploads/fav.png" />
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ;
        // $station_seleted_id = Yii::$app->session['globalSelect'];
        ?>
        <!-- Navigation Bar-->
        <header id="topnav">
            <div class="topbar-main">
                <div class="container">
                    <!-- LOGO -->
                    <div class="topbar-left">
                        <a href="<?php echo Yii::getAlias('@web'); ?>/index.php" class="logo">
                            <img src="<?php echo Yii::getAlias('@web'); ?>/img/saa_logo.png">
                        </a>
                    </div>
                    <!-- End Logo container-->
                    <div class="menu-extras">
                      <ul class="nav navbar-nav pull-right">
                          <li class="nav-item">
                              <!-- Mobile menu toggle-->
                              <a class="navbar-toggle">
                                  <div class="lines">
                                      <span></span>
                                      <span></span>
                                      <span></span>
                                  </div>
                              </a>
                              <!-- End mobile menu toggle-->
                          </li>

                           <li class="nav-item dropdown notification-list">
                              <a class="nav-link waves-effect waves-light right-bar-toggle" href="javascript:void(0);">
                                  <!-- <div id="clockbox"></div> -->
                              </a>
                          </li>
                          <li class="nav-item dropdown notification-list"  data-toggle="dropdown">
                              <div class="nav-link dropdown-toggle arrow-none waves-effect waves-light nav-user"  type="button"
                                  aria-haspopup="false" aria-expanded="false">
                                  <!-- <img src="<?php echo Yii::getAlias('@web'); ?>/assets/images/users/avatar-1.jpg" alt="user" class="img-circle"> -->
                                   Hi, <?= $username; ?> | Settings 
                              </div>

                          </li>
                          <li style="color:#fff;margin-top: 12px;margin-left: 15px;">
                          ID: <i class="fa fa-info" style="
                            background: #fff;
                            padding: 1px 5px;
                            color: #2c3d50;
                            border-radius: 50px;
                            font-size: 10px;
                            "></i>                
                            </li>
                          <li class="nav-item dropdown notification-list item-logout">
                              <a data-value="<?php echo Yii::getAlias('@web'); ?>/index.php?r=site%2Flogout" title="Logout" class="dropdown-item notify-item signout">
                                  <span class="item-logout-label"> Logout  <i class="fa fa-sign-out"></i></span>
                              </a>
                          </li>

                      </ul>
                        </div> <!-- end menu-extras -->
                        <div class="clearfix"></div>
                        </div> <!-- end container -->
                    </div>
                    <!-- end topbar-main -->
                    <div class="navbar-custom">
                        <div class="container">
                            <div id="navigation">
                                <!-- Navigation Menu-->
                                <ul class="navigation-menu">
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=company-profile/update&id=1"; ?>"><i class="fa fa-dashboard"></i> <span> Dashboard </span> </a>
                                    </li>
                                    <li class="has-submenu"> 
                                        <a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i> <span> Tour</span> </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=tour-category">Tour Category</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=tour-item">Tour Item</a>
                                            </li>  
                                        </ul>
                                    </li>
                                    <li class="has-submenu"> 
                                        <a href="#"><i class="fa fa-id-card-o" aria-hidden="true"></i> <span> Setup</span> </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=country">Country</a>
                                            </li>  
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=city">City</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web')."/index.php?r=user"; ?>">User</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web')."/index.php?r=company-profile/update&id=1"; ?>">Company Profile</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=blog"; ?>"> <span> Blog </span> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=extra-service"; ?>"> <span> Extra Service </span> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=about-us"; ?>"> <span> About Us </span> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=chose-us"; ?>"> <span> Chose Us </span> </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=slide/update&id=1"; ?>"> <span> Slide</span> </a>
                                    </li>
                                    <li class="has-submenu"> 
                                        <a href="#"><span> Booking Engine</span> </a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=allotment"> Allotment</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=rate-plan"> Rate Plan</a>
                                            </li>  
                                            <li>
                                                <a href="<?php echo Yii::getAlias('@web'); ?>/index.php?r=customer-booking"> Customer Booking</a>
                                            </li>  
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="<?php echo Yii::getAlias('@web')."/index.php?r=gallery"; ?>"> <span> Gallery</span> </a>
                                    </li>
                                </ul>
                                <!-- End navigation menu  -->
                            </div>
                        </div>
                    </div>
                </header>
                <!-- End Navigation Bar-->
              
                <div class="wrapper">
                <div id="page-header" class="no-print"> 
                <div class="container" style="background: #f5f8fa;padding: 0px;">

                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?> 
                    </div>

                    </div>
                    <div class="container">
                  
                    <?= Alert::widget() ?>
                        <?= $content ?>
                    </div>
                </div>
                <?php $this->endBody() ?>
                 <!-- Start Noty Alert -->
                <?php
                    $flash_msg = Yii::$app->session->getFlash('flash_msg');
                    if(!empty($flash_msg)){
                        $flash_msg_type = Yii::$app->session->getFlash('flash_msg_type');
                        $flash_msg_icon = Yii::$app->session->getFlash('flash_msg_icon');

                ?>
                <script>
                    var flash_msg = '<?php echo $flash_msg ?>';
                    var flash_msg_type = '<?php echo $flash_msg_type ?>';
                    var flash_msg_icon = '<?php echo $flash_msg_icon ?>';

                    noty({
                        text: '<span class="'+ flash_msg_icon +'"></span> '+ '  &nbsp&nbsp&nbsp&nbsp'+flash_msg,
                        layout: 'topCenter',
                        type: flash_msg_type
                    });

                </script>
                <?php } ?>

                <!-- End Noty Alert -->
                <footer class="footer">
                    <div class="container">
                        <p class="pull-left">© eOcambo Technology 2019</p>

                        <p class="pull-right">Powered by : <a style="color:#1cb99a;" href="www.eocambo.com">eOcambo Technology</a></p>

                    </div>
                </footer>
                <div id="res-result" style="display: none;"></div>
                <div id="overlay" class="overlay">
                    <div class="loading">Loading&#8230;</div>
                </div>
                
            </body>

</html>
<?php $this->endPage() ?>
<style type="text/css">
    .fc-popover.fc-more-popover {
        width: auto;
    }
    .fc-day-grid-event.fc-h-event.fc-event.fc-start.fc-end {
        text-align: left;
    }
    /* .footer {
        position: absolute !important;
    } */
    body {
        padding-bottom: 0px !important;
    }
</style>
<script type="text/javascript">
$('#company_id').on('change', function(e) {
    // console.log($('#company_id').val());
    var property_id = $('#company_id').val(); 
    var url = window.location.pathname;
    window.location.replace(url+"?property_id="+property_id); 
 });
$(document).on('click','.signout',function(){
  var val = $(this).data('value');
    swal({
        title: "Are you sure, you want to Logout?",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-warning",
        confirmButtonText: "Yes, please!",
        cancelButtonText: "No, thanks!",
        closeOnConfirm: false,
        closeOnCancel: true
    },
    function(isConfirm) {
        if (isConfirm) {
            swal({
                title: "Please wait...",
                timer: 1500,
                showConfirmButton: false
            });
            $.post(val);
        }
    });
});
$(".alert").delay(3000).fadeOut("slow");
</script>
<style media="screen">
    .alert {
        position: absolute;
    right: 1% !important;
    z-index: 999;
    width: 200px;
    top: 15%;
}
.zmdi {
    display: inline-block;
    font: normal normal normal 14px/1 'Material-Design-Iconic-Font';
    font-size: 14px;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    color: #fff;
    font-size: 15px;
    border: 1px solid;
    padding: 5px 7px;
    border-radius: 7px;
    margin-top: 10px;
}
.notification-list .notify-item {
    padding: 5px 20px;
}
.item-logout-label{color:#fff;cursor: pointer;}   
li.nav-item.dropdown.notification-list.item-logout{margin-top: 8px;}
.select-property{
    min-width: 300px;
    margin-top: 12px;
    height: 25px;
}
#topnav .navbar-custom {
    background-color: #f05c11;
}
#topnav .navigation-menu > li > a {
    display: block;
    color: #ffffff;
    }
#topnav .navigation-menu > li > a:active, #topnav .navigation-menu > li > a:hover ,#topnav .navigation-menu > li.active > a > i, #topnav .navigation-menu > li.active > a  {
    color: #2c3d50 !important;
}
#topnav .navigation-menu > li > a:active i, #topnav .navigation-menu > li > a:hover i, #topnav .navigation-menu > li.active > i {
    color: #2c3d50;
}
.select2-container--krajee .select2-selection--single {
    height: 35px;
    line-height: 1.428571429;
    padding: 0px 24px 6px 12px;
    width: 300px;
    margin-top: 8px;
}
</style>

<script language="javascript" type="text/javascript">
     $(window).load(function() {
        $("#overlay").css("display", "block");
        $("#overlay").css("display", "none");
  });
</script>

<?php


use backend\assets\LoginAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

// LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<?php
  $asset_path = Yii::$app->request->baseUrl;
  // Yii::app()->clientScript->scriptMap = array('jquery.js' => false);
  $is_user=Yii::$app->session['user_id'] ;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-form ">
		<?php $this->beginBody() ?>

		<div class="login-top">
		    <?= Alert::widget() ?>
		    <?= $content ?>
		</div>

		<?php $this->endBody() ?>
</body>
<div class="cls"></div>
</html>
<?php $this->endPage() ?>
<style>
.login-form {
    padding: 50px 0px 10px 0px;
    background: url('https://eo.macobuntheoun.com/backend/web/uploads/loginbg.jpeg') no-repeat !important;
    background-size: 100%;
    color: #fff;
    height: auto;
}
.login-form h1 {
    font-size: 40px;
    color: #0d2450;
    font-weight: 800;
    text-align: center;
}
.login-top {
    background: rgba(3, 3, 3, 0.49) none repeat scroll 0% 0%;
    padding: 15px;
}
.login-top {
    width: 460px;
    display: block;
    margin: 0 auto;
    margin-top: 5%;
}
.login-top a{
    color: #fff;
}
.login-top .checkbox label{
    color: #fff;
}
#loginform-username,#loginform-password {
    background: rgba(255, 255, 255, 0.32) !important;
    margin-bottom: 1.5em;
    padding: 8px;
}
.login-ic .form-control{
	background: none !important;
}
.login-ic i.icon1 {
    background: url('/eo-realestart-yii2/backend/web/images/admin-login.png')no-repeat 6px 12px ;
    width: 38px;
    height: 38px;
    float: left;
    display: inline-block;
}
.login-ic i.icon2 {
   background: url('/eo-realestart-yii2/backend/web/images/pass-login.png')no-repeat 6px 12px;
}
input:-webkit-autofill{
    background-color: none !important;
}
.login-ic .has-success .form-control{
    border-color: #00bbaa;
}
.glyphicon{color: #5d5d5d;}
.has-success .help-block, .has-success .control-label, .has-success .radio, .has-success .checkbox, .has-success .radio-inline, .has-success .checkbox-inline, .has-success.radio label, .has-success.checkbox label, .has-success.radio-inline label, .has-success.checkbox-inline label {
    color: #f87233;
}
.btn-primary{width: 100%;padding: 15px;}
input{
    padding: 20px !important;
}
</style>

<?php 
	$base_url = Yii::getAlias('@web');
 ?>
<!DOCTYPE html>
<html>
<div class="jumbotron text-center">
	<h1 class="display-3 thank-you" >Thank You!</h1>
	<div class="wrap_sent_email">
		<img src="../web/img/sent_email_1.png" alt="">
	</div>
	<p class="lead"><strong>Please check your email</strong> for view more detail about your booking.</p>
	<p>
		Any Question? <a href="<?= $base_url;?>/index.php?r=site/contact">Contact us</a>
	</p>
	<p class="lead">
		<a class="btn btn-default btn-sm btn-service" href="<?= $base_url;?>/index.php?r=site" role="button">Other Service</a>
	</p>
</div>
</html>
<style type="text/css">
	.thank-you{
		font-family: inherit!important;
	    font-weight: 600;
	    text-transform: uppercase;
	    margin-bottom: 20px;
	}
	.jumbotron p{
		font-size: 17px;
	}
	.btn-service{
		padding: 9px 19px!important;
    	font-size: 17px!important;
    	border-radius: 25px;
	}
	.wrap_sent_email{
		width: 160px;
	    height: 135px;
	    margin: auto;
	    margin-top: -25px;
	}
	.wrap_sent_email img{
		object-fit: cover;
    	width: 100%;
    	height: 100%;
	}
</style>
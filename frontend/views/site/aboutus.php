<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'About Us';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
	<div class="row row-no-gutters">
		<div class="col-ld-12 col-md-12 col-sm-12">
			<img src="<?= $categories->feature_image ?>" alt="banner tour" class="img-responsive center"/>
			<div class="text-title">
				<h2>About Us</h2>
			</div>
		</div>
	</div>
</div>
<div class="wrap_aboutus">
	<section class="page-wrapper">
		<div class="container pt-100">
			<div class="section-title text-center w-100">
				
			</div>
			<?php 
				foreach ($about_us as $key => $value) {
				
			 ?>
			<div class="section-title text-center w-100">
				<h2><?= $value['name'] ?></h2>
				
			</div>
			<div class="two-column-css">
				<?= $value['description_about_us'] ?>
			</div>
			<?php 
				}
			 ?>
			<div class="mb-100"></div>
			<div class="section-title text-center w-100">
				<h2><span><span>Why</span> chose us</span></h2>
			</div>
			<div class="row container">	
				<?php 
					foreach ($chose_us as $key => $value) {
						
				?>	
				<div class="col-md-6">
					<div class="featured-icon-horizontal-01 clearfix">
						<div class="icon-font">
							<i class=" fa <?=$value['icon']?> text-primary"></i>
						</div>
						<div class="content">
							<h6><?= $value['name'] ?></h6>
							<p class="text-muted"> <?= $value['description'] ?> </p>
						</div>
					</div>

				</div>
				<?php 
					}
				?>
			</div>
			<div class="mb-100"></div>
			
		</div>
	</section>
</div>
<style type="text/css">
	.wrap_aboutus .page-wrapper {
	    /*padding: 120px 0;*/
	}
	.wrap_aboutus .page-wrapper .pt-100 {
	    /*padding-top: 120px !important;*/
	}
	.section-title.w-100 {
	    width: 100%;
	    max-width: 100%;
	}
	.section-title {
	    margin-bottom: 40px;
	    max-width: 70%;
	}
	.text-center {
	    text-align: center!important;
	}
	.w-100 {
	    width: 100%!important;
	}
	.section-title h2 {
	    font-weight: 200;
	    line-height: 1.15;
	    font-size: 38px;
	    margin: 0;
	    text-transform: capitalize;
	    font-family: 'Metropolis', sans-serif;
	}
	.section-title h2 > span > span {
	    font-weight: 700;
	}
	.section-title h2 + p {
	    margin-top: 5px;
	}
	.section-title p {
	    font-size: 17px;
	    letter-spacing: 1px;
	    line-height: 1.45;
	}
	.two-column-css {
	    -webkit-column-count: 2;
	    -moz-column-count: 2;
	    /* column-count: 2; */
	    -webkit-column-gap: 40px;
	    -moz-column-gap: 40px;
	    column-gap: 40px;
	}
	.two-column-css p {
	    margin-bottom: 15px;
	    font-size: 15px;
    	font-weight: 100;
	}
	.mb-100 {
	    margin-bottom: 100px !important;
	}
	.featured-icon-horizontal-01 .icon-font {
	    width: 60px;
	    height: 60px;
	    line-height: 60px;
	    text-align: center;
	    border-radius: 50%;
	    background-color: #F2F2F2;
	    font-size: 24px;
	    float: left;
	}
	.text-primary {
	    color: #5a4e4e !important;
	}
	.featured-icon-horizontal-01 .content {
	    margin-left: 80px;
	    padding-top: 20px;
	}
	.featured-icon-horizontal-01 h5, .featured-icon-horizontal-01 h6 {
	    font-weight: 400;
	    line-height: 1.25;
	    margin: 0 0 15px;
	}
	.featured-icon-horizontal-01 h6 {
	    font-size: 18px;
	}
	.featured-icon-horizontal-01 .content p {
	    font-size: 15px;
	    letter-spacing: 1px;
	}
	p:last-child {
	    margin-bottom: 0;
	}
	.text-muted {
	    color: #9B9B9B !important;
	}
	.section-title p{
		font-size: 17px;
	    color: #6f6f6f;
	    font-weight: 300;
	    font-family: inherit;
	}
	.user-grid {
	    text-align: center;
	    position: relative;
	    width: 100%;
	}
	.user-grid .image {
	    width: 150px;
	    margin: 0 auto;
	}
	.image-circle, .img-circle {
	    border-radius: 50%;
	}
	img {
	    width: 100%;
	    max-width: 100%;
	    height: auto;
	    display: block;
	}
	.user-grid h6 {
	    margin: 25px 0 10px;
	    line-height: 1.1;
	    font-size: 15px;
	}
	.text-uppercase {
	    text-transform: uppercase !important;
	}
	.user-grid p {
	    margin: 0 0 8px;
	    line-height: 1.1;
	}
	.user-grid ul.social {
	    margin: 0;
	    padding: 0;
	}
	.user-grid ul.social li {
	    display: inline-block;
	    margin: 0 5px;
	}
	.user-grid ul.social li a {
	    color: #9B9B9B;
	}
	a, a:visited, a:focus, a:active, a:hover, :focus {
	    text-decoration: none;
	    outline: none;
	}
	.content p {
	    font-size: 14px;
	    color: #9b9b9b;
	}
	.social i{
		font-size: 18px;
	}
	.section-title{
		margin-top: 40px;
	}
	@media only screen and (max-width: 600px) {
		.two-column-css {
		    -webkit-column-count: 1;
		    -moz-column-count: 2;
		    /* column-count: 2; */
		    -webkit-column-gap: 40px;
		    -moz-column-gap: 40px;
		    column-gap: 40px;
		}
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
        width: 50%;
        padding: 20px;
        text-align: center;
        background: #00000085;
        transform: translate(-50%, -50%);
    }
    .text-title h2 {
        font-size: 53px;
    }

</style>
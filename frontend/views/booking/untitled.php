n<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;
use backend\models\TourCategory;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use kartik\select2\Select2;

$validationUrl = ['booking/validation'];
if (!$model->isNewRecord){
$validationUrl['id'] = $model->id;
}

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
// print_r($cart); 

$this->title = 'Cart';
// $this->params['breadcrumbs'][] = $this->title;
$base_url = Yii::getAlias('@web');
$date_template = '
    {label}
    </br>
    <div class="input-group">
        <span style="width: 40px" class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </span> 
        {input} 
    </div>
    {error}{hint}';
?>
<?php $form = ActiveForm::begin([
        'id' => $model->formName(),
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => ['enctype' => 'multipart/form-data'],
        'validationUrl' => $validationUrl
    ]); ?>
<div class="container">
	<div class="row">
		<!-- extra service -->
		<div class="col-md-6">
			<div class="panel">
				<!--Accordion title-->
		        <div class="panel-heading container">
		            <h4 class="panel-title">
		                <span style="cursor: pointer;" data-parent="#accordion" data-toggle="collapse" href="#collapseOne" aria-expanded="true" class="">Extra Servive 	<i class="fa fa-angle-down"></i></span>
		            </h4>
		        </div>
		        <!--Accordion content-->
		        <div class="panel-collapse collapse in" id="collapseOne" aria-expanded="true" style="">
	                <div class="col-md-12">
						<div class="cart-items">
							<?php
							$i = 0;
								foreach ($extra_service as  $row) {
									$i++
							?>
							<div class="cart-items-container">
								<ul class="cart-items cart  has-controls">
									<li class="cart-item is-booking  first-item">
										<div class="cart-item-booking addons-enabled">
											<div class="details">
												<header class="tour-title">
													<h3 class="title"><span><?= $row->name; ?></span></h3> <br>
												</header>
												<div class="row">
													<div class="col-md-12">
														<div class="col-md-4">
													     	<select class="form-control extra_input_<?= $i ;?>" name="adult" id="adult_<?= $i ;?>">
														       <option value="1">1 Adult</option>
														       <option value="2">2 Adults</option>
														       <option value="3">3 Adults</option>
														       <option value="4">4 Adults</option>
														       <option value="5">5 Adults</option>
														       <option value="6">6 Adults</option>
													     	</select>
														</div>
														<div class="col-md-6"> 
															 <span id="per_adult_<?= $i;?>" value= "<?= $row->adult_price; ?>"><?= $row->adult_price. " Per adult"; ?></span>
														</div>
													</div>
													<div class="col-md-12">
														<br>
														<div class="col-md-4">
													     	<select class="form-control extra_input_<?= $i ;?>" name="child" id="child_<?= $i ;?>">
														       <option value="1">1 Child</option>
														       <option value="2">2 Childs</option>
														       <option value="3">3 Childs</option>
														       <option value="4">4 Childs</option>
														       <option value="5">5 Childs</option>
														       <option value="6">6 Childs</option>
													     	</select>
														</div>
														<div class="col-md-6"> 
															 <span id="per_child_<?= $i;?>" value= "<?= $row->child_price; ?>"><?= $row->child_price. " Per child"; ?></span>
														</div>
													</div>
												</div>
												<dl class="details-list">
													<dd class="list-value participants-price-container">
														<div class="item-price ">
															<h4 class="booking-price text-danger">US$ 65</h4>
															<p style="margin: 10px 0 2px;" title="<?= $row->policy ;?>" class="booking-price">Booking Policies <i class="fa fa-info-circle"></i></p>
														</div>
													</dd>
												</dl>
											</div>
										</div>
									</li>
								</ul>
							</div>
							<?php 
								}
							?>
						</div>
					</div>
		        </div>
		    </div>
		</div>
		<!-- tour item info -->
		<div class="col-md-6">
			<div class="cart-items-column section">
				<div class="cart-items">
					<div class="desktop-time">
						<div class="timer-count-down">
							<p class="count-down-active hide" id="count-down-active">We’ll hold your spot for <strong>%1</strong> minutes.</p>
							<p class="count-down-over" id="demo"></p>
						</div>
					</div>
					<?php 
						foreach ($tour_item_added as  $row) {
							// print_r($data);
							// exit();
					?>
					<div class="cart-items-container">
						<ul class="cart-items cart  has-controls">
							<li class="cart-item is-booking  first-item">
								<div class="cart-item-booking addons-enabled">
									<div class="row">
										<div class="col-md-3">
											<div class="image-container">
												<img class ="img" src="<?= $row->feature_image?>" alt="">
											</div>
										</div>
										<div class="col-md-9">
											<header class="tour-title">
												<h3 class="title"><?= $row->name?></h3>
											</header>
											<dd class="list-value option"><label for="">Category: <?= TourCategory::find()->where(['id' => $row->category_id])->one()->name;?></label>
											</dd>
											<div class="participants-list">
												<p class="participants">
													<?php 
														$adult_value = $row->adult;
														$child_value = $row->child;
														if (empty($adult_value) && empty($child_value)) {
															echo "
															<span class='participants-amount'>Adult : 0
															</span>
															<span class='separator'>|</span>
															<span class='participants-description'>Child : 0 </span>";	
													?>
													<?php 
													 	}else{
													?>
														<span class="participants-amount">
															Adult : <?= $adult_value ?>
														</span>
														<span class="separator">|</span>
														<span class="participants-description">
															Child : <?= $child_value ?>
														</span>
													<?php
														}
													?>
												</p>
											</div>
										</div>
									</div>

									<div class="content-container">
										<div class="details">
											<dl class="details-list">
												<dd class="list-value datetime">
													<time datetime="2020-04-22T10:00:00+0200">
														<span class="date">From: <?= $row->from_date?>
														</span>
														<span class="date">To: <?= $row->to_date?>
														</span>
													</time>
													<dd class="controls">
														<div>
															<a href="<?= Url::toRoute(['booking/edit-from-cart', 'id' => $row->id ]) ?>" class="btn-edit cart-item-control">Edit</a><span class="separator">|</span>
														</div>
														<div>
															<a href="<?= Url::toRoute(['booking/remove-from-cart', 'id' => $row->id ]) ?>">
																<button type="button" class="btn-remove cart-item-control">Remove</button>
															</a>
														</div>
														<div class="item-price ">
														<h4 style="margin: 0px" class="booking-price text-danger"><?= "US$ ".$row->price; ?></h4>
													</div>
													</dd>
												</dd>
												<dd class="list-value participants-price-container">
													
												</dd>
											</dl>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<?php 
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- payment detail -->
<div class="container" style="margin-top: 40px; margin-bottom: 40px;">
	<div class="row">
		<div class="col-md-6">
			<h4 class="panel-title">
			    <span>Guest and payment details 	<i class="fa fa-address-card"></i></span>
			</h4>
		    <div class="book-page">
		        <div class="form">
		        	<?php $form = ActiveForm::begin([
				        'action' => ['send-email'],
				        // 'method' => 'get',
				        'id' => $model->formName(),
				        'enableAjaxValidation' => false,
				        'enableClientValidation' => true,
				        // 'options' => ['enctype' => 'multipart/form-data'],
				        'validationUrl' => $validationUrl
				    ]); ?>
				    <div class="book-form row">
				    	<div class="col-md-3">
				    		<?php 
				    			$title_value = ['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Ms.' => 'Ms.', 'Dr.' => 'Dr.'];
				    		?>
		        			<?=$form->field($model, 'title')->dropDownList($title_value, ['name'=>'title', 'prompt' => 'title'])->label(false);?>
		                </div>
		                <div class="col-md-5">
							<?php echo $form->field($model, 'first_name')->textInput(['name' => 'first_name', 'placeholder' => "First Name"])->label(false); ?>
		                    
		                </div>
		                <div class="col-md-4">
							<?php echo $form->field($model, 'last_name')->textInput(['name' => 'last_name', 'placeholder' => 'Last Name'])->label(false); ?>
		                    
		                </div>
		                <div class="col-md-12">
							<?php echo $form->field($model, 'email')->textInput(['name' => 'email', 'placeholder' => 'Email'])->label(false); ?>
		                     
		                </div>
		                <!-- <div class="col-md-12">
		                    <?php echo $form->field($model, 'confirm_email')->textInput(['name' => 'confirm_email', 'placeholder' => 'Confirm Email'])->label(false); ?>
		                </div> -->
		                <div class="col-md-12">
		                    <?php echo $form->field($model, 'contact_phone')->textInput(['name' => 'contact', 'placeholder' => 'Phone Number'])->label(false); ?>
		                </div>
		                <div class="col-md-12">
		                    <?php
			                    $country_name = ArrayHelper::map(\backend\models\Country::find()
			                    ->where(['status'=>1, 'company_id' => 1])
			                    ->all(), 'id', function($model){return $model->name;});
			                ?>
			                 
			                <?=$form->field($model, 'country_id')->dropDownList($country_name, ['name' => 'country_name', 'prompt' => 'Select Country'])->label(false);?>
		                </div>
		                <div class="col-md-12">
		                	<?= $form->field($model, 'description')->textArea(['name' => 'message', 'placeholder' => 'Additional comments'])->label(false) ?>
		                	<!-- <?= $form->field($model, 'reCaptcha')->widget(\himiklab\yii2\recaptcha\ReCaptcha2::className(),[
							        'siteKey' => '6LcVV-gUAAAAAOZVUIGNqLTF7-bCVy4zA4ZzCYR1', // unnecessary is reCaptcha component was set up
							    ]
							) ?> -->
		                </div>
		                <div class="col-md-12 wrap_a">
		                    <?=Html::submitButton('Book', ['class' => ''])?>
		                    <!-- <?= Html::a('Book',['index'],['class' => '']) ?> -->
							<!-- <a href="<?= Url::toRoute(['booking/index']) ?>">Book</a>  -->
		                </div>
				    </div>
				    <?php ActiveForm::end(); ?>
		        </div>
		    </div>
		    <!-- <span>Informaion resquested by the local Partner</span>
		     -->
		</div>
		<div class="col-md-6">
			
				<h4 class="panel-title">
				    <span>Payment details 	<i class="fa fa-calendar"></i></span>
				</h4>
				
			<div class="panel-section" style="background: #f2f2f240;">
				<div class="row">
					<div class="col-md-6">
						<p>Item charge: </p>
						<p>Extra charge:</p>
					</div>
					<div class="col-md-6">
						<div class="price-float" style="float: right;">
							<?php 
								$query = (new \yii\db\Query())->from('tour_item_card');
        						$item_amount = $query->sum('price');
							 ?>
							<h4 class="text-danger" id="total_item" value= "234">US$ <?= empty($item_amount) ? "0.00" : $item_amount; ?></h4>
							<h4 id="amount_extra_charge" class="text-danger" value= "0">US$ 587</h4>
						</div>
					</div>
				</div>
				<hr>

				<div class="row">
					<div class="col-md-6">
						<p>Total:</p>
					</div>
					<div class="col-md-6">
						<div class="price-float" style="float: right;">
							<h4 class="text-danger">US$ 56</h4>
						</div>
					</div>
				</div>
			</div>

			<div class="panel-section" style="background: #f2f2f240;">
				<div class="row">
					<div class="col-md-6">
						<p>Deposite due now:</p>
						<p>Balance due on arrival:</p>
					</div>
					<div class="col-md-6">
						<div class="price-float" style="float: right;">
							<h4 class="text-danger">US$ 0.00</h4>
							<h4 class="text-danger">US$ 587</h4>
						</div>
					</div>
				</div>
			</div>

			<div class="panel-section" style="background: #f2f2f240;">
				<p>Your credit card won't be charge now. It is only needed to guarentee your booking</p>
			</div>

			<div class="panel-section" style="background: #f2f2f240;">
				<p>Payment method</p>
				<p><i class="fa fa-check-circle-o"></i>        <i class="fa fa-credit-card-alt text-success"> Credit Cards</i></p>
				<div class="centered">
					<section class="cards">
		
						<article class="card">
							<img class="img-card" src="<?= $base_url; ?>/img/credit_card/visa.png" alt="visa">
						</article>

						<article class="card">
							<img class="img-card" src="<?= $base_url; ?>/img/credit_card/discover.png" alt="discover">
						</article>

						<article class="card">
							<img class="img-card" src="<?= $base_url; ?>/img/credit_card/jcb.png" alt="jcb">
						</article>

						<article class="card">
							<img class="img-card" src="<?= $base_url; ?>/img/credit_card/unionpay.png" alt="UnionPay">
						</article>
					</section>
				</div>
				<br>

				<!-- credit card -->
				<div class="row">
					<div class="col-md-4">
						<?php echo $form->field($model, 'credit_card_number')->textInput(['name' => 'credit_card_number', 'placeholder' => "Card number"])->label("Card number"); ?>
					</div>
					<div class="col-md-4">
						<?php echo $form->field($model, 'card_name')->textInput(['name' => 'card_name', 'placeholder' => "Name on card"])->label("Card name"); ?>
					</div>
					<div class="col-md-4">
						<?php echo $form->field($model, 'card_security_code')->textInput(['name' => 'card_security_code', 'placeholder' => "Code"])->label("Card security code"); ?>
					</div>
					<p style="margin-left: 15px;">Expired date</p>
					<div class="col-md-6">
	                    <?= $form->field($model, 'from_date', ['template'=>$date_template])->textInput(['readonly' => true, 'class'=>'date_picker form-control DateFrom', 'placeholder' => 'From'])->label("From date");?>
	                </div>
	                <div class="col-md-6">
	                    <?= $form->field($model, 'to_date', ['template'=>$date_template])->textInput(['readonly' => true,'class'=>'date_picker form-control', 'placeholder' => 'To'])->label("To date");?>
	                </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php ActiveForm::end(); ?>
<style type="text/css">
	.input-group {
	    width: 100%;
	}
	.cart-items-column {
	    position: relative;
	    min-height: 1px;
	    padding-right: 16px;
	    padding-left: 16px;
	    margin-bottom: 32px;
	    border-left: 3px solid #e0e0e0;
	}
	.cart-items {
	    padding: 0;
	    margin: 0;
	    border: none;

	}
	.desktop-time .timer-count-down {
	    margin: 15px 0;
	    font-size: 1.4rem;
	    line-height: 2rem;
	    min-height: 30px;
	}
	.popular-activity, .timer-count-down .count-down-over, .timer-count-down .count-down-active, .availability-message {
	    background: #fff7f2;
	    border-top-color: #ff8c41;
	    color: #ff8c41;
	}
	.desktop-time .count-down-active {
	    padding: 1.3rem 1.5rem;
	}
	.timer-count-down .count-down-active {
	    border-top-style: solid;
	    border-top-width: 2px;
	}
	.timer-count-down p {
	    margin: 0;
	    padding: 5px 10px;
	}
	.hide {
	    display: none !important;
	}
	.timer-count-down .count-down-over {
	    border-top-style: solid;
	    border-top-width: 3px;
	    position: relative;
	    padding: 1.3rem 1.5rem;
	}
	.cart-item {
	    list-style: none;
	    padding-bottom: 16px;
	    border-bottom: 1px solid #e8e9ec;
	    margin-bottom: 16px;
	}
/*	.has-controls .cart-item-booking {
	    padding-bottom: 0;
	}*/
	img.img-card {
	    width: 40px;
	    margin-right: 20px;
	}
	.cards {
	   display: flex;
	}
	.cart-item-booking {
	    padding: 16px 16px 0px 16px;	
	}
	.cart-item-booking .image-container {
	    max-width: 90px;
	    -webkit-box-flex: 1;
	    -moz-box-flex: 1;
	    box-flex: 1;
	    -webkit-flex: 1 0;
	    -moz-flex: 1 0;
	    -ms-flex: 1 0;
	    flex: 1 0;
	    display: inline-block;
	    vertical-align: top;
	}
	.image-container img {
	    width: 92px;
	    vertical-align: middle;
	    object-fit: cover;
	    height: 75px;
	}
	.cart-item-booking .content-container {
	    font-size: 1.4rem;
	    line-height: 2rem;
	    color: #6d7688;
	    margin-left: 10px;
	    -webkit-box-flex: 3;
	    -moz-box-flex: 3;
	    box-flex: 3;
	    -webkit-flex: 3 0;
	    -moz-flex: 3 0;
	    -ms-flex: 3 0;
	    flex: 3 0;
	    display: inline-block;
	    width: 85%;
	}
	.cart-item-booking header {
	   display: flex;
	}
	.cart-item-booking .title {
		margin: 4px 0 10px 0;
	    -webkit-box-ordinal-group: 0;
	    -moz-box-ordinal-group: 0;
	    box-ordinal-group: 0;
	    -webkit-order: 0;
	    -moz-order: 0;
	    order: 0;
	    -ms-flex-order: 0;
	    -webkit-box-flex: 3;
	    -moz-box-flex: 3;
	    box-flex: 3;
	    -webkit-flex: 3 auto;
	    -moz-flex: 3 auto;
	    -ms-flex: 3 auto;
	    flex: 3 auto;
	    font-size: 16px;
	    line-height: 34px;
	    font-weight: 600;
	    margin: 0;
	    max-width: 85%;
	    color: #1a2b49;
	}
	}
	.cart-item-booking .details-list {
	    margin: 0;
	}
	.cart-item-booking .list-value {
	    display: -webkit-box;
	    display: -moz-box;
	    display: box;
	    display: -webkit-flex;
	    display: -moz-flex;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-pack: justify;
	    -moz-box-pack: justify;
	    box-pack: justify;
	    -webkit-justify-content: space-between;
	    -moz-justify-content: space-between;
	    -ms-justify-content: space-between;
	    -o-justify-content: space-between;
	    justify-content: space-between;
	    -ms-flex-pack: justify;
	    -webkit-box-orient: horizontal;
	    -moz-box-orient: horizontal;
	    box-orient: horizontal;
	    -webkit-box-direction: normal;
	    -moz-box-direction: normal;
	    box-direction: normal;
	    -webkit-flex-direction: row;
	    -moz-flex-direction: row;
	    flex-direction: row;
	    -ms-flex-direction: row;
	    -webkit-box-lines: multiple;
	    -moz-box-lines: multiple;
	    box-lines: multiple;
	    -webkit-flex-wrap: wrap;
	    -moz-flex-wrap: wrap;
	    -ms-flex-wrap: wrap;
	    flex-wrap: wrap;
	}
	dd {
	    margin-left: 0;
	    line-height: 22px;
	    font-weight: 300;
	}
	.cart-item-booking .participants-list {
	    margin: 0;
	    list-style: none;
	    -webkit-box-ordinal-group: 1;
	    -moz-box-ordinal-group: 1;
	    box-ordinal-group: 1;
	    -webkit-order: 1;
	    -moz-order: 1;
	    order: 1;
	    -ms-flex-order: 1;
	    display: -webkit-box;
	    display: -moz-box;
	    display: box;
	    display: -webkit-flex;
	    display: -moz-flex;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-lines: multiple;
	    -moz-box-lines: multiple;
	    box-lines: multiple;
	    -webkit-flex-wrap: wrap;
	    -moz-flex-wrap: wrap;
	    -ms-flex-wrap: wrap;
	    flex-wrap: wrap;
	}
	.cart-item-booking .participants {
	    margin: 0;
	    padding: 0;
	    border: none;
	}
	.cart-item-booking .participants:first-child:before {
	    content: "";
	    padding: 0;
	}
	.cart-item-booking .item-price {
	    font-size: 1.6rem;
	    line-height: 2.4rem;
	    font-weight: 500;
	    letter-spacing: .03em;
	    color: #1a2b49;
	    text-align: right;
	    -webkit-box-ordinal-group: 2;
	    -moz-box-ordinal-group: 2;
	    box-ordinal-group: 2;
	    -webkit-order: 2;
	    -moz-order: 2;
	    order: 2;
	    -ms-flex-order: 2;
	    -webkit-box-flex: 1;
	    -moz-box-flex: 1;
	    box-flex: 1;
	    -webkit-flex: 1 auto;
	    -moz-flex: 1 auto;
	    -ms-flex: 1 auto;
	    flex: 1 auto;
	}
	.controls {
	    margin: 0;
	    padding: 8px 16px 8px 0;
	    list-style: none;
	    display: -webkit-box;
	    display: -moz-box;
	    display: box;
	    display: -webkit-flex;
	    display: -moz-flex;
	    display: -ms-flexbox;
	    display: flex;
	    -webkit-box-pack: start;
	    -moz-box-pack: start;
	    box-pack: start;
	    -webkit-justify-content: flex-start;
	    -moz-justify-content: flex-start;
	    -ms-justify-content: flex-start;
	    -o-justify-content: flex-start;
	    justify-content: flex-start;
	    -ms-flex-pack: start;
	    font-size: 1.6rem;
	    line-height: 2.4rem;
	    color: #1593ff;
	    min-height: 28px;
	}
	.controls .cart-item-control.btn-edit {
	    padding-left: 0;
	    color: #219553;
	}
	.controls .cart-item-control.btn-edit:hover {
	    text-decoration: underline;
	    
	}
	.controls .cart-item-control {
	    font-size: 1.6rem;
	    line-height: 2.4rem;
	    padding: 0 8px 0;
	    color: #ff1529;
	    border: none;
	    width: auto;
	    height: auto;
	    background: none;
	    cursor: pointer;
	    -webkit-transition: color .2s linear;
	    -moz-transition: color .2s linear;
	    transition: color .2s linear;
	    outline: none;

	}
	.controls .cart-item-control:hover {
	    text-decoration: underline;
	}
	.controls .separator {
	    color: #c6c8d0;
	    font-size: 15px;
    	font-weight: 100;
	}
	.btn-remove, .btn-remove-addon {
	    border-width: 0;
	    color: #d3d3d4;
	    -webkit-user-select: none;
	    -moz-user-select: none;
	    -ms-user-select: none;
	    user-select: none;
	    text-rendering: optimizeLegibility;
	    font-weight: lighter;
	    width: 44px;
	    height: 44px;
	    padding: 0;
	    background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiI…dyb3VwIj48L3BhdGg+ICAgICAgICAgICAgPC9nPiAgICAgICAgPC9nPiAgICA8L2c+PC9zdmc+) center center no-repeat;
	    -webkit-box-ordinal-group: 2;
	    -moz-box-ordinal-group: 2;
	    box-ordinal-group: 2;
	    -webkit-order: 2;
	    -moz-order: 2;
	    order: 2;
	    -ms-flex-order: 2;
	}
	.list-value lab
	el {
	    font-weight: 500;
	}
	@import url(https://fonts.googleapis.com/css?family=Roboto:300);

    .book-page {
      /*width: 360px;*/
      /*padding: 80px 145px;
      margin: auto;*/
      border:1px solid #dfd8d8;
      margin-top: 15px;
    }
    .book-page .form {
      position: relative;
      z-index: 1;
      background: #FFFFFF;
      width: 100%;
      /*margin: 0 auto 100px;*/
      padding: 14px;
      text-align: center;
      box-shadow: 0 0 6px 0px rgba(0, 0, 0, 0.08), 0 5px 3px 0 rgba(0, 0, 0, 0.1);
    }
    .book-page .form input, .book-page .form select, .book-page .form textarea{
      font-family: "Roboto", sans-serif;
      outline: 0;
      background: #f2f2f2;
      width: 100%;
      border: 0;
      margin: 0 0 15px;
      padding: 15px;
      box-sizing: border-box;
      font-size: 14px;
    }
    .book-page .form button {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #c71e32e8;
        width: 93%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
        position: relative;
    }
    .book-page .form button:hover,.book-page .form button:active,.book-page .form button:focus {
      background: #c71e32;
    }
    #box-vile {
        border: 1px solid #e0d9d9;
        margin-bottom: 20px;
    }
	.book-form .wrap_a a{
		background: #c71e32;
	    padding: 12px 189px;
	    color: white;
	    font-size: 18px;
	    text-decoration: none;
	}
	.book-form .wrap_a {
	    padding: 0;
    	margin: 0;
	}
	.panel-section {
	    padding: 20px;
	    margin-top: 15px;
	    border-radius: 5px;
	}
    
</style><?php
$script = <<< JS
    // =========Datepicker===========

    $('.date_picker').datepicker({
        format: 'yyyy-mm-dd',
        changeMonth: true,
        changeYear: true,
        autoclose: true,
    });

	// function calculateNumber(){
	// 	var i = 0;
	// 		$("details").each(function() {
	// 		   i++;
	// 		   console.log(i);
	// 	});
	// };

    $("#adult_1").change(function() {
    	var number_adult = $(this).val();
    	var price_adult = $('#per_adult_1').val()
    	console.log(price_adult);
    });

   	$(document).ready(function(){

		$string = "<h4 class='text-danger'>""</h4>""

   		});

    

JS;
$this->registerJS($script);
?>
<script>
// Set the date we're counting down to
var countDownDate = new Date("Jan 5, 2021 15:37:25").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML ="Your session will be delete in " + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
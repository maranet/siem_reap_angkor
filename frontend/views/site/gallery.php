<?php
	$this->title = 'Gallery';
	$gallery_image = \backend\models\GalleryImage::find()->all();
	$gallery_title = \backend\models\Gallery::find()->all();

 ?>
 <style type="text/css">
	@import url(https://fonts.googleapis.com/css?family=Raleway:400,800);
	.wrap_gallery p {
		font-size: 35px;
		font-family: Raleway;
		text-transform: uppercase;
		width: 21%;
		border-bottom: 5px solid #f1f1f1;
		margin: 1.66%;
	}
	.wrap_gallery img {
		width: 100%;
	    float: left;
	    object-fit: cover;
	    height: 400px;
	    margin-top: 28px;
	    /*-webkit-filter: grayscale(100%); /* Safari 6.0 - 9.0 */
  		/*filter: grayscale(100%);*/
	}
	.tab-title{
		cursor: pointer;
	}
	@media only screen and (max-width: 600px) {
		.wrap_gallery p {
			font-size: 20px;
			width: 47%;
			margin-top: 10px;
		}
	}

header {
  padding: 50px;
  text-align: center;
}

h1 {
  font-size: 4rem;
}

/* gallery specific CSS */

.-fx-image-gal {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  width: 100%; /* arbitrary valye */
  margin: 0px auto;
}
.-fx-gal-item {
  width: 100%; /* for 3 columns */
  margin: 5px;
  overflow: hidden;
  border-radius: 15px;
}

.-fx-gal-image-thumb img {
  width: 100%;
  border-radius: 15px;
  cursor: pointer;
  -webkit-filter: grayscale(80%);
  -moz-filter: grayscale(80%);
  filter: grayscale(80%);
  transition: all 0.3s ease;
}

.-fx-gal-image-thumb:hover img {
  width: 100%;
  cursor: pointer;
  -webkit-filter: grayscale(0%);
  -moz-filter: grayscale(0%);
  filter: grayscale(0%);

  transform: scale(1.2);
  transition: all 0.5s ease;
}

.-fx-gal-image-thumb:focus + .-fx-gal-image-big {
  display: block;
}

.-fx-gal-image-big {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  background-color: rgba(5, 10, 15, 0.8);
  overflow: hidden;
  height: 100vh;
  width: 100vw;
  z-index: 999;
  transition: all 0.3s ease;
}

.-fx-gal-image-big img {
  /*max-width: 90vw;*/
  width: 650px;
  height: 650px;
  position: absolute;
  box-shadow: 0px 0px 800px 40px rgba(0, 0, 0, 0.9);
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}

</style>
<div class="container-fluid">
	<div class="wrap_gallery">
		<h2 class="container-fluid">Tour Gallery</h2>
		<div class="container-fluid">
			<div class="row">
				<div class= "col-lg-12">
	                <ul class="nav nav-tabs">
	                	<li class="active"><a data-toggle="tab" class= "tab-content tab-title active" href= "#all">View All</a></li>
	                    <?php
	                    	foreach ($gallery_title as $row){
	                    	?>
								<li><a data-toggle="tab" class= "tab-content tab-title" id="<?=$row->id ;?>" href= "#<?=$row->id."_".$row->status ;?>" value= "<?=$row->id ;?>"><?= $row->name;?></a></li>
                    		<?php
		                    	}
		                     ?>
	                </ul>   
                	<!-- content -->
	                <div class="tab-content">
	                	<div id="all" class="tab-pane fade active in">
	                            <?php
	                            	$gallery_image_all = \backend\models\GalleryImage::find()->limit(18)->all();
									foreach ($gallery_image_all as $all) {
								?>
	                            	<div class="col-lg-3">
										<div class="-fx-image-gal">

											<div class="-fx-gal-item">
												<div class="-fx-gal-image-thumb" tabindex="1">
													<img src="<?= $all->file_path.$all->file_name?>" />
												</div>
												<div class="-fx-gal-image-big">
													<img src="<?= $all->file_path.$all->file_name?>" />
												</div>
											</div><!-- /-fx-gal-item -->

										</div><!-- /gallery -->
	                            	</div>
								<?php
									}
	                             ?>
	                    </div>
						<?php
                    	foreach ($gallery_title as $tab){
                    	?>
						<div id="<?= $tab->id."_".$tab->status ;?>" class="tab-pane fade in">
	                            <?php
	                            	$gallery_image = \backend\models\GalleryImage::find()->where(['gallery_id'=>$tab->id])->limit(18)->all();
									foreach ($gallery_image as $row) {
								?>
	                            	<div class="col-lg-3">
										<div class="-fx-image-gal">

											<div class="-fx-gal-item">
												<div class="-fx-gal-image-thumb" tabindex="1">
													<img src="<?= $row->file_path.$row->file_name?>" alt="<?= $row->id;?>" />
												</div>
												<div class="-fx-gal-image-big">
													<img src="<?= $row->file_path.$row->file_name?>" alt="<?= $row->id;?>" />
												</div>
											</div><!-- /-fx-gal-item -->

										</div><!-- /gallery -->
	                            	</div>
								<?php
									}
	                             ?>
	                    </div>
                		<?php
	                    	}
	                     ?>
	                </div>
                </div>
			</div>
		</div>
	</div>
</div>

<?php
$base_url = Yii::getAlias('@web');
$script = <<< JS
	var base_url = "$base_url";

	$(".all-img").click(function() {
		location.reload(true);
	});

	// $(".tab-title").click(function() {
	//     var id = this.id;
	//     $.ajax({
 //            url: base_url+'/index.php?r=site/dependent',
 //            type: 'post',
 //            data: {
 //                id: id,
 //                action: 'image_gallery'
 //            },
 //            success: function(response){ 
 //                var data = JSON.parse(response);
 //                console.log(data);
 //                var str = "";
 //                $.each(data,function(key,value){
 //                    str = str + '<div class="col-lg-3">' +
	// 								'<img src="'+value.file_path+value.file_name+'">' +
 //                            	'</div>';
 //                });
	// 			$( ".row .col-lg-3" ).remove();
 //                $("#gallery-more").append(str);
 //            }
 //        });
	// });
JS;
$this->registerJS($script);
  
?>

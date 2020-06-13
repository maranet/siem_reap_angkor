<?php 
use yii\helpers\Html;
use backend\models\BlogSearch;
use yii\widgets\ListView;

$base_url = Yii::getAlias('@web');
$this->title = 'Blog';
 ?>
 <style>
    .list-view .summary, .pagination li a{
        font-size: 13px;
        font-weight: 200;
    }
    .list-view .pagination{
        margin: 7px auto;
    }
    .list-view .pagination li a{
        color: #a7a7a7;
        padding: 3px 8px;
    }
    .list-view .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
        background-color: #2e3d51 !important;
        border-color: #2e3d51 !important;
        color: white;
        font-size: 13px;
        font-weight: 200;
    }
    .pagination>.disabled>a, .pagination>.disabled>a :focus, .pagination>.disabled>a:hover, .pagination>.disabled>span, .pagination>.disabled>span:focus, .pagination>.disabled>s pan:hover {
        color: #ccc7c7;
        cursor: not-allowed;
        background-color: #fff;
        border-color: #ddd;
        font-size: 13px;
        font-weight: 200;
        padding: 3px 8px;
    }
    .modal-title{
        color: #28710b;
    }
    .modal-body p strong {
        color: #822929;
        font-size: 15px;
        font-weight: 500;
    }
    .modal-body p, li {
        font-weight: 300;
        font-size: 14px;
    }
 	@import url(https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css);
    @import url(https://fonts.googleapis.com/css?family=Raleway:400,500,700);
    .product{
        margin: 50px 0px;
    }
    img.img-item {
        object-fit: cover;
        width: 100%;
        height: 400px;
        margin-top: 27px;
        margin-bottom: 27px;
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
@media only screen and (max-width: 600px) {
  .text-title {
    position: absolute;
    top: 50%;
    left: 50%;
    color: white;
    border-top: 4px solid #fff;
    border-bottom: 4px solid;
    width: 200px;
    padding: 20px;
    text-align: center;
    background: #00000085;
    transform: translate(-50%, -50%);
  }
}
.price {
  float: right;
  text-align: left;
}
.row.item-listing {
    padding: 20px;
}

#box-vile{
  border: 1px solid #e0d9d9;
}
/*#box-vile :hover{
  box-shadow: 0px 3px 8px 5px #888888;
}*/
.price-area {
    padding: 10px;
    border-top: 5px solid #337ab7;
    box-shadow: 0px 3px 8px 5px #88888847;
}
a.btn.btn-danger.custom {
    border-radius: 0px;
}
 </style>
<div class="boday-content">
    <div class="container-fluid">
        <div class="row row-no-gutters">
     		<div class="col-ld-12 col-md-12 col-sm-12">
     			<img src="<?= $categories->feature_image ?>" alt="banner tour" class="img-responsive center"/>
    			<div class="text-title">
                    <h2>Blog Post</h2>
    			</div>
    		</div>
    	</div>
    </div>
	<div class="container">
			<?php 
                $searchModelBlog = new BlogSearch();
                $dataProvider = $searchModelBlog->search(Yii::$app->request->queryParams); 
            ?>
            <?=
                ListView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'firstPageLabel' => 'First',
                        'lastPageLabel' => 'Last',
                        // 'nextPageLabel' => 'next',
                        // 'prevPageLabel' => 'previous',
                        'maxButtonCount' => 3,
                    ],
                    'itemView' => function ($model, $key, $index, $widget){
            ?>
				<div class="row item-listing">
					<div id="box-vile" class="container-fluid box-shadow">
						<div class="col-lg-6 col-md-6 col-sm-12">
							<img src="<?= $model->feature_image == "" || null ? $base_url."/img/empty_img.png" : $model->feature_image ;?>" class="img-item" alt="Tour Category" />
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12"><br>
							<div class="blog-content">
								<h4 style= "color: red"><?= $model->name ?></h4>
                                <?php 
                                    $short_description = Yii::$app->db->createCommand("SELECT SUBSTRING(`description`, 1 , 500) FROM blog where id = $model->id;")->queryScalar();
                                    echo $short_description."...";
                                ?>
                                <p style="color: red;"><?= "Post on ".$model->created_date. " By ". \common\models\User::find()->where(['id' => $model->created_by])->one()->username; ?></p>
                                <!-- Trigger the modal with a button -->
                                <button type="button" class="btn btn-danger custom" data-toggle="modal" data-target=".<?= $model->id?>">Read More</button>
                                <!-- Modal -->
                                <div class="modal fade <?= $model->id?>" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="container">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title"><?= $model->name ?></h4>
                                                </div>
                                                <div class="modal-body">
                                                    <p><?= $model->description; ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
				</div>
            <?php
                    }
                ]);
            ?>
	</div>
</div>


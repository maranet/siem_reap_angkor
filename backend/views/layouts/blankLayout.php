<?php 

use yii\helpers\Html;
use yii\helpers\Url; 
use common\widgets\Alert;
use dominus77\sweetalert2\Alert as sweetAlert;
use backend\assets\AppAsset;
use backend\models\UploadedFile;
use yii\widgets\Breadcrumbs; 

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <link rel="icon" type="image/png" href="<?= Yii::getAlias('@web')?>/img/fav.png" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?> 
    
</head>
<body>
	<?php $this->beginBody() ?>

		<div id="container">
			<div id="content-container">
                <div id="page-content"> 
                	<div class="row">
	                	<div class="col-xs-12"> 
		                		<div class="panel-body">
		                			<?= $content;?>  
		                		</div> 
	                    </div>
	                </div>
                </div>
            </div>
		</div>

 

	<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?> 


   

  
    
 
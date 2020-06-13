<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TourItem */

$this->title = 'Create Tour Item';
$this->params['breadcrumbs'][] = ['label' => 'Tour Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-item-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

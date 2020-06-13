<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TourCategory */

$this->title = 'Create Tour Category';
$this->params['breadcrumbs'][] = ['label' => 'Tour Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tour-category-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

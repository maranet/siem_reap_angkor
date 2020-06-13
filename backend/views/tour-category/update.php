<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TourCategory */

$this->title = 'Update Tour Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tour Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tour-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

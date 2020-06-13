<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TourItem */

$this->title = 'Update Tour Item: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tour Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tour-item-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

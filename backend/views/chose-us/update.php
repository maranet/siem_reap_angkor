<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ChoseUs */

$this->title = 'Update Chose Us: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Chose uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chose-us-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

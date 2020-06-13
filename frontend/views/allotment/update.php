<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Allotment */

$this->title = 'Update Allotment: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Allotments', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="allotment-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

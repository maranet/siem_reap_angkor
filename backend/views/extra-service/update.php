<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraService */

$this->title = 'Update Extra Service: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Extra Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="extra-service-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

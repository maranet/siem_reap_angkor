<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Allotment */

$this->title = 'Create Allotment';
$this->params['breadcrumbs'][] = ['label' => 'Allotments', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="allotment-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

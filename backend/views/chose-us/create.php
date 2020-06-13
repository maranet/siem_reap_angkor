<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ChoseUs */

$this->title = 'Create Chose Us';
$this->params['breadcrumbs'][] = ['label' => 'Chose uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chose-us-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

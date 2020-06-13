<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AboutUs */

$this->title = 'Create About Us';
$this->params['breadcrumbs'][] = ['label' => 'About uses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-us-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

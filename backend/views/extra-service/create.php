<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraService */

$this->title = 'Create Extra Service';
$this->params['breadcrumbs'][] = ['label' => 'Extra Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="extra-service-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ExtraService */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Extra Services', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="extra-service-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'company_id',
            'adult',
            'adult_price',
            'child',
            'child_price',
            'feature_image',
            'description:ntext',
            'policy:ntext',
            'extra_amount',
            'updated_by',
            'updated_date',
            'status',
            'created_by',
            'created_date',
        ],
    ]) ?>

</div>

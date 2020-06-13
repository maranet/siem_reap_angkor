<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\TourItem */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tour Items', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tour-item-view">

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
            'category_id',
            'company_id',
            'name',
            'feature_image',
            'description:ntext',
            'price',
            'duration',
            'starting_time',
            'tip_note:ntext',
            'recommended',
            'duration_type',
            'updated_by',
            'updated_date',
            'status',
            'created_by',
            'created_date',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RatePlan */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rate Plans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="rate-plan-view">

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
            'cost_adult',
            'company_id',
            'rate_set_up_id',
            'rate_range_id',
            'cost_child',
            'price_adult',
            'price_child',
            'mark_up_adult',
            'mark_up_child',
            'mark_up_type',
            'date',
            'updated_by',
            'status',
            'updated_date',
            'created_by',
            'created_date',
        ],
    ]) ?>

</div>

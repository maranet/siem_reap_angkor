<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CompanyProfile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Company Profiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="company-profile-view">

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
            'code',
            'name',
            'address:ntext',
            'country_id',
            'city_id',
            'postal_code',
            'contact_person',
            'general_email:email',
            'invoice_email:email',
            'mobile_number_invoice',
            'main_phone_1',
            'main_phone_2',
            'website_url:url',
            'company_type',
            'number_of_user',
            'sale_date',
            'service_agreement',
            'fee',
            'status',
            'company_status',
            'created_by',
            'created_date',
            'updated_date',
            'updated_by',
            'passed_by',
            'handle_by',
            'deactivated_at',
            'deactivated_reason:ntext',
            'deactivated_requested_by',
            'deactivated_requested_contact_detail:ntext',
            'deactivated_by',
            'lived_date',
        ],
    ]) ?>

</div>

<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
<h5><?= Html::encode($this->title) ?></h5> 

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel"> 
        <div class="panel-body">  
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button data-target="#demo-default-modal" data-toggle="modal" class="btn btn-success" id="modalButton" value="<?= Url::toRoute(['user/create']) ?>">                            Add New <i class="fa fa-plus-square go-right"></i>
                        </button> 
                    </div>
                </div>
            </div>
            <br>
    
        <?php
            Modal::begin([
                'header' => ' <h4 class="modal-title">'.'Users'.'</h4>',
                'id' => 'modal',
                'class' => 'modal fade',
                'size' => 'modal-md',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();
        
        ?>
        <div class="table-responsive">
                <?= GridView::widget([
                'dataProvider' => $dataProvider,
                 
                'layout'=>"
                    {items}
                        <div class='col-md-5 '>
                            <label class='form-inline'>
                                Show ".
                            Html::dropDownList('page_size',
                            $page_size,
                            Yii::$app->params['page_size'],
                            array('class' => 'form-control', 'id' => 'select_page_size'))."
                            </label>
                        </div>
                        <div class='col-md-2' style='padding-top: 5px;'>
                            {summary}
                        </div>
                        <div class='col-md-5' style='text-align: right;'>
                            {pager}
                        </div>
                        ",
                'pager' => [
                    'firstPageLabel' => 'First',
                    'lastPageLabel' => 'Last',
                    'maxButtonCount' => 5,
                ],
                
                //'filterModel' => $searchModel,
        
                'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                            // 'id', 
            // [
            //     'attribute' => 'employee_id',
            //     'format' => 'raw',
            //     'value' => function($model){
            //         return "<a href='". URL::toRoute(['employee-profile/profile','id'=>$model->employee_id, 'smMenu'=>1])."' target='_blank' class='text-info'> ".$model->employee->id_prefix . ' '.$model->employee->first_name . ' '. $model->employee->last_name."</a>" ; 
            //     }
            // ],
            // [
            //     'attribute'=> 'employee_id',
            //     'format' => 'raw',
            //     'value' => function($model){
            //         // return $model->customerProfile->first_name . '-'.$model->customerProfile->last_name;
            //         $mql = "select CONCAT(a.prefix, ' ',a.first_name,' ',a.last_name) as employee_profile_name from employee_profile a 
            //         LEFT JOIN `user` b on a.id = b.employee_id where b.id = $model->id";
            //         $customer_name = Yii::$app->db->createCommand("$mql")->queryScalar();
            //         return $customer_name ;
            //     }, 

            // ],
            'username',
            [
                'attribute' => 'user_type_id',
                'value' => 'userType.user_type_name'
            ],
            // 'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            [
                'attribute' => 'status',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->status == 10) {
                        return '<div class="text-center"><span class="label label-info">Active</span></div>';
                    } else {
                        return '<div class="text-center"><span class="label label-danger">Inactive</span></div>';
                    }
                },
            ],
            //'status',
            //'created_at',
            //'updated_at',
            //'verification_token',
            //'created_date',
            //'created_by',
            //'updated_date',
            //'updated_by',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['style' => 'width:260px;'],
                    'header'=>'Actions',
                    'template' => '{update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                                return Html::button('<i class ="fa fa-search"></i>',
                                [
                                    'value'=> $url,
                                    'id'=> 'modalButtonView',
                                    'data-pjax'=>'0',
                                    'class' => 'padding-10',
                                ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::button('<i class ="fa fa-wrench"></i>',
                            [
                                'value'=> $url,
                                'id'=> 'modalButtonUpdate',
                                'data-pjax'=>'0',
                                'class' => 'padding-10',
                            ]);
                        }, 



                        'delete' => function ($url, $model) {
                            return Html::a('<span class="fa fa-trash"></span>', $url, [
                                'title' => Yii::t('app', 'lead-delete'),
                                'class' => 'padding-10',
                                'data' => [
                                    'confirm' => 'Are you sure want to delete it?',
                                    'method' => 'post',
                                ],
                            ]);
                        }

                    ],

                ],
                ],
            ]); ?>
                                
            </div>
        </div>
    </div>
</div>

<?php
$this->registerJs('
 
        var controller_id = "news";
        $("#select_page_size").change(function(){
            var page_size = $("#select_page_size").val();
            var url = window.location.pathname;
                window.location.replace(url+"?r="+controller_id+"/index&page_size="+page_size);
        });


        $(document).on("click","#modalButton",function () {
            // $("#modal").modal("show")
            //     .find("#modalContent")
            //     .load($(this).attr("value"));
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){
                console.log(res);
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })

        });

        $(document).on("click","#modalButtonView",function () {
            // $("#modal").modal("show")
            //     .find("#modalContent")
            //     .load($(this).attr("value"));
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){
                console.log(res);
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

        $(document).on("click","#modalButtonUpdate",function () {
            // $("#modal").modal("show")
            //     .find("#modalContent")
            //     .load($(this).attr("value"));
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){
                console.log(res);
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

    ');


?>
<style>
    .modal-dialog.modal-md {
    width: 800px;
}
</style>
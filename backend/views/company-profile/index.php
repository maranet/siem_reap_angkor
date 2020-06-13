<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompanyProfileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = 'Company Profiles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-profile-index">
<!-- <h5><?= Html::encode($this->title) ?></h5> -->


    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="panel"> 
        <div class="panel-body">  
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                        <button data-target="#demo-default-modal" data-toggle="modal" class="btn btn-success" id="modalButton" value="<?= Url::toRoute(['company-profile/create']) ?>">                            Add New <i class="fa fa-plus-square go-right"></i>
                        </button> 
                    </div>
                </div>
            </div>
            <br>
    
        <?php
            Modal::begin([
                'header' => ' <h4 class="modal-title">'.'Company Profiles'.'</h4>',
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
                        <div class='col-md-4 '>
                            <label class='form-inline'>
                                Show ".
                            Html::dropDownList('page_size',
                            $page_size,
                            Yii::$app->params['page_size'],
                            array('class' => 'form-control', 'id' => 'select_page_size'))."
                            </label>
                        </div>
                        <div class='col-md-4 text-center' style='padding-top: 5px;'>
                            {summary}
                        </div>
                        <div class='col-md-4' style='text-align: right;'>
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
            'name',
            [
                'attribute' => 'city_id',
                'value' => 'city.name'
            ], 
            [
                'attribute'=> 'company_type',
                'format' => 'raw',
                'value' => function($model){
                    $mql = "select name from company_type where id = $model->company_type";
                    $company_type = Yii::$app->db->createCommand("$mql")->queryScalar();
                    return $company_type ;
                }, 

            ],

            [
                'attribute' => 'company_status',
                'contentOptions' => ['class' => 'text-center'],
                'headerOptions' => ['class' => 'text-center'],
                'format' => 'raw',
                'value' => function ($model) {
                    return '<div class="text-center"><span class="label ' . $model->companyStatus->css_class . '">' . $model->companyStatus->name . '</span></div>';
                },
            ],
            [
                'attribute' => 'created_by',
                'value' => 'createdBy.username'
            ],
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
        var controller_id = "company-profile";
        $("#select_page_size").change(function(){
            var page_size = $("#select_page_size").val();
            var url = window.location.pathname;
                window.location.replace(url+"?r="+controller_id+"/index&page_size="+page_size);
        });


        $(document).on("click","#modalButton",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })

        });

        $(document).on("click","#modalButtonView",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

        $(document).on("click","#modalButtonUpdate",function () { 
            $("#overlay").css("display", "block");
            $("#res-result").load($(this).attr("value"), function(res){ 
                $(this).html("");
                $("#modal").modal("show")
                $("#modalContent").html(res)
                $("#overlay").css("display", "none");
            })
        });

    ');

?>

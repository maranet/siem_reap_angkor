<?php
use yii\widgets\ListView;
use common\models\GlobalFunction;
use yii\helpers\Url;
use yii\bootstrap\Modal; 

/* @var $this yii\web\View */

$this->title = 'Dashboard | eO-BMS'; 
// echo $_SESSION['company_id'];
?> 
 <?php
            Modal::begin([
                'header' => ' <h4 class="modal-title">'.'Add New'.'</h4>',
                'id' => 'modal',
                'class' => 'modal fade',
                'size' => 'modal-md',
            ]);
            echo "<div id='modalContent'></div>";
            Modal::end();
        
?>
<div class="col-md-12" style="margin-bottom: 30px;">
    <div class="col-sm-6 bord-rgtx" style="border: 10px solid #f5f8fa;">
        <div class="panel text-center">
            <div class="panel-heading">
                <div class="row">
                    <span class="panel-title">this month progress</span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group text-left pad-ver">
                            <li class="list-group-item">
                                <div class="pull-right"><span class="text-semibold">0</span></div>
                                <span class="text-semibold">Actual</span>
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right"><span class="text-semibold">0</span></div>
                                <span class="text-semibold">Goal</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div id="this_month-progressing-pie" class="demo-pie pie-title-center" data-percent="0.00%">
                            <!-- <span class="pie-value text-thin text-2x">0.00%</span> -->
                            <div class="wrap_circle">
                                <div class="progress" data-percentage="10">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            10%<br>
                                            <span>completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <canvas height="300" width="300" style="height: 150px; width: 150px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6" style="border: 10px solid #f5f8fa;">
        <div class="panel text-center">
            <div class="panel-heading">
                <div class="row">
                    <span class="panel-title">this year progress</span>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group text-left pad-ver">
                            <li class="list-group-item">
                                <div class="pull-right"><span class="text-semibold">0</span></div>
                                <span class="text-semibold">Actual</span>
                            </li>
                            <li class="list-group-item">
                                <div class="pull-right"><span class="text-semibold">5</span></div>
                                <span class="text-semibold">Goal</span>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div id="this_year-progressing-pie" class="demo-pie pie-title-center" data-percent="0.00%">
                            <!-- <span class="pie-value text-thin text-2x">0.00%</span> -->
                            <div class="wrap_circle">
                                <div class="progress" data-percentage="30">
                                    <span class="progress-left">
                                        <span class="progress-bar" style="border-color: #5bc0de"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar" style="border-color: #5bc0de"></span>
                                    </span>
                                    <div class="progress-value">
                                        <div>
                                            30%<br>
                                            <span>completed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <canvas height="300" width="300" style="height: 150px; width: 150px;"></canvas></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12">
    <div class="col-md-4">
        <h3 class="panel-title">PROPOSAL</h3>
      
        <button data-target="#demo-default-modal" data-toggle="modal" class="add_new" id="modalButton" value="<?= Url::toRoute(['proposal/create']) ?>">                           
         Add New 
        </button> 
        <hr>
        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-main text-md text-semibold">DRAFT <span class="pull-right"><?=$proposal_month_status_1;?> / <?=$proposal_total_status_1;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($proposal_month_status_1, $proposal_total_status_1); ?>%;" class="progress-bar progress-bar-default">
                    <?= GlobalFunction::calculateProgress($proposal_month_status_1, $proposal_total_status_1); ?> %
                </div></div>
                <p class="text-main text-sm top_summary_report"><span class="pull-right"> This Month / Total</span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-info text-md text-semibold">SENT <span class="pull-right"><?=$proposal_month_status_2;?> / <?=$proposal_total_status_2;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($proposal_month_status_2, $proposal_total_status_2); ?>%;" class="progress-bar progress-bar-info">
                    <?= GlobalFunction::calculateProgress($proposal_month_status_2, $proposal_total_status_2); ?> %
                </div></div>
                <p class="text-info text-sm top_summary_report"><span class="pull-right">This Month / Total</span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-warning text-md text-semibold">EXPIRED <span class="pull-right"><?=$proposal_month_status_4;?> / <?=$proposal_total_status_4;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($proposal_month_status_4, $proposal_total_status_4); ?>%;" class="progress-bar progress-bar-warning">
                    <?= GlobalFunction::calculateProgress($proposal_month_status_4, $proposal_total_status_4); ?> %
                </div></div>
                <p class="text-warning text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-danger text-md text-semibold">DECLINED <span class="pull-right"><?=$proposal_month_status_5;?> / <?=$proposal_total_status_5;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($proposal_month_status_5, $proposal_total_status_5); ?>%;" class="progress-bar progress-bar-danger">
                    <?= GlobalFunction::calculateProgress($proposal_month_status_5, $proposal_total_status_5); ?> %
                </div></div>
                <p class="text-danger text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-success text-md text-semibold">ACCEPTED <span class="pull-right"><?=$proposal_month_status_6;?> / <?=$proposal_total_status_6;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($proposal_month_status_6, $proposal_total_status_6); ?>%;" class="progress-bar progress-bar-success">
                    <?= GlobalFunction::calculateProgress($proposal_month_status_6, $proposal_total_status_6); ?> %
                </div></div>
                <p class="text-success text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h3 class="panel-title">QUOTATION</h3>
        <button data-target="#demo-default-modal" data-toggle="modal" class="add_new" id="modalButton" value="<?= Url::toRoute(['quotation/create']) ?>">                           
         Add New 
        </button> 
        <hr>
        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-main text-md text-semibold">DRAFT <span class="pull-right"><?=$quotation_month_status_1;?> / <?=$quotation_total_status_1;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($quotation_month_status_1, $quotation_total_status_1); ?>%;" class="progress-bar progress-bar-default">
                    <?= GlobalFunction::calculateProgress($quotation_month_status_1, $quotation_total_status_1); ?> %
                </div></div>
                <p class="text-main text-sm top_summary_report"><span class="pull-right"> This Month / Total</span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-info text-md text-semibold">SENT <span class="pull-right"><?=$quotation_month_status_2;?> / <?=$quotation_total_status_2;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($quotation_month_status_2, $quotation_total_status_2); ?>%;" class="progress-bar progress-bar-info">
                    <?= GlobalFunction::calculateProgress($quotation_month_status_2, $quotation_total_status_2); ?> %
                </div></div>
                <p class="text-info text-sm top_summary_report"><span class="pull-right">This Month / Total</span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-warning text-md text-semibold">EXPIRED <span class="pull-right"><?=$quotation_month_status_4;?> / <?=$quotation_total_status_4;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($quotation_month_status_4, $quotation_total_status_4); ?>%;" class="progress-bar progress-bar-warning">
                    <?= GlobalFunction::calculateProgress($quotation_month_status_4, $quotation_total_status_4); ?> %
                </div></div>
                <p class="text-warning text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-danger text-md text-semibold">DECLINED <span class="pull-right"><?=$quotation_month_status_5;?> / <?=$quotation_total_status_5;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($quotation_month_status_5, $quotation_total_status_5); ?>%;" class="progress-bar progress-bar-danger">
                    <?= GlobalFunction::calculateProgress($quotation_month_status_5, $quotation_total_status_5); ?> %
                </div></div>
                <p class="text-danger text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-success text-md text-semibold">ACCEPTED <span class="pull-right"><?=$quotation_month_status_6;?> / <?=$quotation_total_status_6;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($quotation_month_status_6, $quotation_total_status_6); ?>%;" class="progress-bar progress-bar-success">
                    <?= GlobalFunction::calculateProgress($quotation_month_status_6, $quotation_total_status_6); ?> %
                </div></div>
                <p class="text-success text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <h3 class="panel-title">CONTRACT</h3>
        <button data-target="#demo-default-modal" data-toggle="modal" class="add_new" id="modalButton" value="<?= Url::toRoute(['contract/create']) ?>">                           
         Add New 
        </button> 
        <hr>
        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-main text-md text-semibold">NOT STARTED <span class="pull-right"><?=$contract_month_status_1;?> / <?=$contract_total_status_1;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($contract_month_status_1, $contract_total_status_1); ?>%;" class="progress-bar progress-bar-default">
                    <?= GlobalFunction::calculateProgress($contract_month_status_1, $contract_total_status_1); ?> %
                </div></div>
                <p class="text-main text-sm top_summary_report"><span class="pull-right"> This Month / Total</span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-info text-md text-semibold">IN PROGRESS <span class="pull-right"><?=$contract_month_status_2;?> / <?=$contract_total_status_2;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($contract_month_status_2, $contract_total_status_2); ?>%;" class="progress-bar progress-bar-info">
                    <?= GlobalFunction::calculateProgress($contract_month_status_2, $contract_total_status_2); ?> %
                </div></div>
                <p class="text-info text-sm top_summary_report"><span class="pull-right">This Month / Total</span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-warning text-md text-semibold">ON HOLD <span class="pull-right"><?=$contract_month_status_4;?> / <?=$contract_total_status_4;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($contract_month_status_4, $contract_total_status_4); ?>%;" class="progress-bar progress-bar-warning">
                    <?= GlobalFunction::calculateProgress($contract_month_status_4, $contract_total_status_4); ?> %
                </div></div>
                <p class="text-warning text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-danger text-md text-semibold">CANCELLED <span class="pull-right"><?=$contract_month_status_5;?> / <?=$contract_total_status_5;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($contract_month_status_5, $contract_total_status_5); ?>%;" class="progress-bar progress-bar-danger">
                    <?= GlobalFunction::calculateProgress($contract_month_status_5, $contract_total_status_5); ?> %
                </div></div>
                <p class="text-danger text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>

        <div class="panel panel-bordered-mint">
            <div class="panel-body"> 
                <p class="text-success text-md text-semibold">FINISHED <span class="pull-right"><?=$contract_month_status_6;?> / <?=$contract_total_status_6;?></span></p>
                <div class="progress progress-md"><div style="width: <?= GlobalFunction::calculateProgress($contract_month_status_6, $contract_total_status_6); ?>%;" class="progress-bar progress-bar-success">
                    <?= GlobalFunction::calculateProgress($contract_month_status_6, $contract_total_status_6); ?> %
                </div></div>
                <p class="text-success text-sm top_summary_report"><span class="pull-right">This Month / Total<span></p>
            </div>
        </div>
    </div>                
</div> 

<style type="text/css">
    .add_new{
        cursor: pointer !important;
        position: absolute;
        top: 0px;
        right: 0px;
        background: none;
        color: #f05c11;
        border: none;
    }
    .panel-bordered-mint {
        border: none;
    }
    .panel-title {
        text-transform: uppercase;
    }
    span.text-semibold {
        font-weight: 400;
    }
    span.panel-title {
        text-align: center;
        width: 100%;
        font-size: 14px;
    }

/*-----Circle Progress------*/
    .wrap_circle{
        height: 0px;
    }
    .wrap_circle .progress {
        width: 135px;
        height: 137px;
        line-height: 150px;
        background: none;
        margin: 0 auto;
        box-shadow: none;
        position: relative;
    }
    .wrap_circle .progress:after {
        content: "";
        width: 135px;
        height: 135px;
        border-radius: 50%;
        border: 7px solid #eee;
        position: absolute;
        top: 0;
        left: 0;
    }
    .wrap_circle .progress > span {
        width: 50%;
        height: 100%;
        overflow: hidden;
        position: absolute;
        top: 0;
        z-index: 1;
    }
    .wrap_circle .progress .progress-left {
        left: 0;
    }
    .wrap_circle .progress .progress-bar {
        width: 67px;
        height: 135px;
        background: none;
        border-width: 7px;
        border-style: solid;
        position: absolute;
        top: 0;
        border-color: #ffb43e;
    }
    .wrap_circle .progress .progress-left .progress-bar {
        left: 100%;
        border-top-right-radius: 75px;
        border-bottom-right-radius: 75px;
        border-left: 0;
        -webkit-transform-origin: center left;
        transform-origin: center left;
    }
    .wrap_circle .progress .progress-right {
        right: 0;
    }
    .wrap_circle .progress .progress-right .progress-bar {
        left: -100%;
        border-top-left-radius: 82px;
        border-bottom-left-radius: 82px;
        border-right: 0;
        -webkit-transform-origin: center right;
        transform-origin: center right;
    }
    .wrap_circle .progress .progress-value {
        display: flex;
        border-radius: 50%;
        font-size: 36px;
        text-align: center;
        line-height: 20px;
        align-items: center;
        justify-content: center;
        height: 100%;
        font-weight: 300;
    }
    .wrap_circle .progress .progress-value div {
        margin-top: 10px;
    }
    .wrap_circle .progress .progress-value span {
        font-size: 12px;
        text-transform: uppercase;
    }
/* This for loop creates the necessary css animation names Due to the split circle of progress-left and progress right, we must use the animations on each side. */
    .wrap_circle .progress[data-percentage="10"] .progress-right .progress-bar {
        animation: loading-1 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="10"] .progress-left .progress-bar {
        animation: 0;
    }
    .wrap_circle .progress[data-percentage="20"] .progress-right .progress-bar {
        animation: loading-2 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="20"] .progress-left .progress-bar {
        animation: 0;
    }
    .wrap_circle .progress[data-percentage="30"] .progress-right .progress-bar {
        animation: loading-3 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="30"] .progress-left .progress-bar {
        animation: 0;
    }
    .wrap_circle .progress[data-percentage="40"] .progress-right .progress-bar {
        animation: loading-4 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="40"] .progress-left .progress-bar {
        animation: 0;
    }
    .wrap_circle .progress[data-percentage="50"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="50"] .progress-left .progress-bar {
        animation: 0;
    }
    .wrap_circle .progress[data-percentage="60"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="60"] .progress-left .progress-bar {
        animation: loading-1 1.5s linear forwards 1.5s;
    }
    .wrap_circle .progress[data-percentage="70"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="70"] .progress-left .progress-bar {
        animation: loading-2 1.5s linear forwards 1.5s;
    }
    .wrap_circle .progress[data-percentage="80"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="80"] .progress-left .progress-bar {
        animation: loading-3 1.5s linear forwards 1.5s;
    }
    .wrap_circle .progress[data-percentage="90"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="90"] .progress-left .progress-bar {
        animation: loading-4 1.5s linear forwards 1.5s;
    }
    .wrap_circle .progress[data-percentage="100"] .progress-right .progress-bar {
        animation: loading-5 1.5s linear forwards;
    }
    .wrap_circle .progress[data-percentage="100"] .progress-left .progress-bar {
        animation: loading-5 1.5s linear forwards 1.5s;
    }
    @keyframes loading-1 {
        0% {
             -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(36);
            transform: rotate(36deg);
        }
    }
    @keyframes loading-2 {
        0% {
             -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
        100% {
            -webkit-transform: rotate(72);
            transform: rotate(72deg);
        }
    }
    @keyframes loading-3 {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }
         100% {
             -webkit-transform: rotate(108);
             transform: rotate(108deg);
        }
    }
     @keyframes loading-4 {
         0% {
             -webkit-transform: rotate(0deg);
             transform: rotate(0deg);
        }
         100% {
             -webkit-transform: rotate(144);
             transform: rotate(144deg);
        }
    }
     @keyframes loading-5 {
         0% {
             -webkit-transform: rotate(0deg);
             transform: rotate(0deg);
        }
         100% {
             -webkit-transform: rotate(180);
             transform: rotate(180deg);
        }
    }
    .wrap_circle .progress {
        margin-bottom: 1em;
    }

/*---End Circle Progress---*/

</style>
<?php
 
$this->registerJs('

$(document).on("click","#modalButton",function () { 
    $("#overlay").css("display", "block");
    $("#res-result").load($(this).attr("value"), function(res){ 
        $(this).html("");
        $("#modal").modal("show")
        $("#modalContent").html(res)
        $("#overlay").css("display", "none");
    })

});
')
?>
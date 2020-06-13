<?php
use yii\widgets\ListView;
use common\models\GlobalFunction;
use yii\helpers\Url;



/* @var $this yii\web\View */

$this->title = 'Dashboard | eO-BMS';

// echo $_SESSION['company_id'];
?> 
<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-8 ">
                <div class="col-md-6">
                    <h2>Summary Last Month  </h2> 
                    <hr>
                    <!-- ===============Sale============= -->
                    <ul class="wr-summary-sale">
                        <li> 
                            <label>Sale</label>
                        </li>
                    </ul>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Target</td>
                                <td>100,00 USD$</</td>
                                <td>Achieved</td>
                                <td>100,00 USD$ (100 %)</td>
                            </tr>
                            <tr>
                                <td>Won</td>
                                <td>10 Case </td>
                                <td colspan="2">12,000 USD$</td>
                            </tr>
                            <tr>
                                <td>Lost</td>
                                <td>5 Case</td>
                                <td colspan="2">1,000 USD$</</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td>15 Case</td>
                                <td colspan="2">13,000 USD$</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- ===============Operation============= -->
                    <ul class="wr-summary-sale">
                        <li> 
                            <label>Operation</label>
                        </li>
                    </ul>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Target</td>
                                <td>100 Project</td>
                                <td>Achieved</td>
                                <td>5 Project (50 %)</td>
                            </tr>
                            <tr>
                                <td>Finish</td>
                                <td colspan="3"> 3 Project (80 %)</</td>
                            </tr>
                            <tr>
                                <td>Processing</td>
                                <td colspan="3">2 Project (20 %)</</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td colspan="3">5 Project</td>
                            </tr>
                        </tbody>
                    </table>   
                </div>
                <div class="col-md-6">
                    <h2>Summary This Month  </h2> 
                    <hr>
                    <!-- ===============Sale============= -->
                    <ul class="wr-summary-sale">
                        <li> 
                            <label>Sale</label>
                        </li>
                    </ul>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Target</td>
                                <td><?=$target_sale_1;?> USD$</td>
                                <td>Achieved</td>
                                <td><?=$achieved_sale_1;?>  USD$ (<?= GlobalFunction::calculateProgress($target_sale_1, $achieved_sale_1); ?> %)</td>
                            </tr>
                            <tr>
                                <td>Won</td>
                                <td><?=$won_case_sale_1;?> Case </td>
                                <td colspan="2"><?=$won_amount_sale_1;?>  USD$</td>
                            </tr>
                            <tr>
                                <td>Lost</td>
                                <td><?=$lost_case_sale_1;?>  Case</td>
                                <td colspan="2"><?=$lost_amount_sale_1;?> USD$</</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td><?=$total_case_sale_1;?>  Case</td>
                                <td colspan="2"><?=$total_amount_sale_1;?>  USD$</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- ===============Operation============= -->
                    <ul class="wr-summary-sale">
                        <li> 
                            <label>Operation</label>
                        </li>
                    </ul>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Target</td>
                                <td><?=$target_operation_1;?> Project</td>
                                <td>Achieved</td>
                                <td><?=$achieved_operation_1;?> Project (<?= GlobalFunction::calculateProgress($target_operation_1, $achieved_operation_1); ?> %)</td>
                            </tr>
                            <tr>
                                <td>Finish</td>
                                <td colspan="3"> <?=$finish_operation_1;?> Project (<?= GlobalFunction::calculateProgress($finish_operation_1, $finish_operation_1); ?> %)</</td>
                            </tr>
                            <tr>
                                <td>Processing</td>
                                <td colspan="3"><?=$processing_operation_1;?> Project (<?= GlobalFunction::calculateProgress($processing_operation_1, $processing_operation_1); ?> %)</</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td colspan="3"><?=$total_operation_1;?> Project</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <h2>Latest News</h2>
                <hr>
                <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider, 
                        'itemView' => function ($model, $key, $index, $widget){
                    ?>
                        <ul class="wr-summary-news">
                            <li> 
                                <?php $over_view_news = URL::toRoute(['news/news-detail','id' => $model->id]) ;?>
                                <a href="<?= $over_view_news ?>" target="_blank"><label>News: <?= $model->name ;?></label></a><!-- <i class="fa fa-ellipsis-h" aria-hidden="true"></i>--> <a href = "http://localhost/dropbox/eocambo_bms_2020/backend/web/index.php?r=news" target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                           <?= $model->description ;?>
                        <div class="news_img">
                            <?php

                                if ($model->feature_image == " ") {
                                    // echo "<a href = '$over_view_news' target='_blank'><img src='../web/uploads/empty_img.png' alt=''></a>";
                                }else{
                                    // echo $model->feature_image;
                                    echo "<a href = '$over_view_news' target='_blank'><img src='$model->feature_image' alt=''></a>";
                                }
                            ?>  
                        </div>
                    <?php
                        }
                    ]);
                ?>
                

            </div>
        </div>
    </div>
</div>
<style type="text/css">
    .news_img{
        height: 200px;
        position: relative;
        margin-bottom: 20px;
    }
    .news_img img{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .wr-summary-news,.wr-summary-sale{
        list-style: none;
        padding-left: 0px;
    }
    .wr-summary-sale li, a label{
        font-size: 15px;
        color: #f05c11d9;
        /*margin-top: 20px;*/
    }
    .wr-summary-news i{
        color: #505354;
        font-size: 15px;
        float: right;
        margin-top: 6px;
    }
    a label,img {
        cursor: pointer;
    }
    p{
        width: 380px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

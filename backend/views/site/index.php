<?php
use yii\widgets\ListView;
use common\models\GlobalFunction;
use yii\helpers\Url;
use yii\bootstrap\Modal; 
use backend\models\NewsLetterDashboardSearch;



/* @var $this yii\web\View */

$this->title = 'Dashboard | eO-BMS';

// echo $_SESSION['company_id'];
?>
<div class="site-index">
    <div class="body-content">
        
    </div>
</div>
<style type="text/css">
    .news_img{
        /*height: 200px;*/
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
        color: #2b3d50;
        font-weight: 700;
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
    .wr-list-news .content{
        display: block;/* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 10.6em;
  line-height: 1.8em;

    }
    .text-semibold, .text-sm {
        width: auto;
    }
    .progress {
        height: 15px;
    }
    .panel {
        margin-bottom: 0px;
    }
    .wr-list-news{
        padding-bottom: 10px;
        border-bottom: 8px solid #f5f8fa;
        margin-bottom: 15px;
    }
    .wrapper .container{
        padding:0 !important;
    }
    .nav-tabs{
        margin-top: 18px;
    }
    h3 {
        font-size: 18px !important;
    }
    ul.nav.nav-tabs li {
        width: 150px;
        text-align: center;
    }
</style>
<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
       // 'assets/plugins/morris/morris.css',
       'assets/plugins/switchery/switchery.min.css',
       'css/custom.css',
       'css/font-awesome.css',
       'css/sweetalert.css',
       'css/jquery-ui.css',
       'css/bootstrap.min.css',
       'css/intlTelInput.css',
       'assets/plugins/custombox/css/custombox.min.css',
       'assets/css/style.css',
       'assets/plugins/timepicker/bootstrap-timepicker.min.css',
       'assets/plugins/mjolnic-bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
       'assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css',
       'assets/plugins/clockpicker/bootstrap-clockpicker.min.css',
       'assets/plugins/bootstrap-daterangepicker/daterangepicker.css',
       'css/style.css',
       //'https://cdn.jsdelivr.net/npm/summernote@0.8.15/dist/summernote.min.css',


    ];
    public $js = [
        'https://code.jquery.com/jquery-3.4.1.js',
        'js/jquery.easypiechart.js',
        'js/bootstrap.min.js',
        'js/jquery-ui.min.js',
        'js/numeral.js',
        'js/intlTelInput.js',
        'js/custom.js',
        'js/sweetalert.min.js',
        'js/dateformat.js',
        // 'https://unpkg.com/sweetalert/dist/sweetalert.min.js',
        'assets/plugins/custombox/js/custombox.min.js',
        'assets/plugins/custombox/js/legacy.min.js',
        'assets/plugins/mjolnic-bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
        'assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js',
        'assets/plugins/clockpicker/bootstrap-clockpicker.js',
        'assets/js/modernizr.min.js',
        'js/locationpicker.jquery.js',
        // 'js/dashboard-custom.js',
        'assets/js/tether.min.js',
        'assets/js/bootstrap.min.js',
        // 'assets/js/waves.js',
        'assets/js/jquery.nicescroll.js',
        'assets/plugins/switchery/switchery.min.js',
        // 'assets/plugins/morris/morris.min.js',
        'assets/plugins/raphael/raphael-min.js',
        'assets/plugins/waypoints/lib/jquery.waypoints.js',
        'assets/plugins/counterup/jquery.counterup.min.js',
        'assets/js/jquery.core.js',
        'assets/js/jquery.app.js',
        // 'assets/pages/jquery.dashboard.js',
        'js/noty/jquery.noty.js',
        'js/noty/layouts/topCenter.js',
        'js/noty/themes/default.js', 
    ];
    public $depends = [
        'yii\web\YiiAsset',
        // 'yii\bootstrap\BootstrapAsset',
    ];

}

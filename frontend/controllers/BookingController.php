<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Booking;
use frontend\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Cookie;
use yz\shoppingcart\ShoppingCart;
use frontend\models\TourItem;
use frontend\models\TourItemCard;
use backend\models\ExtraService;

use backend\models\CustomerBooking;
use backend\models\CustomerBookingItem;
use backend\models\CustomerBookingExtraService;
use backend\models\CompanyProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\assets\BackendAsset;




use frontend\models\User;
$base_url = Yii::getAlias('@web');
/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingController extends Controller
{
    /**
     * {@inheritdoc}
     */

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        // $searchModel = new BookingSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        // return $this->render('index', [
        //     'searchModel' => $searchModel,
        //     'dataProvider' => $dataProvider,
        // ]);
        // $model = new Booking();
        // $cart = new ShoppingCart();  
        // $data = $cart->getPositions();
        // return $this->render('cart',[
        //     'data' => $data,
        //     'model' => $model,

        // ]);

        $tour_item_added = TourItemCard::Find()->where(['session_id'=>session_id()])->all();
        $extra_service = ExtraService::Find()->where(['status'=>1])->all();
        $model = new Booking();

        //edit local
        if (!empty($tour_item_added)) {
            return $this->render('cart',[
                'tour_item_added' => $tour_item_added,
                'model' => $model,
                'extra_service' => $extra_service,

            ]);
        }else{
            return $this->render('empty_cart');
        }

        


    }
// Send Email
    public function actionSendEmail(){
        
        $admin_email = User::find()->where(['id'=>1])->one()->email;
        $company_profile = CompanyProfile::find()->where(['id'=>1])->one();
        $this->layout = 'inner';
        $this->view->title = 'Mail Send';
        if (Yii::$app->request->isPost) {
            $first_name = Yii::$app->request->post('first_name');
            $last_name = Yii::$app->request->post('last_name');
            $full_name = $first_name." ".$last_name;
            $title = Yii::$app->request->post('title');
            $email = Yii::$app->request->post('email');
            // $confirm_email = Yii::$app->request->post('confirm_email');
            $contact = Yii::$app->request->post('contact');
            $country_id = Yii::$app->request->post('country_name');
            $message = Yii::$app->request->post('message');
            $pick_up_location = Yii::$app->request->post('pick_up_location');

            //credit card info
            $credit_card_number = Yii::$app->request->post('credit_card_number');
            $card_name = Yii::$app->request->post('card_name');
            $card_security_code = Yii::$app->request->post('card_security_code');
            $expired_month = Yii::$app->request->post('expired_month');
            $expired_year = Yii::$app->request->post('expired_year');

            //insert customer booking model
            $model_customer_booking = new CustomerBooking();
            $model_customer_booking->name = $first_name." ".$last_name;
            $model_customer_booking->date = date('y-m-d h:i');
            $model_customer_booking->email = $email;
            $model_customer_booking->description = $message;
            $model_customer_booking->pick_up_location = $pick_up_location;
            $model_customer_booking->phone_number = $contact;
            $model_customer_booking->country_id = $country_id;
            $model_customer_booking->booking_code = date('his');

            //cart info
            $model_customer_booking->credit_card_number = $credit_card_number;
            $model_customer_booking->credit_card_name = $card_name;
            $model_customer_booking->credit_card_security_code = $card_security_code;
            $model_customer_booking->expired_month = $expired_month;
            $model_customer_booking->expired_year = $expired_year;
            // echo "<pre>";
            // print_r($model_customer_booking);
            // exit();

            $model_customer_booking->save();

            $booking_id = $model_customer_booking->id;
            $booking_code = $model_customer_booking->booking_code;

            // insert tour item
            $item_added_card = TourItemCard::find()->where(['status'=>1, 'session_id'=>session_id()])->all();
            if ($item_added_card) {
                foreach ($item_added_card as $item_added_card) {
                    $model_customer_booking_item = new CustomerBookingItem();
                    $model_customer_booking_item->customer_booking_id = $booking_id;
                    $model_customer_booking_item->tour_item_id = $item_added_card->tour_item_id;
                    $model_customer_booking_item->name = $item_added_card->name;
                    $model_customer_booking_item->description = $item_added_card->description;
                    $model_customer_booking_item->adult = $item_added_card->adult;
                    $model_customer_booking_item->child = $item_added_card->child;
                    $model_customer_booking_item->price = $item_added_card->amount;
                    $model_customer_booking_item->duration = $item_added_card->duration;
                    $model_customer_booking_item->starting_time = $item_added_card->starting_time;
                    $model_customer_booking_item->save();
                }
            }

            // insert customer booking extra service

            $service_name_id = Yii::$app->request->post('service_name');
            $number_adult = Yii::$app->request->post('number_adult');
            $number_child = Yii::$app->request->post('number_child');
            $total_extra_service = Yii::$app->request->post('total_extra_service');
            if ($service_name_id) {
                foreach ($service_name_id as $key => $value) {
                    // get extra service
                    $model_extra_service = ExtraService::find()->where(['id'=>$service_name_id[$key]])->one();
                    $price_adult = $model_extra_service->adult_price;
                    $price_child = $model_extra_service->child_price;
                    $policy = $model_extra_service->policy;

                    $model_extra_booking = new CustomerBookingExtraService();
                    $model_extra_booking->name = $model_extra_service->name;
                    $model_extra_booking->customer_booking_id = $booking_id;
                    $model_extra_booking->adult = $number_adult[$key];
                    $model_extra_booking->child = $number_child[$key];
                    $model_extra_booking->adult_price = $price_adult;
                    $model_extra_booking->child_price = $price_child;
                    $total_amount_extra = ($number_adult[$key] * $price_adult) + ($number_child[$key] * $price_child);
                    $model_extra_booking->extra_amount = $total_amount_extra;
                    $model_extra_booking->policy = $policy;
                    
                    $model_extra_booking->save();
                    Yii::$app->db->createCommand()->delete('customer_booking_extra_service', ['adult'=>0, 'child'=>0])->execute();

                }
            }


            $country_name = \backend\models\Country::find()
                                ->where(['status'=>1, 'company_id' => 1, 'id' => $country_id])
                                ->one()->name;
            $query = (new \yii\db\Query())->from('tour_item_card');
            $total_item_cost = $query->sum('amount');

            $query_extra = (new \yii\db\Query())->from('customer_booking_extra_service')->where(['customer_booking_id'=>$booking_id]);
            $total_extra_service_cost = $query_extra->sum('extra_amount');


            $number_of_item = TourItemCard::find()->where(['session_id'=>session_id()])->count();
            $current_date = date('yy-m-d H:i:s');

            $extra_service_detail = CustomerBookingExtraService::find()->where(['customer_booking_id'=>$booking_id])->all();
            $tour_item_added = TourItemCard::Find()->where(['session_id'=>session_id()])->all();
            $booking_url = Yii::getAlias('@web');
            $view_booking = Html::a('<span style= "background: #cccccc; padding: 10px; text-decoration: none; color: black; text-decoration: none;"> View Booking</span>',['/../../allotment/index', 'id' => $booking_id], ['class' => 'btn btn-primary']);
            // $view_booking = '<button href= "'.$booking_url.'">View Booking</button>';
            // $arr_booking = TourItemCard::find()->where(['session_id'=>session_id()])->all();
            // foreach ($arr_booking as $row) {
            //     $id_rate_setup = \backend\models\RatePlanSetup::find()->where(['name'=>$row->name])->one()->id;
            //     $origional_number = \backend\models\Allotment::find()->where(['rate_set_up_id'=>$id_rate_setup])->all();
            //     foreach ($origional_number as $key => $value) {
            //         $guest = ($value->adult+$value->child)-$origional_number;
            //         Yii::$app->db->createCommand()
            //         ->update('allotment', [$guest], ['id'=>$row->tour_item_id])
            //         ->execute();
            //     }
            // }
            // exit();

            $item_data_arr = "";
            foreach ($tour_item_added as $row) {
                $item_name = TourItem::find()->where(['id'=>$row->tour_item_id])->one()->name;
                $item_data_arr .= "<div style='background-color:rgb(238,238,238);padding:5px;font-size:14px;margin-top:20px'>$item_name</div>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding-bottom:8px;margin-top:8px'>
                                        <tbody>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px;vertical-align:top'>
                                                    <strong>Name:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>$row->name</td>
                                            </tr>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px;vertical-align:top'>
                                                    <strong>Number of guests:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>$row->adult Adults | $row->child Childs</td>
                                            </tr>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px'>
                                                    <strong>Total price:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>US$ $row->amount
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>";
            }
            $extra_service_arr = "";
            foreach ($extra_service_detail as $row) {
                $extra_service_arr .= "<div style='background-color:rgb(238,238,238);padding:5px;font-size:14px;margin-top:20px'>$row->name</div>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding-bottom:8px;margin-top:8px'>
                                        <tbody>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px;vertical-align:top'>
                                                    <strong>Number of guests:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>$row->adult Adults | $row->child Childs</td>
                                            </tr>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px'>
                                                    <strong>Total price:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>US$ $row->extra_amount
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px;vertical-align:top'>
                                                    <strong>Booking policies:</strong>
                                                </td>
                                                <td width='80%' style='padding:1px 15px'>
                                                    <span>$row->policy</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>";
            }
           
            $email_body = '<blockquote style="margin:0 0 0 0ex;border-left:0px;padding-left:0ex">
                <div dir="ltr">
                    <table width="100%" border="0" cellspacing="0" style="font-family:&quot;Open Sans&quot;,sans-serif;font-size:12px;margin:0px">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="font-size:20px">New Booking - Siem Reap Angkor Adventure</p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="background-color:rgb(238,238,238);padding:15px;border-bottom-left-radius:0px;border-bottom-right-radius:0px">
                                    <table width="100%" border="0" cellpadding="0">
                                        <tbody>
                                            <tr valign="top">
                                                <td width="65%">
                                                    <strong>CONGRATULATIONS! You’ve received a new booking.</strong>
                                                </td>
                                                <td width="35%">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td align="right">
                                                                    <strong>Booking number:</strong>
                                                                    <span>&nbsp;</span>
                                                                    <a href="code:'.$booking_code.'" target="_blank">'.$booking_code.'</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="background-color:rgb(248,248,248);padding:0px 15px 15px;border-top-left-radius:0px;border-top-right-radius:0px">
                                    <table width="100%" border="0" cellpadding="0">
                                        <tbody>
                                            <tr valign="top">
                                                <td width="65%">
                                                    <ul style="padding:15px 0px 0px 15px;margin:0px">
                                                        <li style="line-height:20px;padding:0px;margin:0px">We have sent the confirmation email to the guest.
                                                        </li>
                                                        <li style="line-height:20px;padding:0px;margin:0px">For booking enquiries, cancellations or amendments the guest has been instructed to contact you directly.</li>
                                                    </ul>
                                                </td>
                                                <td width="35%" style="vertical-align:bottom">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr class= "booking-here">
                                                                <td align="right" style="padding-top:10px">
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>YOUR BOOKING</strong>
                                    </div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:8px;margin-top:8px">
                                        <tbody>
                                            <tr>
                                                <td valign="top" width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Guest:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$full_name.' ('.$country_name.')</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" width="20%" style="padding:1px 20px">
                                                    <strong>&nbsp;</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <a href="'.$email.'" title="mailto:'.$email.'" target="_blank">'.$email.'</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" width="20%" style="padding:1px 20px">
                                                    <strong>&nbsp;</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <a href="tel:+85577466082" target="_blank">'.$contact.'</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Check-in:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$_SESSION['from_date'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Check-out:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$_SESSION['to_date'].'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Booked on:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$current_date.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Total item cost:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">US$ '.$total_item_cost.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Total extra service cost:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">US$ '.$total_extra_service_cost.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Balance due on arrival:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <strong>US$ '.number_format($total_item_cost+$total_extra_service_cost, 2).'
                                                        <span>&nbsp;</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Balance due now:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">US$ 00.00</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Pick up at:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$pick_up_location.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>ADDITIONAL DETAILS</strong>
                                    </div>
                                    <br><b style="padding:1px 20px;font-size: 15px;">Additional comments: </b> ' .$message. '
                                    <div style="border-bottom:2px solid rgb(238,238,238);font-size:14px;margin-top:16px">
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>ITEM DETAILS</strong>
                                    </div>
                                    '.$item_data_arr.'
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>EXTRA INFO</strong>
                                    </div>
                                    '.$extra_service_arr.'
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </blockquote>';

            // ======for customer 
            $extra_service_arr = "";
            foreach ($extra_service_detail as $row) {

                $extra_service_arr .= "<div style='background-color:rgb(238,238,238);padding:5px;font-size:14px;margin-top:20px'>$row->name</div>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%' style='padding-bottom:8px;margin-top:8px'>
                                        <tbody>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px;vertical-align:top'>
                                                    <strong>Number of guests:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>$row->adult Adults | $row->child Childs</td>
                                            </tr>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px'>
                                                    <strong>Total price:</strong>
                                                </td>
                                                <td align='80%' width='50' style='padding:1px 15px'>US$ $row->extra_amount
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width='20%' style='padding:1px 20px;vertical-align:top'>
                                                    <strong>Booking policies:</strong>
                                                </td>
                                                <td width='80%' style='padding:1px 15px'>
                                                    <span>$row->policy</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>";
            }

            $email_body_customer = '<blockquote style="margin:0 0 0 0ex;border-left:0px;padding-left:0ex">
                <div dir="ltr">
                    <table width="100%" border="0" cellspacing="0" style="font-family:&quot;Open Sans&quot;,sans-serif;font-size:12px;margin:0px">
                        <tbody>
                            <tr>
                                <td>
                                    <p style="font-size:20px">Siem Reap Angkor Adventure</p>
                                </td>
                            </tr>
                            <tr>
                                <td valign="top" style="background-color:rgb(238,238,238);padding:15px;border-bottom-left-radius:0px;border-bottom-right-radius:0px">
                                    <table width="100%" border="0" cellpadding="0">
                                        <tbody>
                                            <tr valign="top">
                                                <td width="65%">
                                                    <strong>CONGRATULATIONS! Your booking has been successful.</strong>
                                                </td>
                                                <td width="35%">
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tbody>
                                                            <tr>
                                                                <td align="right">
                                                                    <strong>Booking number:</strong>
                                                                    <span>&nbsp;</span>
                                                                    <a href="code:'.$booking_code.'" target="_blank">'.$booking_code.'</a>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="background-color:#f8f8f8;padding:0 15px 15px 15px;border-top-left-radius:0;border-top-right-radius:0" valign="top">
                                                    <table width="100%" border="0" cellpadding="0">
                                                        <tbody>
                                                            <tr valign="top">
                                                                <td width="65%">
                                                                    <ul style="padding:15px 0px 0px 15px;margin:0px">
                                                                        <li style="line-height:20px;padding:0px;margin:0px">We have sent the confirmation email to the guest.
                                                                        </li>
                                                                        <li style="line-height:20px;padding:0;margin:0">For booking enquires, cancellations or amendments please contact us directly at 
                                                                            <a href="mailto:'.$company_profile->general_email.'" target="_blank">'.$company_profile->general_email.'</a> or 
                                                                            <a href="tel:+85569955179" target="_blank">'.$company_profile->main_phone_1.'</a>, 
                                                                            <a href="tel:+85577466082" target="_blank">'.$company_profile->main_phone_2.'</a>.
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>YOUR BOOKING</strong>
                                    </div>
                                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="padding-bottom:8px;margin-top:8px">
                                        <tbody>
                                            <tr>
                                                <td valign="top" width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Guest:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$full_name.' ('.$country_name.')</td>
                                            </tr>
                                            <tr>
                                                <td valign="top" width="20%" style="padding:1px 20px">
                                                    <strong>&nbsp;</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <a href="'.$email.'" title="mailto:'.$email.'" target="_blank">'.$email.'</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" width="20%" style="padding:1px 20px">
                                                    <strong>&nbsp;</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <a href="tel:+85577466082" target="_blank">'.$contact.'</a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Check-in:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$item_added_card->from_date.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Check-out:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$item_added_card->to_date.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Booked on:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$current_date.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Total item cost:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">US$ '.$total_item_cost.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Total extra service cost:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">US$ '.$total_extra_service_cost.'</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Balance due on arrival:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <strong>US$ '.number_format($total_item_cost+$total_extra_service_cost, 2).'
                                                        <span>&nbsp;</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Balance due now:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">US$ 00.00</td>
                                            </tr>
                                            <tr>
                                                <td width="20%" style="padding:1px 10px 1px 20px">
                                                    <strong>Pick up at:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">'.$pick_up_location.'</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>ITEM DETAILS</strong>
                                    </div>
                                    '.$item_data_arr.'
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div style="border-bottom:2px solid rgb(238,238,238);padding-bottom:8px;font-size:14px;margin-top:20px">
                                        <strong>EXTRA INFO</strong>
                                    </div>
                                    '.$extra_service_arr.'
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </blockquote>';
            //to admin
            Yii::$app->mailer->compose()
            ->setFrom($email)
            ->setTo($admin_email)
            ->setSubject('New Booking - Siem Reap Angkor Adventure')
            ->setHtmlBody($email_body)
            // echo $email_body;
            // exit();
            ->send();

            //to admin
            Yii::$app->mailer->compose()
            ->setFrom($admin_email)
            ->setTo($email)
            ->setSubject('Congratulation!   '.$full_name.' your booking is successful')
            ->setHtmlBody($email_body_customer)
            ->send();
            Yii::$app->db->createCommand()->delete('tour_item_card')->execute();
            
            
            

            Yii::$app->session->setFlash('success', "Booking Successful");
            return $this->redirect('index.php?r=booking%2Fthank-guest');
        }
        
    }
    public function actionThankGuest()
    {
        return $this->render('thank_guest');
    }

//End Send Email
//Shopping cart
    public function actionAddToCart($id)
    {
            $adult = Yii::$app->getRequest()->getQueryParam('adult');
            $child = Yii::$app->getRequest()->getQueryParam('child');
            $price_adult = Yii::$app->getRequest()->getQueryParam('price_adult');
            $price_child = Yii::$app->getRequest()->getQueryParam('price_child');
            $item_id = Yii::$app->getRequest()->getQueryParam('item_id');
            $rate_set_up_id = Yii::$app->getRequest()->getQueryParam('rate_set_up_id');
            $from_date = Yii::$app->getRequest()->getQueryParam('from_date');
            $to_date = Yii::$app->getRequest()->getQueryParam('to_date');
            $price = Yii::$app->getRequest()->getQueryParam('price');

                $model_tour_item_card = new TourItemCard();
                $model_rate_set_up = \backend\models\RatePlanSetup::findOne($rate_set_up_id);
                $model = TourItem::findOne($item_id);
                $model_tour_item_card->tour_item_id = $model->id;
                $model_tour_item_card->company_id = 1;
                $model_tour_item_card->name = $model_rate_set_up->name;
                $model_tour_item_card->feature_image = $model->feature_image;
                $model_tour_item_card->description = $model->description;
                $model_tour_item_card->cost = $price;
                $model_tour_item_card->duration = $model->duration;
                $model_tour_item_card->starting_time = $model_rate_set_up->starting_time;
                $model_tour_item_card->tip_note = $model->tip_note;
                $model_tour_item_card->recommended = $model->recommended;
                $model_tour_item_card->duration_type = $model->duration_type;
                $model_tour_item_card->status = 1;
                $model_tour_item_card->created_date = $model->created_date;
                $model_tour_item_card->created_by = $model->created_by;
                $model_tour_item_card->timestamp = date('h:i:s');
                $model_tour_item_card->from_date = $from_date;
                $model_tour_item_card->to_date = $to_date;
                $model_tour_item_card->adult = $adult;
                $model_tour_item_card->child = $child;
                $model_tour_item_card->price_child = $price_child;
                $model_tour_item_card->price_adult = $price_adult;
                $model_tour_item_card->session_id = session_id();

        // $amount = $model_tour_item_card->cost * $model_tour_item_card->adult * $model_tour_item_card->adult;
                $model_tour_item_card->amount = ($price_child * $child) + ($price_adult * $adult);
                // $find_delete = TourItemCard::find()->where(['tour_item_id'=>$model_tour_item_card->tour_item_id, 'from_date' => $model_tour_item_card->from_date, 'to_date'=>$model_tour_item_card->to_date, 'session_id' => session_id()])->one()->id;

                \Yii::$app
                ->db
                ->createCommand()
                ->delete('tour_item_card', ['name' => $model_tour_item_card->name, 'from_date' => $model_tour_item_card->from_date, 'to_date'=>$model_tour_item_card->to_date, 'session_id' => session_id()])
                ->execute();
        // exit();
        // $cart = new ShoppingCart();

        // $model = TourItem::findOne($id);
        // if ($model) {
        //     Yii::$app->session->setFlash('success', "Saved successful");
        //     return $this->redirect(Yii::$app->request->referrer);

        //     // $cart->put($model, 1);
        //     // $data = $cart->getPositions();
        //     // return $this->redirect('index.php?r=booking%2Findex');
        // }
        // throw new NotFoundHttpException();
        
        if ($model_tour_item_card->save()){
            Yii::$app->session->setFlash('success', "Added to card");
            return $this->redirect('index.php?r=booking');
        }

    }

 
    public function actionRemoveFromCart($id)
    {
        $tour_item_card = TourItemCard::find()->where(['id'=>$id, 'session_id'=>session_id()])->one();
        $tour_item_card->delete();
            Yii::$app->session->setFlash('success', "Item Deleted");
        return $this->redirect('index.php?r=booking%2Findex');

    }

    public function actionEditFromCart($id, $item_id)
    {
        $tour_item_card = TourItemCard::find()->where(['id'=>$id, 'session_id'=>session_id()])->one();
        $tour_item_card->delete();
        return $this->redirect(['allotment/item-detail', 'id' => $item_id]);

    }

//End Shopping cart 

    /**
     * Displays a single Booking model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this -> layout = 'blankLayout';

        $model = new Booking();

        $model->created_date =  date('Y-m-d H:i:s');
        $model->created_by = Yii::$app->user->getId(); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Your message to display.");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $this -> layout = 'blankLayout';

        $model = $this->findModel($id);

        $model->updated_date =  date('Y-m-d H:i:s');
        $model->updated_by = Yii::$app->user->getId(); 
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', "Saved successful");
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

     protected function findModelCart($id)
    {
        if (($model = ShoppingCart::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
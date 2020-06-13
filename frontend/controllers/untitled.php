
            //to customer
            Yii::$app->mailer->compose()
            ->setFrom($admin_email)
            ->setTo($email)
            ->setSubject('Congratulation!   '.$first_name.'Booking is successful')
            ->setHtmlBody('<blockquote style="margin:0 0 0 0ex;border-left:0px;padding-left:0ex">
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
                                                            <tr>
                                                                <td align="right" style="padding-top:10px">
                                                                    <a href="" style="text-decoration-line:none;background-color:rgb(71,146,215);border:0px solid rgb(41,117,188);display:inline-block;line-height:normal;padding:0.5rem 1rem 0.5625rem;text-align:center;color:rgb(255,255,255)" target="_blank" >VIEW BOOKING</a>
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
                                                <td style="background-color:#f8f8f8;padding:0 15px 15px 15px;border-top-left-radius:0;border-top-right-radius:0" valign="top">
                                                    <table width="100%" border="0" cellpadding="0">
                                                        <tbody>
                                                            <tr valign="top">
                                                                <td width="65%">
                                                                    <ul style="padding:15px 0 0 15px;margin:0">
                                                                        <li style="line-height:20px;padding:0;margin:0">For booking enquires, cancellations or amendments please contact us directly at 
                                                                            <a href="mailto:'.$company_profile->general_email.'" target="_blank">'.$company_profile->general_email.'</a> or 
                                                                            <a href="tel:+85569955179" target="_blank">'.$company_profile->main_phone_1.'</a>, 
                                                                            <a href="tel:+85577466082" target="_blank">'.$company_profile->main_phone_2.'</a>.
                                                                        </li>
                                                                    </ul>
                                                                </td>
                                                                <td style="font-size:12px" width="35%">
                                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td align="right">&nbsp;</td>
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
                                                    <strong>Balance due on arrival:</strong>
                                                </td>
                                                <td width="80%" style="padding:1px 20px">
                                                    <strong>US$ '.$total_item_cost.'
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
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </blockquote>')
            // ->send();
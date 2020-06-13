<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrap_intro">
    <div class="intro">
        <div class="container">
            <h1 class="intro-header">Hello, how can we help you today?</h1>
        </div>
    </div>
</div>
<div class="wrap_contact">
    <div class="contact-form-container">
        <div class="contact-us">
            <div class="contact-header">
              <h1>
                &#9135;&#9135;&#9135;&#9135;&nbsp;&nbsp;CONTACT US
              </h1>
            </div>
            <div class="social-bar">
                <ul>
                    <li>
                      <a href="<?= $company_profile->link_facebook ?>" target = "_blank">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                      </a>
                    </li>
                    <li>
                        <a href="<?= $company_profile->link_instagram ?>" target = "_blank">
                          <i class="fa fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                      <a href="<?= $company_profile->link_twitter ?>" target = "_blank">
                        <i class="fa fa-twitter"></i>
                      </a>
                    </li>
                    <li>
                      <a href="<?= $company_profile->link_linkedin ?>" target = "_blank">
                        <i class="fa fa-linkedin"></i>
                      </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="header">
            <h1>
              Let's Get Started
            </h1>
            <h2>
              Contact us to start your next project! 
            </h2>
        </div>
          <div class="contact_address">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <h3>
                <?= $company_profile->address?>
              </h3>
          </div>
        <div class="contact_email">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <h3>
              <?= $company_profile->general_email?>
            </h3>
        </div>
        <div class="contact-form">
            <?php $form = ActiveForm::begin([
                'action' => ['send-email-contact-us'],
            ]); ?>
                <input placeholder="Name" name = "name" required type="text" />
                <input placeholder="Email" name = "email" required type="contact_email" />
                <textarea placeholder="Tell us about your project..." rows="4" name = "comments"></textarea>
                <button type="submit">SEND </button>
            <?php ActiveForm::end(); ?>
        </div>
    </div>  
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d199706.71732953694!2d103.72623455333107!3d13.360496857971837!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3110169a8c91a879%3A0xa940aaf93ee5bbfa!2sKrong%20Siem%20Reap%2C%20Cambodia!5e0!3m2!1sen!2sus!4v1587107107130!5m2!1sen!2sus" width="100%" height="650px" frameborder="0" style="border:0; height: 500px;" allowfullscreen>
        </iframe>
    </div> 
</div>
<style type="text/css">
    @import url("https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap");
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Pretty Stuff */
    .wrap_contact .contact-form-container {
      background: #F4F3F3;
      font-family: "Lato", sans-serif;
    }

    .wrap_contact .contact-form-container .contact-us {
      position: relative;
      width: 250px;
      background: #ffffff;
      overflow: hidden;
    }
    .wrap_contact .contact-form-container .contact-us:before {
      position: absolute;
      content: "";
      bottom: -50px;
      left: -100px;
      height: 250px;
      width: 400px;
      background: #F8B7D8;
      transform: rotate(25deg);
    }
    .wrap_contact .contact-form-container .contact-us:after {
      position: absolute;
      content: "";
      bottom: -80px;
      right: -100px;
      height: 270px;
      width: 400px;
      background: #9ED8EB;
      transform: rotate(-25deg);
    }

    .wrap_contact .contact-form-container .contact-us .contact-header {
      color: white;
      position: absolute;
      transform: rotate(-90deg);
      top: 120px;
      left: -40px;
    }
    .wrap_contact .contact-form-container .contact-us .contact-header h1 {
      font-size: 24px;
      color: #87c2d6;
    }

    .wrap_contact .contact-form-container .contact-us .social-bar {
      position: absolute;
      bottom: 20px;
      left: 75px;
      z-index: 1;
      width: 100px;
    }
    .wrap_contact .contact-form-container .contact-us .social-bar ul {
      list-style-type: none;
    }
    .wrap_contact .contact-form-container .contact-us .social-bar ul li {
      display: inline-block;
      color: white;
      width: 25px;
      height: 25px;
      line-height: 25px;
      text-align: center;
      margin-right: -4px;
      font-size: 20px;
    }
    .wrap_contact .contact-form-container .contact-us .social-bar ul li a{
      color: white;
      font-size: 20px;
    }

    .wrap_contact .contact-form-container .header {
      text-align: center;
      padding: 20px 0;
      color: #444;
    }
    .wrap_contact .contact-form-container .header h1 {
      font-weight: normal;
    }
    .wrap_contact .contact-form-container .header h2 {
      margin-top: 10px;
      font-weight: 300;
    }

    .wrap_contact .contact-form-container .contact_address, .contact_email{
      text-align: center;
      padding: 20px 0;
      color: #444;
    }
    .wrap_contact .contact-form-container .contact_address h3, .contact_email h3, .contact_phone h3 {
        margin: 0;
        font-size: 15px;
        font-weight: 300;
    }
    .wrap_contact .contact-form-container .contact_address i, .contact_email i, .contact_phone i {
      color: #F8B7D8;
      font-size: 30px;
      margin-bottom: 20px;
    }

    .wrap_contact .contact-form-container .contact-form form {
      position: relative;
      width: 490px;
      margin: 0 auto;
      padding: 20px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
      background: white;
    }
    .wrap_contact .contact-form-container .contact-form form input, form textarea {
      background: white;
      display: block;
      margin: 20px auto;
      width: 100%;
      border: 0;
    }
    .wrap_contact .contact-form-container .contact-form form input {
      height: 40px;
      line-height: 40px;
      outline: 0;
      border-bottom: 1px solid rgba(68, 68, 68, 0.3);
      font-size: 17px;
      color: rgba(68, 68, 68, 0.8);
    }
    .wrap_contact .contact-form-container .contact-form form textarea {
      border-bottom: 1px solid rgba(68, 68, 68, 0.3);
      resize: none;
      outline: none;
      font-size: 17px;
      font-family: lato;
      color: rgba(68, 68, 68, 0.8);
    }
    .wrap_contact .contact-form-container .contact-form form button {
      position: absolute;
      display: block;
      height: 40px;
      width: 250px;
      left: 122px;
      border: 0;
      border-radius: 20px;
      bottom: -20px;
      background: #9ED8EB;
      color: white;
      font-size: 21px;
      font-weight: 400;
      outline: none;
    }

    .wrap_contact .contact-form-container .contact-form {
        padding-bottom: 60px;
    }

    /* Layout Stuff */
    .wrap_contact {
      background: #ffffff;
      /*height: 100vh;*/
      width: 100%;
      position: relative;
      background-size: cover;
      background-repeat: no-repeat;
      display: grid;
      justify-items: center;
      align-items: center;
    }

    .wrap_contact .contact-form-container {
        margin-top: 55px;
        width: 888px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        grid-template-rows: 0.5fr 0.5fr 2fr;
        grid-template-areas: "contact-us header header header" "contact-us contact_address contact_phone contact_email" "contact-us contact-form contact-form contact-form";
    }

    .wrap_contact .contact-form-container .contact-us {
      grid-area: contact-us;
      border: 1px solid #9ed8eb;
    }

    .wrap_contact .contact-form-container .header {
      grid-area: header;
    }

    .wrap_contact .contact-form-container .contact_address {
      grid-area: contact_address;
    }

    .wrap_contact .contact-form-container .contact_phone {
      grid-area: contact_phone;
    }

    .wrap_contact .contact-form-container .contact_email {
      grid-area: contact_email;
    }

    .wrap_contact .contact-form-container .contact-form {
      grid-area: contact-form;
    }
    .wrap_contact .map{
        width: 100%;
        height: 500px;
        margin-top: 55px;
    }
    .wrap_intro .intro{
        background: #ffe5ee;
    }
    .wrap_intro .intro .container{
        text-align: center;
    }
    .wrap_intro .intro .container .intro-header {
        font-size: 33px;
        color: #1a2b49;
        margin: 70px auto;
    }
    @media only screen and (max-width: 600px) {
        @import url("https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap");
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        /* Pretty Stuff */
        .wrap_contact .contact-form-container {
          background: #F4F3F3;
          font-family: "Lato", sans-serif;
        }

        .wrap_contact .contact-form-container .contact-us {
          position: relative;
          width: 250px;
          background: #ffffff;
          overflow: hidden;
        }
        .wrap_contact .contact-form-container .contact-us:before {
          position: absolute;
          content: "";
          bottom: -50px;
          left: -100px;
          height: 250px;
          width: 400px;
          background: #F8B7D8;
          transform: rotate(25deg);
        }
        .wrap_contact .contact-form-container .contact-us:after {
          position: absolute;
          content: "";
          bottom: -80px;
          right: -100px;
          height: 270px;
          width: 400px;
          background: #9ED8EB;
          transform: rotate(-25deg);
        }

        .wrap_contact .contact-form-container .contact-us .contact-header {
          color: white;
          position: absolute;
          transform: rotate(-90deg);
          top: 120px;
          left: -40px;
        }
        .wrap_contact .contact-form-container .contact-us .contact-header h1 {
          font-size: 24px;
          color: #87c2d6;
        }

        .wrap_contact .contact-form-container .contact-us .social-bar {
          position: absolute;
          bottom: 20px;
          left: 75px;
          z-index: 1;
          width: 100px;
        }
        .wrap_contact .contact-form-container .contact-us .social-bar ul {
          list-style-type: none;
        }
        .wrap_contact .contact-form-container .contact-us .social-bar ul li {
          display: inline-block;
          color: white;
          width: 25px;
          height: 25px;
          line-height: 25px;
          text-align: center;
          margin-right: -4px;
          font-size: 20px;
        }

        .wrap_contact .contact-form-container .header {
          text-align: center;
          padding: 20px 0;
          color: #444;
        }
        .wrap_contact .contact-form-container .header h1 {
          font-weight: normal;
        }
        .wrap_contact .contact-form-container .header h2 {
          margin-top: 10px;
          font-weight: 300;
        }

        .wrap_contact .contact-form-container .contact_address, .contact_email, .contact_phone {
          text-align: center;
          padding: 20px 0;
          color: #444;
        }
        .wrap_contact .contact-form-container .contact_address h3, .contact_email h3, .contact_phone h3 {
            margin: 0;
            font-size: 15px;
            font-weight: 300;
        }
        .wrap_contact .contact-form-container .contact_address i, .contact_email i, .contact_phone i {
          color: #F8B7D8;
          font-size: 30px;
          margin-bottom: 20px;
        }

        .wrap_contact .contact-form-container .contact-form form {
          position: relative;
          width: 490px;
          margin: 0 auto;
          padding: 20px;
          box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
          background: white;
        }
        .wrap_contact .contact-form-container .contact-form form input, form textarea {
          background: white;
          display: block;
          margin: 20px auto;
          width: 100%;
          border: 0;
        }
        .wrap_contact .contact-form-container .contact-form form input {
          height: 40px;
          line-height: 40px;
          outline: 0;
          border-bottom: 1px solid rgba(68, 68, 68, 0.3);
          font-size: 17px;
          color: rgba(68, 68, 68, 0.8);
        }
        .wrap_contact .contact-form-container .contact-form form textarea {
          border-bottom: 1px solid rgba(68, 68, 68, 0.3);
          resize: none;
          outline: none;
          font-size: 17px;
          font-family: lato;
          color: rgba(68, 68, 68, 0.8);
        }
        .wrap_contact .contact-form-container .contact-form form button {
          position: absolute;
          display: block;
          height: 40px;
          width: 250px;
          left: 122px;
          border: 0;
          border-radius: 20px;
          bottom: -20px;
          background: #9ED8EB;
          color: white;
          font-size: 21px;
          font-weight: 400;
          outline: none;
        }

        .wrap_contact .contact-form-container .contact-form {
            padding-bottom: 60px;
        }

        /* Layout Stuff */
        .wrap_contact {
          background: #ffffff;
          /*height: 100vh;*/
          width: 100%;
          position: relative;
          background-size: cover;
          background-repeat: no-repeat;
          display: grid;
          justify-items: center;
          align-items: center;
        }

        .wrap_contact .contact-form-container {
            margin-top: 55px;
            width: 888px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-template-rows: 0.5fr 0.5fr 2fr;
            grid-template-areas: "contact-us header header header" "contact-us contact_address contact_phone contact_email" "contact-us contact-form contact-form contact-form";
        }

        .wrap_contact .contact-form-container .contact-us {
          grid-area: contact-us;
          border: 1px solid #9ed8eb;
        }

        .wrap_contact .contact-form-container .header {
          grid-area: header;
        }

        .wrap_contact .contact-form-container .contact_address {
          grid-area: contact_address;
        }

        .wrap_contact .contact-form-container .contact_phone {
          grid-area: contact_phone;
        }

        .wrap_contact .contact-form-container .contact_email {
          grid-area: contact_email;
        }

        .wrap_contact .contact-form-container .contact-form {
          grid-area: contact-form;
        }
        .wrap_contact .map{
            width: 100%;
            height: 500px;
            margin-top: 55px;
        }
        .wrap_intro .intro{
            background: #ffe5ee;
        }
        .wrap_intro .intro .container{
            text-align: center;
        }
        .wrap_intro .intro .container .intro-header {
            font-size: 33px;
            color: #1a2b49;
            margin: 70px auto;
        }
    }
</style>

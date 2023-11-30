<?php

/**
 * --------------------------------------------------------------
 *  Base URL 
 * --------------------------------------------------------------
 */

function baseurl()
{

  return 'http://localhost:3000';
}



/**
 * --------------------------------------------------------------
 *  WEB GENERAL CONFIGURATION 
 * --------------------------------------------------------------
 */


$GLOBALS['config'] = array(

  //configuration for database connection

  "mysql" => array(
    "DB_HOST" => "localhost",
    "DB_USERNAME" => "root",
    "DB_PASSWORD" => "",
    "DB_DATABASE" => "early-alert-system",
    "db_charset" => "utf8"
  ),


  /**
   * Configuration for: Email server credentials
   * Emails are sent using SMTP, Don"t use built-in mail() function in PHP.
   *
   */
  "mailer" => array(
    "email_stmp_debug" => 2,
    "email_stmp_auth" => true,
    "email_stmp_sucure" => "ssl",
    "email_stmp_host" => "smtp.gmail.com",
    "email_stmp_username" => "mathewsuarez20@gmail.com",
    "email_stmp_password" => "kjlrypqvhswzrlew",
    "email_stmp_port" => "465",
    "email_from" => "mathewsuarez20@gmail.com",
    "email_from_name" => "Matthew",
    "email_reply_to" => "no-reply@yourdomain.com",
    "admin_email" => "mathewsuarez20@gmail.com",


    /**
     * Configuration for: OTP Confirmation
     *
     *
     */

    "email_otp_confirmation" => "1",
    "email_account_verified" => "2",
    "email_account_forgot-password" => "3",
    "email_send_alert" => "4",

    "email_subject_loginOTP" => "Login OTP",
    "email_subject_verified" => "TRACE Early Alert Account Verified",
    "email_subject_forgot-password" => "TRACE Early Alert Request reset password.",
    // "email_subject_earlyalert" => "",



  ),

  /**
   * Configuration for: Hashing strength
   *
   */

  "hashing" => array(

    "hash_cost_factor" => "10"
  ),

);

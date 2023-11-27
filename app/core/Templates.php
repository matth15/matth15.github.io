<?php


class Templates
{

  /**
   * Construct the body of contact email
   *
   */
  public static function getOtpLoginBody($data)
  {

    // You patse your HTML email template in the ''
    $body  = ' 
    
              <p>Someone who knows your password is attempting to sign-in to your TRACE Early Alert web account.</p>
              <p>If this was you, your verification code is:</p>
              <h3><b>' . $data["otp"] . '</b></h3>
              <p>Don’t share it with others.</p>
    ';
    return $body;
  }

  //
  public static function getAccountVerifiedBody($data)
  {

    $body = '
    
             <p>Your TRACE Email ' . $data["email"] . ' has Successfully Verified to</p>
             <p>TRACE College Early Alert System. You can now access ' . $data["user_type"] . '</p> 
             <p> dashboard. </p>
    
    ';
    return $body;
  }
  //
  public static function getOtpForgotPasswordBody($data)
  {
    $body  = ' 
    
    <p>Hi '.$data["name"].',</p>
    <p>We received a request to reset the password for your account in TRACE Early Alert</p>
    <p>Get the code to reset your password: </p>
    <h3><b>' . $data["otp"] . '</b></h3>
    <p>Don’t share it with others.</p>
';
return $body;
  }
}

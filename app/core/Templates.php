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
    
              <p>Someone who knows your password is attempting to sign-in to your account.</p>
              <p>If this was you, your verification code is:</p>
              <h3><b>'. $data["otp"] .'</b></h3>
              <p>Don’t share it with others.</p>
    ';
    return $body;
  }

  //for signup body 
  public function getOtpSignupBody($data){

    $body = '
             <p>
             <p>
             <p>
             <p>

    ';
    return $body;
  }

  
}

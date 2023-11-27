<?php


/**
 * Email Class
 */

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Email
{

    /**
     * This is the constructor for Email object.
     *
     * @access private
     */
    private function __construct()
    {
    }

    /**
     * send an email
     *
     * @access private
     * @static static method
     * @param  string  $type Email constant - check config.php
     * @param  string  $email
     * @param  array   $userData
     * @param  array   $data any associated data with the email
     * @throws Exception If failed to send the email
     */
    public static function sendEmail($type, $email, $data)
    {
        try {

            $mail  = new PHPMailer();
            $mail->IsSMTP();

            // good for debugging, otherwise keep it commented
            //  $mail->SMTPDebug  = Config::get('mailer/email_stmp_debug');
            $mail->SMTPAuth   = Config::get('mailer/email_stmp_auth');
            $mail->SMTPSecure = Config::get('mailer/email_stmp_sucure');
            $mail->Host       = Config::get('mailer/email_stmp_host');
            $mail->Port       = Config::get('mailer/email_stmp_port');
            $mail->Username   = Config::get('mailer/email_stmp_username');
            $mail->Password   = Config::get('mailer/email_stmp_password');
            $mail->isHTML(true);


            switch ($type) {
                    /**
                 * 
                 * 
                 * 
                 */
                case (Config::get('mailer/email_otp_confirmation')):
                    $mail->Body = Templates::getOtpLoginBody($data);
                    $mail->SetFrom(Config::get('mailer/email_from'), Config::get('mailer/email_from_name'));
                    $mail->AddReplyTo(Config::get('mailer/email_reply_to'));
                    $mail->Subject = Config::get('mailer/email_subject_loginOTP');
                    $mail->AddAddress($email);
                    break;
                    /**
                     * 
                     * 
                     * 
                     */
                case (Config::get('mailer/email_account_verified')):
                    $mail->Body = Templates::getAccountVerifiedBody($data);
                    $mail->SetFrom(Config::get('mailer/email_from'), Config::get('mailer/email_from_name'));
                    $mail->AddReplyTo(Config::get('mailer/email_reply_to'));
                    $mail->Subject = Config::get('mailer/email_subject_verified');
                    $mail->AddAddress($email);
                    break;
                case (Config::get('mailer/email_account_forgot-password')):
                    $mail->Body = Templates::getOtpForgotPasswordBody($data);
                    $mail->SetFrom(Config::get('mailer/email_from'), Config::get('mailer/email_from_name'));
                    $mail->AddReplyTo(Config::get('mailer/email_reply_to'));
                    $mail->Subject = Config::get('mailer/email_subject_forgot-password');
                    $mail->AddAddress($email);
                    break;
            }

            $mail->Send();
        } catch (Exception $e) {
            Session::set('danger', 'Message could not be sent. <br> <strong>Mailer Error:</strong> ' . $mail->ErrorInfo);
        }
    }
}

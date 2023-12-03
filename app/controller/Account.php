<?php

class Account extends Controller
{
    private $redirect;
    private $authmodel;
    private $request;

    public function __construct(Request $request = null)
    {
        $this->request = $request !== null ? $request : new Request();
        $this->redirect = new Redirect();
        $this->authmodel = $this->model('AuthModel');
    }
    /**
     * 
     * 
     * 
     * 
     */
    public function index()
    {

    }
    /**
     * 
     * 
     * 
     * 
     */

     public function profile($param1=''){
        
     }
    /**
     * 
     * 
     * 
     */
    function forgot_password()
    {

        $data  = [];
        if ($this->request->isPost()) {
            $email = $this->request->data('email');

            $rule = new ValidationRules();
            if (!$rule->isRequired($email)) {
                $data['forgot-password-err'] = "TRACE Email field is Required!";
            } elseif (!$rule->email($email)) {
                $data['forgot-password-err'] = "Enter a Valid TRACE E-mail.";
            }
            if (!empty($data)) {
                Session::set('FORGOT-PASSWORD-DANGER', $data['forgot-password-err']);
            }
            if (empty($data)) {

                if ($this->authmodel->forgot_password($email)) {



                    $otp = $this->authmodel->generateOTP();
                    $otp_expiration = date("Y-m-d H:i", strtotime(date('Y-m-d H:i') . " +1 mins"));
                    $result = $this->authmodel->updateGeneratedOTP($email, $otp, $otp_expiration);

                    if ($result) {

                        Session::set('forgot-password-process', true);
                        $userName = $this->authmodel->getProfileInfo($email)['name'];
                        $data = ['email' => $email, 'otp' => $otp, "name" => $userName];

                        Email::sendEmail(Config::get('mailer/email_account_forgot-password'),  $email, $data);

                        //Redirect to OTP verification view
                        Session::set('OTP-SUCCESS', "We've sent an OTP Code from your TRACE Email");
                        $this->redirect->to('auth/verifyOTP');
                    } else {
                    }
                } else {
                    Session::set('FORGOT-PASSWORD-DANGER', "TRACE Email not found!");
                }
            }
        }
        $this->view('Forgot-Password', $data);
    }
    /**
     * 
     * 
     * 
     * 
     */
    function reset_password()
    {
        $data = [];
        if (!Session::get('forgot-password-process')) {
            $this->redirect->to('auth');
            die();
        }
        if ($this->request->isPost()) {

            if ($this->request->data('csrf_token') !== session::generateCsrfToken()) {
                $this->redirect->to('account');
                die;
            }

            $new_password = $this->request->data('n_pass');
            $new_cpassword =  $this->request->data('n_cpass');
            $email = $this->request->data("email");

            //validator
            $rule = new ValidationRules();

            //validate new password
            if (!$rule->isRequired($new_password)) {
                $data['reset-password-err'] = "New Password field is Required!";
            } elseif (!$rule->minLen($new_password, 5)) {
                $data['reset-password-err'] = "New Password must not be less than 5 Characters.";
            } elseif (!$rule->password($new_password)) {
                $data['reset-password-err'] = "New Password must have at least a lowercase, uppercase, integer, and special character";
            } else {
                //validate new confirm password
                if (empty($new_cpassword) || !$rule->equals($new_password, [$new_cpassword])) {
                    $data['reset-password-err'] = "New Password & New Confirm Password not Matched!";
                }
            }

            if (!empty($data)) {
                Session::set('RESET-PASSWORD-DANGER', $data['reset-password-err']);
            } else {
                if ($this->authmodel->reset_password($new_password, $email)) {

                    Session::set('LOGIN-SUCCESS', 'testing');
                    $this->redirect->to("auth");
                } else {

                    Session::set('RESET-PASSWORD-DANGER', "Failed to change password. Try again.");
                }
            }
        }
        $this->view('Reset-Password', $data);
    }
    /**================== //improve soon
     * Handle user logout
     * ==================
     */
    public function logout()
    {
        // Log the user out and redirect to the login page
        $this->authmodel->logout(Session::getUserId());
        return $this->redirect->to('auth');
    }
}

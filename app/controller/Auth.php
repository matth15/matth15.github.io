<?php

/**
 *  Auth Controller
 */

class Auth extends Controller
{
    //properties

    public $request;
    public $redirect;
    public $authmodel;

    public function __construct(Request $request = null)
    {
        $this->request = $request !== null ? $request : new Request();
        $this->redirect = new Redirect();
        $this->authmodel = $this->model('AuthModel');
    }
    /**
     * ============================
     *    AUTH DIRECT TO LOGIN
     * ============================
     */
    public function index()
    {
        if (Session::getIsLoggedIn()) {
           $this->redirect->to("Home/index");
        } else {
            $this->view('login');
        }
    }

    /*
     * ====================================================
     *             SIGNUP CONTROLLER METHOD
     * ====================================================
     */
    public function signup()
    {
        $data = [];

        if ($this->request->isPost()) {

            //validate csrf token
            if ($this->request->data('csrf_token') !== session::generateCsrfToken()) {
                $this->redirect->to('auth');
                die;
            }

            // Declare input variable
            $lastName = $this->request->data('lastname');
            $firstName = $this->request->data('firstname');
            $email = $this->request->data('email');

            $parentPhoneNo =  $this->request->data('parent_phone_no');

            $password =  $this->request->data('password');
            $confirmPassword =  $this->request->data('confirm_password');
            $gradeLevel = $this->request->data('grade_level');
            $strand = $this->request->data('strand');

            // (Instatiate ValidationRules class)
            $rule = new ValidationRules();

            // == Validate input fields ==

            // Validate first name field
            if (!$rule->isRequired($firstName)) {
                $data['signup-err'] = "First name field is Required!";
            } elseif (!$rule->minLen($firstName, 3)) {
                $data['signup-err'] = "First name should be at least 3 Characters.";
            } else {

                // Validate last name field
                if (!$rule->isRequired($lastName)) {
                    $data['signup-err'] = "Last name field is Required!";
                } else if (!$rule->minLen($lastName, 3)) {
                    $data['signup-err'] = "Last name should be at least 3 Characters.";
                } else {

                    // Validate email field & parent phone number
                    if (!$rule->isRequired($email)) {
                        $data['signup-err'] = "Email address is Required!";
                    } elseif (!$rule->checkEmailDomain($email, "tracecollege.edu.ph")) {
                        $data['signup-err-domain'] = " Only TRACE Email domain can access sign up form.";
                    } elseif (!$rule->emailUnique($email)){
                        //
                    }
                    elseif(!$rule->isRequired($parentPhoneNo)){
                        //
                    }
                     else {
                        // Validate password field
                        if (!$rule->isRequired($password)) {
                        } elseif (!$rule->minLen($password, 5)) {
                            $data['signup-err'] = "Password must not be less than 5 Characters.";
                        } elseif (!$rule->password($password)) {
                            $data['signup-err'] = "Password must have at least a lowercase, uppercase, integer, and special character";
                        } else {

                            // Validate confirm password field
                            if (empty($confirmPassword) || !$rule->equals($this->request->data("password"), [$this->request->data("confirm_password")])) {
                                $data['signup-err'] = 'Password is not match!';
                            } else {

                                // Validate grade level & strand 
                                if (!$rule->isRequired($gradeLevel)) {
                                    $data['signup-err'] = 'Grade Level is Required!';
                                } else {
                                    if (!$rule->isRequired($strand)) {
                                        $data['signup-err'] = "Strand is Required!";
                                    }
                                }
                            }
                        }
                    }
                }
            }

            if (!empty($data)) {
                if (!empty($data['signup-err'])) {
                    Session::set("SIGNUP-ERROR", $data['signup-err']);
                }
                if (!empty($data['signup-err-domain'])) {
                    Session::set("SIGNUP-WARNING", $data['signup-err-domain']);
                }
            }

            // Login Process
            if (empty($data)) {
                $result = $this->authmodel->register($firstName . ' ' . $lastName, $email, $password, $gradeLevel, $strand,$parentPhoneNo);
                if ($result) {
                    Session::set('LOGIN-SUCCESS', 'Registration successful.');
                    $this->redirect->to('auth/login');
                    die();
                }
            }
        }
        $this->view('Signup', $data);
    }


    /*
     * ======================================================
     *              LOGIN CONTROLLER METHOD
     * ======================================================
     */
    public function login($params1 ='')
    {

        $data = [];
    
        if ($this->request->isPost()) {

            if ($this->request->data('csrf_token') !== session::generateCsrfToken()) {
                $this->redirect->to('auth');
                die;
            }

            // Extract input fields' values
            $email = $this->request->data("email");
            $password = $this->request->data("password");

            // Instantiate validation rules
            $rule = new ValidationRules();

            // Validate email field
            if (!$rule->isRequired($email)) {
                $data['login-err'] = 'Email cannot be empty.';
            } elseif (!$rule->email($email)) {
                $data['login-err'] = 'Enter a valid TRACE Email address';
            } else {
                // Validate password field
                if (!$rule->isRequired($password)) {
                    $data['login-err'] = 'Password cannot be empty.';
                }
            }
            //
            if (!empty($data)) {
                Session::set('LOGIN-ERROR', $data['login-err']);
            }
            //
            if (empty($data)) {

                // Check the password against the database
                if ($this->authmodel->login($email, $password)) {
                    //Set Session login process 
                    Session::set('login-process', true);

                    // Password is correct, proceed to generate and send OTP
                    $otp = $this->authmodel->generateOTP();
                    $otp_expiration = date("Y-m-d H:i", strtotime(date('Y-m-d H:i') . " +5 mins"));
                    $result = $this->authmodel->updateGeneratedOTP($email, $otp, $otp_expiration);

                    if ($result) {

                        $data = ['email' => $email, 'otp' => $otp];
                        Email::sendEmail(Config::get('mailer/email_otp_confirmation'),  $email, $data);

                        //Redirect to OTP verification view
                        Session::set('OTP-SUCCESS', "We've sent an OTP Code from your TRACE Email");
                        $this->redirect->to('auth/verifyOTP');
                    } else {
                        Session::set('LOGIN-ERROR', "Failed to generateOTP and send to your E-mail");
                    }
                }
            }
        }


        $this->view('Login', $data);
    }

    /*
     * ===================================================
     *             VERIFY OTP CONTROLLER METHOD
     * ===================================================
     */
    public function verifyOTP()
    {

        $data = [];

        //Identify if Session is in Login OR Forgot-Password Process
        if (!Session::get('login-process')) {
            if (!Session::get('forgot-password-process')) {
                $this->redirect->to("account");
                die();
            }
        }

        if ($this->request->isPost()) {
            if ($this->request->data('csrf_token') !== session::generateCsrfToken()) {
                $this->redirect->to('auth');
                die();
            }
            // Extract input fields' values
            $email = $this->request->data("email");
            $otp = $this->request->data("otp_data");



            // Instantiate validation rules
            $rule = new ValidationRules();

            // Validate OTP field
            if (!$rule->isRequired($otp)) {
                $data['otp-err'] = 'OTP cannot be empty.';
            }

            if (!empty($data['otp-err'])) {
                Session::set('OTP-ERROR', $data['otp-err']);
            }


            if (empty($data)) {
                // Verify User OTP
                if ($this->authmodel->verifyOTP($email, $otp)) {
                    // If user is in Session of Forgot-Password Process
                    if (Session::get('forgot-password-process')) {

                        $this->redirect->to('account/reset_password');
                    } else {
                        // Check if User email is Verified
                        if (!$rule->is_email_verified($email)) {

                            //Set User email Verified
                            $this->authmodel->setUserVerified($email);
                            $userInfo = $this->authmodel->getProfileInfo($email);
                            // Send notif of TRACE College Account Verified
                            $data = ["email" => $email, "user_type" => $userInfo["user_type"]];
                            Email::sendEmail(Config::get('mailer/email_account_verified'), $email, $data);
                        }

                        if(Session::get("login-process")) {

                            // Destroy login process Session :
                            Session::getAndDestroy('login-process');

                            Session::set('LOGIN-SUCCESS', 'Login Successfully!');
                            // TO set logged in session :
                            Session::setLoggedInSession();
                            $this->redirect->to('auth');
                        }
                    }
                }
            }
        }

        $this->view('Email-Verification', $data);
    }


    /*
     * ========================================================
     *                RESEND OTP CONTROLLER METHOD
     * ========================================================
     */
    public function resendOTP()
    {
        if ($this->request->data('csrf_token') !== session::generateCsrfToken()) {
            $this->redirect->to('auth');
            die;
        }
        // Get the user's email from the session or user input
        $email = $this->request->data("email");
        $userName = $this->request->data('name');

        // Update the OTP and OTP expiration time in the database
        $otp = $this->authmodel->generateOTP();
        $otp_expiration = date("Y-m-d H:i", strtotime(date('Y-m-d H:i') . " +5 mins"));
        //
        $result = $this->authmodel->updateGeneratedOTP($email, $otp, $otp_expiration);

        if ($result) {
            // Send the new OTP to the user's email
            if (Session::get('forgot-password-process')) {
                $data = ['email' => $email, 'otp' => $otp, 'name' => $userName];
                Email::sendEmail(Config::get('mailer/email_account_forgot-password'), $email, $data);
            } else {
                $data = ['email' => $email, 'otp' => $otp];
                Email::sendEmail(Config::get('mailer/email_otp_confirmation'), $email, $data);
            }

            session::set('OTP-SUCCESS', 'New OTP have been sent to your email.');
            $this->redirect->to('auth/verifyOTP');
        }

        $this->view('verifyOTP', $data);
    }
}

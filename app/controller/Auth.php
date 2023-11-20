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
            print_r('logged in ');
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

            // declare input variable
            $lastname = $this->request->data('lastname');
            $firstname = $this->request->data('firstname');
            $email = $this->request->data('email');
            $password =  $this->request->data('password');
            $confirmPassword =  $this->request->data('confirm_password');
            $gradeLevel = $this->request->data('grade_level');
            $strand = $this->request->data('strand');

            // Instatiate ValidationRules class
            $rule = new ValidationRules();


            // validating input fields
            if (!$rule->isRequired($firstname)) {
                $data['signup-err'] = "First name is Required!";
            } elseif (!$rule->minLen($firstname, 3)) {
                $data['signup-err'] = 'First name sould be atleast 3 characters';
            } else {
                if (!$rule->isRequired($lastname)) {
                    $data['signup-err'] = 'Last name is required';
                } elseif (!$rule->minLen($lastname, 3)) {
                    $data['signup-err'] = 'Last name should be atleast 3 characters';
                } else {
                    // Validate email field
                    if (!$rule->isRequired($email)) {
                        $data['signup-err'] = 'TRACE Email field is Required!';
                    }
                    elseif (!$rule->unique($email,"email")) {
                        $data['signup-err'] = $email . ' Email account already exist.';
                    } 
                    elseif (!$rule->email($email)) {
                        $data['signup-err'] = 'Enter a valid email address';
                    } elseif (!$rule->checkEmailDomain($email, "tracecollege.edu.ph")) {
                        $data['signup-err-domain'] = 'Only TRACE Email domain can access signup form.';
                    } else {
                        // Validate password field
                        if (!$rule->isRequired($password)) {
                            $data['signup-err'] = 'Password cannot be empty.';
                        } elseif (!$rule->minLen($password, 5)) {
                            $data['signup-err'] = 'Password must not be less than 5 characters';
                        } elseif (!$rule->password($password)) {
                            $data['signup-err'] = 'Password must have at least a lowercase, uppercase, integer, and special character';
                        } else {
                            // Validate password confirmation
                            if (empty($confirmPassword) || !$rule->equals($this->request->data("password"), [$this->request->data("confirm_password")])) {
                                $data['signup-err'] = 'Password is not match!';
                            } else {
                                //validate student gradelevel and strand
                                if (!$rule->isRequired($gradeLevel)) {
                                    $data['signup-err'] = 'Grade Level is Required!';
                                } else {
                                    if (!$rule->isRequired($strand)) {
                                        $data['signup-err'] = 'Strand is Required!';
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (!empty($data)) {
                if (!empty($data['signup-err-domain'])) {
                    Session::set('signup-error-domain', $data['signup-err-domain']);
                } else {
                    Session::set('signup-error', $data['signup-err']);
                }
            }

            if (empty($data)) {

                //modify
                $result = $this->authmodel->register($firstname . ' ' . $lastname, $email, $password, $gradeLevel, $strand);
                if ($result) {
                    Session::set('success', 'Registration successful.');
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
    public function login()
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
            if (!empty($data)) {
                Session::set('login-error', $data['login-err']);
            }
            //
            if (empty($data)) {
                // Check the password against the database
                if ($this->authmodel->login($email, $password)) {
                    // Password is correct, proceed to generate and send OTP
                    $otp = $this->authmodel->generateOTP();
                    $otp_expiration = date("Y-m-d H:i", strtotime(date('Y-m-d H:i') . " +1 mins"));
                    $result = $this->authmodel->updateGeneratedOTP($email, $otp, $otp_expiration);

                    if ($result) {
                        $data = ['email' => $email, 'otp' => $otp];
                        Email::sendEmail(Config::get('mailer/email_otp_confirmation'),  $email,  $otp, $data);
                        // Redirect to OTP verification view
                        $this->redirect->to('auth/verifyOTP');
                    }
                }
            }
        }
        

        $this->view('Login', $data);
    }


    /*
     * =============================================================================================================================================
     *  
     * =============================================================================================================================================
     */
    public function forgot_password()
    {
        $this->view('Forgot-Password');
    }


    /*
     * ===================================================
     *             VERIFY OTP CONTROLLER METHOD
     * ===================================================
     */
    public function verifyOTP()
    {
        $data = [];

        if ($this->request->isPost()) {
            if ($this->request->data('csrf_token') !== session::generateCsrfToken()) {
                $this->redirect->to('auth');
                die;
            }
            // Extract input fields' values
            $email = $this->request->data("email");
            $otp = $this->request->data("otp_data");

            $cancel = $this->request->data('otp_cancel');
            
            // Instantiate validation rules
            $rule = new ValidationRules();

            // Validate OTP field
            if (!$rule->isRequired($otp)) {
                $data['otp-err'] = 'OTP cannot be empty.';
            }

            if (!empty($data['otp-err'])) {
                Session::set('otp-error', $data['otp-err']);
            }
            if (empty($data)) {
                // Verify OTP
                if ($this->authmodel->verifyOTP($email, $otp)) {
                    // OTP is correct, proceed with login

                    $this->redirect->to('auth/login');
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

        // Update the OTP and OTP expiration time in the database
        $otp = $this->authmodel->generateOTP();
        $otp_expiration = date("Y-m-d H:i", strtotime(date('Y-m-d H:i') . " +1 mins"));
        //
        $result = $this->authmodel->updateGeneratedOTP($email, $otp, $otp_expiration);

        if ($result) {
            // Send the new OTP to the user's email
            $data = ['email' => $email, 'otp' => $otp];
            Email::sendEmail(Config::get('mailer/email_otp_confirmation'), $email, $otp, $data);
            session::set('success', 'New OTP have been sent to your email.');
            $this->redirect->to('auth/verifyOTP');
        }

        $this->view('verifyOTP', $data);
    }



    /**================== //improve soon
     * Handle user logout
     * ==================
     */
    public function logout()
    {
        // Log the user out and redirect to the login page
        $this->authmodel->logout(Session::getUserId());
        return $this->redirect->to('auth/');
    }
}

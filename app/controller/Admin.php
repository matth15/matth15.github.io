<?php

if (Session::getIsLoggedIn()) {
    if (Session::getUserType() !== "admin") {
        header('location : ' . baseurl());
        exit();
    }
}

class Admin extends Controller
{
    public $request;
    public $redirect;
    public $adminmodel;
    public $authmodel;
    public $studentmodel;
    public $teachermodel;

    public function __construct(Request $request = null)
    {
        $this->request = $request !== null ? $request : new Request();
        $this->redirect = new Redirect();
        $this->authmodel = $this->model('authModel');
        $this->adminmodel = $this->model('adminModel');
        $this->studentmodel = $this->model('studentModel');
        $this->teachermodel = $this->model('teacherModel');
    }
    public function index()
    {
        $this->redirect->to('admin/dashboard');
    }
    public function dashboard()
    {
        $data = [];
        $studentCount = $this->studentmodel->getStudentCount();
        $facultyCount = $this->teachermodel->getFacultyCount();
        $data = ['studentCount' => $studentCount, 'teacherCount' => $facultyCount];

        $this->view("admin/dashboard", $data);
    }

    public function student_list($param1 = "", $param2 = "")
    {
        $data = [];


        if (isset($_POST['deleteStudentSubmit'])) {
        }

        $studentCount = $this->studentmodel->getStudentCount();

        if ($param1 === "page" && !empty($param2)) {
            $page_no = $param2;
        } else {
            $page_no = 1;
        }
        $total_records_per_pages = 10;
        $offset = ($page_no - 1) * $total_records_per_pages;

        $total_records = $studentCount;

        $total_no_of_pages = ceil($total_records / $total_records_per_pages);

        $studentData = $this->studentmodel->fetchStudentDataPerPage($offset, $total_records_per_pages);

        //pass the data into student_list
        $data = [
            'sd' => $studentData,
            'totalStudent' => $studentCount,
            'total_num_of_pages' => $total_no_of_pages,
            'page_num' => $page_no,
            'previous_page' => $page_no - 1,
            'next_page' => $page_no + 1
        ];




        $this->view("admin/StudentList", $data);
    }

    public function faculty_list($param1 = '', $param2 = '')
    {
        $data = [];
        $facultyData = $this->teachermodel->fetchFacultyData();
        $data = ['fd' => $facultyData];
        $this->view("admin/FacultyList", $data);
    }


    public function add_student()
    {

        if ($this->request->isPost()) {
            
            //csrf protection
            if ($this->request->data("data")['action']) {
                if ($this->request->data('data')['csrf_token'] !== session::generateCsrfToken()) {
                    $this->redirect->to('home');
                    die;
                }
               
                $firstName = $this->request->data('firstname');
                $lastName =  $this->request->data('lastname');
                $email =  filter_input($this->request->data('email'), FILTER_SANITIZE_EMAIL);
                $password =  $this->request->data('password');
                $confirm_password = $this->request->data('confirm_password');
                $grade_level =  $this->request->data('grade_level');
                $strand =  $this->request->data('strand');

                $rule = new ValidationRules();

                $domainAllowed = "tracecollege.edu.ph";

                //validate student data
                if (!$rule->isRequired($firstName)) {
                    $data['ValidationError'] = "First name is Required.";
                } elseif (!$rule->isRequired($lastName)) {
                    $data['ValidationError'] = "Last name is Required.";
                } elseif (!$rule->isRequired($email)) {
                    $data['ValidationError'] = "Email is Required.";
                } elseif (!$rule->isRequired($password)) {
                    $data['ValidationError'] = "Password is Required.";
                } elseif (!$rule->isRequired($confirm_password)) {
                    $data['ValidationError'] = "Confirm password is Required.";
                } elseif (!$rule->isRequired($grade_level)) {
                    $data['ValidationError'] = "Grade level is Required.";
                } elseif (!$rule->isRequired($strand)) {
                    $data['ValidationError'] = "Strand is Required.";
                } else {
                    //validate firstname and lastname 
                    if (!$rule->minLen($firstName, 3)) {
                        $data['ValidationError'] = "Strand is Required.";
                    } elseif (!$rule->minLen($lastName, 3)) {
                        $data['ValidationError'] = "Strand is Required.";
                    } else {
                        //validate email
                        if (!$rule->checkEmailDomain($email, $domainAllowed)) {
                            $data['ValidationError'] = "Strand is Required.";
                        } elseif (!$rule->emailUnique($email)) {
                            $data['ValidationError'] = "Strand is Required.";
                        } else {
                            //validate password & confirm password
                            if (!$rule->minLen($password, 5)) {
                                $data['ValidationError'] = "Strand is Required.";
                            } elseif (!$rule->password($password)) {
                                $data['ValidationError'] = "Strand is Required.";
                            } elseif (empty($confirm_password) || !$rule->equals($password, [$confirm_password])) {
                                $data['ValidationError'] = "Strand is Required.";
                            }
                        }
                    }
                }

                header('Content-Type: application/json');

               echo json_encode(['ValidationError' => true , "ValidationMessage" => "tite"]);
            }
        }
    }

    public function edit_student(){

    }

    public function delete_student(){

    }
}

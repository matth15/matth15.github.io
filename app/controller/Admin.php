<?php

if (Session::getIsLoggedIn()) {
    if (Session::getUserType() !== "admin") {
        echo "Access denied!";
        header('location : ' . baseurl());
        exit();
    }
}
else {
    echo "Access denied!";
    header('location : ' . baseurl());
    exit();
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

    //add student data
    public function add_student()
    {

        $data = [];
        $response = [];

        if ($this->request->isPost()) {

            $mydata = $this->request->data('data');
            $action = $mydata['action'];

            // $firstName = $mydata['firstname'];
            $firstName = filter_var($mydata['firstname'], FILTER_SANITIZE_STRING);
            $lastName = filter_var($mydata['lastname'], FILTER_SANITIZE_STRING);
            $sanitizeEmail = filter_var($mydata['email'], FILTER_SANITIZE_EMAIL);
            $password = filter_var($mydata['password'], FILTER_SANITIZE_STRING);
            $confirm_password = filter_var($mydata['confirm_password'], FILTER_SANITIZE_STRING);
            $grade_level = filter_var($mydata['grade_level'], FILTER_SANITIZE_STRING);
            $strand = filter_var($mydata['strand'], FILTER_SANITIZE_STRING);;

            if ($action == "insert") {
                if ($this->request->data('csrf_token') == session::generateCsrfToken()) {
                    $this->redirect->to('home');
                    die;
                }

                $rule = new ValidationRules();

                $domainAllowed = "tracecollege.edu.ph";

                // validate student data

                if (!$rule->isRequired($firstName)) {
                    $data['ValidationError'] = "First name is Required.";
                } elseif (!$rule->isRequired($lastName)) {
                    $data['ValidationError'] = "Last name is Required.";
                } elseif (!$rule->isRequired($sanitizeEmail)) {
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
                        $data['ValidationError'] = "First name should be at least 3 Characters.";
                    } elseif (!$rule->minLen($lastName, 3)) {
                        $data['ValidationError'] = "Last name should be at least 3 Characters.";
                    } else {
                        //validate email
                        if (!$rule->checkEmailDomain($sanitizeEmail, $domainAllowed)) {
                            $data['ValidationError'] = "Trace email address only.";
                        } elseif (!$rule->unique($sanitizeEmail, "email")) {
                            $data['ValidationError'] = "Trace email address is already exist!";
                        } else {
                            //validate password & confirm password
                            if (!$rule->minLen($password, 6)) {
                                $data['ValidationError'] = "Password must not be less than 5 Characters.";
                            } elseif (!$rule->password($password)) {
                                $data['ValidationError'] = "Password must have at least a lowercase, uppercase, integer, and special character.";
                            } elseif (empty($confirm_password) || !$rule->equals($password, [$confirm_password])) {
                                $data['ValidationError'] = "Password is not match!";
                            }
                        }
                    }
                }
                if (!empty($data)) {
                    $ValidationMessage =  $data['ValidationError'];
                    $response = ['ValidationError' => true, 'ValidationMessage' => $ValidationMessage];
                } else {
                    if (empty($data)) {
                        $result = $this->authmodel->register($firstName . ' ' . $lastName, $sanitizeEmail, $password, $grade_level, $strand);
                        if ($result) {
                            $response = ['Success' => true, "SuccessMessage" => "Registered student successfully!"];
                        } else {
                            $response = ['TechnicalError' => true, "TechnicalMessage" => "Failed to register student data. Error occured."];
                        }
                    }
                }

                header("Content-Type: application/json");
                echo json_encode($response);
            }
        }
    }

    public function get_student($param1 = '', $param2 = '')
    {

        $data = [];
        $response = [];
        if (!empty($param1)) {
            $studentId = filter_var($param1, FILTER_SANITIZE_NUMBER_INT);

            $studentData = $this->studentmodel->fetchStudentProfile($studentId);
            if ($studentData) {
                $response = ["FetchConditionSuccess" => true, "FetchData" => $studentData];
            } else {
                $response = ["FetchConditionFailed" => true, "FetchConditionMessage" => "Student ID not found."];
            }
            header("Content-Type: application/json");
            echo json_encode($response);
        }
    }

    public function update_student()
    {  $data = [];
        $response = [];

        if ($this->request->isPost()) {
          

            if ($this->request->data('update_student')) {
                
                //csrf token here

                $id = filter_var($this->request->data('student_id'),FILTER_SANITIZE_NUMBER_INT);
                $name = filter_var($this->request->data('student_Name'), FILTER_SANITIZE_STRING);
                $email = filter_var($this->request->data('student_Email'), FILTER_SANITIZE_EMAIL);
                $strand = filter_var($this->request->data('student_Strand'), FILTER_SANITIZE_STRING);
                $class = filter_var($this->request->data('student_Class'),FILTER_SANITIZE_STRING);
                $section = filter_var($this->request->data('student_Section'),FILTER_SANITIZE_STRING);
                $grade = filter_var($this->request->data('student_GradeLevel'), FILTER_SANITIZE_STRING);
                
                //validation of update data
                // if(){

                // }

                if(empty($data)){
                $result = $this->studentmodel->updateStudentData($name,$email,$strand,$section,$grade,$class,$id);
                if ($result) {
                    $response = ['UpdateSuccess' => true, 'UpdateSuccessMessage' => "Update success!"];
                } else {
                    $response = ['UpdateFailed' => true, 'UpdateFailedMessage' => "Update Failed"];
                }
                }
                
                echo json_encode($response);
            }
        }
    }
    public function delete_student()
    {
        $response = [];
        $data = [];

        if($this->request->isPost()){
            //csrf here

            if($this->request->data('delete_student')){

                $data = $this->request->data('data');

                $studentId = filter_var($data["delete_StudentId"],FILTER_SANITIZE_STRING);
                $uniId = filter_var($data['delete_StudentUniqueId'],FILTER_SANITIZE_STRING);

                $rule = new ValidationRules();

                $studentUniId = $this->studentmodel->fetchStudentProfile($studentId)['unique_id'];

                if(!$rule->isRequired($uniId)){
                    $response = ['FailedDeleteStudent' => true, "FailedMessage" => "Unique id is Required."];
                }
                else {
                    if($studentUniId == $uniId){
                        if($this->studentmodel->deleteStudent($studentId)){
                            $response = ['SuccessDeleteStudent' => true, "SuccessMessage" => "Delete Success!"];
                        }
                        else {
                            $response = ['FailedDeleteStudent' => true, "FailedMessage" =>"Failed to delete student data in SQL."];
                        }
                    }
                    else {
                        $response = ['FailedDeleteStudent' => true, "FailedMessage" =>"Invalid Unique ID."];
                    }
                }
                header("Content-Type: application/json");
                echo json_encode($response);
            }

          
        }
    }

    public function view_student($param1 ='' , $param2=''){

        $data = [];
        $response = [];
        if(!empty($param1)){
            $studentId = filter_var($param1, FILTER_SANITIZE_NUMBER_INT);

            $studentData = $this->studentmodel->fetchStudentProfile($studentId);
            if ($studentData) {
                $response = ["FetchConditionSuccess" => true, "FetchData" => $studentData];
            } else {
                $response = ["FetchConditionFailed" => true, "FetchConditionMessage" => "Student ID not found."];
            }
            header("Content-Type: application/json");
            echo json_encode($response);
        }

    }
}

<?php
class Teacher extends Controller
{
    public $request;
    public $redirect;
    public $authmodel;
    public $studentmodel;
    public $teachermodel;

    public function __construct(Request $request = null)
    {
        $this->request = $request !== null ? $request : new Request();
        $this->redirect = new Redirect();
        $this->authmodel = $this->model('');
        $this->studentmodel = $this->model('studentModel');
        $this->teachermodel = $this->model('teacherModel');
    }
    public function dashboard(){
        $data = [];

        $this->view("teacher/dashboard");
    }
    public function student_list($param1 ="", $param2=""){
        $data = [];

        $studentCount = $this->studentmodel->getStudentCount();

        if($param1 === "page" && !empty($param2)){
            $page_no = $param2;
        }
        else {
            $page_no = 1 ;
        }
        $total_records_per_pages = 10;
        $offset = ($page_no - 1) * $total_records_per_pages;
        
        $total_records = $studentCount;

        $total_no_of_pages = ceil($total_records / $total_records_per_pages);

        $studentData = $this->studentmodel->fetchStudentDataPerPage($offset,$total_records_per_pages);
        
        //pass the data into student_list
        $data = ['sd' => $studentData,
         'totalStudent' => $studentCount,
          'total_num_of_pages' => $total_no_of_pages,
           'page_num' => $page_no ,
           'previous_page' => $page_no - 1,
           'next_page' => $page_no + 1
           ];

        $this->view('teacher/studentlist',$data);
    }
}

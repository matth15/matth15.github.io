<?php
class Admin extends Controller
{
    public $request;
    public $redirect;
    public $authmodel;

    public function __construct(Request $request = null)
    {
        $this->request = $request !== null ? $request : new Request();
        $this->redirect = new Redirect();
        $this->authmodel = $this->model('AdminModel');
    }

    public function dashboard()
    {
        $data = [];
         $studentCount = $this->authmodel->getStudentCount();
         $facultyCount = $this->authmodel->getFacultyCount();
         $data = ['studentCount' => $studentCount, 'teacherCount' => $facultyCount];
         
        $this->view("admin/dashboard", $data);
    }

    public function student_list()
    {
        $data = [];

        $total_records_per_pages = 10;

        $studentData = $this->authmodel->fetchStudentData();
        $studentCount = $this->authmodel->getStudentCount();
        $data = ['sd' => $studentData, 'totalStudent' => $studentCount];
        $this->view("admin/StudentList", $data);
    }
    public function faculty_list()
    {
        $data = [];
        $facultyData = $this->authmodel->fetchFacultyData();
        $data = ['fd' => $facultyData];
        $this->view("admin/FacultyList", $data);
    }
    public function alert_history()
    {
        $data = [];

        $this->view("admin/AlertHistory", $data);
    }
    public function send_alert(){
        $data = []; 

        $this->view("admin/SendAlert");
    }
}

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
        $this->authmodel = $this->model('');
    }

    public function dashboard()
    {
        $data = [];

        $this->view("admin/dashboard", $data);
    }

    public function student_list()
    {
        $data = [];

        $this->view("admin/StudentList", $data);
    }
    public function faculty_list()
    {
        $data = [];
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

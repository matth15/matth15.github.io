<?php

class Student extends Controller {
    public $request;
    public $redirect;
    public $authmodel;

    public function __construct(Request $request = null)
    {
        $this->request = $request !== null ? $request : new Request();
        $this->redirect = new Redirect();
        $this->authmodel = $this->model('');
    }

    public function inbox(){
        $data = [];
        
        $this->view("/student/inbox",$data);
    }
}
?>
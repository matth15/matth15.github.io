<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

/**============================
 *      HOME CONTROLLER
 * ============================
 */

class Home extends Controller
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

   public function index()
   {
      if(Session::getIsLoggedIn()) {
        if(Session::getUserType()=='student'){
        $this->view("/student/Dashboard");
        }
        elseif(Session::getUserType()=='admin'){
         $this->view("/admin/Dashboard");
        }
        elseif(Session::getUserType()=='teacher'){
         print_r("logged in by teacher");
        }
      }
      else {
        $this->view('home');
      }
   }
}

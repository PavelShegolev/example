<?php
  class Controller_main_page extends Controller{
    public function __construct(){
      parent::__construct();
      $this->model= new Model_user;
    }
    
    public function Index(){
      $this->view->load('main_page.php');
    }
    
    public function Generate_Captcha(){
      $this->model->Generate_Captcha();
    }
    
    public function Send_Email(){
      $result= $this->model->Send_Email();
      if(!$result){
        $this->view->name= $_GET['name'];
        $this->view->email= $_GET['email'];
        $this->view->comments= $_GET['comments'];
        $this->view->type_site= $_GET['type_site'];
      }else{
        MessageCollector::set_message('e-mail successfully sent.',success);
      }
      $this->view->load('main_page.php');
    }
    
  }
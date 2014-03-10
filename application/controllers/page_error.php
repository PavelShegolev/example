<?php
	class Controller_page_error extends Controller{
    public function __construct(){
      parent::__construct();
    }
		public function Page($code){
      switch($code){
        case 404: { $this->view->load('page_error_404.php');
          break;
        }
        case 500: { $this->view->load('page_error_500.php');
          break;
        }
      }
		}
	}
?>
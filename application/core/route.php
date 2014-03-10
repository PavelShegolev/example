<?php
  abstract class Route{
  
    static $bond_contr_mod= array(
      'main_page' => 'user'
    );
    
    static $controllers= array(
      'main_page',
      'page_error'
    );
    
    static public function Start(){
      $controller_name= 'main_page';
      $action= 'Index';
     
      $request= $_SERVER['REQUEST_URI'];
      $GET_= strpos($request,'?');
      if($GET_){
        $request= substr($request,0,$GET_);
      }
      
      $request= explode('/',$request);
      if(!empty($request[1])){
        $controller_name= $request[1];
      }
      
      if(!empty($request[2]))
        $action= $request[2];

      if(in_array($controller_name, self::$controllers)){
        include '/../../application/controllers/'.$controller_name.'.php';
      }else{
         Route::ErrorPage(404);
      }
      
      $model= self::$bond_contr_mod[$controller_name];
      if(!empty($model))
        include '/../../application/models/'.$model.'.php';
      
      $class_controller= 'Controller_'.$controller_name;
      $controller= new $class_controller;
      if(empty($request[3]))
        $controller->$action();
      else
        $controller->$action($request[3]);
    }
    
    static function ErrorPage($code_error){
      switch($code_error){ 
        case 404:{
          $host = 'http://'.$_SERVER['HTTP_HOST'].'/page_error/page/'.$code_error;
          header('HTTP/1.1 404 Not Found');
          header('Location:'.$host);
        }
        case 500:{
          $host = 'http://'.$_SERVER['HTTP_HOST'].'/page_error/page/'.$code_error;
          header('HTTP/1.1 500 Internal Server Error');
          header('Location:'.$host);
        }
      }
		}
    
    static function DisplayError($error){
      $host = 'http://'.$_SERVER['HTTP_HOST'].'/display_error/Error/'.$error;
      header('Location:'.$host);
		}
    
  }
<?php
  class MessageCollector{
    private static $instance;
    private $error_messages;
    private $warning_messages;
    private $success_messages;
    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}
    
    private static function get_instance(){
      if(!isset(self::$instance)){
        self::$instance= new MessageCollector;
      }
      return self::$instance;
    }
    
    private function set($message, $type){
      if(!empty($message)){
        switch($type){
          case error:{
            $this->error_messages[]= $message;
            break;
          }
          case warning:{
            $this->warning_messages[]= $message;
            break;
          }
          case success:{
            $this->success_messages[]= $message;
            break;
          }
        }
      }
    }
    
    private function get($type){
      $temp;
      switch($type){
        case error:{
          $temp= $this->error_messages;
          $this->error_messages= '';
          return $temp;
        }
        case warning:{
          $temp= $this->warning_messages;
          $this->warning_messages= '';
          return $temp;
        }
        case success:{
          $temp= $this->success_messages;
          $this->success_messages= '';
          return $temp;
        }
      }      
    }
    
    public static function set_message($str, $type= warning){
      self::get_instance()->set($str, $type);
    }
    
    public static function get_message($type= warning){
      return self::get_instance()->get($type);
    }
    
  }

  
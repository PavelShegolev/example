<?php
  class View{
    public $data=array();

    public function __set($name, $value){
      $this->data[$name]= $value;
    }
    
    public function __get($name){
      return $this->data[$name];
    }
    
    public function load($content){
      include '/../../application/views/template.php';
    }
    
    public function generate($content){
      include '/../../application/views/'.$content;
    }
  }
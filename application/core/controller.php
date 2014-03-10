<?php
  abstract class Controller{
    public function __construct(){
      $this->view= new View();
    }
  }
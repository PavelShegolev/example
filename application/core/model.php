<?php
  abstract class Model{
    public static $link;
    public function ConnectDB(){
      self::$link= new mysqli(host, user, pass, name_db);
    }
    public function Set($query){
      self::$link->query($query);
    }
    public function Get($query){
      $data= self::$link->query($query);
      return $data;
    }
    
  }
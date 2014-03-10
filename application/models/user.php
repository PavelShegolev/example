<?php
  class Model_user extends Model{
    public function __construct(){
      parent::ConnectDB();
    }
    
    private function check_fields($name, $email, $comments, $code){
      session_start();
      $result= true;
      if(empty($name)){
        MessageCollector::set_message('Fill field name.', warning);
        $result= false;
      }
      if(empty($email)){
        MessageCollector::set_message('Fill filed email.', warning);
        $result= false;
      }
      if(empty($comments)){
        MessageCollector::set_message('Fill filed comments.', warning);
        $result= false;
      }
      if(empty($code)){
        MessageCollector::set_message('Fill filed code.', warning);
        $result= false;
      }
      
      if(!preg_match('/^[a-z0-9\-\.]+@[a-z0-9\.\-]+\..{2,2}$/i',$email)){
        MessageCollector::set_message('Enter e-mail is correct.', warning);
        $result= false;
      }
      
      if($code != $_SESSION['captcha']){
        MessageCollector::set_message('Enter captcha is correct.', warning);
        $result= false;
      }
      return $result;
    }
    
    private function check($str){
      return parent::$link->real_escape_string($str);
    }
    
    private function send_to_db($name, $email, $comments, $type_site){
      $query= "insert into message_user (name, email, comment, type_site) values('".$name."','".$email."','".$comments."','".$type_site."')";
      parent::Set($query);
    }
    
    public function Generate_Captcha(){
      session_start();
      $words= 'qwertyuiopasdfghjklzxcvbnm';
      $width= 100;
      $height= 40;
      
      for($i=0; $i<=4; $i++){
        $word= $words[rand(0,21)];
        if($i % 2)
          $word= strtoupper($word);
        $_words.= $word;
      }
      
      $image= imagecreatetruecolor($width, $height);
      $text_color= imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
      imagestring($image, 18, 31, 9, $_words, $text_color);
      $_SESSION['captcha']= $_words;
      header('Content-type: image/gif');
      imagegif($image);
      
      
    }

    public function Send_Email(){
      $name= $this->check($_GET['name']);
      $email= $this->check($_GET['email']);
      $comments= $this->check($_GET['comments']);
      $code= $this->check($_GET['code']);
      $type_site= $this->check($_GET['type_site']);
      if(!$this->check_fields($name, $email, $comments, $code))
        return false;
      $message= $name . $comments . $type_site;
      $result= mail($email, 'site choose', $message);
      if($result){
        MessageCollector::set_message('e-mail not send.',warning);
        return false;
      }
      $this->send_to_db($name, $email, $comments, $type_site);
      return true;
    }
    
  }
<?php
class ErrorHandler{
  private $error_codes= array(E_ERROR, E_PARSE, E_COMPILE_ERROR, E_CORE_ERROR);
  public function __construct(){
    set_error_handler(array($this, 'Error_Catcher'));
    register_shutdown_function(array(&$this, 'Fatal_Error_Catcher'));
  }
    
  private function Get_Error_Type($errno){
    switch($errno){
      case E_ERROR:
        return 'E_ERROR';
      case E_WARNING:  
        return 'E_WARNING';
      case E_PARSE:  
        return 'E_PARSE';
      case E_CORE_ERROR:   
        return 'E_CORE_ERROR';
      case E_CORE_WARNING:
        return 'E_CORE_WARNING'; 
      case E_COMPILE_ERROR: 
        return 'E_COMPILE_ERROR'; 
      case E_COMPILE_WARNING: 
        return 'E_COMPILE_WARNING'; 
      case E_USER_ERROR: 
        return 'E_USER_ERROR';
      case E_USER_WARNING: 
        return 'E_USER_ERROR';
      case E_USER_NOTICE: 
        return 'E_USER_ERROR';
      case E_STRICT:  
        return 'E_STRICT';
      case E_RECOVERABLE_ERROR: 
        return 'E_RECOVERABLE_ERROR';
      case E_DEPRECATED:   
        return 'E_DEPRECATED';
      case E_USER_DEPRECATED: 
        return 'E_USER_DEPRECATED';
    }
    return '';
  }  
  
  private function Write_Log($err_message){
    $handle= fopen(PATH_LOG_ERROR,'a');
    fwrite($handle, $err_message."\r\n");
    fclose($handle);
  }
  
  private function Send_Email($err_message){
    mail(ADM_EMAIL, 'Error in site', $err_message);
  }
    
  public function Error_Catcher($errno, $errstr, $errfile, $errline){
    $err_message= '[' . date('d-m h:m:s') . '] <b>' . $this->Get_Error_Type($errno) . ': </b>' . $errstr . 'in <b>' . $errfile . '</b> on line <b>' . $errline . '</b><br>';
    if(WRITE_LOG_ERROR == 'on'){
      $this->Write_Log($err_message);
    }
    if(SEND_ERROR_ON_EMAIL == 'on'){
      $this->Send_Email($err_message);
    }
    
  }
    
  public function Fatal_Error_Catcher(){
    $error = error_get_last();
    if($error and in_array($error['type'], $this->error_codes)){
      ob_end_clean();
      $err_message= '[' . date('d-m h:m:s') . '] <b>' . $this->Get_Error_Type($error['type']) . ': </b>' . $error['message'] . 'in <b>' . $error['file'] . '</b> on line <b>' . $error['line'] . '</b><br>';
      
      if(WRITE_LOG_ERROR == 'on'){
        $this->Write_Log($err_message);    
      }
      if(SEND_ERROR_ON_EMAIL == 'on'){
        $this->Send_Email($err_message);
      }
      Route::ErrorPage(500);
    }else{
      if(DISPLAY_ERROR == 'on'){
        $handle = fopen(PATH_LOG_ERROR, "r");
        $contents = fread($handle, filesize(PATH_LOG_ERROR));
        fclose($handle);
        echo $contents;//что-то тут много ошибок
      }
      ob_end_flush();
    }
  }
}
  $error_handler= new ErrorHandler();
?>
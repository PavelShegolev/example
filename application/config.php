<?php
  define('host','localhost');
  define('name_db','example');
  define('user','pavel');
  define('pass','12345');
  
  define('success','success');
  define('error','error');
  define('warning','warning');
  
  ini_set('display_errors', 1);
  ini_set('error_reporting', E_ALL | E_STRICT);
  
  define('WRITE_LOG_ERROR', 'off');
  define('DISPLAY_ERROR', 'off');
  define('PATH_LOG_ERROR', $_SERVER['DOCUMENT_ROOT'].'/../logs/errors.html');
  define('SEND_ERROR_ON_EMAIL', 'off');
  define('ADM_EMAIL', 'pavel-shegolev@inbox.ru');
  
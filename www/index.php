<?php
  ob_start();
  require_once '../application/core/class.ErrorHandler.php';
  require_once '../application/config.php';
  require_once '../application/core/route.php';
  require_once '../application/core/controller.php';
  require_once '../application/core/model.php';
  require_once '../application/core/view.php';
  require_once '../application/core/class.messageCollector.php';
  Route::Start();
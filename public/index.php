<?php 
define( "APP_PATH" , "/../");

require_once "WF_Application.php";
WF_Application_Manager::Instance()->run( APP_PATH."/config.php" , "production" );
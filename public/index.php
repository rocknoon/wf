<?php
define('APP_PATH', dirname(__FILE__));
require APP_PATH . '/lib/WF/Application/Manager.php';
WF_Application_Manager::Instance()->run(APP_PATH . '/config.php' , 'production');

<?php
define('APP_PATH', dirname(dirname(__FILE__)));
require APP_PATH . '/lib/WF/Application/Manager.php';
WF_Application_Manager::run(APP_PATH . '/config.php' , 'product');

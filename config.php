<?php
$product = new stdClass();
/*core*/
//$product->app->view = 'Smarty';
$product->app->router->directory = array( "admin" ); /* 加入其他命名空间下的 controller 和 action */
$product->app->error_log = APP_PATH . '/logs/error.log';

/*database*/
$product->db->driver = 'mysql';
$product->db->database = 'mysql';
$product->db->host = '127.0.0.1';
$product->db->user = 'root';
$product->db->password = 'l2117839';
$product->db->port = 3306;
/*Smarty*/
$product->smarty->template_dir= APP_PATH . '/app/views';
$product->smarty->compile_dir= APP_PATH . '/temp';
$product->smarty->cache_dir= APP_PATH . '/temp';
$product->smarty->cache_lifetime= 0;
$product->smarty->left_delimiter= '{';
$product->smarty->right_delimiter= '}';
$product->smarty->auto_literal= false;
$product->smarty->compress= true;

$develop = clone $product;

$develop->db->host = '127.0.0.1';
$develop->smarty->cache_life_time= 0;

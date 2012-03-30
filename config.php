<?php
$product = new stdClass();
/*core*/
$product->app->debug = false;
$product->app->engine = 'Smarty';
$product->app->router->directory = array( "admin" ); /* 加入其他命名空间下的 controller 和 action */
/*database*/
$product->db->driver = 'mysql';
$product->db->database = '';
$product->db->host = '';
$product->db->user = '';
$product->db->password = '';
$product->db->port = 3306;
/*Smarty*/
$product->smarty->temlate_dir= APP_PATH . '/app/views';
$product->smarty->compile_dir= APP_PATH . '/temp';
$product->smarty->cache_dir= APP_PATH . '/temp';
$product->smarty->cache_life_time= 600;
$product->smarty->left_delimiter= '{';
$product->smarty->right_delimiter= '}';
$product->smarty->auto_literal= false;
$product->smarty->compress= true;

$develop = clone $product;

$develop->db->host = '127.0.0.1';
$develop->smarty->cache_life_time= 0;

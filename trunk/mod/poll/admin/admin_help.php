<?php
/**
* Advanced Poll 2.0 (PHP/MySQL)
*
*
* Filename: *.php
*
* @author Chi Kien Uong
* @version 1.1
* @access public
* @package Poll
* @link http://www.proxy2.de
* @copyright http://www.proxy2.de
*
*/ 
require "./common.inc.php";

$path = dirname(__file__);
$path = dirname("$path");
if (eregi("WIN",PHP_OS)) {
    $path = str_replace("\\","/",$path);
}
$CLASS["template"]->set_templatefiles(array(
    "admin_help" => "admin_help.html"
));
$admin_help = $CLASS["template"]->pre_parse("admin_help");
no_cache_header();
eval("echo \"$admin_help\";");

?>
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

$CLASS["template"]->set_templatefiles(array(
    "admin_license" => "admin_license.html"
));
$admin_license = $CLASS["template"]->pre_parse("admin_license");
no_cache_header();
eval("echo \"$admin_license\";");

?>
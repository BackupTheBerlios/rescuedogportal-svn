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

$POLLDB["dbName"] 	= $sqldb;
$POLLDB["host"] 	= $sqlhost;
$POLLDB["user"]   	= $sqluser;
$POLLDB["pass"]   	= $sqlpassword;
$POLLDB["class"]  	= "class_mysql.php";
		

/* tables  */
$POLLTBL["poll_config"]  = "poll_config";
$POLLTBL["poll_index"]   = "poll_index";
$POLLTBL["poll_data"]    = "poll_data";
$POLLTBL["poll_ip"]      = "poll_ip";
$POLLTBL["poll_log"]     = "poll_log";
$POLLTBL["poll_comment"] = "poll_comment";
$POLLTBL["poll_user"]    = "poll_user";
$POLLTBL["poll_tpl"]     = "poll_templates";
$POLLTBL["poll_tplset"]  = "poll_templateset";
?>
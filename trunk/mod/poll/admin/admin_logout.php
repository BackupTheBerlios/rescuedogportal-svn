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

srand((double)microtime()*1000000);
$new_session = cryptmy_password (uniqid (rand()));
$CLASS["db"]->query("UPDATE $POLLTBL[poll_user] SET session='$new_session' WHERE session='$session'");
$CLASS["template"]->set_templatefiles(array(
    "login" => "admin_login.html"
));
$message = $lang['FormEnter'];
$poll_login = $CLASS["template"]->pre_parse("login");
no_cache_header();
eval("echo \"$poll_login\";");

?>
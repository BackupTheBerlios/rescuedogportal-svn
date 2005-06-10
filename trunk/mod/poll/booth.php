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

$include_path = dirname(__FILE__);

require $include_path."/include/config.inc.php";
require $include_path."/include/$POLLDB[class]";
require $include_path."/include/class_poll.php";

$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect();
$php_poll = new poll();

?>
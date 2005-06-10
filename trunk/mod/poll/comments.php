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

if (!isset($PHP_SELF)) {
    $PHP_SELF = $HTTP_SERVER_VARS["PHP_SELF"];
    if (isset($HTTP_GET_VARS)) {
        while (list($name, $value)=each($HTTP_GET_VARS)) {
            $$name=$value;
        }
    }
    if (isset($HTTP_POST_VARS)) {
        while (list($name, $value)=each($HTTP_POST_VARS)) {
            $$name=$value;
        }
    }
}

require $include_path."/include/config.inc.php";
require $include_path."/include/$POLLDB[class]";
require $include_path."/include/class_poll.php";
require $include_path."/include/class_pollcomment.php";

$CLASS["db"] = new polldb_sql;
$CLASS["db"]->connect();
$my_comment = new pollcomment();
if (isset($template_set)) {
    $my_comment->set_template_set("$template_set");
}
echo $my_comment->comment_process($id);

?>
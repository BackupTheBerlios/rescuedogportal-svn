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

$cookie_expire = 2400; // hours

$action = (isset($HTTP_GET_VARS['action'])) ? $HTTP_GET_VARS['action'] : '';
$action = (isset($HTTP_POST_VARS['action'])) ? $HTTP_POST_VARS['action'] : $action;
$poll_ident = (isset($HTTP_GET_VARS['poll_ident'])) ? $HTTP_GET_VARS['poll_ident'] : '';
$poll_ident = (isset($HTTP_POST_VARS['poll_ident'])) ? $HTTP_POST_VARS['poll_ident'] : $poll_ident;

if ($action=="vote" && (isset($HTTP_POST_VARS['option_id']) || isset($HTTP_GET_VARS['option_id']))) {
    $cookie_name = "AdvancedPoll".$poll_ident;
    if (!isset($HTTP_COOKIE_VARS[$cookie_name])) {
        $endtime = time()+3600*$cookie_expire;
        setcookie($cookie_name, "1", $endtime);
    }
}

?>
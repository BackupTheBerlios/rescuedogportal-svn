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

include "./poll_cookie.php";
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
include "./booth.php";
?>
<html>
<head>
<title><?php echo $php_poll->pollvars["title"]; ?></title>
</head >
<body bgcolor="#FFFFFF">
<center>
<br>
<?php
$php_poll->set_template_set("popup");
if (isset($poll_ident) && isset($action)) {
    $php_poll->set_max_bar_length(70);
    echo $php_poll->poll_process($poll_ident);
}
?>
</center>
</body>
</html>

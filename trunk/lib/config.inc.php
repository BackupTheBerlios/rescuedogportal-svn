<?php
/**
*
* Configuration File
*
* Filename: config.inc.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package includes
* @link http://rescue-dogs.de
* @copyright 2005 BRK Rettungshundestaffel Ansbach
*
* Subversion CVS system settings of current developments
*	$LastChangedDate$
*	$LastChangedRevision$
*	$LastChangedBy$
*	$HeadURL$
*
*/
if(INADMIN_CODE != 1) die("Hacking attempt");

/**
* <b>****************************************** Installation done ***********************************************</b><br />
* Installation done.<br />
*
*/
define('PORTAL_INSTALLED', true);


if($filename != "customer_pdf.php")setlocale (LC_ALL, 'de_DE@euro', 'de_DE', 'de', 'ge');

if($_SERVER['SERVER_NAME']== "127.0.0.1" || $_SERVER['SERVER_NAME']== "localhost"){
		$sqluser 			= "";
		$sqlpassword 		= "";
		$sqlhost 			= "";
		$sqldb 				= "";

		$smtp_mailhost 		= "";
		$smtp_user 			= "";
		$smtp_pw 			= "";

		$smarty_debug 		= false;

		$poll_admin_username = "";
		$poll_admin_password = "";

		define ("MOS_GALLERY2_PARAMS_PATH","");

}else{
		$sqluser 			= "";
		$sqlpassword 		= "";
		$sqlhost 			= "";
		$sqldb 				= "";

		$smtp_mailhost 		= "";
		$smtp_user 			= "";
		$smtp_pw 			= "";

		$smarty_debug 		= true;

		$poll_admin_username = "";
		$poll_admin_password = "";

		define ("MOS_GALLERY2_PARAMS_PATH","");

}
?>
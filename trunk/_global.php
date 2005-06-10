<?php
/**
* Common File for alle files
*
*
* Filename: global.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package BRKPortal
* @link http://rescue-dogs.de
* @copyright 2005 BRK Rettungshundestaffel Ansbach
*
* Subversion CVS system settings of current developments
*   $LastChangedDate$
*   $LastChangedRevision$
*   $LastChangedBy$
* 	Repository Browser via Web: http://svn.berlios.de/wsvn/rescuedogportal
*   $HeadURL$
*
* We want to help rescue-dog groups and organisations to have a powerfull web page.
* Copyright (C) 2005  Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
*
* This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
* You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
* http://www.gnu.org/licenses/gpl.txt or ./install/gpl-en.txt
*
*
* Wir wollen Rettungshundestaffeln und deren Verbänden helfen einen herforagenden Webauftritt zu bekommen.
* Copyright (C) 2005  Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
*
* Dieses Programm ist freie Software. Sie können es unter den Bedingungen der GNU General Public License,
* wie von der Free Software Foundation veröffentlicht, weitergeben und/oder modifizieren, entweder gemäß
* Version 2 der Lizenz oder (nach Ihrer Option) jeder späteren Version.
* Die Veröffentlichung dieses Programms erfolgt in der Hoffnung, daß es Ihnen von Nutzen sein wird, aber OHNE
* IRGENDEINE GARANTIE, sogar ohne die implizite Garantie der MARKTREIFE oder der VERWENDBARKEIT FÜR EINEN BESTIMMTEN
* ZWECK. Details finden Sie in der GNU General Public License.
* Sie sollten ein Exemplar der GNU General Public License zusammen mit diesem Programm erhalten haben. Falls nicht,
* schreiben Sie an die Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, USA.
* http://www.gnu.de/gpl-ger.html or ./install/gpl-ger.html
*/


/**
* <b>****************************************** Session Handling ***********************************************</b><br />
* Start with Session Handling.<br />
*
*/
define('SESSION_HANDLING', true);

if(INADMIN_CODE != 1) die("Hacking attempt");


session_name("sid");
session_start();
$sid = session_id();
session_register("mandant");

$url_und_sid = "&sid=$sid";
$url_sid = "?sid=$sid";



/**
* <b>****************************************** Include Functions ***********************************************</b><br />
* File of generela function store.<br />
*
*/
require($manu_additional_patch."./lib/functions.php");


/**
* <b>****************************************** Global Arrays ***********************************************</b><br />
* PHP Version dependant Gloabl array definitions.<br />
*
*/
define('INITIALIZE_GLOBAL_ARRAYS', true);
if($phpversion<410) {
 $_REQUEST=array();
 $_COOKIE=array();
 $_POST=array();
 $_GET=array();
 $_SERVER=array();
 $_FILES=array();
 get_vars_old();
}


// remove slashes in get post cookie data...
if (get_magic_quotes_gpc()) {
  if(is_array($_REQUEST)) $_REQUEST=stripslashes_array($_REQUEST);
  if(is_array($_POST)) $_POST=stripslashes_array($_POST);
  if(is_array($_GET)) $_GET=stripslashes_array($_GET);
  if(is_array($_COOKIE)) $_COOKIE=stripslashes_array($_COOKIE);
}
@set_magic_quotes_runtime(0);


/**
* <b>****************************************** Include Mail Class ***********************************************</b><br />
* Sen Mail Class.<br />
*
*/
require($manu_additional_patch."./lib/class.phpmailer.php");

/**
* <b>****************************************** DB Settings ***********************************************</b><br />
* DB Settings.<br />
*
*/
require($manu_additional_patch."./lib/config.inc.php");

if(!PORTAL_INSTALLED){
	header("Location: ./install/");
	exit();
}


/**
* <b>****************************************** DB Class ***********************************************</b><br />
* DB Classs.<br />
*
*/
require($manu_additional_patch."./lib/class.db_mysql.php");



/**
* <b>****************************************** DB Connection ***********************************************</b><br />
* DB Connection.<br />
*
*/
define('INITIALIZE_DB', true);
$db = new db($sqlhost,$sqluser,$sqlpassword,$sqldb,$phpversion);



/**
* <b>****************************************** General Variables and Options ***********************************************</b><br />
* General Variables and Options.<br />
*
*/
define('INITIALIZE_OPTIONS', true);
require($manu_additional_patch."./lib/options.inc.php");



/**
* <b>****************************************** Style ***********************************************</b><br />
* Style.<br />
*
*/
define('INITIALIZE_STYLE', true);
if(!isset($_GET['tempid']) OR $_GET['tempid'] == "") $template = "home";
else  $template = $_GET['tempid'];

/**
* <b>****************************************** Mandant ***********************************************</b><br />
* Mandant.<br />
*
*/
define('INITIALIZE_MADNANT', true);
if($_SESSION['mandant'])$mandant=$_SESSION['mandant']['mandant_id'];
if($_GET['mandant'])$mandant=$_GET['mandant'];

if($mandant=="")$mandant=2;
$mandant = $db->query_first("SELECT * FROM rhs_mandant WHERE mandant_id=$mandant");
if(!$mandant) $mandant = $db->query_first("SELECT * FROM rhs_mandant WHERE mandant_id=2");

/**
* <b>****************************************** Header ***********************************************</b><br />
* Class for GZip Output.<br />
*
*/
require($manu_additional_patch."./lib/class.headers.php");


$i=0;
$result = $db->query("SELECT * FROM rhs_download_data ORDER BY create_date DESC LIMIT 6");
while ($row = $db->fetch_array($result)){
	$row['dl_counter_man']=$i+1;
	$overall_download_data[$i] = $row;
	$i++;
}


$i=0;
$result = $db->query("SELECT * FROM rhs_link ORDER BY create_date DESC LIMIT 6");
while ($row = $db->fetch_array($result)){
	$row['dl_counter_man']=$i+1;
	$overall_link_data[$i] = $row;
	$i++;
}

$i=0;
$result = $db->query("SELECT * FROM rhs_tberichte ORDER BY datefrom DESC LIMIT 6");
while ($row = $db->fetch_array($result)){
	$row['dl_counter_man']=$i+1;
	$overall_berichte_data[$i] = $row;
	$i++;
}


/**
* <b>****************************************** Include smarty ***********************************************</b><br />
* Include of the common file where all smarty template engine classes are stored.<br />
*
*/
include($manu_additional_patch."./lib/smarty/Smarty.class.php");

$smarty = new Smarty;
$smarty->debugging = $smarty_debug;
$smarty->compile_check = true;
$smarty->template_dir = "templates/tpl";
$smarty->compile_dir = "templates/compile";
$smarty->config_dir = "templates/configs";
$smarty->cache_dir = "templates/cache";
$smarty->caching = 0;




/**
* <b>****************************************** Include Poll ***********************************************</b><br />
* Include of the class for advanced poll and initialize it.<br />
*
*/
if(!isset($pollisset))$pollisset=0;
if($pollisset!=1) require ($manu_additional_patch."./mod/poll/booth.php");
$poll_html_text = $php_poll->poll_process("newest");



/**
* <b>****************************************** Global Smarty Vars ***********************************************</b><br />
* Global Smarty Vars.<br />
*
*/
define('INITIALIZE_SMARTY_VARS', true);
$smarty->assign($config_array);
$smarty->assign($mandant);
$smarty->assign("url_und_sid", $url_und_sid);
$smarty->assign("url_sid", $url_sid);
$smarty->assign($shopconfig);
$smarty->assign("poll_html_text", $poll_html_text);
$smarty->assign("overall_download_data", $overall_download_data);
$smarty->assign("overall_link_data", $overall_link_data);
$smarty->assign("overall_berichte_data", $overall_berichte_data);

/**
* <b>****************************************** Include smarty ***********************************************</b><br />
* Include of the common file where all smarty template engine classes are stored.<br />
*
*/
include($manu_additional_patch."./lib/versions.inc.php");
?>
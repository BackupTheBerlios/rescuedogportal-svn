<?php
/**
* global settings
*
*
* Filename: global.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package BRKPortalAdmin
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
* Wir wollen Rettungshundestaffeln und deren Verb�nden helfen einen herforagenden Webauftritt zu bekommen.
* Copyright (C) 2005  Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
*
* Dieses Programm ist freie Software. Sie k�nnen es unter den Bedingungen der GNU General Public License,
* wie von der Free Software Foundation ver�ffentlicht, weitergeben und/oder modifizieren, entweder gem��
* Version 2 der Lizenz oder (nach Ihrer Option) jeder sp�teren Version.
* Die Ver�ffentlichung dieses Programms erfolgt in der Hoffnung, da� es Ihnen von Nutzen sein wird, aber OHNE
* IRGENDEINE GARANTIE, sogar ohne die implizite Garantie der MARKTREIFE oder der VERWENDBARKEIT F�R EINEN BESTIMMTEN
* ZWECK. Details finden Sie in der GNU General Public License.
* Sie sollten ein Exemplar der GNU General Public License zusammen mit diesem Programm erhalten haben. Falls nicht,
* schreiben Sie an die Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307, USA.
* http://www.gnu.de/gpl-ger.html or ./install/gpl-ger.html*
*/

if(INADMIN_CODE != 1) die("Hacking attempt");



/**
* <b>****************************************** Include Functions ***********************************************</b><br />
* File of generela function store.<br />
*
*/
require("../lib/functions.php");


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

$phpversion=(int)(str_replace(".","",phpversion()));
$pagestarttime=microtime();
$query_count=0;
$disableverify=0;


$REMOTE_ADDR = getIpAddress();
$HTTP_USER_AGENT = substr($_SERVER['HTTP_USER_AGENT'], 0, 100);
$REMOTE_ADDR=htmlspecialchars($REMOTE_ADDR);
$HTTP_USER_AGENT=htmlspecialchars($HTTP_USER_AGENT);

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
require("../lib/class.phpmailer.php");

/**
* <b>****************************************** DB Settings ***********************************************</b><br />
* DB Settings.<br />
*
*/
require("../lib/config.inc.php");

/**
* <b>****************************************** DB Class ***********************************************</b><br />
* DB Classs.<br />
*
*/
require("../lib/class.db_mysql.php");



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
require("../lib/options.inc.php");


/**
* <b>****************************************** Header ***********************************************</b><br />
* Class for GZip Output.<br />
*
*/
require("../lib/class.headers.php");


/**
* <b>****************************************** PHP Mailer ***********************************************</b><br />
* PHP Mailer.<br />
*
*/
require_once("../lib/class.phpmailer.php");


/**
* <b>****************************************** Include smarty ***********************************************</b><br />
* Include of the common file where all smarty template engine classes are stored.<br />
*
*/
include('../lib/smarty/Smarty.class.php');

$smarty = new Smarty;
$smarty->debugging = $smarty_debug;
$smarty->compile_check = true;
$smarty->template_dir = "templates/tpl";
$smarty->compile_dir = "templates/compile";
$smarty->config_dir = "templates/configs";
$smarty->cache_dir = "templates/cache";
$smarty->caching = 0;



/**
* <b>****************************************** Admin ***********************************************</b><br />
* Admin.<br />
*
*/
define('INITIALIZE_ADMIN', true);
require_once("../lib/class.adminsession.php");
$adminsession = new adminsession();

if($_GET['sid'] || $_POST['sid']) {
	if($_GET['sid']) $_POST['sid'] = $_GET['sid'];

	$adminsession->update($_POST['sid'], $REMOTE_ADDR, $HTTP_USER_AGENT, $shopconfig['shopconfig_adminsession_timeout']);
	$adminsession->getSessionUserData();
	$adminsession->getSessionMandantData($_GET['simple'], $_GET['mandant'], $REMOTE_ADDR, $HTTP_USER_AGENT, $shopconfig['shopconfig_adminsession_timeout']);

	$smarty->assign($adminsession->session_data);
	$smarty->assign($adminsession->session_user_data);
	$smarty->assign($adminsession->session_mandant_data);

	$smarty->assign("mandantselection", $adminsession->getSelectionMandantData());
}


/**
* <b>****************************************** Global Smarty Vars ***********************************************</b><br />
* Global Smarty Vars.<br />
*
*/
define('INITIALIZE_SMARTY_VARS', true);
$smarty->assign($config_array);
$smarty->assign("session_simpleview", 1);
$smarty->assign("url_und_sid", "&sid=".$adminsession->session_data['hash']);
$smarty->assign("url_sid", "?sid=".$adminsession->session_data['hash']);
$smarty->assign("sid", $adminsession->session_data['hash']);
$smarty->assign($shopconfig);
?>
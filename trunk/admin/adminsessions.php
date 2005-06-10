<?php
/**
* Session Administration Page
*
*
* Filename: asminsession.php
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
* http://www.gnu.de/gpl-ger.html or ./install/gpl-ger.html*
*/
$filename="adminsession.php";


/**
* <b>****************************************** Define In Admin Code ***********************************************</b><br />
* Define In Admin Code to check hacking attempts.<br />
*
*/
define('INADMIN_CODE', 1);


/**
* <b>****************************************** Define Admin Access ***********************************************</b><br />
* If a user which is not an Admin should see this page enter true.<br />
*
*/
define('ENTER_FOR_NO_ADMINS', 0);



/**
* <b>****************************************** Global ***********************************************</b><br />
* Include Gloabl File.<br />
*
*/
require("_global.php");
if($adminsession->session_user_data['admin_can_use_adminsession'] !=1)$adminsession->NoEntryForUser();


@set_time_limit(1200);
if(isset($_POST['send'])) {
	if(isset($_POST['all']) && $_POST['all']) {
		$db->query("DELETE FROM rhs_adminsessions WHERE lastactivity<='".(time()-$shopconfig['shopconfig_adminsession_timeout'])."'");
	}
	else {
		$kicksession=$_POST['kicksession'];
		if(is_array($kicksession) && count($kicksession)) {
			$sessionlist = str_replace(",","','",implode(",",$kicksession));
			$db->query("DELETE FROM rhs_adminsessions WHERE hash IN ('$sessionlist') AND lastactivity<='".(time()-$shopconfig['shopconfig_adminsession_timeout'])."'");
		}
	}
}



$result= $db->query("SELECT a.*, u.customer_admin_name FROM rhs_adminsessions a, rhs_customer u WHERE a.userid = u.customer_id");
$i=0;
while($row=$db->fetch_array($result)) {
	if($row['lastactivity']>time()-$shopconfig['shopconfig_adminsession_timeout']) $row['disabled'] = " DISABLED";
	else $row['disabled'] = "";

	$row['starttime']=date("H:i:s d-m-Y", $row['starttime']);
	$row['lastactivity']=date("H:i:s d-m-Y", $row['lastactivity']);
	if(strlen($row['useragent'])>50) $row['useragent']=substr($row['useragent'],0,48)."...";
	$row['class'] = getone($count++,"firstrow","secondrow");

	$sessiondata[$i] = $row;
	$smarty->assign("sessiondata", $sessiondata);
	$i++;
}


$smarty->display("a_adminsessions.tpl.php");
exit();
?>

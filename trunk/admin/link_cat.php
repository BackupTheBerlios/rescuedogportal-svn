<?php
/**
* Link DB Administration Page
*
*
* Filename: link.php
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
$filename="link_cat.php";


/**
* <b>****************************************** Define In Admin Code ***********************************************</b><br />
* Define In Admin Code to check hacking attempts.<br />
*
*/
define('INADMIN_CODE', 1);


/**
* <b>****************************************** Global ***********************************************</b><br />
* Include Gloabl File.<br />
*
*/
require("_global.php");
if($adminsession->session_user_data['admin_can_use_global_links'] !=1)$adminsession->NoEntryForUser();


if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";


/**
*
*  Standartanzeige der Links
*
**/
if(!$action) {
	if($_GET['orderby'])$orderby=$_GET['orderby'];
	else $orderby="ref";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="ASC";

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_link_cat WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");

	$smarty->display("a_link_cat_show.tpl.php");
	exit();
}



/**
*
*  Entfernen einer Link Kategorie
*
**/
if($action=="deleteref") {
	$result = $db->query("SELECT ref, id FROM rhs_link_cat WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$_GET['id']);
	$catname = $db->fetch_array($result);
	$smarty->assign("deletename", $catname['ref']);
	$smarty->assign("deleteid", $catname['id']);
	$smarty->assign("action", $action);
	$smarty->assign("filename", $filename);
	$smarty->assign("pagename", "Link Categorie");

	/* Wenn das Forumlar abgeschickt wurde */
	if(isset($_POST['send'])) {
		if(isset($_POST['ja'])){
			$db->query("DELETE FROM rhs_link WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND refid=".$_GET['id']);
			$db->query("DELETE FROM rhs_link_cat WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$_GET['id']);
		}
		header("Location: link.php?sid=".$adminsession->session_data['hash']);
		exit();
	}
	$smarty->display("delete.tpl.php");
	exit();
}
?>
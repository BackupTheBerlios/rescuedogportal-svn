<?php
/**
* Training Type Administration Page
*
*
* Filename: index_projects.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package BRKprojectsAdmin
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
$filename="index_projects.php";


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
if($adminsession->session_user_data['admin_can_use_index_projects'] !=1)$adminsession->NoEntryForUser();

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";

/**
*
*  Standartanzeige der Links
*
**/
if(!$action) {
	if($_GET['orderby'])$orderby=$_GET['orderby'];
	else $orderby="create_date";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="DESC";

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_projects WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");

	$smarty->display("a_index_projects_show.tpl.php");
	exit();
}


/**
*
*  Training Typ editieren
*
**/
if($action=="edit") {
	$smarty->assign("action", $action);
	if($_POST['send']){
		$result = $db->query("UPDATE rhs_projects SET url='$_POST[url]', email='$_POST[email]', text='$_POST[message]', bilddb_id='$_POST[bilddb_id]', titel='$_POST[titel]', changedate=".time()." WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
		if($result){
			$smarty->assign("fehler", 1);
			$smarty->assign("page_redirect", "index_projects.php?sid=".$adminsession->session_data['hash']);
		}else $smarty->assign("fehler", 2);
	}
	$rowlink = $db->query_first("SELECT * FROM rhs_projects WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
	$rowlink['text'] = htmlconverter(stripcrap(trim($rowlink['text'])));

	$rowlink['bilddb_id2']=makeoption(0, "Keine Bilder", "");
	$result = $db->query("SELECT g_title as title, g_id as aid FROM g2_Item WHERE g_canContainChildren = 1 ORDER BY g_title DESC");
	while($row = $db->fetch_array($result))$rowlink['bilddb_id2'].=makeoption($row['aid'], $row['name']." - ".$row['title'], $rowlink['bilddb_id']);

	$smarty->assign($rowlink);
	$smarty->display("a_index_projects_edit.tpl.php");
	exit();
}

/**
*
*  Links erzeugen
*
**/
if($action=="new") {
	$smarty->assign("action", $action);
	if($_POST['send']){
		$result = $db->query("INSERT INTO rhs_projects SET url='$_POST[url]', email='$_POST[email]', text='$_POST[message]', bilddb_id='$_POST[bilddb_id]', titel='$_POST[titel]', mandant=".$adminsession->session_mandant_data['mandant_id'].", create_userid=".$adminsession->session_user_data['customer_id'].", create_date=".time());
		if($result){
			$rowlink = $db->query_first("SELECT * FROM rhs_projects WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$db->insert_id());
			$smarty->assign("fehler", 1);
			$smarty->assign("page_redirect", "index_projects.php?sid=".$adminsession->session_data['hash']);
		}else $smarty->assign("fehler", 2);
	}

	$rowlink['bilddb_id2']=makeoption(0, "Keine Bilder", "");
	$result = $db->query("SELECT g_title as title, g_id as aid FROM g2_Item WHERE g_canContainChildren = 1 ORDER BY g_title DESC");
	while($row = $db->fetch_array($result))$rowlink['bilddb_id2'].=makeoption($row['aid'], $row['name']." - ".$row['title'], $rowlink['bilddb_id']);
	$smarty->assign($rowlink);
	$smarty->display("a_index_projects_edit.tpl.php");
	exit();
}


/**
*
*  Entfernen einer Link Kategorie
*
**/
if($action=="delete") {
	$result = $db->query("SELECT titel, id FROM rhs_projects WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
	$catname = $db->fetch_array($result);
	$smarty->assign("deletename", $catname['titel']);
	$smarty->assign("deleteid", $catname['id']);
	$smarty->assign("action", $action);
	$smarty->assign("filename", $filename);
	$smarty->assign("pagename", "projectsnews");

	/* Wenn das Forumlar abgeschickt wurde */
	if(isset($_POST['send'])) {
		if(isset($_POST['ja'])){
			$db->query("DELETE FROM rhs_projects WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
		}
		header("Location: index_projects.php?sid=".$adminsession->session_data['hash']);
		exit();
	}

	$smarty->display("delete.tpl.php");
	exit();
}


?>
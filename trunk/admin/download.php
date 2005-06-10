<?php
/**
* Link DB Administration Page
*
*
* Filename: downloads.php
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
$filename="download.php";


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
if($adminsession->session_user_data['admin_can_use_downloads'] !=1)$adminsession->NoEntryForUser();


if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="showlinks";



/**
*
*  Entfernen eines Links
*
**/
if($action=="delete") {
	$result = $db->query("SELECT dlname, id, filetype FROM rhs_download_data WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$_GET['id']);
	$catname = $db->fetch_array($result);
	$smarty->assign("deletename", $catname['dlname']);
	$smarty->assign("deleteid", $catname['id']);
	$smarty->assign("action", $action);
	$smarty->assign("filename", $filename);
	$smarty->assign("pagename", "Downloads");

	/* Wenn das Forumlar abgeschickt wurde */
	if(isset($_POST['send'])) {
		if(isset($_POST['ja'])){
			$db->query("DELETE FROM rhs_download_data WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$_GET['id']);
			unlink($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$catname['filetype']);
		}
		header("Location: download_cat.php?sid=".$adminsession->session_data['hash']);
		exit();
	}

	$smarty->display("delete.tpl.php");
	exit();
}

/**
*
*  Links anzeigen
*
**/
if($action=="show") {
	if($_GET['orderby'])$orderby=$_GET['orderby'];
	else $orderby="dlname";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="ASC";

	if($_GET['id']=="all") $whereclaus = "";
	else $whereclaus = " AND catid=$_GET[id] ";

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_download_data WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." $whereclaus ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");
	$smarty->assign("refid", $_GET['id']);

	$smarty->display("a_download_show.tpl.php");
	exit();
}


/**
*
*  Links editieren
*
**/
if($action=="edit") {
	$smarty->assign("action", $action);
	if($_POST['send']){
		if($_FILES['uploadfile']['size']<=$shopconfig['shopconfig_max_upload_size']){
			$attachment_file_extension = strtolower(substr(strrchr($_FILES['uploadfile']['name'], '.'), 1));
			$attachment_file_name2 = substr($_FILES['uploadfile']['name'], 0, (intval(strlen($attachment_file_extension)) + 1) * -1);
			$allowextensions = str_replace("\n", "|", str_replace('*', '[a-z0-9]*', dos2unix($shopconfig['shopconfig_allowed_upload_extension'])));
			$upload_file_size = $_FILES['uploadfile']['size'];
			// Wenn die Datei hochgeladen werden darf
			if (preg_match("/^($allowextensions)$/i", $attachment_file_extension)) {
				$result = $db->query("UPDATE rhs_download_data SET
					dlname='$_POST[dlname]',
					dldescription='$_POST[dldescription]',
					dlfile='$attachment_file_name2.$attachment_file_extension',
					catid='$_POST[p_cat]',
					filesize='$upload_file_size',
					filetype='$attachment_file_extension'
					WHERE
					mandant=".$adminsession->session_mandant_data['mandant_id']." AND
					id=".$_GET['id']);
				if($result){
					if(!is_dir($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id'])){
						mkdir($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']);
					}
					if(is_file()){
						unlink();
					}
					// Bild auf den Server speichern
					if (@move_uploaded_file($_FILES['uploadfile']['tmp_name'], $shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']."/".$db->insert_id().'.'.$attachment_file_extension)) {
						@chmod($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']."/".$db->insert_id().'.'.$attachment_file_extension, 0777);

						$smarty->assign("fehler", 1);
						$smarty->assign("action", "editlink");
						$smarty->assign("page_redirect", "download_cat.php?sid=".$adminsession->session_data['hash']);
					}else $smarty->assign("fehler", 2);
				}else{
					$smarty->assign("fehler", 2);
				}
			}else{
				$smarty->assign("fehler", 2);
			}
		}else{
			$smarty->assign("fehler", 2);
		}
		$rowlink = $db->query_first("SELECT * FROM rhs_download_data WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$db->insert_id());
		$smarty->assign($rowlink);
		$smarty->assign("linkid", $_GET['p_cat']);
	}
	$rowlink = $db->query_first("SELECT * FROM rhs_download_data WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
	$smarty->assign($rowlink);

	$result = $db->query("SELECT *	FROM rhs_download_cat WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY catname ASC");
	while($row = $db->fetch_array($result))$refoption.=makeoption($row['id'], $row['catname'], $_GET['id']);
	$smarty->assign("refoption", $refoption);

	$smarty->assign("linkid", $_GET['id']);
	$smarty->display("a_download_edit.tpl.php");
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
		if($_FILES['uploadfile']['size']<=$shopconfig['shopconfig_max_upload_size']){
			$attachment_file_extension = strtolower(substr(strrchr($_FILES['uploadfile']['name'], '.'), 1));
			$attachment_file_name2 = substr($_FILES['uploadfile']['name'], 0, (intval(strlen($attachment_file_extension)) + 1) * -1);
			$allowextensions = str_replace("\n", "|", str_replace('*', '[a-z0-9]*', dos2unix($shopconfig['shopconfig_allowed_upload_extension'])));
			$upload_file_size = $_FILES['uploadfile']['size'];
			// Wenn die Datei hochgeladen werden darf
			if (preg_match("/^($allowextensions)$/i", $attachment_file_extension)) {
				$result = $db->query("INSERT INTO rhs_download_data SET
					dlname='$_POST[dlname]',
					dldescription='$_POST[dldescription]',
					dlfile='$attachment_file_name2.$attachment_file_extension',
					catid='$_POST[p_cat]',
					filesize='$upload_file_size',
					filetype='$attachment_file_extension',
					mandant=".$adminsession->session_mandant_data['mandant_id'].",
					create_userid=".$adminsession->session_user_data['customer_id'].",
					create_date=".time());
				if($result){
					if(!is_dir($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id'])){
						mkdir($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']);
					}
					// Bild auf den Server speichern
					if (@move_uploaded_file($_FILES['uploadfile']['tmp_name'], $shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']."/".$db->insert_id().'.'.$attachment_file_extension)) {
						@chmod($shopconfig['shopconfig_upload_folder'].$adminsession->session_mandant_data['mandant_id']."/".$db->insert_id().'.'.$attachment_file_extension, 0777);

						$smarty->assign("fehler", 1);
						$smarty->assign("action", "editlink");
						$smarty->assign("page_redirect", "download_cat.php?sid=".$adminsession->session_data['hash']);
					}else $smarty->assign("fehler", 2);
				}else{
					$smarty->assign("fehler", 2);
				}
			}else{
				$smarty->assign("fehler", 2);
			}
		}else{
			$smarty->assign("fehler", 2);
		}
		$rowlink = $db->query_first("SELECT * FROM rhs_download_data WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$db->insert_id());
		$smarty->assign($rowlink);
		$smarty->assign("linkid", $_GET['p_cat']);
	}

	$result = $db->query("SELECT *	FROM rhs_download_cat WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY catname ASC");
	while($row = $db->fetch_array($result))$refoption.=makeoption($row['id'], $row['catname'], $_GET['id']);
	$smarty->assign("refoption", $refoption);

	$smarty->display("a_download_edit.tpl.php");
	exit();
}
?>
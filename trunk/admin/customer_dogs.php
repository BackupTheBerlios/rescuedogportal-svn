<?php
/**
* Training Type Administration Page
*
*
* Filename: customer_dog.php
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
$filename="customer_dogs.php";


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
if($adminsession->session_user_data['admin_can_use_customer_users'] !=1)$adminsession->NoEntryForUser();

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";


/**
*
*  Standartanzeige der Links
*
**/
if(!$action) {
	if($_GET['orderby'])$orderby=$_GET['orderby'];
	else $orderby="name";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="ASC";

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$row['gender'] = $gender[$row['gender']];
		$row['exam'] = $exam[$row['exam']];
		$row['exam_tr'] = $exam[$row['exam_tr']];
		if($row['dob']==0)$row['dob']=date("d.m.Y", time());
		else $row['dob']=date("d.m.Y", $row['dob']);

		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");

	$smarty->display("a_customer_dogs_show.tpl.php");
	exit();
}


/**
*
*  Training Typ editieren
*
**/
if($action=="edit") {
	if($adminsession->session_user_data['admin_can_use_customer_users_change'] !=1)$adminsession->NoEntryForUser();
	$smarty->assign("action", $action);
	if($_POST['send']){
		// Wenn das Bild gelöscht werden soll, alle Bildtypen löschen um das Verzeichnis rein zu halten
		if($_POST['delete_pic'] == 1){
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.jpg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.jpeg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.png');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.gif');
		}elseif ($_FILES['img_for_this_user']['tmp_name'] && $_FILES['img_for_this_user']['tmp_name'] != 'none') {
			$attachment_file_extension = strtolower(substr(strrchr($_FILES['img_for_this_user']['name'], '.'), 1));
			$attachment_file_name2 = substr($_FILES['img_for_this_user']['name'], 0, (intval(strlen($attachment_file_extension)) + 1) * -1);

			$allowextensions = str_replace("\n", "|", str_replace('*', '[a-z0-9]*', dos2unix($shopconfig['shopconfig_allowed_attachment_extension'])));

			// Wenn das Bild hochgeladen werden darf
			if (preg_match("/^($allowextensions)$/i", $attachment_file_extension)) {
				// evtl alte Bilder löschen
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.jpg');
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.jpeg');
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.png');
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.gif');

				// Bild auf den Server speichern
				if (@move_uploaded_file($_FILES['img_for_this_user']['tmp_name'], $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension)) {
					@chmod($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension, 0777);

					// Bildgröße checken und evtl. verkleinern
					$imagesize = getimagesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension);

					if($imagesize[0] > $shopconfig['shopconfig_allowed_attachment_width']){
						 if ($attachment_file_extension == "jpg" || $attachment_file_extension == "jpeg"){
							$src_img = imagecreatefromjpeg($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension);
						}else{
							$src_img = imagecreatefrompng($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension);
						}

						if (!$src_img) {
							// no new image
						}else{
							$srcWidth = $imagesize[0];
							$srcHeight = $imagesize[1];
							$ratio = $srcHeight / $shopconfig['shopconfig_allowed_attachment_width'];

							$ratio = max($ratio, 1.0);
							$destWidth = (int)($srcWidth / $ratio);
							$destHeight = (int)($srcHeight / $ratio);

							$dst_img = imagecreatetruecolor($destWidth, $destHeight);
							imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
							imagejpeg($dst_img, $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension, 100);
							imagedestroy($src_img);
							imagedestroy($dst_img);
						}
					}

					// Wenn das Bild nach der Verkleinerung immer noch zu groß ist löschen
					if(filesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension) > $shopconfig['shopconfig_max_attachment_size']){
						unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.'.$attachment_file_extension);
					}

				}else {
					// No Upload possible
				}
			}else{
				// file extension not allowed
			}
		}

		$result = $db->query("UPDATE rhs_customer_dogs SET name='$_POST[name]', dob=".makemytime($_POST[dob]).", gender='$_POST[gender]', species='$_POST[species]', exam_tr=$_POST[exam_tr], exam=$_POST[exam] WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
		if($result){
			$smarty->assign("fehler", 1);
			$smarty->assign("page_redirect", "customer_dogs.php?sid=".$adminsession->session_data['hash']);
		}else $smarty->assign("fehler", 2);
	}
	$rowlink = $db->query_first("SELECT * FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
	$rowlink['gender'] = create_options_gender($rowlink['gender']);
	$rowlink['exam'] = create_options_yes_no($rowlink['exam']);
	$rowlink['exam_tr'] = create_options_yes_no($rowlink['exam_tr']);
	if($rowlink['dob']==0)$rowlink['dob']=date("d.m.Y", time());
	else $rowlink['dob']=date("d.m.Y", $rowlink['dob']);

	if(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.jpg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.jpg");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.jpeg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.png")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.gif")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id']."_hund.gif");
	else $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath']."nopic_hund.png");


	$smarty->assign($rowlink);
	$smarty->display("a_customer_dogs_edit.tpl.php");
	exit();
}

/**
*
*  Links erzeugen
*
**/
if($action=="new") {
	if($adminsession->session_user_data['admin_can_use_customer_users_change'] !=1)$adminsession->NoEntryForUser();
	$smarty->assign("action", $action);
	if($_POST['send']){
		$result = $db->query("INSERT INTO rhs_customer_dogs SET name='$_POST[name]', dob=".makemytime($_POST[dob]).", gender='$_POST[gender]', species='$_POST[species]', exam_tr=$_POST[exam_tr], exam=$_POST[exam], mandant=".$adminsession->session_mandant_data['mandant_id'].", create_userid=".$adminsession->session_user_data['customer_id'].", create_date=".time());
		if($result){
			$thisdbinsertid = $db->insert_id();
			$rowlink = $db->query_first("SELECT * FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$thisdbinsertid);
			$smarty->assign("fehler", 1);
			$smarty->assign("page_redirect", "customer_dogs.php?sid=".$adminsession->session_data['hash']);

			if ($_FILES['img_for_this_user']['tmp_name'] && $_FILES['img_for_this_user']['tmp_name'] != 'none') {
				$attachment_file_extension = strtolower(substr(strrchr($_FILES['img_for_this_user']['name'], '.'), 1));
				$attachment_file_name2 = substr($_FILES['img_for_this_user']['name'], 0, (intval(strlen($attachment_file_extension)) + 1) * -1);

				$allowextensions = str_replace("\n", "|", str_replace('*', '[a-z0-9]*', dos2unix($shopconfig['shopconfig_allowed_attachment_extension'])));

				// Wenn das Bild hochgeladen werden darf
				if (preg_match("/^($allowextensions)$/i", $attachment_file_extension)) {
					// evtl alte Bilder löschen
					@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.jpg');
					@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.jpeg');
					@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.png');
					@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.gif');

					// Bild auf den Server speichern
					if (@move_uploaded_file($_FILES['img_for_this_user']['tmp_name'], $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension)) {
						@chmod($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension, 0777);

						// Bildgröße checken und evtl. verkleinern
						$imagesize = getimagesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension);

						if($imagesize[0] > $shopconfig['shopconfig_allowed_attachment_width']){
							 if ($attachment_file_extension == "jpg" || $attachment_file_extension == "jpeg"){
								$src_img = imagecreatefromjpeg($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension);
							}else{
								$src_img = imagecreatefrompng($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension);
							}

							if (!$src_img) {
								// no new image
							}else{
								$srcWidth = $imagesize[0];
								$srcHeight = $imagesize[1];
								$ratio = $srcHeight / $shopconfig['shopconfig_allowed_attachment_width'];

								$ratio = max($ratio, 1.0);
								$destWidth = (int)($srcWidth / $ratio);
								$destHeight = (int)($srcHeight / $ratio);

								$dst_img = imagecreatetruecolor($destWidth, $destHeight);
								imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $destWidth, (int)$destHeight, $srcWidth, $srcHeight);
								imagejpeg($dst_img, $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension, 100);
								imagedestroy($src_img);
								imagedestroy($dst_img);
							}
						}

						// Wenn das Bild nach der Verkleinerung immer noch zu groß ist löschen
						if(filesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension) > $shopconfig['shopconfig_max_attachment_size']){
							unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'_hund.'.$attachment_file_extension);
						}

					}else {
						// No Upload possible
					}
				}else{
					// file extension not allowed
				}
			}
		}else $smarty->assign("fehler", 2);
	}
	$rowlink['gender'] = create_options_gender($rowlink['gender']);
	$rowlink['exam'] = create_options_yes_no($rowlink['exam']);
	$rowlink['exam_tr'] = create_options_yes_no($rowlink['exam_tr']);
	if($rowlink['dob']==0)$rowlink['dob']=date("d.m.Y", time());
	else $rowlink['dob']=date("d.m.Y", $rowlink['dob']);

	if(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.jpg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.jpg");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.jpeg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.png")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.gif")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid."_hund.gif");
	else $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath']."nopic_hund.png");

	$smarty->assign("page_redirect", "customer_dogs.php?sid=".$adminsession->session_data['hash']);


	$smarty->assign($rowlink);
	$smarty->display("a_customer_dogs_edit.tpl.php");
	exit();
}


/**
*
*  Entfernen einer Link Kategorie
*
**/
if($action=="delete") {
	if($adminsession->session_user_data['admin_can_use_customer_users_change'] !=1)$adminsession->NoEntryForUser();
	$result = $db->query("SELECT name, id FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
	$catname = $db->fetch_array($result);
	$smarty->assign("deletename", $catname['name']);
	$smarty->assign("deleteid", $catname['id']);
	$smarty->assign("action", $action);
	$smarty->assign("filename", $filename);
	$smarty->assign("pagename", "Hunde");

	/* Wenn das Forumlar abgeschickt wurde */
	if(isset($_POST['send'])) {
		if(isset($_POST['ja'])){
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.jpg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.jpeg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.png');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'_hund.gif');
			$db->query("DELETE FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
		}
		header("Location: customer_dogs.php?sid=".$adminsession->session_data['hash']);
		exit();
	}

	$smarty->display("delete.tpl.php");
	exit();
}


?>
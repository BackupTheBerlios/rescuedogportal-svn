<?php
/**
* Training Type Administration Page
*
*
* Filename: customer.php
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
$filename="customer.php";


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
	else $orderby="customer_surname";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="ASC";

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_customer WHERE customer_mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");

	$smarty->display("a_customer_show.tpl.php");
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
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.jpg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.jpeg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.png');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.gif');
		}elseif ($_FILES['img_for_this_user']['tmp_name'] && $_FILES['img_for_this_user']['tmp_name'] != 'none') {
			$attachment_file_extension = strtolower(substr(strrchr($_FILES['img_for_this_user']['name'], '.'), 1));
			$attachment_file_name2 = substr($_FILES['img_for_this_user']['name'], 0, (intval(strlen($attachment_file_extension)) + 1) * -1);

			$allowextensions = str_replace("\n", "|", str_replace('*', '[a-z0-9]*', dos2unix($shopconfig['shopconfig_allowed_attachment_extension'])));

			// Wenn das Bild hochgeladen werden darf
			if (preg_match("/^($allowextensions)$/i", $attachment_file_extension)) {
				// evtl alte Bilder löschen
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.jpg');
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.jpeg');
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.png');
				@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.gif');

				// Bild auf den Server speichern
				if (@move_uploaded_file($_FILES['img_for_this_user']['tmp_name'], $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension)) {
					@chmod($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension, 0777);

					// Bildgröße checken und evtl. verkleinern
					$imagesize = getimagesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension);

					if($imagesize[0] > $shopconfig['shopconfig_allowed_attachment_width']){
						 if ($attachment_file_extension == "jpg" || $attachment_file_extension == "jpeg"){
							$src_img = imagecreatefromjpeg($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension);
						}else{
							$src_img = imagecreatefrompng($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension);
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
							imagejpeg($dst_img, $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension, 100);
							imagedestroy($src_img);
							imagedestroy($dst_img);
						}
					}

					// Wenn das Bild nach der Verkleinerung immer noch zu groß ist löschen
					if(filesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension) > $shopconfig['shopconfig_max_attachment_size']){
						unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.'.$attachment_file_extension);
					}

				}else {
					// No Upload possible
				}
			}else{
				// file extension not allowed
			}
		}
		$result = $db->query("SELECT * FROM rhs_customer WHERE customer_id <> ".$_GET['id']." AND customer_admin_name='$_POST[customer_admin_name]'");
		if($db->num_rows() > 0){
			$smarty->assign("fehler", 2);
		}else{
			$result = $db->query("UPDATE rhs_customer
				SET customer_surname='$_POST[surname]',
					customer_firstname='$_POST[firstname]',
					customer_description='$_POST[description]',
					customer_show_address='$_POST[show_address]',
					customer_street='$_POST[street]',
					customer_admin_name='$_POST[customer_admin_name]',
					customer_admin_groupsid='$_POST[customer_admin_groupsid]',
					customer_zipcode='$_POST[zipcode]',
					customer_city='$_POST[city]',
					customer_show_email='$_POST[show_email]',
					customer_email='$_POST[email]',
					customer_show_email2='$_POST[show_email2]',
					customer_show_user='$_POST[show_user]',
					customer_groupsid='$_POST[groupsid]',
					customer_show_dog='$_POST[show_dog]',
					customer_show_dog2='$_POST[show_dog2]',
					customer_email2='$_POST[email2]',
					customer_show_phone='$_POST[show_phone]',
					customer_phone='$_POST[phone]',
					customer_show_phone_business='$_POST[show_phone_business]',
					customer_phone_business='$_POST[phone_business]',
					customer_show_fax='$_POST[show_fax]',
					customer_fax='$_POST[fax]',
					customer_dogid='$_POST[dogid]',
					customer_dogid2='$_POST[dogid2]',
					customer_show_mobile='$_POST[show_mobile]',
					customer_mobile='$_POST[mobile]'
				WHERE customer_mandant=".$adminsession->session_mandant_data['mandant_id']." AND customer_id=$_GET[id]");
			if($result){
				$smarty->assign("fehler", 1);
				$smarty->assign("page_redirect", "customer.php?sid=".$adminsession->session_data['hash']);
			}else $smarty->assign("fehler", 2);
		}
	}
	$rowlink = $db->query_first("SELECT * FROM rhs_customer WHERE customer_mandant=".$adminsession->session_mandant_data['mandant_id']." AND customer_id=$_GET[id]");

	$result = $db->query("SELECT * FROM rhs_customer_groups WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY name");
	while($row = $db->fetch_array($result))$rowlink['customer_groups'].=makeoption($row['id'], $row['name'], $rowlink['customer_groupsid']);

	$result = $db->query("SELECT * FROM rhs_customer_admin_groups ORDER BY admin_name");
	while($row = $db->fetch_array($result))$rowlink['customer_admin_groupsid2'].=makeoption($row['admin_id'], $row['admin_name'], $rowlink['customer_admin_groupsid']);

	$result = $db->query("SELECT *FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY name ASC");
	while($row = $db->fetch_array($result)){
		$rowlink['customer_dogid_1'] .= makeoption($row['id'], $row['name'], $rowlink['customer_dogid']);
		$rowlink['customer_dogid_2'] .= makeoption($row['id'], $row['name'], $rowlink['customer_dogid2']);
	}
	if(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".jpg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".jpg");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".jpeg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".png")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".gif")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].".gif");
	else $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath']."nopic.png");

	$rowlink['customer_show_user'] = create_options_yes_no($rowlink['customer_show_user']);
	$rowlink['customer_show_dog'] = create_options_yes_no($rowlink['customer_show_dog']);
	$rowlink['customer_show_dog2'] = create_options_yes_no($rowlink['customer_show_dog2']);
	$rowlink['customer_show_address'] = create_options_yes_no($rowlink['customer_show_address']);
	$rowlink['customer_show_email'] = create_options_yes_no($rowlink['customer_show_email']);
	$rowlink['customer_show_email2'] = create_options_yes_no($rowlink['customer_show_email2']);
	$rowlink['customer_show_phone'] = create_options_yes_no($rowlink['customer_show_phone']);
	$rowlink['customer_show_phone_business'] = create_options_yes_no($rowlink['customer_show_phone_business']);
	$rowlink['customer_show_fax'] = create_options_yes_no($rowlink['customer_show_fax']);
	$rowlink['customer_show_mobile'] = create_options_yes_no($rowlink['customer_show_mobile']);
	$rowlink['customer_show_mobile'] = create_options_yes_no($rowlink['customer_show_mobile']);

	$smarty->assign($rowlink);
	$smarty->display("a_customer_edit.tpl.php");
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
		$result = $db->query("SELECT * FROM rhs_customer WHERE customer_admin_name='$_POST[customer_admin_name]'");
		if($db->num_rows() > 0){
			$smarty->assign("fehler", 2);
		}else{
			$result = $db->query("INSERT INTO rhs_customer
				SET customer_surname='$_POST[surname]',
					customer_firstname='$_POST[firstname]',
					customer_description='$_POST[description]',
					customer_show_address='$_POST[show_address]',
					customer_street='$_POST[street]',
					customer_zipcode='$_POST[zipcode]',
					customer_admin_password='".cryptmy_password($_POST['customer_admin_password'])."',
					customer_admin_name='$_POST[customer_admin_name]',
					customer_admin_groupsid='$_POST[customer_admin_groupsid]',
					customer_city='$_POST[city]',
					customer_show_email='$_POST[show_email]',
					customer_email='$_POST[email]',
					customer_show_email2='$_POST[show_email2]',
					customer_groupsid='$_POST[groupsid]',
					customer_email2='$_POST[email2]',
					customer_show_phone='$_POST[show_phone]',
					customer_show_user='$_POST[show_user]',
					customer_show_dog='$_POST[show_dog]',
					customer_show_dog2='$_POST[show_dog2]',
					customer_phone='$_POST[phone]',
					customer_show_phone_business='$_POST[show_phone_business]',
					customer_phone_business='$_POST[phone_business]',
					customer_show_fax='$_POST[show_fax]',
					customer_fax='$_POST[fax]',
					customer_dogid='$_POST[dogid]',
					customer_dogid2='$_POST[dogid2]',
					customer_show_mobile='$_POST[show_mobile]',
					customer_mobile='$_POST[mobile]',
					customer_mandant=".$adminsession->session_mandant_data['mandant_id'].",
					customer_create_userid=".$adminsession->session_user_data['customer_id'].",
					customer_create_date=".time());
			if($result){
				$thisdbinsertid = $db->insert_id();
				$rowlink = $db->query_first("SELECT * FROM rhs_customer WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=".$thisdbinsertid);
				$smarty->assign("fehler", 1);
				$smarty->assign("page_redirect", "customer.php?sid=".$adminsession->session_data['hash']);

				if ($_FILES['img_for_this_user']['tmp_name'] && $_FILES['img_for_this_user']['tmp_name'] != 'none') {
					$attachment_file_extension = strtolower(substr(strrchr($_FILES['img_for_this_user']['name'], '.'), 1));
					$attachment_file_name2 = substr($_FILES['img_for_this_user']['name'], 0, (intval(strlen($attachment_file_extension)) + 1) * -1);

					$allowextensions = str_replace("\n", "|", str_replace('*', '[a-z0-9]*', dos2unix($shopconfig['shopconfig_allowed_attachment_extension'])));

					// Wenn das Bild hochgeladen werden darf
					if (preg_match("/^($allowextensions)$/i", $attachment_file_extension)) {
						// evtl alte Bilder löschen
						@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.jpg');
						@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.jpeg');
						@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.png');
						@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.gif');

						// Bild auf den Server speichern
						if (@move_uploaded_file($_FILES['img_for_this_user']['tmp_name'], $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension)) {
							@chmod($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension, 0777);

							// Bildgröße checken und evtl. verkleinern
							$imagesize = getimagesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension);

							if($imagesize[0] > $shopconfig['shopconfig_allowed_attachment_width']){
								 if ($attachment_file_extension == "jpg" || $attachment_file_extension == "jpeg"){
									$src_img = imagecreatefromjpeg($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension);
								}else{
									$src_img = imagecreatefrompng($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension);
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
									imagejpeg($dst_img, $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension, 100);
									imagedestroy($src_img);
									imagedestroy($dst_img);
								}
							}

							// Wenn das Bild nach der Verkleinerung immer noch zu groß ist löschen
							if(filesize($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension) > $shopconfig['shopconfig_max_attachment_size']){
								unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.'.'.$attachment_file_extension);
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
	}
	$result = $db->query("SELECT *FROM rhs_customer_dogs WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY name ASC");
	while($row = $db->fetch_array($result)){
		$rowlink['dogid_1'] .= makeoption($row['id'], $row['name'], $rowlink['dogid']);
		$rowlink['dogid_2'] .= makeoption($row['id'], $row['name'], $rowlink['dogid2']);
	}

	$result = $db->query("SELECT * FROM rhs_customer_groups WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY name");
	while($row = $db->fetch_array($result))$rowlink['groups'].=makeoption($row['id'], $row['name'], $rowlink['groupsid']);

	$rowlink['show_user'] = create_options_yes_no($rowlink['show_user']);
	$rowlink['show_dog'] = create_options_yes_no($rowlink['show_dog']);
	$rowlink['show_dog2'] = create_options_yes_no($rowlink['show_dog2']);
	$rowlink['show_address'] = create_options_yes_no($rowlink['show_address']);
	$rowlink['show_email'] = create_options_yes_no($rowlink['show_email']);
	$rowlink['show_email2'] = create_options_yes_no($rowlink['show_email2']);
	$rowlink['show_phone'] = create_options_yes_no($rowlink['show_phone']);
	$rowlink['show_phone_business'] = create_options_yes_no($rowlink['show_phone_business']);
	$rowlink['show_fax'] = create_options_yes_no($rowlink['show_fax']);
	$rowlink['show_mobile'] = create_options_yes_no($rowlink['show_mobile']);

	if(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".jpg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".jpg");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".jpeg")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".png")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".png");
	elseif(is_file($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".gif")) $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$thisdbinsertid.".gif");
	else $smarty->assign("img_for_this_user", $shopconfig['shopconfig_adminimgpath']."nopic.png");

	$smarty->assign("page_redirect", "customer.php?sid=".$adminsession->session_data['hash']);

	$smarty->assign($rowlink);
	$smarty->display("a_customer_edit.tpl.php");
	exit();
}


/**
*
*  Entfernen einer Link Kategorie
*
**/
if($action=="delete") {
	if($adminsession->session_user_data['admin_can_use_customer_users_change'] !=1)$adminsession->NoEntryForUser();
	$result = $db->query("SELECT customer_surname, customer_id FROM rhs_customer WHERE customer_mandant=".$adminsession->session_mandant_data['mandant_id']." AND customer_id=$_GET[id]");
	$catname = $db->fetch_array($result);
	$smarty->assign("deletename", $catname['customer_surname']);
	$smarty->assign("deleteid", $catname['customer_id']);
	$smarty->assign("action", $action);
	$smarty->assign("filename", $filename);
	$smarty->assign("pagename", "User");


	/* Wenn das Forumlar abgeschickt wurde */
	if(isset($_POST['send'])) {
		if(isset($_POST['ja'])){
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.jpg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.jpeg');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.png');
			@unlink($shopconfig['shopconfig_adminimgpath'].$adminsession->session_mandant_data['mandant_id']."/".$_GET['id'].'.gif');

			$db->query("DELETE FROM rhs_customer WHERE customer_mandant=".$adminsession->session_mandant_data['mandant_id']." AND customer_id=$_GET[id]");
			if($catname[dogid]!="")$db->query("DELETE FROM rhs_customer_dogs WHERE id=$catname[dogid]");
		}
		header("Location: customer.php?sid=".$adminsession->session_data['hash']);
		exit();
	}

	$smarty->display("delete.tpl.php");
	exit();
}


/**
* Änderung des Passwortes mit Versenden von EMails als Info für die Änderung
*
* Tabellen: tbl1_adminusers
**/
if($_GET['action']=="pw") {
	if($adminsession->session_user_data['admin_can_use_customer_users_change'] !=1)$adminsession->NoEntryForUser();
	$result = $db->query("SELECT * FROM rhs_customer WHERE customer_id=".$_GET['userid']);
	$user = $db->fetch_array($result);
	$smarty->assign($user);

	if(isset($_POST['send'])) {
		if($_POST['mode']==1){
			$newpassword = password_generate();
			$_POST['sendmail']=1;
		}else $newpassword = $_POST['newpassword'];

		$db->query("UPDATE rhs_customer SET customer_admin_password='".cryptmy_password($newpassword)."' WHERE customer_id='".$_GET['userid']."'");

		if($_POST['sendmail']==1) {
			eval ("\$mail_html = \"".$shopconfig['shopconfig_mailnewpw_html']."\";");
			eval ("\$mail_text = \"".$shopconfig['shopconfig_mailnewpw_text']."\";");

			$mail = new phpmailer();
			$mail->From     = $adminsession->session_mandant_data['mandant_email'];
			$mail->FromName = $adminsession->session_mandant_data['mandant_vorname'] ." ". $adminsession->session_mandant_data['mandant_nachname'];
			$mail->Mailer   = "smtp";
			$mail->Host		= $smtp_mailhost;
			$mail->SMTPAuth	= true;
			$mail->Username	= $smtp_user;
			$mail->Password	= $smtp_pw;
			$mail->Subject 	= "Neues Passwort für Ihren Account bei ".$shopconfig['shopconfig_pagetitle'];

			$mail->Body    	= $mail_html;
			$mail->AltBody 	= $mail_text;
			$mail->AddAddress($user['customer_email'], $user['customer_surname']);

			@$mail->Send();
			$mail->ClearAddresses();
			$mail->ClearAttachments();
		}
		$smarty->display("a_window_close.tpl.php");
		exit();
	}

	$smarty->display("a_customer_pw.tpl.php");
	exit();
}
?>
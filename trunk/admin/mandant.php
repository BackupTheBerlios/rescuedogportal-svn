<?php
/**
* Training Type Administration Page
*
*
* Filename: mandant.php
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
* http://www.gnu.de/gpl-ger.html or ./install/gpl-ger.html
*
*/
$filename="mandant.php";


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
if($adminsession->session_user_data['admin_can_use_mandant'] !=1)$adminsession->NoEntryForUser();

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";

/**
*
*  Standartanzeige der Links
*
**/
if(!$action) {
	if($_GET['orderby'])$orderby=$_GET['orderby'];
	else $orderby="mandant_name";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="ASC";

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_mandant ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");

	$smarty->display("a_mandant_show.tpl.php");
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
		$result = $db->query("UPDATE rhs_mandant SET mandant_name='$_POST[mandant_name]', mandant_email='$_POST[mandant_email]', mandant_nachname='$_POST[mandant_nachname]',
			mandant_vorname='$_POST[mandant_vorname]', mandant_show_kontakt='$_POST[mandant_show_kontakt]', mandant_show_index_portal='$_POST[mandant_show_index_portal]',
			mandant_show_index_projects='$_POST[mandant_show_index_projects]', mandant_show_index_sponsors='$_POST[mandant_show_index_sponsors]',
			mandant_show_konto='$_POST[mandant_show_konto]', mandant_konto_nr='$_POST[mandant_konto_nr]', mandant_show_index_start='$_POST[mandant_show_index_start]',
			mandant_konto_blz='$_POST[mandant_konto_blz]', mandant_konto_bank='$_POST[mandant_konto_bank]',
			mandant_staffeltext='$_POST[message]'
		WHERE mandant_id=$_GET[id]");
		if($result){
			$smarty->assign("fehler", 1);
			$smarty->assign("page_redirect", "mandant.php?sid=".$adminsession->session_data['hash']);
		}else $smarty->assign("fehler", 2);
	}
	$rowlink = $db->query_first("SELECT
	mandant_id as mandant_id2, mandant_name as mandant_name2, mandant_email as mandant_email2, mandant_nachname as mandant_nachname2,
	mandant_vorname as mandant_vorname2 , mandant_show_kontakt as mandant_show_kontakt2, mandant_show_index_start as mandant_show_index_start2,
	mandant_show_index_portal as mandant_show_index_portal2, mandant_show_index_projects as mandant_show_index_projects2,
	mandant_show_index_sponsors as mandant_show_index_sponsors2, mandant_show_konto as mandant_show_konto2, mandant_konto_nr as mandant_konto_nr2,
	mandant_konto_blz as mandant_konto_blz2, mandant_konto_bank as mandant_konto_bank2, mandant_staffeltext as mandant_staffeltext2
	FROM rhs_mandant WHERE mandant_id=$_GET[id]");

	$rowlink['mandant_show_index_start2'] = create_options_yes_no($rowlink['mandant_show_index_start2']);
	$rowlink['mandant_show_kontakt2'] = create_options_yes_no($rowlink['mandant_show_kontakt2']);
	$rowlink['mandant_show_index_portal2'] = create_options_yes_no($rowlink['mandant_show_index_portal2']);
	$rowlink['mandant_show_index_projects2'] = create_options_yes_no($rowlink['mandant_show_index_projects2']);
	$rowlink['mandant_show_index_sponsors2'] = create_options_yes_no($rowlink['mandant_show_index_sponsors2']);
	$rowlink['mandant_show_konto2'] = create_options_yes_no($rowlink['mandant_show_konto2']);
	$rowlink['mandant_staffeltext2'] = htmlconverter(stripcrap(trim($rowlink['mandant_staffeltext2'])));

	$smarty->assign($rowlink);
	$smarty->display("a_mandant_edit.tpl.php");
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
		$result = $db->query("INSERT INTO rhs_mandant SET mandant_name='$_POST[mandant_name]', mandant_email='$_POST[mandant_email]',
		mandant_nachname='$_POST[mandant_nachname]', mandant_vorname='$_POST[mandant_vorname]', mandant_show_index_start='$_POST[mandant_show_index_start]',
		mandant_show_kontakt='$_POST[mandant_show_kontakt]', mandant_show_index_portal='$_POST[mandant_show_index_portal]',
		mandant_show_index_projects='$_POST[mandant_show_index_projects]', mandant_show_index_sponsors='$_POST[mandant_show_index_sponsors]',
		mandant_show_konto='$_POST[mandant_show_konto]', mandant_konto_nr='$_POST[mandant_konto_nr]',
		mandant_konto_blz='$_POST[mandant_konto_blz]', mandant_konto_bank='$_POST[mandant_konto_bank]',
		mandant_staffeltext='$_POST[message]'
		 create_userid=".$adminsession->session_user_data['customer_id'].", create_date=".time());
		@mkdir("../bilder/kontakt/".$db->insert_id());
		if($result){
			$rowlink = $db->query_first("SELECT
				mandant_id as mandant_id2, mandant_name as mandant_name2, mandant_email as mandant_email2, mandant_nachname as mandant_nachname2,
				mandant_vorname as mandant_vorname2 , mandant_show_kontakt as mandant_show_kontakt2, mandant_show_index_start as mandant_show_index_start2,
				mandant_show_index_portal as mandant_show_index_portal2, mandant_show_index_projects as mandant_show_index_projects2,
				mandant_show_index_sponsors as mandant_show_index_sponsors2, mandant_show_konto as mandant_show_konto2, mandant_konto_nr as mandant_konto_nr2,
				mandant_konto_blz as mandant_konto_blz2, mandant_konto_bank as mandant_konto_bank2, mandant_staffeltext as mandant_staffeltext2
				FROM rhs_mandant WHERE mandant_id=".$db->insert_id());
			$smarty->assign("fehler", 1);
			$smarty->assign("page_redirect", "mandant.php?sid=".$adminsession->session_data['hash']);
		}else $smarty->assign("fehler", 2);
	}

	$rowlink['mandant_show_index_start2'] = create_options_yes_no($rowlink['mandant_show_index_start2']);
	$rowlink['mandant_show_kontakt2'] = create_options_yes_no($rowlink['mandant_show_kontakt2']);
	$rowlink['mandant_show_index_portal2'] = create_options_yes_no($rowlink['mandant_show_index_portal2']);
	$rowlink['mandant_show_index_projects2'] = create_options_yes_no($rowlink['mandant_show_index_projects2']);
	$rowlink['mandant_show_index_sponsors2'] = create_options_yes_no($rowlink['mandant_show_index_sponsors2']);
	$rowlink['mandant_show_konto2'] = create_options_yes_no($rowlink['mandant_show_konto2']);
	$rowlink['mandant_staffeltext2'] = htmlconverter(stripcrap(trim($rowlink['mandant_staffeltext2'])));
	$smarty->assign($rowlink);
	$smarty->display("a_mandant_edit.tpl.php");
	exit();
}
?>
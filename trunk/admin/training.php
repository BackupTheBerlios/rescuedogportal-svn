<?php
/**
* Training Administration Page
*
*
* Filename: training.php
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
*/
$filename="training.php";


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
if($adminsession->session_user_data['admin_can_use_training'] !=1)$adminsession->NoEntryForUser();

if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";

/**
*
*  Standartanzeige des Training
*
**/
if(!$action) {
	if($_GET['orderby'])$orderby=$_GET['orderby'];
	else $orderby="tr.starttime";

	if($_GET['orderdir']=="ASC")$orderdir=$_GET['orderdir'];
	if($_GET['orderdir']=="DESC")$orderdir=$_GET['orderdir'];
	else $orderdir="DESC";

	$i=0;
	$trainerall=substr($trainerall, 0, strlen($trainerall)-5);
	$result = $db->query("SELECT tr.id as myid, tr.*, ort.*,  training.*, trainer.*
		FROM rhs_training tr
		LEFT JOIN rhs_training_ort ort ON (tr.ort=ort.id)
		LEFT JOIN rhs_training_trainer trainer ON (tr.trainer=trainer.id)
		LEFT JOIN rhs_training_training training ON (tr.training=training.id)
		WHERE tr.mandant=".$adminsession->session_mandant_data['mandant_id']."
		ORDER BY $orderby $orderdir");
	while($row = $db->fetch_array($result)){
		$row['starttime'] = date("H:i d.m.Y", $row['starttime']);
		$row['endtime'] = date("H:i d.m.Y", $row['endtime']);
		$rowlinks[$i] = $row;
		$smarty->assign("rowlinks", $rowlinks);
		$i++;
	}

	if($orderdir=="ASC")$smarty->assign("orderdir", "DESC");
	else $smarty->assign("orderdir", "ASC");

	$smarty->display("a_training_show.tpl.php");
	exit();
}


/**
*
*  Links erzeugen
*
**/
if($action=="new") {
	if($_POST['send']){
		foreach($_POST['training'] as $key => $val){
			if($_POST[ort][$key]!=-1){
				$result = $db->query("INSERT INTO rhs_training SET mandant='".$adminsession->session_mandant_data['mandant_id']."', ort='".$_POST[ort][$key]."', training='".$_POST[training][$key]."', trainer='".$_POST[trainer][$key]."', starttime=".makemytime($_POST[start][$key])." , endtime=".makemytime($_POST[ende][$key]).", create_userid=".$adminsession->session_user_data['customer_id'].", create_date=".time());
				if($result)$text[$key].=$_POST[start][$key].": Erfolgreich gespeichert<br>";
				else $text[$key].=$_POST[start][$key].": <font color=\"red\">Fehler beim Speichern</font><br>";
			}
		}
		header("Location: training.php?sid=".$adminsession->session_data['hash']);
	}


	$result = $db->query("SELECT * FROM rhs_training_ort WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY ort");
	while($row = $db->fetch_array($result))$row_val['ort'].=makeoption($row['id'], $row['ort'], "");

	$result = $db->query("SELECT * FROM rhs_training_trainer trainer WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id>0 ORDER BY trainer");
	while($row = $db->fetch_array($result))$row_val['trainer'].=makeoption($row['id'], $row['trainer'], 9);

	$result = $db->query("SELECT * FROM rhs_training_training training WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY training");
	while($row = $db->fetch_array($result))$row_val['training'].=makeoption($row['id'], $row['training'], 4);

	$lastdate = $db->query_first("SELECT * FROM rhs_training WHERE mandant = ".$adminsession->session_mandant_data['mandant_id']." ORDER BY starttime DESC LIMIT 0,1");
	$lastdate['oneday']=60*60*24;
	$lastdate['onemonth']=60*60*24*30;
	$whiletime = $lastdate['starttime'];
	$i=0;
	while($whiletime + ($lastdate['onemonth'] + ($lastdate['oneday']*5)) >= $lastdate['starttime']){
		$lastdate['starttime'] = $lastdate['starttime']+$lastdate['oneday'];
		if(date("w", $lastdate['starttime'])==3){
			$row_val['tag']=date("l", $lastdate['starttime']);
			$row_val['start']=date("d.m.Y", $lastdate['starttime'])." 19:00:00";
			$row_val['ende']=date("d.m.Y", $lastdate['starttime'])." 22:30:00";

			$rowlinks[$i] = $row_val;
			$smarty->assign("rowlinks", $rowlinks);
			$i++;
		}

		if(date("w", $lastdate['starttime'])==0){
			$row_val['tag']=date("l", $lastdate['starttime']);
			$row_val['start']=date("d.m.Y", $lastdate['starttime'])." 09:00:00";
			$row_val['ende']=date("d.m.Y", $lastdate['starttime'])." 12:30:00";

			$rowlinks[$i] = $row_val;
			$smarty->assign("rowlinks", $rowlinks);
			$i++;
		}
	}

	$smarty->display("a_training_edit.tpl.php");
	exit();
}


/**
*
*  Entfernen einer Link Kategorie
*
**/
if($action=="delete") {
	$result = $db->query("SELECT training, id FROM rhs_training WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
	$catname = $db->fetch_array($result);
	$smarty->assign("deletename", $catname['training']);
	$smarty->assign("deleteid", $catname['id']);
	$smarty->assign("action", $action);
	$smarty->assign("filename", $filename);
	$smarty->assign("pagename", "Training");

	/* Wenn das Forumlar abgeschickt wurde */
	if(isset($_POST['send'])) {
		if(isset($_POST['ja'])){
			$db->query("DELETE FROM rhs_training WHERE mandant=".$adminsession->session_mandant_data['mandant_id']." AND id=$_GET[id]");
		}
		header("Location: training.php?sid=".$adminsession->session_data['hash']);
		exit();
	}

	$smarty->display("delete.tpl.php");
	exit();
}


?>
<?
/**
* Staffeldatenbank
* Einsatzdatenabnk
* Linkdatenbank
*
*
*
* Filename: database.php
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
$filename="database.php";

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

switch ($_GET['tempid']) {

	case "gallery":
		define ("MOS_GALLERY2_PARAMS_RELATIVEG2PATH","gallery2");
		define ("MOS_GALLERY2_PARAMS_EMBEDURI","database.php?mandant=".$mandant['mandant_id']."&tempid=gallery".$url_und_sid);
		define ("MOS_GALLERY2_PARAMS_LOGINREDIRECT","database.php?mandant=2&tempid=gallery".$url_und_sid);
		define ("MOS_GALLERY2_PARAMS_DISPLAYSIDEBAR",1);
		define ("MOS_GALLERY2_PARAMS_DISPLAYLOGIN",1);
		define ("MOS_GALLERY2_PARAMS_EMBEDPATH","");


		require_once(MOS_GALLERY2_PARAMS_PATH . 'embed.php');
		$ret = GalleryEmbed::init(array('embedUri' => MOS_GALLERY2_PARAMS_EMBEDURI,'embedPath' => MOS_GALLERY2_PARAMS_EMBEDPATH, 'relativeG2Path' => MOS_GALLERY2_PARAMS_RELATIVEG2PATH,'loginRedirect' => MOS_GALLERY2_PARAMS_LOGINREDIRECT, 'activeUserId' => '0'));

		if (MOS_GALLERY2_PARAMS_DISPLAYSIDEBAR == 0) {
			GalleryCapabilities::set('showSidebar', false);
		}else {
				GalleryCapabilities::set('showSidebar', true);
		}

		if (MOS_GALLERY2_PARAMS_DISPLAYLOGIN == 0) {
			GalleryCapabilities::set('login' , false);
		}else {
				GalleryCapabilities::set('login' , true);
		}

		// handle the G2 request
		$g2moddata = GalleryEmbed::handleRequest();

		// show error message if isDone is not defined
		if (!isset($g2moddata['isDone']))
		{
		  echo 'isDone is not defined, something very bad must have happened.';
		  exit;
		}

		// die if it was a binary data (image) request
		if ($g2moddata['isDone'])
		{
		  exit; /* uploads module does this too */
		}

		 if ($ret->isError())
		 {
		   $bodyhtml .= $ret->getAsHtml();
		 }

		$headhtml =  $g2moddata['headHtml'];
		$bodyhtml .= $g2moddata['bodyHtml'];
		$smarty->assign("headhtml", $headhtml);
		$smarty->assign("bodyhtml", $bodyhtml);


		$smarty->display("index_content_gallery.tpl.php");
	break;

    case "staffel":
		$db = new db($sqlhost,$sqluser,$sqlpassword,$sqldb_2,$phpversion);

		$i=0;
		$result = $db->query("SELECT * FROM bb1_mod_staffeldb_staffelorg ORDER BY org ASC");
		while ($row = $db->fetch_array($result)){
			$staffelorg[$i] = $row;
			$smarty->assign("staffelorg", $staffelorg);
			$i++;
		}

		$i=0;
		$result = $db->query("SELECT * FROM bb1_mod_staffeldb_staffeln ORDER BY staffel_org, staffel_name ASC");
		while ($row = $db->fetch_array($result)){
			$staffel[$i] = $row;
			$smarty->assign("staffel", $staffel);
			$i++;
		}

		$smarty->display("database_staffel.tpl.php");

		$db = new db($sqlhost,$sqluser,$sqlpassword,$sqldb,$phpversion);
	break;

	case "einsatz":
		$db = new db($sqlhost,$sqluser,$sqlpassword,$sqldb_2,$phpversion);

		include("./mod/mod_einsatzdb_values.php");

		$i=0;
		$result = $db->query("SELECT jahr FROM bb1_mod_einsatzdb GROUP BY jahr ORDER BY start DESC");
		while ($row = $db->fetch_array($result)){
			$einsatzjahr[$i] = $row;
			$smarty->assign("einsatzjahr", $einsatzjahr);
			$i++;
		}

		$res = $db->query('SELECT adm0,name FROM bb1_mod_geodb_adm0');
		while ($row = $db->fetch_array($res)) $staaten[$row['adm0']] = $row['name'];

		$res = $db->query('SELECT adm1,adm0,name FROM bb1_mod_geodb_adm1 ORDER BY adm0 DESC,adm1');
		while ($row = $db->fetch_array($res)) $laender[$row['adm0']][$row['adm1']] = $row['name'];

		$i=0;
		$result = $db->query("SELECT * FROM bb1_mod_einsatzdb ORDER BY start ASC");
		while ($row = $db->fetch_array($result)){
			$row['start'] = date("d.m.Y", $row['start']);
			$row['ende'] = date("d.m.Y", $row['ende']);
			$row['land']=$landarray[$row['land']]['land'];
			$row['suchart']=$sucharray[$row['suchart']];
			$row['dauer']=$dauerarray[$row['dauer']];
			$row['wegentfernung']=$entfernungarray[$row['wegentfernung']];
			$row['polizei']=$janeinarray[$row['polizei']];
			$row['heli']=$janeinarray[$row['heli']];
			$row['erfolg_ohne']=$janeinarray[$row['erfolg_ohne']];
			$row['erfolg']=$janeinarray[$row['erfolg']];

			if(strlen($row['url'])>1 AND substr($row['url'], 0, 7)!="http://") $row['url']="http://".$row['url'];

			if($row_jahr['ortsdb_id']!=0){
				$ort = $db->query_first('SELECT * FROM bb'.$n.'_mod_geodb_locations WHERE id='.$row['ortsdb_id']);
				if(strpos($ort['plz'], $row['plz'])===false)$row['plz'] = $ort['plz'];
				$row['region'] = $staaten[$ort['adm0']] ." / ". $laender[$ort['adm0']][$ort['adm1']] ." / ". $ort['ort'];
			}else{
				$row['region'] = $row['land']." / ".$row['ort'];
			}

			$einsatz[$i] = $row;
			$smarty->assign("einsatz", $einsatz);
			$i++;
		}

		$smarty->display("database_einsatz.tpl.php");

		$db = new db($sqlhost,$sqluser,$sqlpassword,$sqldb,$phpversion);
	break;

	case "dl":
		$i=0;
		$result = $db->query("SELECT * FROM rhs_download_cat ORDER BY catorder ASC");
		while ($row = $db->fetch_array($result)){
			$rowdata = $db->query_first("SELECT count(id) as anzahl FROM rhs_download_data WHERE catid = ".$row['id']);
			$row['anzahl']=$rowdata['anzahl'];
			$linkref[$i] = $row;
			$smarty->assign("linkref", $linkref);
			$i++;

			$optionhtml .= makeoption($row['id'], $row['catname'], $_GET['ref']);
		}
		$smarty->assign("optionhtml", $optionhtml);
		$smarty->display("database_dl_cat.tpl.php");
	break;

	case "dldetail":
		$i=0;
		$result = $db->query("SELECT * FROM rhs_download_data WHERE catid = ".$_GET['ref']." ORDER BY dlname ASC");
		while ($row = $db->fetch_array($result)){
			$linkref[$i] = $row;
			$smarty->assign("linkref", $linkref);
			$i++;
		}
		$result = $db->query("SELECT * FROM rhs_download_cat ORDER BY catorder ASC");
		while ($row = $db->fetch_array($result)){
			$optionhtml .= makeoption($row['id'], $row['catname'], $_GET['ref']);
		}
		$smarty->assign("optionhtml", $optionhtml);
		$smarty->display("database_dl.tpl.php");
	break;

	case "dlfile":
		$row = $db->query_first("SELECT * FROM rhs_download_data WHERE id = ".$_GET['id']." ORDER BY dlname ASC");
		$folder = "./mod/db/".$row['mandant']."/".$row['id'].".".$row['filetype'];

		$fh = fopen($folder, 'r');
		header("Content-Disposition: attachment; filename=".$row['dlfile'].".".$row['filetype']);
		$filecontent = fread($fh , filesize($folder));
		fclose($fh);

		print $filecontent;
		exit;
	break;


	case "link":
		$i=0;
		$result = $db->query("SELECT * FROM rhs_link_cat ORDER BY ref ASC");
		while ($row = $db->fetch_array($result)){
			$rowdata = $db->query_first("SELECT count(id) as anzahl FROM rhs_link WHERE refid = ".$row['id']);
			$row['anzahl']=$rowdata['anzahl'];

			$linkref[$i] = $row;
			$smarty->assign("linkref", $linkref);
			$i++;
			$optionhtml .= makeoption($row['id'], $row['ref'], $_GET['ref']);
		}

		$smarty->assign("optionhtml", $optionhtml);
		$smarty->display("database_link_cat.tpl.php");
	break;

	case "linkdetail":
		$i=0;
		$result = $db->query("SELECT * FROM rhs_link WHERE refid = ".$_GET['ref']." ORDER BY titel ASC");
		while ($row = $db->fetch_array($result)){
			$linkref[$i] = $row;
			$smarty->assign("linkref", $linkref);
			$i++;
		}

		$result = $db->query("SELECT * FROM rhs_link_cat ORDER BY ref ASC");
		while ($row = $db->fetch_array($result)){
			$optionhtml .= makeoption($row['id'], $row['ref'], $_GET['ref']);
		}

		$smarty->assign("optionhtml", $optionhtml);
		$smarty->display("database_link.tpl.php");
	break;


	case "newlink":
		eval ("\$email_html = \"".$shopconfig['shopconfig_maillink_text']."\";");
		eval ("\$email_text = \"".$shopconfig['shopconfig_maillink_html']."\";");
		$mail = new phpmailer();
		$mail->From     = $mandant['mandant_email'];
		$mail->FromName = $mandant['mandant_vorname'] ." ". $mandant['mandant_nachname'];
		$mail->Mailer   = "smtp";
		$mail->Host		= $smtp_mailhost;
		$mail->SMTPAuth	= true;
		$mail->Username	= $smtp_user;
		$mail->Password	= $smtp_pw;
		$mail->Subject 	= "Nachricht von $pagename |".$mandant['mandant_name'];

		$mail->Body    	= $email_html;
		$mail->AltBody 	= $email_text;
		$mail->AddAddress($result['email'], $result['firstname'] ." ".$result['surname']);
		$mail->AddCC($mandant['mandant_email'], $mandant['mandant_vorname'] ." ". $mandant['mandant_nachname']);

		if(@$mail->Send()){
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			header("Location: database.php?send=succes&mandant=".$mandant['mandant_id']." &tempid=link$url_und_sid");
			exit();
		}else{
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			header("Location: database.php?send=bad&mandant=".$mandant['mandant_id']." &tempid=link$url_und_sid");
			exit();
		}
	break;
}
?>
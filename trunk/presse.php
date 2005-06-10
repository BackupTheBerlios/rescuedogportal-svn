<?
/**
* Presse Pages.
*
*
* Filename: presse.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package BRKPortal
* @link http://rescue-dogs.de
* @copyright 2005 BRK Rettungshundestaffel Ansbach
*
* Subversion CVS system settings of current developments
*   $LastChangedDate: 2005-06-07 09:42:33 +0200 (Tue, 07 Jun 2005) $
*   $LastChangedRevision: 47 $
*   $LastChangedBy: AdminRBG.WJ $
*   $HeadURL: http://osrdnt06.osram-os.com/svn/WEB_RHS/presse.php $
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
$filename="presse.php";

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
require('./lib/class.parse.php');

switch ($_GET['tempid']) {
    case "berichte":

		if($_GET['where'] == 1) $whereclause = " WHERE 1=1 ";
		if($_GET['selecttype'] > 0) $whereclause .= " AND tb.ref = ".$_GET['selecttype'];
		if($_GET['berichtid'] > 0) $whereclause .= " AND tb.id = ".$_GET['berichtid'];
		$parse = &new parse(0, 75, 1, '', 1);

		$data_result = $db->query("SELECT tb.*, u.* FROM rhs_tberichte tb LEFT JOIN rhs_customer u ON (tb.create_userid=u.customer_id) $whereclause ORDER BY tb.datefrom DESC");
		$i=0;
		while ($row = $db->fetch_array($data_result)) {
			$row['beschreibung'] = $parse->doparse($row['beschreibung'], 1, 0, 1, 1);
			$termineentries[$i] = $row;
			$smarty->assign("termineentries", $termineentries);
			$i++;
		}

		$smarty->display("presse_berichte.tpl.php");
		exit();
	break;

case "termine":
		$parse = &new parse(0, 75, 1, '', 1);

		$data_result = $db->query("SELECT * FROM rhs_tberichte WHERE mandant = ".$mandant['mandant_id']." AND datefrom > ".time()." ORDER BY datefrom desc");
		$i=0;
		while ($row = $db->fetch_array($data_result)) {
			$row['beschreibung'] = $parse->doparse($row['beschreibung'], 1, 0, 1, 1);
			$termineentries[$i] = $row;
			$smarty->assign("termineentries", $termineentries);
			$i++;
		}
		$smarty->assign("send", $_GET['send']);
		$smarty->display("presse_termine.tpl.php");
		exit();
	break;


case "training":
				/**
		* <b>****************************************** Traianing ***********************************************</b><br />
		* Training Settings<br />
		*
		*/
		define('TRAINING_ENTRY', true);

		$data_result = $db->query("SELECT
				rhs_training.id as id,
				rhs_training.starttime as starttime,
				rhs_training.endtime as endtime,
				rhs_training_ort.ort as ort,
				rhs_training_trainer.trainer as trainer,
				rhs_training_training.training as training
			 FROM rhs_training, rhs_training_ort, rhs_training_trainer, rhs_training_training
			 WHERE rhs_training.ort = rhs_training_ort.id AND
				rhs_training.trainer = rhs_training_trainer.id AND
				rhs_training.training = rhs_training_training.id AND
				rhs_training.mandant = ".$mandant['mandant_id']." AND
				rhs_training.starttime >= ".time()."
			ORDER BY rhs_training.starttime ASC");
		$i=0;
		while ($row = $db->fetch_array($data_result)) {
			$trainingsentries[$i] = $row;
			$smarty->assign("trainingsentries", $trainingsentries);
			$i++;
		}

		$smarty->display("presse_training.tpl.php");
		exit();
	break;

	case "newdate":
		/**
		* <b>****************************************** Traianing ***********************************************</b><br />
		* Training Settings<br />
		*
		*/
		define('NEWDATE_ENTRY', true);

		eval ("\$email_html = \"".$shopconfig['shopconfig_mailterm_text']."\";");
		eval ("\$email_text = \"".$shopconfig['shopconfig_mailterm_html']."\";");

		$mail = new phpmailer();
		$mail->From     = $mandant['mandant_email'];
		$mail->FromName = $mandant['mandant_vorname'] ." ". $mandant['mandant_nachname'];
		$mail->Mailer   = "smtp";
		$mail->Host		= $smtp_mailhost;
		$mail->SMTPAuth	= true;
		$mail->Username	= $smtp_user;
		$mail->Password	= $smtp_pw;
		$mail->Subject 	= "Nachricht von $pagename |".$mandant['name'];

		$mail->Body    	= $email_html;
		$mail->AltBody 	= $email_text;
		$mail->AddAddress($result['email'], $result['firstname'] ." ".$result['surname']);
		$mail->AddCC($mandant['mandant_email'], $mandant['mandant_vorname'] ." ". $mandant['mandant_nachname']);

		if(@$mail->Send()){
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			header("Location: presse.php?send=succes&mandant=".$mandant['mandant_id']." &tempid=termine$url_und_sid");
			exit();
		}else{
			$mail->ClearAddresses();
			$mail->ClearAttachments();

			header("Location: presse.php?send=bad&mandant=".$mandant['mandant_id']." &tempid=termine$url_und_sid");
			exit();
		}
	break;
}

?>
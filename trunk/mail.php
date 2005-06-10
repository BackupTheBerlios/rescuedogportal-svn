<?php
/**
* Sen Mail to webmaster inside a form.
*
*
* Filename: mail.php
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
$filename="mail.php";

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





switch ($action) {
	case "add":
    	/**
		* <b>****************************************** Sen Mail ***********************************************</b><br />
		* Check EMail data and send mail via smtp.<br />
		*
		*/
		define('SEND_EMAILFORM', true);

		if ($_POST['sender_message']=="" OR $_POST['sender_name']=="" OR $_POST['sender_email']=="") {
			$result = $db->query_first("SELECT rc.*, rcg.name as rcgname, rcg.sortierung as rcgorder FROM (
				rhs_customer rc LEFT JOIN rhs_customer_gruppe rcg ON rc.customer_gruppe=rcg.id)
				WHERE rc.customer_mandant=$mandant[mandant_id] AND rc.customer_rhs_show=1 AND rc.customer_id = ".$_GET['contactid']);
			$smarty->assign("messagetext", "Die Nachrichten Felder wurden nicht richtig ausgefüllt.");
			$smarty->assign("sender_name", $_POST['sender_name']);
			$smarty->assign("sender_email", $_POST['sender_email']);
			$smarty->assign("sender_message", $_POST['sender_message']);
			$smarty->assign("contactid", $_GET['contactid']);

			if($result){
				$smarty->assign("contactid", $_GET['contactid']);
				$smarty->assign("firstname", $result['customer_firstname']);
				$smarty->assign("surname", $result['customer_surname']);

				$smarty->display("mail_form.tpl.php");
				exit();
			}else{
				$smarty->assign("messagetext", "Fehlerhafte ID.");

				$smarty->display("mail_form.tpl.php");
				exit();
			}
		} else {
			$result = $db->query_first("SELECT rc.*, rcg.name as rcgname, rcg.sortierung as rcgorder FROM (rhs_customer rc LEFT JOIN rhs_customer_gruppe rcg ON rc.customer_groupsid=rcg.id) WHERE rc.customer_mandant=$mandant[mandant_id] AND rc.customer_show_user=1 AND rc.customer_id = ".$_GET['contactid']);

			$mail = new phpmailer();
			$mail->From     = $mandant['mandant_email'];
			$mail->FromName = $mandant['mandant_name'];
			$mail->Mailer   = "smtp";
			$mail->Host		= $smtp_mailhost;
			$mail->SMTPAuth	= true;
			$mail->Username	= $smtp_user;
			$mail->Password	= $smtp_pw;
			$mail->Subject 	= "Nachricht von $pagename |".$mandant['mandant_name'];

			eval ("\$email_html = \"".$shopconfig['shopconfig_email_html']."\";");
			eval ("\$email_text = \"".$shopconfig['shopconfig_email_text']."\";");
			$mail->Body    	= $email_html;
			$mail->AltBody 	= $email_text;
			$mail->AddAddress($result['customer_email'], $result['customer_firstname'] ." ".$result['customer_surname']);
			$mail->AddCC($mandant['mandant_email'], $mandant['mandant_vorname'] ." ". $mandant['mandant_nachname']);

			if (@$mail->Send()){
				$mail->ClearAddresses();
				$mail->ClearAttachments();

				$smarty->display("mail_success.tpl.php");
				exit();
			}else{
				$mail->ClearAddresses();
				$mail->ClearAttachments();

				$result = $db->query_first("SELECT rc.*, rcg.name as rcgname, rcg.sortierung as rcgorder FROM (rhs_customer rc LEFT JOIN rhs_customer_gruppe rcg ON rc.customer_groupsid=rcg.id) WHERE rc.customer_mandant=$mandant[mandant_id] AND rc.customer_show_user=1 AND rc.customer_id = ".$_GET['contactid']);
				$smarty->assign("contactid", $_GET['contactid']);
				$smarty->assign("firstname", $result['customer_firstname']);
				$smarty->assign("surname", $result['customer_surname']);
				$smarty->assign("sender_name", $_POST['sender_name']);
				$smarty->assign("sender_email", $_POST['sender_email']);
				$smarty->assign("sender_message", $_POST['sender_message']);
				$smarty->assign("contactid", $_GET['contactid']);
				$smarty->assign("messagetext", "Fehler im Mailversand, bitte versuchen sie es später noch einmal.");

				$smarty->display("mail_form.tpl.php");
				exit();
			}
		}
    break;

  default:
    	/**
		* <b>****************************************** Display EMail Send Form ***********************************************</b><br />
		* Display EMail Send Form.<br />
		*
		*/
		define('INITIALIZE_EMAILFORM', true);
		$result = $db->query_first("SELECT rc.*, rcg.name as rcgname, rcg.sortierung as rcgorder FROM (rhs_customer rc LEFT JOIN rhs_customer_gruppe rcg ON rc.customer_groupsid=rcg.id) WHERE rc.customer_mandant=$mandant[mandant_id] AND rc.customer_show_user=1 AND rc.customer_id = ".$_GET['contactid']);
		if($result){
			$smarty->assign("contactid", $_GET['contactid']);
			$smarty->assign("firstname", $result['customer_firstname']);
			$smarty->assign("surname", $result['customer_surname']);

			$smarty->display("mail_form.tpl.php");
			exit();
		}else{
			$smarty->assign("messagetext", "Fehlerhafte ID.");

			$smarty->display("mail_form.tpl.php");
			exit();
		}
    break;
}

?>
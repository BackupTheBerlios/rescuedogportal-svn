<?
/**
* Guestbook
* Chat
*
*
*
* Filename: community.php
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
$filename="community.php";


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
    case "gaestebuch":

		/**
		* <b>****************************************** Guestbook ***********************************************</b><br />
		* Guestbook Settings<br />
		*
		*/
		define('GUESTBOOK_ENTRY', true);

		if($_POST['action'] == "add") {

			$datum=date("y-m-d H:i:s",time());

			if (strlen($_POST['myemail'])==0) $email="Keine E-Mail Adresse";
			if (strlen($_POST['mymassage']) < 4) $fehler=2;
			if (strlen($_POST['myname']) < 3) $fehler=1;
			if (strlen($_POST['myhp'])==0) $homepage="Keine eigene Homepage";

			if ($fehler=="") {
				$varresult = $db->query("INSERT INTO rhs_gaestebuch (mandant, name, datum, kommentar, email, homepage, icq, aim, yahoo) VALUES('".$mandant['mandant_id']."', '".$_POST['myname']."', '".$datum."', '".$_POST['mymassage']."', '".$_POST['myemail']."', '".$_POST['myhp']."', '".$_POST['myicq']."', '".$_POST['myaim']."', '".$_POST['myyahoo']."')");

				$_GET['neu']=0;
				$mail = new phpmailer();
				$mail->From     = $_POST['sender_email'];
				$mail->FromName = $_POST['sender_email'];
				$mail->Mailer   = "smtp";
				$mail->Host		= $smtp_mailhost;
				$mail->SMTPAuth	= true;
				$mail->Username	= $smtp_user;
				$mail->Password	= $smtp_pw;
				$mail->Subject 	= "EMail vom ".$shopconfig['shopconfig_pagetitle']." Gästebuch";

				$body    	= "Hallo ".$_POST['myname'].",
vielen Dank für den Eintrag in unserem Gästebuch,
Name: ". $_POST['myname']. "
Datum: ". $datum ."
Email: ". $_POST['myemail'] ."
Homepage: ". $_POST['myhp']. "
Kommentar: ". $_POST['mymassage'] ."
Text: ". $_POST['text']."

Das $pagename |".$mandant['name']." Team";

				$mail->Body 	= $body;
				$mail->AltBody 	= $body;
				$mail->AddAddress($_POST['myemail'], $_POST['myname']);
				$mail->AddCC($mandant['mandant_email'], $mandant['mandant_vorname'] ." ". $mandant['mandant_nachname']);
				@$mail->Send();
				$mail->ClearAddresses();
				$mail->ClearAttachments();
			}else {
				print $fehler;
				if ($fehler==1) $smarty->assign("fehler", 1);
				if ($fehler==2) $smarty->assign("fehler", $fehler);
				$_GET['neu']=1;
				$smarty->assign("myname", $_POST['myname']);
				$smarty->assign("mymassage", $_POST['mymassage']);
				$smarty->assign("myemail", $_POST['myemail']);
				$smarty->assign("myhp", $_POST['myhp']);
				$smarty->assign("myicq", $_POST['myicq']);
				$smarty->assign("myaim", $_POST['myaim']);
				$smarty->assign("myyahoo", $_POST['myyahoo']);
			}
		}


		$varresult = $db->query("SELECT * FROM rhs_gaestebuch WHERE mandant = ".$mandant['mandant_id']." ORDER BY id DESC");

		$html="";
		$iZeile=1;
		$iMaxZeile=1;
		$iRow=1;
		$iMaxRow=1;
		$kZeile=1;

		while ($db->num_rows($varresult)>=$iMaxZeile){
			$iMaxRow=$iMaxRow+1;
			$iMaxZeile = $iMaxZeile + 10;
		}

		$kZeile=$pagegaeste*10;
		while(($kZeile-11)>0)while($row = $db->fetch_array($varresult) and ($kZeile-11)>0)$kZeile=$kZeile-1;
		if($pagegaeste==1) $prevpage=1;
		else $prevpage=$pagegaeste-1;

		$gastbook['linkleiste'] .= "<a href=\"community.php?tempid=gaestebuch&pagegaeste=1{$url_und_sid}\">&nbsp;<<&nbsp;&nbsp;</a>";
		$gastbook['linkleiste'] .= "<a href=\"community.php?tempid=gaestebuch&pagenr=7&page=0&pagegaeste=".$prevpage."{$url_und_sid}\">&nbsp;<&nbsp;&nbsp;</a>|";
		while ($iZeile<$iMaxRow){
			if($pagegaeste!=$iZeile) $gastbook['linkleiste'] .= "<a href=\"community.php?tempid=gaestebuch&pagegaeste=". $iZeile ."{$url_und_sid}\">&nbsp;". $iZeile ."&nbsp;</a>|";
			if($pagegaeste==$iZeile) $gastbook['linkleiste'] .= "&nbsp;<font color=#ffffff>". $iZeile ."</font>&nbsp;|";
			$iZeile=$iZeile+1;
		}

		if($pagegaeste==$iMaxRow-1) $nextpage=$iMaxRow-1;
		else $nextpage=$pagegaeste+1;

		$gastbook['linkleiste'] .= "<a href=\"community.php?tempid=gaestebuch&pagegaeste=".$nextpage."{$url_und_sid}\">&nbsp;>&nbsp;&nbsp;</a>";
		$gastbook['linkleiste'] .= "<a href=\"community.php?tempid=gaestebuch&pagegaeste=".($iMaxRow-1)."{$url_und_sid}\">&nbsp;>>&nbsp;&nbsp;</a>";
		$i = 0;
		while ($row = $db->fetch_array($varresult) and $iRow<=10){
			$gastbook['email']=str_replace(" ","&nbsp;", str_replace("\r\n","<br>",htmlentities($row["email"]))) ;
			$gastbook['homepage']=str_replace(" ","&nbsp;", str_replace("\r\n","<br>",htmlentities($row["homepage"])));
			$gastbook['massege']= htmlentities($row["kommentar"]);
			$gastbook['antwort']=str_replace(" ","&nbsp;", str_replace("\r\n","<br>",htmlentities($row["antwort"])));

			if($row["icq"] == "") {
				$gastbook['icq'] = "";
			} else {
				$gastbook['icq'] = "<a href=\"http://wwp.icq.com/".htmlspecialchars($row["icq"])."#pager\" target=\"_blank\"><font size=\"1\" face=\"Tahoma\">".htmlspecialchars($row["icq"])."</font></a>";
			}

			if($row["aim"] == "") {
				$gastbook['aim'] = "";
			} else {
				$gastbook['aim'] = "<a href=\"aim:goim?screenname=".htmlspecialchars($row["aim"])."&message=Hi+".htmlspecialchars($row["aim"]).".+Are+you+there?\" target=\"_blank\"><font size=\"1\" face=\"Arial\">".htmlspecialchars($row["aim"])."</font></a>";
			}

			if($row["yahoo"] == "") {
				$gastbook['yahoo'] = "";
			} else {
				$gastbook['yahoo'] = "<a href=\"http://edit.yahoo.com/config/send_webmesg?.target=".htmlspecialchars($row["yahoo"])."&.src=pg\" target=\"_blank\"><font size=\"1\" face=\"Tahoma\">".htmlspecialchars($row["yahoo"])."</font></a>";
			}

			$gastbook['massege'] = format_post($gastbook['massege'], 0, 1);


			$gastbook['name'] 	= $row['name'];
			$gastbook['tag']	= wochentag(strtotime($row['datum']));
			$gastbook['jahr']	= date('d.m.Y',strtotime($row['datum']));
			$gastbook['uhr']	= date('H:i:s',strtotime($row['datum']));
			$gastbook['id'] 	= $row['id'];


			$guestbookentrie[$i] = $gastbook;
			$smarty->assign("guestbookentrie", $guestbookentrie);
			$i++;
			$iRow=$iRow+1;
		}

		$smarty->assign("gastbooklinkleiste", $gastbook['linkleiste']);
		$smarty->assign("neuer_eintrag", $_GET['neu']);

		$smarty->display("community_gaestebuch.tpl.php");
	break;

    case "chat":

		/**
		* <b>****************************************** Chat ***********************************************</b><br />
		* Chat Settings<br />
		*
		*/
		define('CHAT_ENTRY', true);

		$smarty->display("community_chat.tpl.php");
	break;
}



?>
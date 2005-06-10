<?php
/**
* Training Type Administration Page
*
*
* Filename: customer_pdf.php
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
$filename="customer_pdf.php";


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


require "../lib/class.pdf.php";
require "../lib/class.pdf_ez.php";


if(isset($_REQUEST['action'])) $action=$_REQUEST['action'];
else $action="";

/**
*
*  Standartanzeige der Links
*
**/
if(!$action) {
	$mypdfdata = array();
	$result = $db->query("SELECT *	FROM rhs_customer WHERE customer_mandant =".$adminsession->session_mandant_data['mandant_id']." ORDER BY customer_surname ASC");
	while($row = $db->fetch_array($result)){

		$mypdfdata['author'] = "<b>".$row['customer_firstname']." ".$row['customer_surname']."</b>\n";
		$mypdfdata['author'] .= $row['customer_street']."\n";
		$mypdfdata['author'] .= $row['customer_zipcode']." ".$row['customer_city']."\n";
		$mypdfdata['author'] .= "EMail: <c:alink:".$row['email'].">".$row['customer_email']."</c:alink>\n";
		$mypdfdata['author'] .= "EMail 2: <c:alink:".$row['email2'].">".$row['customer_email2']."</c:alink>";

		$mypdfdata['post'] ="Telefon: ". $row['customer_phone']."\n";
		$mypdfdata['post'].="Fax: ". $row['customer_fax']."\n";
		$mypdfdata['post'].="Geschäftlich: ". $row['customer_phone_business']."\n";
		$mypdfdata['post'].="Mobile: ". $row['customer_mobile'];
		$mypdfdata_array[]=$mypdfdata;
	}


	$table_options['showLines']=2;
	$table_options['fontSize']=11;
	$table_options['maxWidth']="525";
	$table_options['width']="525";

	$pdf =& new Cezpdf();
	$pdf->ezImage("./bilder/hintergrund/srh.jpg", 5, 100, '', 'center');
	$pdf->ezText("<b>".$shopconfig['shopconfig_pagetitle']." | ".$adminsession->session_mandant_data['mandant_name']."</b>", 14, "", $shopconfig['shopconfig_url']);
	$pdf->ezText("<b>Auf ".$shopconfig['shopconfig_url']."</b>", 14, "", $shopconfig['shopconfig_url']);
	$pdf->ezText("\n", 12);
	$pdf->ezTable($mypdfdata_array, array("author"=>"Erstellt von: ". $adminsession->session_mandant_data['mandant_vorname']." ".$adminsession->session_mandant_data['mandant_nachname'], "post"=>"Kontaktliste Stand: ".date("d.m.Y", time())." ".date("H:i:s", time())), "", $table_options);
	$pdf->eztext("\nPowered by: PDF Creator ".$shopconfig['shopconfig_url'],8,array("justification"=>"right"), $shopconfig['shopconfig_url']);
	$pdf->ezStream();
}

/**
*
*  Standartanzeige der Links
*
**/
if($action=="komplett") {

	$result = $db->query("SELECT * FROM rhs_mandant");
	while($row = $db->fetch_array($result)){
		$mandantarray[$row['mandant_id']]= $row['mandant_name'];
	}
	$mypdfdata = array();
	$result = $db->query("SELECT * FROM rhs_customer ORDER BY customer_mandant, customer_surname ASC");
	while($row = $db->fetch_array($result)){

		$mypdfdata['author'] = $mandantarray[$row['customer_mandant']]."\n";
		$mypdfdata['author'] .= $row['customer_firstname']." ".$row['customer_surname']."\n";
		$mypdfdata['author'] .= $row['customer_street']."\n";
		$mypdfdata['author'] .= $row['customer_zipcode']." ".$row['city']."\n";
		$mypdfdata['author'] .= "EMail: <c:alink:".$row['email'].">".$row['customer_email']."</c:alink>\n";
		$mypdfdata['author'] .= "EMail 2: <c:alink:".$row['email2'].">".$row['customer_email2']."</c:alink>";

		$mypdfdata['post'] ="Telefon: ". $row['customer_phone']."\n";
		$mypdfdata['post'].="Fax: ". $row['customer_fax']."\n";
		$mypdfdata['post'].="Geschäftlich: ". $row['customer_phone_business']."\n";
		$mypdfdata['post'].="Mobile: ". $row['customer_mobile'];
		$mypdfdata_array[]=$mypdfdata;
	}


	$table_options['showLines']=2;
	$table_options['fontSize']=11;
	$table_options['maxWidth']="525";
	$table_options['width']="525";

	$pdf =& new Cezpdf();
	$pdf->ezImage("./bilder/hintergrund/srh.jpg", 5, 100, '', 'center');

	$pdf->ezText("<b>".$shopconfig['shopconfig_pagetitle']."</b>", 14, "", $shopconfig['shopconfig_url']);
	$pdf->ezText("<b>Auf ".$shopconfig['shopconfig_url']."</b>", 14, "", $shopconfig['shopconfig_url']);
	$pdf->ezText("\n", 12);
	$pdf->ezTable($mypdfdata_array, array("author"=>"Erstellt von: ". $adminsession->session_mandant_data['mandant_vorname']." ".$adminsession->session_mandant_data['mandant_nachname'], "post"=>"Kontaktliste Stand: ".date("d.m.Y", time())." ".date("H:i:s", time())), "", $table_options);
	$pdf->eztext("\nPowered by: PDF Creator ".$shopconfig['shopconfig_url'],8,array("justification"=>"right"), $shopconfig['shopconfig_url']);
	$pdf->ezStream();
}


/**
*
*  Standartanzeige der Links
*
**/
if($action=="accept") {
	$table_options['showLines']=2;
	$table_options['fontSize']=8;
	$table_options['maxWidth']="525";
	$table_options['width']="525";

	$pdf =& new Cezpdf();

	$i=0;
	$result = $db->query("SELECT *	FROM rhs_customer WHERE customer_mandant=".$adminsession->session_mandant_data['mandant_id']." ORDER BY customer_surname ASC");
	while($row = $db->fetch_array($result)){
		if($i!=0)$pdf->ezNewPage();
		$i++;
		$pdf->ezImage("./bilder/hintergrund/srh.jpg", 5, 100, '', 'center');
		$pdf->ezText("<b>".$shopconfig['shopconfig_pagetitle']." | ".$adminsession->session_mandant_data['mandant_name']." auf ".$shopconfig['shopconfig_url']."</b>", 14, "", $shopconfig['shopconfig_url']);
		$pdf->ezText("\n \n", 8);

		$pdf->ezText("<b>Einverständniserklärung</b>", 14);
		$pdf->ezText("Erstellt: ".date("d.m.Y H:i", time()), 8, array("justification"=>"right"));
		$pdf->ezText("\n \n", 8);

		$pdf->ezText("Betrifft: ".$row['customer_firstname']." ".$row['customer_surname']."\n", 8);
		$pdf->ezText("Diese Einverständniserklärung ist für die Veröffentlichung von personenbezogenen Daten auf der Website ". $shopconfig['shopconfig_pagetitle'].", die als default Domain folgende URL hat: ".$shopconfig['shopconfig_url']." gedacht", 8);
		$pdf->ezText("\n \n", 8);

		$mypdfdata = array();
		$mypdfdata[0]['text']="Ich gestatte, dass ich mit meinem Namen auf der Website angezeigt werde: (zur Zeit: ".$row['customer_firstname']." ".$row['customer_surname'].")";
		$mypdfdata[0]['yes']="";
		$mypdfdata[0]['no']="";

		$mypdfdata[1]['text']="Ich gestatte, dass meine Telefonnummer auf der Website angezeigt wird: (zur Zeit: ".$row['customer_phone'].")";
		$mypdfdata[1]['yes']="";
		$damypdfdatata[1]['no']="";

		$mypdfdata[2]['text']="Ich gestatte, dass meine Telefonnummer (geschäftlich) auf der Website angezeigt wird: (zur Zeit: ".$row['customer_phone_business'].")";
		$mypdfdata[2]['yes']="";
		$mypdfdata[2]['no']="";

		$mypdfdata[3]['text']="Ich gestatte, dass meine Faxnummer auf der Website angezeigt wird: (zur Zeit: ".$row['customer_fax'].")";
		$mypdfdata[3]['yes']="";
		$mypdfdata[3]['no']="";

		$mypdfdata[4]['text']="Ich gestatte, dass meine Handynummer auf der Website angezeigt wird: (zur Zeit: ".$row['customer_mobile'].")";
		$mypdfdata[4]['yes']="";
		$mypdfdata[4]['no']="";

		$mypdfdata[5]['text']="Ich gestatte, dass meine EMail Adresse auf der Website angezeigt wird: (zur Zeit: ".$row['customer_email'].")";
		$mypdfdata[5]['yes']="";
		$mypdfdata[5]['no']="";

		$mypdfdata[6]['text']="Ich gestatte, dass meine Adresse auf der Website angezeigt wird: (zur Zeit: ".$row['customer_street'].", ".$row['customer_zipcode']." ".$row['customer_city'].")";
		$mypdfdata[6]['yes']="";
		$mypdfdata[6]['no']="";

		$mypdfdata[7]['text']="Ich gestatte, dass die Daten von meinem Hund angezeigt werden:";
		$mypdfdata[7]['yes']="";
		$mypdfdata[7]['no']="";

		$mypdfdata[8]['text']="Ich gestatte, dass meine EMail Adresse 2 auf der Website angezeigt wird: (zur Zeit: ".$row['customer_email2'].")";
		$mypdfdata[8]['yes']="";
		$mypdfdata[8]['no']="";

		$pdf->ezTable($mypdfdata, array("text"=>"", "yes"=>"Ja", "no"=>"Nein"), '', $table_options);

		$pdf->ezText("\n \n", 8);
		$pdf->ezText("Wenn sich Daten ändern, können sie auf der Website aktualisiert werden ohne eine gesonderte Einverständniserklärung auszustellen.", 8);
		$pdf->ezText("Verantwortlicher für die Darstellung der Daten: ".$adminsession->session_mandant_data['mandant_vorname']." ".$adminsession->session_mandant_data['mandant_nachname']."\n", 8);
		$pdf->ezText("\n \n", 8);
		$pdf->ezText("_________________________________________________________________________________________________ ", 8);
		$pdf->ezText("Ort, Datum und Unterschrift: ".$row['firstname']." ".$row['surname']."\n", 8);
		$pdf->ezText("\n \n", 14);
		$pdf->ezText("\n \n", 14);
		$pdf->ezText("\n \n", 14);
		$pdf->ezText("\n \n", 14);
		$pdf->ezText("\n \n", 14);
		$pdf->eztext("\n \nPowered by: PDF Creator ".$shopconfig['shopconfig_url'],8,array("justification"=>"right"), $shopconfig['shopconfig_url']);
	}
	$pdf->ezStream();
}
?>
<?
/**
* Index Page for static content
*
*
* Filename: menu.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package RescueDogPortal
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
**/

$filename="menu.php";

/**
* <b>****************************************** Define In Admin Code ***********************************************</b><br />
* Define In Admin Code to check hacking attempts.<br />
*
*/
define('INADMIN_CODE', 1);
$manu_additional_patch=".";

/**
* <b>****************************************** Global ***********************************************</b><br />
* Include Gloabl File.<br />
*
*/
require("../_global.php");

/**
* <b>****************************************** Kontakt Menu ***********************************************</b><br />
* Kontakt Menu.<br />
*
*/
define('INITIALIZE_KONTAKT_MENU', true);
$result = $db->query("SELECT * FROM  rhs_mandant WHERE mandant_show_kontakt=1 ORDER BY mandant_name");
while ($row = $db->fetch_array($result)){
	$thismenuitem = "";
	$result2 = $db->query("SELECT * FROM  rhs_customer_groups WHERE mandant=".$row['mandant_id']." ORDER BY sortierung");
	while ($row2 = $db->fetch_array($result2)){
		$thismenuitem .="
		[wrap_child('".$row2['name']."', 'script.gif'), imgpathforme+'kontakt.php?mandant=".$mandant['mandant_id']."&tempid=special&id=".$row2['id'].$url_und_sid."', null],";
	}
	$thismenuitem=",".substr($thismenuitem, 0, strlen($thismenuitem)-1);
	$shopconfig['mandant_kotakt_menu'].="
	[wrap_parent('".$row['mandant_name']."', 'm_award.gif'), imgpathforme+'kontakt.php?mandant=".$row['mandant_id'].$url_und_sid."', null,
		[wrap_child('Alle', 'script.gif'), imgpathforme+'kontakt.php?mandant=".$row['mandant_id'].$url_und_sid."', null]".$thismenuitem."],
	";


	if($row['mandant_show_index_portal']==1){
		$shopconfig['mandant_home_menu'].= "[wrap_parent('".$row['mandant_name']."', 'm_empfehlen.gif'), imgpathforme+'index.php?tempid=start&mandant=".$row['mandant_id'].$url_und_sid."', null";
		if($row['mandant_show_index_start']==1)$shopconfig['mandant_home_menu'].= ", [wrap_child('News@".$row['mandant_name']."', 'm_empfehlen.gif'), imgpathforme+'index.php?tempid=home&mandant=".$row['mandant_id'].$url_und_sid."', null]";
		if($row['mandant_show_index_portal']==1)$shopconfig['mandant_home_menu'].= ", [wrap_child('".$row['mandant_name']."', 'm_empfehlen.gif'), imgpathforme+'index.php?tempid=start&mandant=".$row['mandant_id'].$url_und_sid."', null]";
		if($row['mandant_show_index_sponsors']==1)$shopconfig['mandant_home_menu'].= ", [wrap_child('Partner und Sponsoren', 'm_webmail.gif'), imgpathforme+'index.php?mandant=".$row['mandant_id'].$url_und_sid."&tempid=partner', null]";
		if($row['mandant_show_index_projects']==1)$shopconfig['mandant_home_menu'].= ", [wrap_child('Projekte', 'm_pnbox.gif'), imgpathforme+'index.php?mandant=".$row['mandant_id'].$url_und_sid."&tempid=project', null]";
		$shopconfig['mandant_home_menu'].= "] ,";
	}
}

?>
var MENU_ITEMS_XP = [
	[wrap_root('Home'), imgpathforme+'index.php?tempid=home&site=portal&mandant'+mandant+sessionhash, {'tt' : 'Startseite', 'sb' : 'Alle wichtigen Informationen'},

<?
	print $shopconfig['mandant_home_menu'];
?>
		 [wrap_child('Vermisst', 'm_calender.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=vermisst&dateiname=http://www.polizei.bayern.de/fahndung/vermisst/vermisst.htm'+sessionhash, null]
	],
	[wrap_root('Rettungshunde'), imgpathforme+'index.php?mandant='+mandant+'&tempid=rhs'+sessionhash, {'tt' : 'Alles zum Thema Rettungshunde', 'sb' : 'Rettungshunde in der BRK Ansbach'},
		[wrap_child('Der Hund', 'm_galerie.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=hund'+sessionhash, null],
		[wrap_child('Die Ausbildung', 'm_urlaub.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=ausbildung'+sessionhash, null],
		[wrap_parent('Die Suche', 'm_profil.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=rhs'+sessionhash, null,
			[wrap_child('Die Flächensuche', 'usercp_usergroups.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=flaeche'+sessionhash, null],
			[wrap_child('Die Trümmersuche', 'usercp_profile_edit.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=truemmer'+sessionhash, null],
			[wrap_child('Die Lawinensuche', 'usercp_password_change.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=lawine'+sessionhash, null],
			[wrap_child('Die Wassersuche', 'usercp_email_change.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=wasser'+sessionhash, null],
			[wrap_child('Die Leichensuche', 'usercp_avatars.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=leiche'+sessionhash, null],
			[wrap_child('Das Mantrailing', 'usercp_signature_edit.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=trailing'+sessionhash, null]
		],
		[wrap_child('Hilfeleistungssystem des DRK', 'm_empfehlen.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=drkhilfe'+sessionhash, null]
	],
	[wrap_root('Presse'), imgpathforme+'presse.php?mandant='+mandant+'&tempid=termine'+sessionhash, {'tt' : 'Berichte, Termine,...', 'sb' : 'Presseinformationen und Terminkalender der Staffel'},
		[wrap_parent('Berichte', 'm_faq.gif'), imgpathforme+'presse.php?mandant='+mandant+'&tempid=berichte'+sessionhash, null,
			[wrap_child('Presseberichte', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=8'+sessionhash, null],
			[wrap_child('Einsatzberichte', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=2'+sessionhash, null],
			[wrap_child('Ausbildungslager', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=1'+sessionhash, null],
			[wrap_child('Prüfungen', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=3'+sessionhash, null],
			[wrap_child('Übungen', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=5'+sessionhash, null],
			[wrap_child('Vorführungen', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=4'+sessionhash, null],
			[wrap_child('Sonstiges', 'script.gif'), imgpathforme+'presse.php?where=1&mandant='+mandant+'&tempid=berichte&selecttype=6'+sessionhash, null]
		],
		[wrap_child('Termine', 'm_members.gif'), imgpathforme+'presse.php?mandant='+mandant+'&tempid=termine'+sessionhash, null],
		[wrap_child('Training', 'm_members.gif'), imgpathforme+'presse.php?mandant='+mandant+'&tempid=training'+sessionhash, null]
	],
	[wrap_root('Community'), imgpathforme+'community.php?mandant='+mandant+'&tempid=gaestebuch'+sessionhash, {'tt' : 'Chat, Forum, Gästebuch', 'sb' : 'Community'},
		[wrap_child('Gästebuch', 'm_award.gif'), imgpathforme+'community.php?mandant='+mandant+'&tempid=gaestebuch'+sessionhash, null],
		[wrap_child('Chat', 'm_newsticker.gif'), imgpathforme+'community.php?mandant='+mandant+'&tempid=chat'+sessionhash, null],
		[wrap_child('Forum', 'm_einsatzdb.gif'), 'http://forum.rescue-dogs.de/index.php?template=rescue-dogs', null]
	],
	[wrap_root('Kontakt'), imgpathforme+'kontakt.php?mandant='+mandant+''+sessionhash, {'tt' : 'Kontaktadressen bei der RHS BRK Ansbach', 'sb' : 'Kontakt'},
<?
	print $shopconfig['mandant_kotakt_menu'];
?>
		[wrap_child('Impressum', 'm_link.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=impressum'+sessionhash, null],
		[wrap_child('Haftungsausschluss', 'm_newsticker.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=haftung'+sessionhash, null]
	],
	[wrap_root('Datenbanken'), imgpathforme+'database.php?mandant='+mandant+'&tempid=gallery'+sessionhash, {'tt' : 'RHS Datenbanken', 'sb' : 'Linkdatenbank, Staffeldatenbank, ...'},
		 [wrap_child('Bilder', 'm_newsletter.gif'), imgpathforme+'database.php?mandant='+mandant+'&tempid=gallery'+sessionhash, null],
		 [wrap_child('Videos', 'm_umfrage.gif'), imgpathforme+'index.php?mandant='+mandant+'&tempid=video'+sessionhash, null],
		 [wrap_child('Links', 'm_link.gif'), imgpathforme+'database.php?mandant='+mandant+'&tempid=link'+sessionhash, null],
		 [wrap_child('Downloads', 'm_dl.gif'), imgpathforme+'database.php?mandant='+mandant+'&tempid=dl'+sessionhash, null],
		 [wrap_child('Einsaetze', 'm_theorie.gif'), imgpathforme+'database.php?mandant='+mandant+'&tempid=einsatz'+sessionhash, null],
		 [wrap_child('Staffelsuche', 'm_po.gif'), imgpathforme+'database.php?mandant='+mandant+'&tempid=staffel'+sessionhash, null]
	]
];
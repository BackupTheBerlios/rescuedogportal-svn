<?
/**
* Page for displaying members with pictures and responsibilities
*
*
* Filename: kontakt.php
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
$filename="kontakt.php";

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
    case "special":
		$result = $db->query("SELECT rc.*, rcg.name as rcgname, rcg.sortierung as rcgorder FROM
			(rhs_customer rc LEFT JOIN rhs_customer_groups rcg ON rc.customer_groupsid=rcg.id)
			WHERE rc.customer_mandant=$mandant[mandant_id] AND rc.customer_show_user=1 AND rcg.id=$_GET[id] ORDER BY rcgorder ASC, rc.customer_surname ASC ");
	break;

	case "user":
		$result = $db->query("SELECT * FROM rhs_customer WHERE customer_id=$_GET[id]");
		$menu_template = "small";
	break;

	default:
		$result = $db->query("SELECT * FROM  rhs_customer WHERE customer_mandant=$mandant[mandant_id] ORDER BY customer_surname ASC");
	break;
}
$i=0;
while ($row = $db->fetch_array($result)){
	if(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].gif"))$img="./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].gif";
	elseif(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].png"))$img="./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].png";
	elseif(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].jpg"))$img="./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].jpg";
	elseif(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].jpeg"))$img="./bilder/kontakt/$mandant[mandant_id]/$row[customer_id].jpeg";
	else $img="./bilder/kontakt/nopic.png";

	if(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.gif"))$img_hund="./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.gif";
	elseif(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.png"))$img_hund="./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.png";
	elseif(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.jpg"))$img_hund="./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.jpg";
	elseif(is_file("./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.jpeg"))$img_hund="./bilder/kontakt/$mandant[mandant_id]/$row[customer_dogid]_hund.jpeg";
	else $img_hund="./bilder/kontakt/nopic_hund.png";

	$row['img_hund'] = $img_hund;
	$row['img'] = $img;
	$kontakts[$i] = $row;
	$smarty->assign("kontakts", $kontakts);
	$i++;
}

$i=0;
$result = $db->query("SELECT * FROM rhs_customer_dogs WHERE mandant=$mandant[mandant_id]");
while ($row = $db->fetch_array($result)){
	$row['exam'] = $exam[$row['exam']];
	$row['exam_tr'] = $exam[$row['exam_tr']];
	$row['gender'] = $gender[$row['gender']];
	$row['dob'] = date("d.m.Y", $row['dob']);
	$dogs[$i] = $row;
	$smarty->assign("dogs", $dogs);
	$i++;
}

$smarty->assign("menu_template", $menu_template);
$smarty->display("kontakte.tpl.php");
?>
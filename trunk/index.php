<?
/**
* Index Page for static content
*
*
* Filename: index.php
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
$filename="download.php";

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

if(isset($_GET['dateiname']) OR $_GET['dateiname'] != "")$smarty->assign("get_filename", $_GET['dateiname']);

if($template=="home"){
	$parse = &new parse(0, 75, 1, '', 1);

	$data_result = $db->query("SELECT * FROM rhs_mandant");
	while ($row = $db->fetch_array($data_result)){
		$index_mandant_data[$row['mandant_id']]=$row['mandant_name'];
	}

	if($_GET['site']!="portal") $where = "WHERE tb.mandant=".$mandant['mandant_id'];
	$data_result = $db->query("SELECT tb.*, u.* FROM rhs_portal tb LEFT JOIN rhs_customer u ON (tb.create_userid=u.customer_id) $where ORDER BY tb.create_date DESC LIMIT 10");
	$i=0;
	while ($row = $db->fetch_array($data_result)) {
		$row['text'] = $parse->doparse($row['text'], 1, 0, 1, 1);
		$row['mandant_name'] = $index_mandant_data[$row['mandant']];
		$portal[$i] = $row;
		$i++;
	}
	$smarty->assign("portal", $portal);
	$smarty->display("index_portal.tpl.php");
	exit;
}elseif($template=="project"){
	$parse = &new parse(0, 75, 1, '', 1);

	$data_result = $db->query("SELECT tb.*, u.* FROM rhs_projects tb LEFT JOIN rhs_customer u ON (tb.create_userid=u.customer_id) WHERE tb.mandant=".$mandant['mandant_id']." ORDER BY tb.create_date DESC");
	$i=0;
	while ($row = $db->fetch_array($data_result)) {
		$row['text'] = $parse->doparse($row['text'], 1, 0, 1, 1);
		$portal[$i] = $row;
		$smarty->assign("portal", $portal);
		$i++;
	}

	$smarty->display("index_project.tpl.php");
	exit;
}elseif($template=="partner"){
	$parse = &new parse(0, 75, 1, '', 1);

	$data_result = $db->query("SELECT tb.*, u.* FROM rhs_sponsors tb LEFT JOIN rhs_customer u ON (tb.create_userid=u.customer_id) WHERE tb.mandant=".$mandant['mandant_id']." ORDER BY tb.create_date DESC");
	$i=0;
	while ($row = $db->fetch_array($data_result)) {
		$row['text'] = $parse->doparse($row['text'], 1, 0, 1, 1);
		$portal[$i] = $row;
		$smarty->assign("portal", $portal);
		$i++;
	}

	$smarty->display("index_partner.tpl.php");
	exit;
}elseif($template=="start"){

	$smarty->display("index_start.tpl.php");
	exit;
}else{
	$smarty->display("index_content_".$template.".tpl.php");
	exit;
}
?>
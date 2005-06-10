<?php
/**
* 
* Settings save class
*
* Filename: classes.settings.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package Classes
* @link http://rescue-dogs.de
* @copyright 2005 BRK Rettungshundestaffel Ansbach
*
* Subversion CVS system settings of current developments
*   $LastChangedDate$
*   $LastChangedRevision$
*   $LastChangedBy$
*   $HeadURL$
*
*/
if(INADMIN_CODE != 1) die("Hacking attempt");

class settings {
	var $classpath = "";

	function settings($classpath) {
		$this->classpath=$classpath;	
	}
 
	function write() {
		global $link_id, $shopconfig;
		
		$fp=fopen($this->classpath."/settings.inc.php","w+");
		fwrite($fp, "<?php\n// automatic generated setting file\n// do not change\n\n");
		$result = $db->query("SELECT varname, value FROM rhs_setting");
		while($row = $db->fetch_array($result)){
			if(is_double($row['value']) OR is_integer($row['value']))fwrite($fp, "\$shopconfig['".$row['varname']."'] = ".str_replace("\"","\\\"",$row['value']).";\n");
			else fwrite($fp, "\$shopconfig['".$row['varname']."'] = \"".str_replace("\"","\\\"",$row['value'])."\";\n");
		}
		
		
		/*
		* Schreibt die Steuerwerte in die Einstellungen
		*/
		$resulttax = $db->query("SELECT * FROM rhs_tax");
		while($rowtax = $db->fetch_array($resulttax)){
			fwrite($fp, "\$taxarray['".$rowtax[id]."']['rate']=".$rowtax['taxrate'].";\n");
			fwrite($fp, "\$taxarray['".$rowtax[id]."']['des']=\"".$rowtax['description']."\";\n");
		}
		
		/*
		* Schreibt die Abschlagswerte in die Einstellungen
		*/
		$resulttax = $db->query("SELECT * FROM rhs_threshold ORDER By value DESC");
		$idc=0;
		while($rowtresh = $db->fetch_array($resulttax)){
			fwrite($fp, "\$thresholdarray['".$idc."']['value']=".$rowtresh['value'].";\n");
			fwrite($fp, "\$thresholdarray['".$idc."']['disagio']=\"".$rowtresh['disagio']."\";\n");
			$idc++;
		}
		
		/*
		* Schreibt die Versandkosten in die Einstellungen
		*/
		$resulttax = $db->query("SELECT * FROM rhs_shipping");
		$idc=0;
		while($rowvers = $db->fetch_array($resulttax)){
			fwrite($fp, "\$versandarray['".$idc."']['price']=".$rowvers['price'].";\n");
			fwrite($fp, "\$versandarray['".$idc."']['weight']=\"".$rowvers['weight']."\";\n");
			$idc++;
		}
		
		/*
		* Schreibt die Zahlungsweisen in die Einstellungen
		*/
		$result = $db->query("SELECT * FROM rhs_payment ORDER BY name");
		while($row = $db->fetch_array($result)){
			fwrite($fp, "\$payoptarray['".$row[id]."']=\"".$row['name']."\";\n");
		}
		fwrite($fp, "?>");
		fclose($fp);	
	}
}
?>

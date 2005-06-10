<?php
/**
* 
*   WoltLab Burning Board 2 is NOT free software. You may not redistribute this package or any of it's files
*
* Filename: classes.parse.php
*
* @author Burntime
* @version 1.1
* @access public
* @package Classes
* @link http://www.woltlab.de/
* @copyright (c) 2001-2004 WoltLab GmbH
*
* Subversion CVS system settings of current developments
*   $LastChangedDate$
*   $LastChangedRevision$
*   $LastChangedBy$
*   $HeadURL$
*
*/

class parsecode extends parse {
	function parsecode($usecode = 1) {
		$this->usecode = $usecode;
		if ($usecode == 1) {
			$this->generateHash();
		}
	}
	function doparse($post) {
		// cache code
		if ($this->usecode == 1) {
			$this->tempsave['php'] = array();
			$this->tempsave['code'] = array();
			$this->index['php'] = -1;
			$this->index['code'] = -1;
			$post = preg_replace("/(\[(php|code)\])(.*)(\[\/\\2\])/seiU", "\$this->cachecode('\\3','\\2')", $post);
		}
		return $post;
	}
	function replacecode($post) {
		if ($this->usecode == 1 && ($this->index['php'] != -1 || $this->index['code'] != -1)) {
			reset($this->tempsave);
			while (list($mode, $val) = each($this->tempsave)) {
				while (list($varnr, $code) = each($val)) $post = str_replace("{".$this->hash."_".$mode."_".$varnr."}", "[".$mode."]".str_replace("\\\"", "\"", $code)."[/".$mode."]", $post);
			}
		}
		return $post;
	}
}
?>

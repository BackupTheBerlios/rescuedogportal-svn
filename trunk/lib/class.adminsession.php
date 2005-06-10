<?php
/**
* 
* Admin Sessions class
*
* Filename: classes.headers.php
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

class adminsession {

    /**
     * Sets the variables for all session data
     * @public
     * @type array
     */
	var $session_data = array();

    /**
     * Sets the variables for all session user data
     * @public
     * @type string
     */
	 var $session_user_data = array();

    /**
     * Sets the variables for all session mandant data
     * @public
     * @type string
     */
	 var $session_mandant_data = array();
	
	
	
	/**
     * Updates the actual session.  Returns void.
     * @public
     * @returns void
     */
	function update($hash="", $ip, $agent, $shopconfig_adminsession_timeout = 3600) {
		global $db, $smarty;
		if($hash!="" && strlen($hash)==32) {		
			/*
			* check session data of existing session id	
			*/
			if($shopconfig['disableverify']!=0){
				$result = $db->query("SELECT * FROM rhs_adminsessions WHERE hash = '".addslashes($hash)."' AND lastactivity >= '".(time()-$shopconfig_adminsession_timeout)."'");
				$session = $db->fetch_array($result);
			}else{
				$result = $db->query("SELECT * FROM rhs_adminsessions WHERE hash = '".addslashes($hash)."' AND ipaddress = '".addslashes($ip)."' AND useragent = '".addslashes($agent)."' AND lastactivity >= '".(time()-$shopconfig_adminsession_timeout)."'");
				$session = $db->fetch_array($result);
			}
			/*
			* if a valid session exists create session userdata, else delet sessions and logoff
			*/
			if($session['hash'] and $db->num_rows()==1) {				
				$db->query("UPDATE rhs_adminsessions SET lastactivity='".time()."' WHERE hash = '".$session['hash']."'");
				$this->session_data = $session;	
			}elseif($db->num_rows()!=1){
				$db->query("DELETE FROM rhs_adminsessions WHERE hash = '".$session['hash']."'");
				$smarty->assign("error", 1);
				$smarty->display("a_login.tpl.php");
				exit();
			}else{
				$smarty->assign("error", 1);
				$smarty->display("a_login.tpl.php");
				exit();
			}
		}else {
			$smarty->assign("error", 1);
			$smarty->display("a_login.tpl.php");
			exit();	
		}			
	}	

	/**
     * Creates a new session.  Returns void.
     * @public
     * @returns void
     */	
	function create($userid, $ip, $agent) {
	global $db;
		$this->session_data['hash'] = md5(uniqid(microtime()));
		$this->session_data['userid'] = $userid;
		$this->session_data['ipaddress'] = addslashes($ip);
		$this->session_data['useragent'] = addslashes($agent);
		$this->session_data['starttime'] = time();
		$this->session_data['lastactivity'] = time();
		$this->session_data['mandant'] = $this->session_user_data['customer_mandant'];
		$this->session_data['simple_menu'] = 0;
		
		$db->query("INSERT INTO rhs_adminsessions (hash, userid, ipaddress, useragent, starttime, lastactivity, mandant, simple_menu) VALUES ('".$this->session_data['hash']."','".$this->session_data['userid']."','".$this->session_data['ipaddress']."','".$this->session_data['useragent']."','".$this->session_data['starttime']."','".$this->session_data['lastactivity'] ."', ".$this->session_data['mandant'].", ".$this->session_data['simple_menu'].");");
		
		return $this->session_data;
	}
	
	
	/**
     * checks the user settings for the login.  Returns void.
     * @public
     * @returns void
     */
	function checkUser($name, $password){
	global $db;
		$result = $db->query("SELECT c.*, cag.* FROM rhs_customer c LEFT JOIN rhs_customer_admin_groups cag ON (c.customer_admin_groupsid=cag.admin_id) WHERE customer_admin_name = '".addslashes(htmlspecialchars($name))."' AND customer_admin_password = '".cryptmy_password($password)."';");
		$row = $db->fetch_array($result);		
		$this->session_user_data = $row; 
	}


	/**
     * Sets the sessions data array.  Returns void.
     * @public
     * @returns void
     */
	function getSessionUserData(){
	global $db;				
		$this->session_user_data = array();
		$result = $db->query("SELECT c.*, cag.* FROM rhs_customer c LEFT JOIN rhs_customer_admin_groups cag ON (c.customer_admin_groupsid=cag.admin_id) WHERE customer_id = '".$this->session_data['userid']."';");
		$row = $db->fetch_array($result);		
		$this->session_user_data = $row; 
	}

	/**
     * Returns the option list of all mandants.  Returns string.
     * @public
     * @returns string
     */	
	function getSelectionMandantData(){
	global $db;
	
		$result = $db->query("SELECT * FROM rhs_mandant ORDER BY mandant_name");
		while($row = $db->fetch_array($result)) $optionlist .= $this->makeoption($row['mandant_id'], $row['mandant_name'], $this->session_mandant_data['mandant_id']);
		return $optionlist;
	}
	

	/**
     * Returns the <option> tags for the mandant selection box.  Returns string.
     * @public
     * @returns string
     */	
	function makeoption($value, $text, $selected_value="", $selected=1, $style="") {
		$option_selected="";
		if($selected==1) {
			if(is_array($selected_value)) {
				if(in_array($value, $selected_value)) $option_selected=" selected";
			}elseif($selected_value==$value){
				$option_selected=" selected";
			}
		}
		return "<option value=\"$value\"".$option_selected.">$text</option>";
	}


	/**
     * Sets the sessions mandant data array.  Returns void.
     * @public
     * @returns void
     */	
	function getSessionMandantData($simplemenu, $getdata = 0, $ip, $agent, $shopconfig_adminsession_timeout = 3600){
	global $db, $smarty;				
		
		if($getdata != 0 AND $this->session_data['mandant'] != $getdata){
			$db->query("UPDATE rhs_adminsessions SET mandant=$getdata, lastactivity='".time()."' WHERE hash = '".$this->session_data['hash']."'");
			$this->update($this->session_data['hash'], $ip, $agent, $shopconfig_adminsession_timeout);
		}

		if($simplemenu != "" AND $this->session_data['simple_menu'] != $simplemenu){
			$db->query("UPDATE rhs_adminsessions SET simple_menu=$simplemenu, lastactivity='".time()."' WHERE hash = '".$this->session_data['hash']."'");
			$this->update($this->session_data['hash'], $ip, $agent, $shopconfig_adminsession_timeout);
		}
		
		$result = $db->query("SELECT * FROM rhs_mandant WHERE mandant_id = ".$this->session_data['mandant'].";");
		$row = $db->fetch_array($result);
		if($db->num_rows()==0) {				
			$smarty->assign("error", 1);
			$smarty->display("a_login.tpl.php");
			exit();	
		}				
		$this->session_mandant_data = $row; 
	}	
	

	/**
     * Checks the user settings if a user is admin.  Returns void.
     * @public
     * @returns void
     */	
	function NoEntryForUser() {
	global $smarty;
		if($this->session_user_data['admin_admin']!=1) {
			$smarty->assign("l_username", $_POST['l_username']);
			$smarty->assign("error", 1);
			$smarty->display("a_login.tpl.php");
			exit();
		}
	}
}
?>
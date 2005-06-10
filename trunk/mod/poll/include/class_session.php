<?php
/**
* Advanced Poll 2.0 (PHP/MySQL)
*
*
* Filename: *.php
*
* @author Chi Kien Uong
* @version 1.1
* @access public
* @package Poll
* @link http://www.proxy2.de
* @copyright http://www.proxy2.de
*
*/
class poll_session {

    var $expire = 7200;
    var $table = array();
    var $db;

    function poll_session() {
        global $POLLTBL;
        $this->table = $POLLTBL;
    }

    function set_session_time($expire_time='') {
        if ($expire_time>0) {
            $this->expire = $expire_time;
        }
    }

    function is_valid_session($session,$user_id) {
        $this->db->query("SELECT session, last_visit from ".$this->table['poll_user']." WHERE session='$session' and user_id='$user_id'");
        $row = $this->db->fetch_array($this->db->result);
        if ($row) {            
            return ($this->expire + $row['last_visit'] > time()) ? $row["session"] : false;
        } else {
            return false;
        }
    }

    function is_valid_user($user_id) {
        $this->db->query("SELECT username FROM ".$this->table['poll_user']." WHERE user_id='$user_id'");
        $this->db->fetch_array($this->db->result);
        return ($this->db->record) ? true : false;
    }

    function generate_new_session_id($user_id) {
        srand((double)microtime()*1000000);
        $session = cryptmy_password (uniqid (rand()));
        $timestamp = time();
        $this->db->query("UPDATE ".$this->table['poll_user']." SET session='$session', last_visit='$timestamp' WHERE user_id='$user_id'");
        return $session;
    }

    function check_pass($username,$password) {
        if (get_magic_quotes_gpc()) {            
            $password = stripslashes($password);
        } else {
            $username = addslashes($username);
        }
        $password = cryptmy_password($password);  
        $this->db->query("SELECT user_id FROM ".$this->table['poll_user']." WHERE username='$username' and userpass='$password'");
        $this->db->fetch_array($this->db->result);
        return ($this->db->record) ? $this->db->record["user_id"] : false;
    }

    function check_session_id() {
        global $username, $password, $session, $uid, $poll_admin_username, $poll_admin_password;
		
		if($_GET['sid']!=""){
			$this->db->query("SELECT * FROM rhs_adminsessions WHERE hash = '".addslashes($_GET['sid'])."' AND lastactivity >= '".(time()-3600)."'");
			$session = $this->db->fetch_array($this->db->result);

			if($session['hash']) {				
				$username = $poll_admin_username;
				$password = $poll_admin_password;
				$enter=1;
			}
		}
        if (isset($session) && isset($uid)) {
            return ($this->is_valid_session($session,$uid)) ? array("session" => "$session", "uid" => "$uid") : false;
        } elseif (isset($username) && isset($password)) {
            $ID = $this->check_pass($username,$password);
            if ($ID) {
                $session = $this->generate_new_session_id($ID);
                return array("session" => "$session", "uid" => "$ID");
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

}

?>
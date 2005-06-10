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
class pollcomment extends poll {

    var $poll_comment_html = array();

    function pollcomment() {
        $this->poll();
    }

    function show_form($poll_id) {
        if (!isset($this->poll_comment_html[$poll_id]) || !isset($this->poll_comment_html[$poll_id][$this->template_set])) {
            $row = $this->db->fetch_array($this->db->query("SELECT question FROM ".$this->tbl['poll_index']." WHERE (poll_id = '$poll_id')"));
            $question = htmlspecialchars($row['question']);
            eval("\$result_html = \"".$this->get_poll_tpl("comment")."\";");
            $this->poll_comment_html[$poll_id][$this->template_set] = $result_html;
        }
        return $this->poll_comment_html[$poll_id][$this->template_set];
    }

    function format_string($strg) {
        if (!get_magic_quotes_gpc()) {
            $strg = addslashes($strg);
        }
        $strg = trim($strg);
        $strg = htmlspecialchars($strg);
        return $strg;
    }

    function add_comment($poll_id) {
        global $name, $email, $message;
        $name = $this->format_string($name);
        if (!$name) {
            $name = "anonymous";
        }
        $email = $this->format_string($email);
        $message = $this->format_string($message);
        if (!eregi("^[_a-z0-9-]+(\\.[_a-z0-9-]+)*@([0-9a-z][0-9a-z-]*[0-9a-z]\\.)+[a-z]{2,6}$", $email) ) {
            $email = '';
        }
        $this_time = time();
        $host = gethostbyaddr($this->ip);
        $agent = @getenv("HTTP_USER_AGENT");
        $this->db->query("INSERT INTO ".$this->tbl['poll_comment']." (poll_id,time,host,browser,name,email,message) VALUES ('$poll_id','$this_time','$host','$agent','$name','$email','$message')");
        return ($this->db->result) ? true : false;
    }

    function print_message($strg,$autoclose=0) {
        $msg ='';
        if ($autoclose==1) {
            $msg .= "<script language=\"JavaScript\">
            setTimeout(\"closeWin()\",2000);
            function closeWin() {
                self.close();
            }
            </script>";
        }
        $msg .= "<font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"1\">$strg</font>";
        return $msg;
    }

    function is_comment_allowed($poll_id) {
        if ($poll_id>0) {
            $this->db->fetch_array($this->db->query("SELECT comments FROM ".$this->tbl['poll_index']." WHERE poll_id=$poll_id AND status<2"));
            return ($this->db->record['comments']==1) ? true : false;
        } else {
            return false;
        }
    }
    
    function comment_process($poll_id) {
        global $message, $action;
        $message = (isset($message)) ? trim($message) : '';
        if (!isset($action)) {
            $action='';
        }
        if (!isset($poll_id)) {
            return $this->print_message("Poll ID <b>".$poll_id."</b> does not exist or is disabled!");
        }
        if ($action == "add" && $this->is_comment_allowed($poll_id)) {
            if (empty($message)) {
                return $this->print_message("You forgot to fill in the message field!<br><a href=\"javascript:history.back()\">Go back</a>");
            } else {
                $this->add_comment($poll_id);
                return $this->print_message("Your message has been sent!",1);
            }
        } else {
            return $this->show_form($poll_id);
        }
    }

}

?>
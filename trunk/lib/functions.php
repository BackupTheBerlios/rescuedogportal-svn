<?php
/**
* 
* Configuration File
* 
* Filename: functions.php
*
* @author Markus Wilhelm <markus.wilhelm@rescue-dogs.de>
* @version 1.1
* @access public
* @package includes
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


/**
 * dos2unix.
 *
 * @param string $text
 */
function dos2unix($text) {
	if ($text != '') {
		$text = preg_replace("#(\r\n)|(\r)#", "\n", $text);
	}
	return $text;
}




/**
* htmlconverter function
* @param string text
*
* @return string encoded text
*/
function htmlconverter($text) {
	global $phpversion;
	$charsets = array('ISO-8859-1', 'ISO-8859-15', 'UTF-8', 'CP1252', 'WINDOWS-1252', 'KOI8-R', 'BIG5', 'GB2312', 'BIG5-HKSCS', 'SHIFT_JIS', 'EUC-JP');
	if (version_compare($phpversion, '4.3.0') >= 0 && in_array(strtoupper(ENCODING), $charsets)) return @htmlentities($text, ENT_COMPAT, ENCODING);
	elseif (in_array(strtoupper(ENCODING), array('ISO-8859-1', 'WINDOWS-1252'))) return htmlentities($text);
	else return htmlspecialchars($text);

}

/**
* strip crap from posts (i.e. sessionhash
*
* @param string post
* 
* @return string post
*/
function stripcrap($post) {
	if ($post) {
		$post = preg_replace("/(\?|\&){1}sid=[a-z0-9]{32}/", "\\1sid=", $post);	
		$post = preg_replace("/(&#)(\d+)(;)/e", "chr(intval('\\2'))", $post);
		$post = dos2unix($post);
	}
	return $post;
}



/**
 * Creates timestamp.
 *
 * @param array $thistime string or array with year, month, day, hour, min, sec fields
 */
function makemytime($thistime){
	if(!is_array($thistime)){
		if(strlen($thistime<=10))$thistime.=" 00:00:00";
		$lastdate['year']=substr($thistime, 6, 4);
		$lastdate['month']=substr($thistime, 3, 2);
		$lastdate['day']=substr($thistime, 0, 2);
		$lastdate['hour']=substr($thistime, 11, 2);
		$lastdate['min']=substr($thistime, 14, 2);
		$lastdate['sec']=substr($thistime, 17, 2);
	}else{
		$lastdate=$thistime;
	}
	$lastdate1time=mktime($lastdate['hour'], $lastdate['min'], $lastdate['sec'], $lastdate['month'], $lastdate['day'], $lastdate['year']);	
	return $lastdate1time;
}

/**
 * Crypt Passwords.
 *
 * @param string $mypw for new password
 */				
function cryptmy_password($mypw){
	return crypt($mypw, "fo");
}

/**
 * wochentag
 *
 * @datumsWert string 
 */	
function wochentag($datumsWert){

	switch (date('l',$datumsWert)) {
		case "Monday":
			$tagName = "Montag";
			break;
		case "Tuesday":
			$tagName = "Dienstag";
			break;
		case "Wednesday":
			$tagName = "Mittwoch";
			break;
		case "Thursday":
			$tagName = "Donnerstag";
			break;
		case "Friday":
			$tagName = "Freitag";
			break;
		case "Saturday":
			$tagName = "Samstag";
			break;
		case "Sunday":
			$tagName = "Sonntag";
			break;
		default:
			$tagName = date('l',$datumsWert);     
	}
	return $tagName;
}

/**
 * format_post
 *
 * @text string 
 * @nosmilies string 
 * @com string 
 */	
function format_post($text, $nosmilies = 0, $com = 0) {
	global $data, $smilie;

	if ($data["html"] == 0 and $com == 0) {
		$text = htmlspecialchars($text);
	}

	$text = nl2br($text);

	if ($data["smilies"] == 1 or $com == 1) {
		if ($nosmilies == 0) {
			if (isset($smilie) and is_array($smilie)) {
				$text = str_replace(array_keys($smilie), array_values($smilie), $text);
			}
		}
	}

	if ($data["apbcode"] == 1 or $com == 1) {
		$text = eregi_replace("([ \r\n])http://([^ ,\r\n]*)", "\\1[url]http://\\2[/url]", $text);
		$text = eregi_replace("([ \r\n])https://([^ ,\r\n]*)", "\\1[url]https://\\2[/url]", $text);
		$text = eregi_replace("([ \r\n])ftp://([^ ,\r\n]*)", "\\1[url]ftp://\\2[/url]", $text);
		$text = eregi_replace("([ \r\n])www\\.([^ ,\r\n]*)", "\\1[url]http://www.\\2[/url]", $text);
		$text = eregi_replace("^http://([^ ,\r\n]*)", "[url]http://\\1[/url]", $text);
		$text = eregi_replace("^https://([^ ,\r\n]*)", "[url]https://\\1[/url]", $text);
		$text = eregi_replace("^ftp://([^ ,\r\n]*)", "[url]ftp://\\1[/url]", $text);
		$text = eregi_replace("^www\\.([^ ,\r\n]*)", "[url]http://www.\\1[/url]", $text);
		$text = eregi_replace("(\[size=)([^]]*)(])", "<font size=\"\\2\">", $text);
		$text = str_replace("[/size]", "</font>", $text);
		$text = eregi_replace("(\[color=)([^]]*)(])", "<font color=\"\\2\">", $text);
		$text = str_replace("[/color]", "</font>", $text);
		$text = str_replace("[center]", "<center>", $text);
		$text = str_replace("[/center]", "</center>", $text);
		$text = str_replace("[b]", "<b>", $text);
		$text = str_replace("[/b]", "</b>", $text);
		$text = str_replace("[i]", "<i>", $text);
		$text = str_replace("[/i]", "</i>", $text);
		$text = str_replace("[u]", "<u>", $text);
		$text = str_replace("[/u]", "</u>", $text);
		$text = eregi_replace("\\[url\\]www.([^\\[]*)\\[/url\\]", "<a href=\"http://www.\\1\" target=\"_blank\">\\1</a>", $text);
		$text = eregi_replace("\\[url\\]([^\\[]*)\\[/url\\]", "<a href=\"\\1\" target=\"_blank\">\\1</a>", $text);
		$text = str_replace("[url=\\&quot;", "[url=\"", $text);
		$text = str_replace("\&quot;]", "\"]", $text);
		$text = eregi_replace("\\[url=\"([^\"]*)\"\\]([^\\[]*)\\[\\/url\\]", "<a href=\"\\1\" target=\"_blank\">\\2</a>", $text);
		$text = eregi_replace("\\[url=([^\"]*)\\]([^\\[]*)\\[\\/url\\]", "<a href=\"\\1\" target=\"_blank\">\\2</a>", $text);
		$text = eregi_replace("\\[img\\]([^\"\\[]*)\\[/img\\]", "<img src=\"\\1\" border=\"0\">", $text);
		$text = str_replace("[list]", "<ul type=\"square\">", $text);
		$text = str_replace("[/list]", "</ul>", $text);
		$text = str_replace("[list=1]", "<ol type=\"1\">", $text);
		$text = str_replace("[list=a]", "<ol type=\"A\">", $text);
		$text = str_replace("[list=A]", "<ol type=\"A\">", $text);
		$text = str_replace("[/list=1]", "</ol>", $text);
		$text = str_replace("[/list=a]", "</ol>", $text);
		$text = str_replace("[/list=A]", "</ol>", $text);
		$text = str_replace("[*]", "<li>", $text);
		$text = str_replace("[quote]", "<blockquote>Zitat:<hr>", $text);
		$text = str_replace("[/quote]", "<hr></blockquote>", $text);
		$text = str_replace("[code]", "<blockquote><pre>Code:<hr>", $text);
		$text = str_replace("[/code]", "<hr></pre></blockquote>", $text);
	}

	return badwords($text);
}

/**
 * badwords
 *
 * @text string 
 */	
function badwords($text) {
	global $data;
	$ctcensorword = explode(",", $data["badwords"]);
	while (list($key,$val) = each($ctcensorword)) {
		if ($val != "") {
			if (substr($val, 0, 1) == "{") {
				$val = substr($val,1,-1);
				$text = trim(eregi_replace("([^A-Za-z])".$val."([^A-Za-z])","\\1".chars("*",strlen($val))."\\2"," $text "));
			} else {
				$text = trim(eregi_replace($val,chars("*",strlen($val))," $text "));
			}
		}
	}
	return $text;
}

/**
 * get_vars_old
 * 
 */
function get_vars_old() {
 global $HTTP_COOKIE_VARS, $HTTP_POST_FILES, $HTTP_POST_VARS, $HTTP_GET_VARS, $HTTP_SERVER_VARS, $_REQUEST, $_COOKIE, $_POST, $_GET, $_SERVER, $_FILES;
  
 if(is_array($HTTP_COOKIE_VARS)) {
  while(list($key,$val)=each($HTTP_COOKIE_VARS)) {
   $_REQUEST[$key]=$val;
   $_COOKIE[$key]=$val;
  }
 }

 if(is_array($HTTP_POST_VARS)) {
  while(list($key,$val)=each($HTTP_POST_VARS)) {
   $_REQUEST[$key]=$val;
   $_POST[$key]=$val;
  }
 }
  
 if(is_array($HTTP_GET_VARS)) {
  while(list($key,$val)=each($HTTP_GET_VARS)) {
   $_REQUEST[$key]=$val;
   $_GET[$key]=$val;
  }
 }

 if(is_array($HTTP_POST_FILES)) while(list($key,$val)=each($HTTP_POST_FILES)) $_FILES[$key]=$val;
 if(is_array($HTTP_SERVER_VARS)) while(list($key,$val)=each($HTTP_SERVER_VARS)) $_SERVER[$key]=$val;
}


/**
 * convert_url
 *
 * @url string 
 * @hash string 
 * @nosessionhash string 
 */	
function convert_url($url,$hash,$nosessionhash=0) {
 if($nosessionhash==0) $url=preg_replace("/sid=[0-9a-z]*/","sid=$hash",$url);
 else $url=preg_replace("/sid=[0-9a-z]*/","sid=",$url);
 return $url;
} 


/**
 * rehtmlspecialchars
 *
 * @text string 
 */
function rehtmlspecialchars($text) {
 $text = str_replace("&lt;","<",$text);
 $text = str_replace("&gt;",">",$text);	
 $text = str_replace("&quot;","\"",$text);
 $text = str_replace("&amp;","&",$text);
 
 return $text;
}


/**
 * stripslashes_array
 *
 * @text array 
 */
function stripslashes_array(&$array) {
 reset($array);
 while(list($key,$val)=each($array)) {
  if(is_string($val)) $array[$key]=stripslashes($val);
  elseif(is_array($val)) $array[$key]=stripslashes_array($val);
 }
 return $array;
}


/**
 * trim_array
 *
 * @text array 
 */
function trim_array(&$array) {
 reset($array);
 while(list($key,$val)=each($array)) {
  if(is_array($val)) $array[$key]=trim_array($val);
  elseif(is_string($val)) $array[$key]=trim($val);  
 }
 return $array;
}

/**
 * htmlspecialchars_array
 *
 * @text array 
 */
function htmlspecialchars_array(&$array) {
 reset($array);
 while(list($key,$val)=each($array)) {
  if(is_array($val)) $array[$key]=htmlspecialchars_array($val);
  elseif(is_string($val)) $array[$key]=htmlspecialchars($val);  
 }
 return $array;
}


/**
 * ifelse
 *
 * @expression string 
 * @returntrue string
 * @returnfalse string
 */
function ifelse($expression,$returntrue,$returnfalse="") {
 if($expression) return $returntrue;
 else return $returnfalse;
}


/**
 * ifbbcookieelse
 *
 * @name string 
 * @value string
 * @time string
 */
function bbcookie($name, $value, $time) {
 global $cookiepath, $cookiedomain;
 
 if($cookiedomain) setcookie($name, $value, $time, $cookiepath, $cookiedomain);
 elseif($cookiepath) setcookie($name, $value, $time, $cookiepath);
 else setcookie($name, $value, $time);
 
}

/**
 * makehreftag
 *
 * @url string 
 * @name string
 * @target string
 */
function makehreftag($url, $name, $target="") {
 return "<a href=\"".$url."\"".ifelse($target," target=\"".$target."\"").">".$name."</a>";
}

function makeimgtag($path,$alt="") {
 return "<img src=\"$path\" ".ifelse($alt,"alt=\"".$alt."\" ","")."border=0>";
}


/**
 * formatdate
 *
 * @timeformat string 
 * @timestamp string
 * @replacetoday string
 */
function formatdate($timeformat,$timestamp,$replacetoday=0) {
 global $wbbuserdata, $tpl;
 $summertime = date("I")*3600;
 $timestamp+=3600*intval($wbbuserdata['timezoneoffset'])+$summertime;
 if($replacetoday==1) {
  if(gmdate("Ymd",$timestamp)==gmdate("Ymd",time()+3600*intval($wbbuserdata['timezoneoffset'])+$summertime)) {
   eval ("\$today = \"".$tpl->get("today")."\";");
   return $today;
  }
  else $replacetoday=0; 
 }
 if($replacetoday==0) return gmdate($timeformat, $timestamp);
}


/**
 * getone
 *
 * @number string 
 * @one string
 * @two string
 */
function getone($number, $one, $two) {
 if($number % 2) return $one;
 else return $two;
}


/**
 * formatRI
 *
 * @images string 
 */
function formatRI($images) {
 if(!$images) return;
 
 $imgArray = explode(";",$images);
 
 for($i=0;$i<count($imgArray);$i++) 
  $RI.="<img src=\"$imgArray[$i]\">";
 
 return $RI;
}


/**
 * parseURL
 *
 * @message string 
 */
function parseURL($message) {
 $urlsearch[]="/([^]_a-z0-9-=\"'\/])((https?|ftp):\/\/|www\.)([^ \r\n\(\)\^\$!`\"'\|\[\]\{\}<>]*)/si";
 $urlsearch[]="/^((https?|ftp):\/\/|www\.)([^ \r\n\(\)\^\$!`\"'\|\[\]\{\}<>]*)/si";
 $urlreplace[]="\\1[URL]\\2\\4[/URL]";
 $urlreplace[]="[URL]\\1\\3[/URL]";
 $emailsearch[]="/([\s])([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))/si";
 $emailsearch[]="/^([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))/si";
 $emailreplace[]="\\1[EMAIL]\\2[/EMAIL]";
 $emailreplace[]="[EMAIL]\\0[/EMAIL]";
 $message = preg_replace($urlsearch, $urlreplace, $message);
 if (strpos($message, "@")) $message = preg_replace($emailsearch, $emailreplace, $message);
 return $message;
}


/**
 * makeoption
 *
 * @value string 
 * @text string
 * @selected_value string
 * @selected string
 * @style string
 */
function makeoption($value, $text, $selected_value="", $selected=1, $style="") {
 $option_selected="";
 if($selected==1) {
  if(is_array($selected_value)) {
   if(in_array($value,$selected_value)) $option_selected=" selected";
  }
  elseif($selected_value==$value) $option_selected=" selected";
 }
 return "<option value=\"$value\"".ifelse($style!=""," style=\"color:$style\"").$option_selected.">$text</option>";
}


/**
 * create_options_yes_no
 *
 * @value string 
 */
function create_options_yes_no($value) {
	if($value==1) $yes = "selected";
	else $no = "selected";
 return "<option value=\"1\" $yes>Yes</option><option value=\"0\" $no>No</option>";
}

/**
 * create_options_gender
 *
 * @value string 
 */
function create_options_gender($value) {
	if($value==1) $yes = "selected";
	else $no = "selected";
 return "<option value=\"1\" $yes>Rüde</option><option value=\"0\" $no>Hündin</option>";
}


/**
 * getmonth
 *
 * @number string 
 */
function getmonth($number) {
 global $months, $tpl;
 if(!isset($months)) $months = explode("|", $tpl->get("months"));
 return $months[$number-1];
}


/**
 * getday
 *
 * @number string 
 */
function getday($number) {
 global $days, $tpl;
 if(!isset($days)) $days = explode("|", $tpl->get("days"));
 return $days[$number];
}

/**
 * access_error
 *
 */
function access_error() {
	print "Error in der Funktion access_error";
 exit();
}


/**
 * verify_email_news
 *
 * @email string 
 */
function verify_email_news($email) {
 global $db, $n, $multipleemailuse, $ban_email;

 $email=strtolower($email);
 if(!preg_match("/^([_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,}))/si",$email)) return false;
 $ban_email=explode("\n",preg_replace("/\s*\n\s*/","\n",strtolower(trim($ban_email))));
 for($i = 0; $i < count($ban_email); $i++) {
  $ban_email[$i]=trim($ban_email[$i]);
  if(!$ban_email[$i]) continue;
  if(strstr($ban_email[$i], "*")) {
   $ban_email[$i] = str_replace("*",".*",$ban_email[$i]);
   if(preg_match("/$ban_email[$i]/i",$email)) return false;
  }
  elseif($email==$ban_email[$i]) return false;
 }
 return true;
}

/**
 * verify_ip
 *
 * @ip string 
 */
function verify_ip($ip) {
 global $ban_ip;

 if($ban_ip) {
  $ban_ip=explode("\n",preg_replace("/\s*\n\s*/","\n",strtolower(trim($ban_ip))));
  for($i = 0; $i < count($ban_ip); $i++) {
   $ban_ip[$i]=trim($ban_ip[$i]);
   if(!$ban_ip[$i]) continue;
   if(strstr($ban_ip[$i], "*")) {
    $ban_ip[$i] = str_replace("*",".*",$ban_ip[$i]);
    if(preg_match("/$ban_ip[$i]/i",$ip)) access_error();
   }
   elseif($ip==$ban_ip[$i]) access_error();
  }
 }
}


/**
 * password_generate
 *
 * @numbers string 
 * @length string 
 */
function password_generate($numbers=2,$length=8) {
 
 $time = intval(substr(microtime(), 2, 8));
 mt_srand($time);
 
 $numberchain="1234567890";
 
 for($i=0;$i<$numbers;$i++) {
  $random=mt_rand(0,strlen($numberchain)-1);
  $number[intval($numberchain[$random])]=mt_rand(1,9);
  $numberchain=str_replace($random,"",$numberchain);
 } 
  
 $chain = "abcdefghijklmnopqrstuvwxyz";
 for($i=0;$i<$length;$i++) {
  if($number[$i]) $password.=$number[$i];
  else $password.=$chain[mt_rand(0,strlen($chain)-1)];
 }
 return $password;
}


/**
 * code_generate
 *
 */
function code_generate() {
 
 $time = intval(substr(microtime(), 2, 8));
 mt_srand($time);
 
 return mt_rand(1000000,10000000);
} 


/**
 * stopShooting
 *
 * @topic string  
 */
function stopShooting($topic) {
 if($topic==strtoupper($topic)) return ucwords(strtolower($topic));
 return $topic;	
}


/**
 * cutTopic
 *
 * @topic string  
 * @length string
 */
function cutTopic($topic,$length=28) {
 $topic=str_replace("&quot;","\"",$topic);	
 $topic=str_replace("&lt;","<",$topic);	
 $topic=str_replace("&gt;",">",$topic);	
 $topic=str_replace("&amp;","&",$topic);
 
 $topic = trim(substr($topic, 0, $length))."...";
 return htmlspecialchars($topic);	
}


/**
 * htmlspecialchars_wbb
 *
 * @text string
 */
function htmlspecialchars_wbb($text) {
 $text=str_replace("\"","&quot;",$text);	
 $text=str_replace("<","&lt;",$text);	
 $text=str_replace(">","&gt;",$text);	
 
 return $text;
}


/**
 * add2list
 *
 * @list string
 * @add string
 */
function add2list($list,$add) {
 if($list=="") return $add;
 else {
  $listelements=explode(' ',$list);
  if(!in_array($add,$listelements)) {
   $listelements[]=$add;
   return implode(' ',$listelements);
  }
  else return -1;
 }
}


/**
 * removeFromlist
 *
 * @list string
 * @remove string
 */
function removeFromlist($list,$remove) {
 $listelements=explode(' ',$list);
 if(!in_array($remove,$listelements)) return -1;
 else {
  $count=count($listelements);
  for($i=0;$i<$count;$i++) {
   if($listelements[$i]==$remove) {
    if($i==$count-1) array_pop($listelements);
    else $listelements[$i]=array_pop($listelements);
    break;
   }
  }
  return implode(' ',$listelements);
 }
}


/**
 * decode_cookie
 *
 * @textdatastring
 */
function decode_cookie($data) {
 $result=array();
 $data = explode(",",$data);
 for($i=0;$i<count($data)/2;$i++) $result[$data[($i*2)]]=$data[($i*2+1)];	
 return $result; 
}


/**
 * encode_cookie
 *
 * @name string
 * @time string
 * @is_visittime string
 */
function encode_cookie($name,$time=0,$is_visittime=true) {
 global $$name, $wbbuserdata;
 $newdata="";
 while(list($key,$val)=each($$name)) {
  if($is_visittime && $wbbuserdata['lastvisit']>=$val) continue;
  if($newdata) $newdata.=",$key,$val";
  else $newdata="$key,$val";
 }
 bbcookie($name,$newdata,$time);	
}


/**
 * microtime_past
 *
 * @starttime string
 * @endtime string
 */
function microtime_past($starttime,$endtime) {
 $starttime=explode(" ",$starttime);
 $endtime=explode(" ",$endtime);
 return round($endtime[0]-$starttime[0]+$endtime[1]-$starttime[1],3);
}


/**
 * formatFilesize
 *
 * @byte string
 */
function formatFilesize($byte) {
 $string = "Byte";
 if($byte>1024) {
  $byte/=1024;
  $string="KB";
 }
 if($byte>1024) {
  $byte/=1024;
  $string="MB";
 }
 if($byte>1024) {
  $byte/=1024;
  $string="GB";
 }	
	
 if(number_format($byte,0)!=$byte) $byte=number_format($byte,2);
 return $byte." ".$string;	
}


/**
 * getIpAddress
 *
 */
function getIpAddress() {
 $REMOTE_ADDR=getenv("REMOTE_ADDR");
 $HTTP_X_FORWARDED_FOR=getenv("HTTP_X_FORWARDED_FOR");
	
 if($HTTP_X_FORWARDED_FOR!="") {
  if(preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $HTTP_X_FORWARDED_FOR, $ip_match)) {
   $private_ip_list = array("/^0\./", "/^127\.0\.0\.1/", "/^192\.168\..*/", "/^172\.16\..*/", "/^10..*/", "/^224..*/", "/^240..*/");	
   $REMOTE_ADDR = preg_replace($private_ip_list, $REMOTE_ADDR, $ip_match[1]);	
  }	
 }
 
 if(strlen($REMOTE_ADDR)>16) $REMOTE_ADDR=substr($REMOTE_ADDR, 0, 16);
 return $REMOTE_ADDR;
}


/**
 * var2key
 *
 * @varArray string
 * @value string
 */
function var2key($varArray,$value=1) {
 $keyArray=array();
 
 reset($varArray);
 while(list($key,$val)=each($varArray)) $keyArray[$val]=$value;
 
 return $keyArray;
}


/**
 * key2var
 *
 * @keyArray string
 */
function key2var($keyArray) {
 $varArray=array();
 
 reset($keyArray);
 while(list($key,$val)=each($keyArray)) $varArray[]=$key;
 
 return $varArray;
}
?>
<?php
/**
* 
* Options File
* 
* Filename: options.inc.php
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
* <b>****************************************** Menu Templates ***********************************************</b><br />
* Administration.<br />
*
*/
define('MENUE_HANDLING', true);
$menu_template = "large";


/**
* <b>******************************************Netstadt Statistics ***********************************************</b><br />
* Netstadt Statistics.<br />
*
*/
define('NETSTAT_HANDLING', true);
$config_array['show_net_stat'] = true;
$config_array['show_net_stat_url'] = "http://v1.nedstatbasic.net/stats?ABqyJgyWBQfwUrr3QhWXfHqjSf4w";

/**
* <b>****************************************** Overlib Administration ***********************************************</b><br />
* Overlib Administration.<br />
*
*/
define('OVERLIB_HANDLING', true);
$config_array['config_array_nav_borderlight'] 		= "#7E97A5";
$config_array['config_array_nav_borderdark'] 		= "#718694";
$config_array['config_array_nav_bg_row'] 			= "#718694";
$config_array['config_array_nav_bg_row_mouse'] 		= "#7E97A5";
$config_array['config_array_version'] 				= "v1.0.0";
$config_array['config_array_header_bgcolor'] 		= "#c6c6c6";
$config_array['config_array_ol_fgcolor'] 			= "#9AA9B3";
$config_array['config_array_ol_bgcolor'] 			= "#304A5C";
$config_array['config_array_ol_textcolor'] 			= "#000000";
$config_array['config_array_ol_capcolor'] 			= "#FFFFFF";
$config_array['config_array_ol_closecolor'] 		= "#C0C0C0";
$config_array['config_array_ol_textfont'] 			= "Verdana,Arial,Helvetica";
$config_array['config_array_ol_captionfont'] 		= "Verdana,Arial,Helvetica";
$config_array['config_array_ol_closefont'] 			= "Verdana,Arial,Helvetica";
$config_array['config_array_ol_textsize'] 			= "1";
$config_array['config_array_ol_captionsize'] 		= "3";
$config_array['config_array_ol_closesize'] 			= "1";
$config_array['config_array_ol_width'] 				= "250";
$config_array['config_array_ol_border'] 			= "2";
$config_array['config_array_topdownload'] 			= "10";


/**
* <b>****************************************** GLOBAL Administration ***********************************************</b><br />
* GLOBAL Administration.<br />
*
*/
define('GLOBAL_SETTING', true);
$shopconfig['shopconfig_pagetitle']						= "BRK Rettungshundeportal";
$shopconfig['shopconfig_adminurl']						= "http://www.rescue-dogs.de/admin/";
$shopconfig['shopconfig_url']							= "http://www.rescue-dogs.de/";
$shopconfig['shopconfig_adminimgpath']					= "../bilder/kontakt/";
$shopconfig['shopconfig_adminsession_timeout']			= 3600;
$shopconfig['shopconfig_disableverify']					= 1;
$shopconfig['shopconfig_max_attachment_size']			= 40000;
$shopconfig['shopconfig_allowed_attachment_width']  	= 150;
$shopconfig['shopconfig_allowed_attachment_extension'] 	= "jpg
jpeg
png";

$shopconfig['shopconfig_max_upload_size']				= 8000000;
$shopconfig['shopconfig_upload_folder'] 				= "../mod/db/";
$shopconfig['shopconfig_allowed_upload_extension'] 		= "jpg
png
gif
pdf
doc
xls
zip
tar
gz
txt";

$gender[1]												= "Ruede";
$gender[0]												= "Huendin";
$exam[1]												= "Ja";
$exam[0]												= "Nein";


/**
* <b>****************************************** EMail Texts ***********************************************</b><br />
* EMail Texts.<br />
*
*/
define('EMAIL_HANDLING', true);
$shopconfig['shopconfig_email_text'] 					= 'Hi,
das ist eine email von $pagename |$mandant[mandant_name]

Name: $_POST[sender_name]
EMail Adresse: $_POST[sender_email]

Nachricht: 
$_POST[sender_message]
				
Das $pagename | $mandant[mandant_name] Team';

$shopconfig['shopconfig_email_html'] 					= 'Hi,<br>
das ist eine email von $pagename |$mandant[mandant_name]<br>
<br>
Name: $_POST[sender_name]<br>
EMail Adresse: $_POST[sender_email]<br>
<br>
Nachricht: <br>
$_POST[sender_message]<br>
<br><br>		
Das $pagename | $mandant[mandant_name] Team';


/**
* <b>****************************************** EMail Texts Administration ***********************************************</b><br />
* EMail Texts Administration.<br />
*
*/
define('EMAIL_HANDLING2', true);
$shopconfig['shopconfig_mailnewpw_html'] 				= 'Hi,<br>
das ist eine email von $pagename |$mandant[mandant_name], man hat ihr Passwort für die Administration geändert.<br>
<br>
Name: $user[customer_surname]<br>
EMail Adresse: $user[customer_email]<br>
Neues Passwort: $newpassword<br>
<br><br>		
Das $pagename | $mandant[mandant_name] Team';

$shopconfig['shopconfig_mailnewpw_text'] 				= 'Hi,
das ist eine email von $pagename |$mandant[mandant_name], man hat ihr Passwort für die Administration geändert.

Name: $user[customer_surname]
EMail Adresse: $user[customer_email]
Neues Passwort: $newpassword
		
Das $pagename | $mandant[mandant_name] Team';
	

$shopconfig['shopconfig_mailnewpw_html_new'] 			= 'Hi,<br>
das ist eine email von $pagename |$mandant[mandant_name], man hat einen neuen Account für Sie angelegt.<br>
<br>
Name: $user[customer_surname]<br>
EMail Adresse: $user[customer_email]<br>
Passwort: $_POST[passwort]<br>
URL: $shopconfig[adminurl]<br>
<br><br>		
Das $pagename | $mandant[mandant_name] Team';


$shopconfig['shopconfig_mailnewpw_text_new'] 			= 'Hi,
das ist eine email von $pagename |$mandant[mandant_name], man hat einen neuen Account für Sie angelegt.

Name: $user[customer_surname]
EMail Adresse: $user[customer_email]
Passwort: $_POST[passwort]
URL: $shopconfig[adminurl]
		
Das $pagename | $mandant[mandant_name] Team';
		
		
$shopconfig['shopconfig_maillink_text']  				= "Hi,
das ist eine email von $pagename | $mandant[mandant_name]


Nachricht: 
$_POST[thisneuerlink]
				
Das $pagename | $mandant[mandant_name] Team";

$shopconfig['shopconfig_maillink_html']  				= "Hi,<br>
das ist eine email von $pagename | $mandant[mandant_name]<br>
<br><br>
Nachricht: <br>
$_POST[thisneuerlink]<br><br>				
Das $pagename | $mandant[mandant_name] Team";


$shopconfig['shopconfig_mailterm_text']  				= "Hi,
das ist eine email von $pagename | $mandant[mandant_name]


Nachricht: 
$_POST[thisneuerlink]
				
Das $pagename | $mandant[mandant_name] Team";
		

$shopconfig['shopconfig_mailterm_html']  				= "Hi,<br>
das ist eine email von $pagename | $mandant[mandant_name]<br>
<br><br>
Nachricht: <br>
$_POST[thisneuerlink]<br><br>				
Das $pagename | $mandant[mandant_name] Team";

	
		
/**
* <b>****************************************** Guestbook Handling ***********************************************</b><br />
* Guestbook Handling and settings.<br />
*
*/
define('GUESTBOOK_HANDLING', true);		
$data['html']										= 0;
$data['smilies']									= 1;
$data['apbcode']									= 1;
	
$smilie = array(":cool:" => "<img src=\"./bilder/smilies/cool.gif\" border=\"0\">",
			":D" => "<img src=\"./bilder/smilies/biggrin.gif\" border=\"0\">",
			":rolleyes:" => "<img src=\"./bilder/smilies/rolleyes.gif\" border=\"0\">",
			":)" => "<img src=\"./bilder/smilies/smile.gif\" border=\"0\">",
			":o" => "<img src=\"./bilder/smilies/wow.gif\" border=\"0\">",
			":(" => "<img src=\"./bilder/smilies/sad.gif\" border=\"0\">",
			";)" => "<img src=\"./bilder/smilies/wink.gif\" border=\"0\">",
			":angry:" => "<img src=\"./bilder/smilies/angry.gif\" border=\"0\">",
			":confused:" => "<img src=\"./bilder/smilies/confused.gif\" border=\"0\">",
			":bored:" => "<img src=\"./bilder/smilies/redface.gif\" border=\"0\">",
			":p" => "<img src=\"./bilder/smilies/tounge.gif\" border=\"0\">"); 
?>
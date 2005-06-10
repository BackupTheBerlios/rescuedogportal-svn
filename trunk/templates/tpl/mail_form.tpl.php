<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de" xml:lang="de">
<head>
<title>BRK Rettungshundeportal | {$mandant_name}</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="author" content="Markus Wilhelm">
<meta name="Publisher" content="http://www.rescue-dogs.de">
<meta name="copyright" content="Rettungshundestaffel BRK Ansbach">
<meta name="keywords" content="Rettungshund, Rettungshunde, Suchhunde, Personensuche, Vermisstensuche, Hundeforum, Dies und Das, Hundezucht, Hundefutter, Fressnapf, Zooplus">
<meta name="description" content="Portal der DRK Rettungshundestaffeln">
<meta name="page-topic" content="Rettungshundestaffel BRK Ansbach">
<meta name="audience" content="Alle">
<meta name="Publisher" content="http://www.rescue-dogs.de">
<meta name="expires" content="After 10 days">
<meta name="revisit-after" content="2 weeks">
<meta name="content-language" content="de">
<meta name="language" content="de"> 
<meta name="page-type" content="Nicht Gewinnorientiert">
<meta name="robots" content="INDEX,FOLLOW">
<meta name="generator" content="Markus Wilhelm by rescue-dogs.de"> 
<link rel="stylesheet" media="screen" type="text/css" href="./lib/styles/formate.css">
</head>
<body>

<script language="JavaScript" src="./mod/js_wait/wait.js"></script>

<div id='waitDiv' style='position:absolute;left:40%;top:50%;visibility:hidden;text-align:center;'>
     <table cellpadding='6' border='0'>
            <tr>
                <td align='center' >
                    <b>
                       <font face="Tahoma,Helvetica" size="2">
                             Loading...
                       </font>
                    </b>
                    <br>
                    <img src='bilder/mod/wait.gif' alt='bitte warten'>
                    <br>
                    <b>
                       <font face="Tahoma,Helvetica" size="1">Bitte Warten</font>
                    </b>
                </td>
            </tr>
     </table>
</div>

<script language="JavaScript">
	<!--//
	ap_showWaitMessage('waitDiv', 1);sessionhash
	//-->
</script> 

<table border="0" cellspacing="0" cellpadding="1" align="center" bgcolor="#003366"  width="277" height="450">
  <tr align="center">
    <td height="21"> 
      <font color="#FFFFFF" face="Verdana, Arial, Helvetica, sans-serif" size="2"><b>Nachricht an {$firstname} {$surname} schicken</b></font></td>
  </tr>
  <tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="5" align="center" bgcolor="#FFFFFF" width="270" height="411">
        <tr>
          <td height="419"> 
            <form method="post" action="mail.php{$url_sid}&contactid={$contactid}">
              <table border="0" cellspacing="0" cellpadding="2" bgcolor="#FFFFFF" align="center" width="206" height="380">
                <tr>
                  <td class="td1" height="40"><b><font face="Verdana, Arial, Helvetica, sans-serif" size="1">{$messagetext}</font></b></td>
                </tr>
                <tr>
                  <td class="td1"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Name:</font><br>
                    <input type="text" name="sender_name" maxlength="70" class="input" size="40" value="{$sender_name}">
                  </td>
                </tr>
                <tr>
                  <td class="td1"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Email:</font><br>
                    <input type="text" name="sender_email" size="40" maxlength="70" class="input" value="{$sender_email}">
                  </td>
                </tr>
                <tr>
                  <td class="td1" height="200"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Comment(*):</font><br>
                    <font face="MS Sans Serif" size="1">
                    <textarea name="sender_message" cols="40" wrap="VIRTUAL" rows="10" class="textarea">{$sender_message}</textarea>
                    </font>
                  </td>
                </tr>
                <tr valign="top">
                  <td>
                    <input type="submit" value="Abschicken" class="button">
                    <input type="reset" value="L&ouml;schen" class="button">
                    <input type="hidden" name="action" value="add">
                  </td>
                </tr>
              </table>
            </form>
          </td>
		 </tr>
		 <tr>
		  <td>
		  	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
	<tr>
		<td bgcolor="#003D71">
			<table border="0" cellpadding="5" cellspacing="1" width="100%">
				<tr> 
					<td bgcolor="#778899" align="left">
						<font size="1" face="Tahoma"><b>Shopping, chatten, Infos,... und noch vieles mehr</b></font>
					</td>
				</tr>
				<tr> 
					  <td align="center" bgcolor="#c6c6c6" valign="top" width="100%" rowspan="5"> 
                        <font size="1" face="Tahoma"> <A HREF="http://ads01.pipeline.de:8080/RealMedia/ads/click_lx.ads/www.pipeline.de/hdh/homehz/19881/Left/hzo_home/schwasubanner.gif/36322e3134342e3131362e323032" TARGET="_blank"> 
                        <IMG SRC="bilder/hintergrund/schwasubanner.gif" BORDER="0" ALT="Shopping, chatten, Infos,... und noch vieles mehr" WIDTH="468" HEIGHT="60"> 
                        </A> </font> </td>
				</tr>
			</table>
		</td>
	</tr>
</table>
		  </td>
        </tr>
      </table>
    </td>
  </tr>
</table>

<script>
	<!--//
	ap_showWaitMessage('waitDiv', 0);
	//-->
</script> 
</body>
</html>


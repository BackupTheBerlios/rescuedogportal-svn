<?xml version="1.0" encoding="iso-8859-1"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de" xml:lang="de">
<head>
<title>{$shopconfig_pagetitle} | {$mandant_name}</title>
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
<link rel="stylesheet" media="screen" type="text/css" href="./templates/tpl/formate.css">
</head>
<body>
<script language="JavaScript">
	<!--//
	var sessionhash = '{$url_und_sid}';
	var sessionhash2 = '{$url_sid}';
	
	var mandant = {$mandant_id};
	var kontaktname = '{$mandant_name}';
	var TMenu_path_to_files = 'mod/js_menu/';
	var imgpathforme = './';
	//-->
</script> 
<SCRIPT language="JavaScript" src="./lib/templates/tpl/scripts.js"  type="text/javascript"></script>
<script language="JavaScript" src="./mod/js_additional/functions.js"></script>
<script language="JavaScript" src="./mod/js_wait/wait.js"></script>

<script language="JavaScript" src="./mod/js_menu/menu.js"></script>
<script language="JavaScript" src="./mod/js_menu/functions.js"></script>
<script language="JavaScript" src="./mod/js_menu/templateXP.js"></script>
<link rel="stylesheet" href="./mod/js_menu/menuXP.css">

<div id="overDiv" style="position:absolute; visibility:hidden; z-index:1000"></div>
<script language="Javascript">
	var ol_fgcolor = "{$config_array_ol_fgcolor}";
	var ol_bgcolor = "{$config_array_ol_bgcolor}";
	var ol_textcolor = "{$config_array_ol_textcolor}";
	var ol_capcolor = "{$config_array_ol_capcolor}";
	var ol_closecolor = "{$config_array_ol_closecolor}";
	var ol_textfont = "{$config_array_ol_textfont}";
	var ol_captionfont = "{$config_array_ol_captionfont}";
	var ol_closefont = "{$config_array_ol_closefont}";
	var ol_textsize = "{$config_array_ol_textsize}";
	var ol_captionsize = "{$config_array_ol_captionsize}";
	var ol_closesize = "{$config_array_ol_closesize}";
	var ol_width = "{$config_array_ol_width}";
	var ol_border = "{$config_array_ol_border}";
</script>
<script language="JavaScript" src="./mod/js_overlib/overlib.js">
<!-- overLIB (c) Erik Bosrup -->
</script> 

<script language="JavaScript" src="./mod/menu.php">
<!-- Menu -->
</script> 


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
                       <font face="Tahoma,Helvetica" size="1">
                             Bitte Warten
                       </font>
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



{if $menu_template == "small"}

{else}
<table width="100%" cellpadding="0" cellspacing="1" align="center" border="0">
	<tr>
		<td class="mainpage" align="center">
			<table width="100%">
				<tr class="rhslinkhell">
					<td class="rhslinkhell" align="center" colspan="2">
						<script language="JavaScript">
							<!--//
							new menu (MENU_ITEMS_XP, MENU_POS_XP);
							//-->
						</script>
					</td>
				</tr>
			</table>
			<table  width="100%" cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td width="2" valign="top">&nbsp;</td>
					<td width="160" valign="top">
					<!-- ++++++++++++++++ Begin Left Navigation Page			+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
						<table border="0" cellpadding="0" cellspacing="0" width="99%" class="tableoutborder">
							<tr> 
								<td width="100%" align="left">
									<img src="./bilder/hintergrund/bg2.jpg" border="0" alt="">
								</td>
							</tr>
						</table>
						<br />
						<table border="0" cellpadding="5" cellspacing="1" width="100%" class="tableinborder">
							<tr>
								<td class="table_title" align="left">
									<span class="smallfont"><b>Neueste Berichte</b></span>
								</td>
							</tr>
							<tr>
								<td class="tableb" align="left" width="100%" rowspan="5">
									<table>
									{section name=outer loop=$overall_berichte_data}
										<tr><td><span class="smallfont">{$overall_berichte_data[outer].dl_counter_man}) <a href="presse.php?where=1&tempid=berichte&berichtid={$overall_berichte_data[outer].id}{$url_und_sid}">{$overall_berichte_data[outer].titel} vom {$overall_berichte_data[outer].create_date|date_format:"%d.%m.%Y %H:%M:%S"}</a></span></td></tr>
									{sectionelse}
										<tr><td><span class="smallfont">Kein Ergebnis in dieser Selektion.</span></td></tr>
									{/section}
									</table>
								</td>
							</tr>
						</table>
						<br />					
						<table border="0" cellpadding="5" cellspacing="1" width="99%" class="tableinborder">
							<tr> 
								<td class="table_title" width="100%" align="left">
									<span class="smallfont"><b>ZOOplus.de</b></span>
								</td>
							</tr>
							<tr> 
								<td class="tableb" align="left" width="100%" rowspan="5">
								<span class="smallfont">
								<a href="http://partners.webmasterplan.com/click.asp?ref=86418&site=1597&type=b12&bnb=12" target="_blank"><img src="./bilder/hintergrund/zoo.gif" border="0" alt="Zooplus.de - der große Internet-Haustiershop" width="100" height="100"></a>
								</span>
								</td>
							</tr>
						</table>
						<br />
						
						<table border="0" cellpadding="5" cellspacing="1" width="99%" class="tableinborder">
							<tr> 
								<td class="table_title" width="100%" align="left">
									<span class="smallfont"><b>Buchtip</b></span>
								</td>
							</tr>
							<tr> 
								<td class="tableb" align="left" width="100%" rowspan="5">								
									<span class="smallfont">
									<a href="http://www.amazon.de/exec/obidos/ASIN/3929592312/brkrettungshu-21" target="_blank"><img src="./bilder/hintergrund/bloch.jpg" border="0" alt="" width="96" height="140" hspace="3" vspace="3"></a>
									Günther Bloch ... beschäftigt sich seit über 20 Jahren mit Hunden ... und seit 1992 beobachtet er Wölfe und Kojoten in Calgary." <br /> Es handelt sich um ein sehr interessantes Buch, dass ein Muss für Hundeführer ist.
									</span>							
								</td>
							</tr>
						</table>
						<br />
						
						<table border="0" cellpadding="5" cellspacing="1" width="99%" class="tableinborder">
							<tr> 
								<td class="table_title" width="100%" align="left">
									<span class="smallfont"><b>Buchtip</b></span>
								</td>
							</tr>
							<tr> 
								<td class="tableb" align="left" width="100%" rowspan="5">
									<span class="smallfont">
									<a href="http://www.amazon.de/exec/obidos/ASIN/3440076911/brkrettungshu-21" target="_blank">Erste Hilfe für den Hund. "Symptome erkennen! Maßnamen ergreifen! Extra: Gesundheits- Check"</a><br />
									Ein Buch, das in keinem Hundehaushalt fehlen darf.</span>								
								</td>
							</tr>
						</table>
						<br />			
					<!-- ++++++++++++++++ END Left Navigation Page				+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
					</td>
					<td width="100%" valign="top">
					<!-- ++++++++++++++++ Begin Center Page						+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
						<table width="100%">
							<tr>
								<td width="2"></td>
								<td>
{/if}								
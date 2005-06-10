{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>{$mandant_name}</b></span></td>
	</tr>
</table>
<br />
 

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb" align="center"> 
			<img src="./bilder/gruppenbild/{$mandant_id}.jpg" width="567" height="399"><br />
			<p style="alignment:justify; text-align:justify"><span class="normalfont">{$mandant_staffeltext}</span></p>
		</td> 			
	</tr>
</table>
<br />
{if $mandant_show_konto == 1}
<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 
			<span class="normalfont"><b>Wir leben von ihren Spenden!</b></span>
			<br /><br />
			<span class="normalfont">
				Wir arbeiten als ehrenamtliche Mitarbeiter des Bayerischen Roten Kreuzes und finanzieren 
				uns selbst. Unsere Ausr&uuml;stung, den Hund und die Zeit, die wird f&uuml;r die 
				Ausbildung und die Eins&auml;tze investieren geht gr&ouml;&szlig;tenteils auf 
				unsere Kosten. Aus diesem Grund w&uuml;rden wir uns sehr freuen, wenn sie uns 
				durch eine kleine Spende unterst&uuml;tzen w&uuml;rden.<br>&nbsp;
			</span>	
			<table width="100%" border="0" cellpadding="0" cellspacing="0">
				<tr> 
					<td width="20%"><span class="smallfont"><b>Spendenkonto:</b></span></td>
					<td><span class="smallfont">{$mandant_konto_bank}</span></td>
				</tr>
				<tr> 
					<td width="20%"><span class="smallfont"><b>BLZ: </b></span></td>
					<td ><span class="smallfont">{$mandant_konto_blz}</span></td>
				</tr>
				<tr>
					<td width="20%"><span class="smallfont"><b>Kto. Nr.: </b></span></td>
					<td ><span class="smallfont">{$mandant_konto_nr}</span></td>
				</tr>
			</table>
		</td> 			
	</tr>
</table>
<br />
{/if}

{include file="_footer.tpl.php" title=foo}
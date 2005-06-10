{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Termine: {$mandant_name}</b>
		{if $send == "success"}
			<br><b><font color="#003399">Ihr Nachricht wurde erfolgreich gespeichert, vielen Dank.</font></b>
		{/if}
		{if $send == "bad"}
			<br><b><font color="#FF0000">Fehler beim versenden, bitte probieren sie es später noch einmal, vielen Dank.</font></b>
		{/if}
		</span></td>
	</tr>
</table>
<br />

{section name=outer loop=$termineentries}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="table_title" align="left"><span class="normalfont"><b>{$termineentries[outer].titel} am {$termineentries[outer].datefrom|date_format:"%A"}, den {$termineentries[outer].datefrom|date_format:"%d.%m.%Y"} in: {$termineentries[outer].tort}</b></span></td>
		</tr>
			<tr>
			<td class="tableb" align="left">
				<span class="normalfont">
				<table>
					<tr>
						<td><span class="smallfont">{$termineentries[outer].tbeschreibung}</span></td>									
						{if $termineentries[outer].tbild != ""}
							<td><img src="bilder/{$termineentries[outer].tbild}" alt=""></td>
						{/if}
					</tr>
					<tr>
						<td><span class="smallfont"><b>Dauer: </b>{$termineentries[outer].datefrom|date_format:"%A"}, den {$termineentries[outer].datefrom|date_format:"%d.%m.%Y %H:%M:%S"} Uhr bis {$termineentries[outer].dateto|date_format:"%A"}, den {$termineentries[outer].dateto|date_format:"%d.%m.%Y %H:%M:%S"} Uhr</span></td>
					</tr>		
					{if $termineentries[outer].tlink != ""}
						<tr><td><span class="smallfont"><a href="./bilddb.php?titelname={$termineentries[outer].tlink}{$url_und_sid}#showme">Bilder zu diesem Event</a></span></td></tr>
					{/if}
				</table>
				</span>
			</td>
		</tr>
	</table>
	<br />
{sectionelse}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr><td class="table_title" align="left"><span class="normalfont"><b>Keine Termine in dieser Selection vorhanden</b></span></td></tr>
	</table>
	<br />
{/section}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 
			<span class="smallfont">
			<b>Einen fehlenden Termin in die DB eintragen:</b><br />
			<center>
			<form method="post" action="presse.php?tempid=newdate{$url_und_sid}">
				<textarea name="thisneuerlink" style="width:90%" rows="5">Einfach eintragen:
- was für einen Termin ihr habt,
- wann
- wo
- wer
und vergesst nicht den Ansprechpartner</textarea><br />
				<input class="button" type="submit" name="neuerlink" value="Verschicken">
			</form>
			</center>
			</span>
		</td> 			
	</tr>
</table>
<br />

{include file="_footer.tpl.php" title=foo}
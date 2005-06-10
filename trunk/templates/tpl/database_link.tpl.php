{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Das ist unsere Linkdatenbank: {$mandant_name}</b></span></td>
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 
			<span class="smallfont">
			<form method="post" action="database.php?tempid=linkdetail{$url_und_sid}" name="formjahr">
				<b>Kategorien:</b><br />
				<select name="page" onChange="jumplink('{$url_und_sid}', 'linkdetail')">
					{$optionhtml}
				</select>
				<input class="button" type="submit" name="neuerlink" value="Anzeigen">
			</form>
			</center>
			</span>
		</td> 			
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
{section name=outer loop=$linkref}
	<tr>
		<td class="tableb" width="50%">
			<span class="normalfont"><a href="{$linkref[outer].link}" target="_blank"><b>{$linkref[outer].titel}</b></a></span><br />
			<span class="smallfont">{$linkref[outer].beschreibung}</span>
		</td>  		
	</tr>
{sectionelse}
	<tr>
		<td class="table_title" width="45%"><span class="normalfont">Kein Ergebnis in dieser Selektion.</span></td> 			
	</tr>
{/section}
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 
			<span class="smallfont">
			<b>Wenn ihr Links habt, die bei uns fehlen:</b><br />
			<center>
			<form method="post" action="database.php?tempid=newlink">
				<input class="input" type="text" style="width:60%" size="30" name="thisneuerlink" value="">
				<input class="button" type="submit" name="neuerlink" value="Verschicken">
			</form>
			</center>
			</span>
		</td> 			
	</tr>
</table>
<br />


{include file="_footer.tpl.php" title=foo}
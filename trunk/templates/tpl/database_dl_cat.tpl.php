{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Das sind unsere Downloads: {$mandant_name}</b></span></td>
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb">
			<span class="smallfont">
			<form method="post" action="database.php?tempid=dldetail{$url_und_sid}" name="formjahr">
				<b>Kategorien:</b><br />
				<select name="page" onChange="jumplink('{$url_und_sid}', 'dldetail')">
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
			<span class="normalfont"><a href="database.php?tempid=dldetail&ref={$linkref[outer].id}{$url_und_sid}"><b>{$linkref[outer].catname}</b></a> ({$linkref[outer].anzahl} Downloads)</span><br />
		</td>
	</tr>
{sectionelse}
	<tr>
		<td class="table_title" width="45%"><span class="normalfont">Kein Ergebnis in dieser Selektion.</span></td>
	</tr>
{/section}
</table>
<br />
{include file="_footer.tpl.php" title=foo}
{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="5">{$pagename} Löschen</td>
	</tr>
	<tr class="secondrow">
		<td>					
			<b>Sie wollen den Eintrag "{$deletename}" löschen?</b><br>
			<font color="#FF0000" size="+1"><b>!Achtung!</b></font><br>
			<font color="#FF0000"><b>Sie löschen dadurch den Eintrag aus der Datenbank, diese Aktion ist nicht umkehrbar.</b></font>
			<form action="{$filename}{$url_sid}&action={$action}&id={$deleteid}" method="post">
			<input type="submit" value="Ja" name="ja">&nbsp;&nbsp;
			<input type="submit" value="Nein" name="nein">
			<input type="hidden" name="send" value="send">
			</form>
		</td>
	</tr>
</table>
						
{include file="_footer.tpl.php" title=foo}
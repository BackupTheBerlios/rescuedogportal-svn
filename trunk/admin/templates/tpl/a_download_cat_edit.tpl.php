{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
						
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<form action="download_cat.php?action={$action}&id={$id}{$url_und_sid}" method="post">
	<tr class="tblhead">
		<td colspan="2">Admin Download Catagorie</td>
	</tr>
	{if $fehler == 1} 
		<tr><td class="tblsectionhead" colspan="2">Die Benutzerdaten wurden Erfolgreich gespeichert. Wenn die Weiterleitung nicht funktioniert, <a href="{$page_redirect}">bitte hier klicken</a></td></tr>
	{/if}
	{if $fehler == 2} 
		<tr><td class="tblsectionhead" colspan="2" align="left"><font color="#FF0000">Fehler beim Speichern.</font></td></tr>
	{/if}
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Name</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="catname" style="width:100%" value="{$catname}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Reihenfolge</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="catorder" style="width:100%" value="{$catorder}"/></td>
	</tr>
	<tr class="tblsection">
		<td align="center" colspan="2"><input type="hidden" name="send" value="true" /><input type="submit" value="Speichern" /></td>
	</tr>
	</form>
</table>
												
{include file="_footer.tpl.php" title=foo}
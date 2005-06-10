{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
  	
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<form action="download.php?action={$action}&id={$linkid}{$url_und_sid}" method="post" enctype="multipart/form-data">
	<tr class="tblhead">
		<td colspan="2">Admin Linkdatenbank</td>
	</tr>
	{if $fehler == 1} 
	<tr>
		<tr><td class="tblsectionhead" colspan="2">Die Benutzerdaten wurden Erfolgreich gespeichert. Wenn die Weiterleitung nicht funktioniert, <a href="{$page_redirect}">bitte hier klicken</a></td></tr>
	</tr>
	{/if}
	{if $fehler == 2}
	<tr>
		<tr><td class="tblsectionhead" colspan="2"><font color="#FF0000">Fehler beim Speichern.</font></td></tr>
	</tr>
	{/if}
	<tr>
		<td width="20%" class="tblsectionhead" align="left">Name</td>
		<td width="80%" class="tblsection" align="left"><input type="text" name="dlname" style="width:100%" value="{$dlname}"/></td>
	</tr>
	<tr>
		<td class="tblsectionhead" align="left">Beschreibung</td>
		<td class="tblsection" align="left"><input type="text" name="dldescription" style="width:100%" value="{$dldescription}"/></td>
	</tr>
	<tr>
		<td class="tblsectionhead" align="left">Kategorie</td>
		<td class="tblsection" align="left"><select name="p_cat" style="width:100%">{$refoption}</select></td>
	</tr>
	<tr><td class="tblsectionhead" colspan="2">Dateiupload</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">Dateiupload:<br> 
		- Es werden die Formate jpg, png, gif, pdf, doc, xls, zip, tar, gz und txt gestattet.<br>
		- Die Dateien dürfen maximal 4MB haben.<br><br>
		</td>
		<td width="75%"  class="tblsection"><input type="file" name="uploadfile"></td>
	</tr>
	<tr class="tblsection">
		<td align="center" colspan="2"><input type="hidden" name="send" value="true" /><input type="submit" value="Speichern" /></td>
	</tr>
	</form>
</table>
												
{include file="_footer.tpl.php" title=foo}
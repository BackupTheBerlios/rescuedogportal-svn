{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Galery Copyright</td>
	</tr>
	<tr class="tblsectionhead">
		<td colspan="2">
		Albums <font color="#FF0000">Vorsicht: Wenn Du das Script ausführst wird das Copyright in das Bild eingefügt. Diese Funktion is nicht reversiebel.
		Falls ein Browsert Timeout ensteht einfach refreshen oder noch einmal ausführen.</font>
		</td>	</tr>

	{section name=outer loop=$rowfolders}
		<tr class="tblsection">
			<td align="left">
			{$rowfolders[outer].foldername}
			</td>
			<td align="left">
			<a href="galery.php?action=create&folder={$thisfolder}&subfolder={$rowfolders[outer].foldername}{$url_und_sid}">Copyritgh in Bilder einfügen</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>						
			
{include file="_footer.tpl.php" title=foo}
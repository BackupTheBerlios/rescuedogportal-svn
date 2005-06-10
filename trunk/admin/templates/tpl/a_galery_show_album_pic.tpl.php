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
		</td>
	</tr>

	{section name=outer loop=$rowfolders}
		<tr class="tblsection">
			<td align="left">
				<font color="#009933">Picture Copyright eingebunden:</font> <img src="galery.php?action=createpic&folder={$thisfolder}&subfolder={$thissubfolder}&file={$rowfolders[outer].filename}{$url_und_sid}" border="0"> {$rowfolders[outer].filename}				
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>						
			
{include file="_footer.tpl.php" title=foo}
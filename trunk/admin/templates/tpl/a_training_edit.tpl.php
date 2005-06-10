{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

	<form method="post" action="training.php?action={$action}{$url_und_sid}">
	<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
		<tr class="tblhead">
			<td colspan="7">Admin Training</td>
		</tr>
		<tr class="tblsectionhead">
			<td>Tag</td>
			<td>Training</td>
			<td>Trainer</td>
			<td>Ort</td>
			<td>Start</td>
			<td>Ende</td>
		</tr>

		{section name=outer loop=$rowlinks}
			<tr class="tblsection">
				<td align="left">{$rowlinks[outer].tag}</td>
				<td align="left"><select name="training[{$rowlinks[outer].id}]"><option value="-1">please select</option>{$rowlinks[outer].training}</select></td>
				<td align="left"><select name="trainer[{$rowlinks[outer].id}]"><option value="-1">please select</option>{$rowlinks[outer].trainer}</select></td>
				<td align="left"><select name="ort[{$rowlinks[outer].id}]"><option value="-1" selected>please select</option>{$rowlinks[outer].ort}</select></td>
				<td align="left"><input type="text" name="start[{$rowlinks[outer].id}]" value="{$rowlinks[outer].start}"></select></td>
				<td align="left"><input type="text" name="ende[{$rowlinks[outer].id}]" value="{$rowlinks[outer].ende}"></select></td>
			</tr>
		{sectionelse}
			<tr class="tblsection">
				<td colspan="7">Kein Eintrag vorhanden.</td>
			</tr>
		{/section}
	
	</table>
	<input type="hidden" value="send" name="send">
	<input type="submit" name="Submit" value="submit">					
</td>
</form>
		
{include file="_footer.tpl.php" title=foo}
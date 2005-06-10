{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
<hr>
<a href="mandant.php?action=new{$url_und_sid}">Neuen Mandant eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Mandant</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="mandant.php?orderby=mandant_id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td colspan="2"><a href="mandant.php?orderby=mandant_name&orderdir={$orderdir}{$url_und_sid}">Name</a></td>
		<td colspan="2"><a href="mandant.php?orderby=mandant_name&orderdir={$orderdir}{$url_und_sid}">Verantwortlicher</a></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].mandant_id}</td>
			<td align="left">{$rowlinks[outer].mandant_name}</font></td>
			<td align="left">{$rowlinks[outer].mandant_vorname} {$rowlinks[outer].mandant_nachname}</font></td>
			<td width="120"><a href="mandant.php?action=edit&id={$rowlinks[outer].mandant_id}{$url_und_sid}">Edit</a></td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
				
{include file="_footer.tpl.php" title=foo}
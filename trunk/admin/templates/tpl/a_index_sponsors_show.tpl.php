{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
<hr>
<a href="index_sponsors.php?action=new{$url_und_sid}">Neuen Sponsor eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Sponsoren</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="index_sponsors.php?orderby=id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td><a href="index_sponsors.php?orderby=create_date&orderdir={$orderdir}{$url_und_sid}">Datum</a></td>
		<td><a href="index_sponsors.php?orderby=titel&orderdir={$orderdir}{$url_und_sid}">Titel</a></td>
		<td><a href="index_sponsors.php?orderby=email&orderdir={$orderdir}{$url_und_sid}">EMail</a></td>
		<td colspan="2"><a href="index_sponsors.php?orderby=url&orderdir={$orderdir}{$url_und_sid}">URL</a></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].id}</td>
			<td align="left">{$rowlinks[outer].create_date|date_format:"%d.%m.%Y"}</font></td>
			<td align="left">{$rowlinks[outer].titel}</font></td>
			<td align="left">{$rowlinks[outer].email}</font></td>
			<td align="left">{$rowlinks[outer].url}</font></td>
			<td width="120">
				<a href="index_sponsors.php?action=edit&id={$rowlinks[outer].id}{$url_und_sid}">Edit</a> | 
				<a href="index_sponsors.php?action=delete&id={$rowlinks[outer].id}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
				
{include file="_footer.tpl.php" title=foo}
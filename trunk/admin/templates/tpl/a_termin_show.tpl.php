{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
<hr>
<a href="termin.php?action=new{$url_und_sid}">Neuen Termine eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Termine und Berichte</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="termin.php?orderby=id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td><a href="termin.php?orderby=datefrom&orderdir={$orderdir}{$url_und_sid}">Datum Begin</a></td>
		<td><a href="termin.php?orderby=dateto&orderdir={$orderdir}{$url_und_sid}">Datum Ende</a></td>
		<td><a href="termin.php?orderby=titel&orderdir={$orderdir}{$url_und_sid}">Titel</a></td>
		<td colspan="2"><a href="termin.php?orderby=ort&orderdir={$orderdir}{$url_und_sid}">Ort</a></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].id}</td>
			<td align="left">{$rowlinks[outer].datefrom|date_format:"%d.%m.%Y"}</font></td>
			<td align="left">{$rowlinks[outer].dateto|date_format:"%d.%m.%Y"}</font></td>
			<td align="left">{$rowlinks[outer].titel}</font></td>
			<td align="left">{$rowlinks[outer].ort}</font></td>
			<td width="120">
				<a href="termin.php?action=edit&id={$rowlinks[outer].id}{$url_und_sid}">Edit</a> | 
				<a href="termin.php?action=delete&id={$rowlinks[outer].id}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
				
{include file="_footer.tpl.php" title=foo}
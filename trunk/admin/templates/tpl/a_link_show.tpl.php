{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
  
<hr>
<a href="link.php?action=showlinks&id=all{$url_und_sid}">Alle Links anzeigen</a> | 
<a href="link.php?action=newlink&id={$refid}{$url_und_sid}">Neuen Link eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Linkdatenbank</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="link.php?action=showlinks&id={$refid}&orderby=id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td colspan="5"><a href="link.php?action=showlinks&id={$refid}&orderby=beschreibung&orderdir={$orderdir}{$url_und_sid}">Name</a></td>
	</tr>
	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].id}</td>
			<td align="left">{$rowlinks[outer].beschreibung} <a href="{$rowlinks[outer].link}" target="_blank">{$rowlinks[outer].link}</a><br />
			<font size="-2">{$rowlinks[outer].titel}</font></td>
			<td width="120">
			<a href="link.php?action=editlink&id={$rowlinks[outer].id}{$url_und_sid}">Edit</a> | 
			<a href="link.php?action=deletelink&id={$rowlinks[outer].id}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
</table>
						
{include file="_footer.tpl.php" title=foo}
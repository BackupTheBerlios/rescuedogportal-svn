{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
<hr>
<a href="customer_groups.php?action=new{$url_und_sid}">Neue Gruppe eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="7">Admin Trainings Typ</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="customer_groups.php?orderby=id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td><a href="customer_groups.php?orderby=name&orderdir={$orderdir}{$url_und_sid}">Name</a></td>
		<td colspan="2"><a href="customer_groups.php?orderby=sortierung&orderdir={$orderdir}{$url_und_sid}">Sortierung</a></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].id}</td>
			<td align="left">{$rowlinks[outer].name}</font></td>
			<td align="left">{$rowlinks[outer].sortierung}</font></td>
			<td width="120">
			<a href="customer_groups.php?action=edit&id={$rowlinks[outer].id}{$url_und_sid}">Edit</a> | 
			<a href="customer_groups.php?action=delete&id={$rowlinks[outer].id}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
				
{include file="_footer.tpl.php" title=foo}
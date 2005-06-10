{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
<hr>
<a href="training_typ.php?action=new{$url_und_sid}">Neuen Typ eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Trainings Typ</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="training_typ.php?orderby=id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td colspan="2"><a href="training_typ.php?orderby=training&orderdir={$orderdir}{$url_und_sid}">Trainings Typ</a></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].id}</td>
			<td align="left">{$rowlinks[outer].training}</font></td>
			<td width="120">
			<a href="training_typ.php?action=edit&id={$rowlinks[outer].id}{$url_und_sid}">Edit</a> | 
			<a href="training_typ.php?action=delete&id={$rowlinks[outer].id}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
				
{include file="_footer.tpl.php" title=foo}
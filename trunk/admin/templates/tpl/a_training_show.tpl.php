{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<hr>
<a href="training.php?action=new{$url_und_sid}">Neues Training eintragen</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="7">Admin Training</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="training.php?orderby=tr.id&orderdir=<?=$orderdir?>{$url_und_sid}">ID</a></td>
		<td><a href="training.php?orderby=training.training&orderdir=<?=$orderdir?>{$url_und_sid}">Training</a></td>
		<td><a href="training.php?orderby=trainer.trainer&orderdir=<?=$orderdir?>{$url_und_sid}">Trainer</a></td>
		<td><a href="training.php?orderby=ort.ort&orderdir=<?=$orderdir?>{$url_und_sid}">Ort</a></td>
		<td><a href="training.php?orderby=tr.starttime&orderdir=<?=$orderdir?>{$url_und_sid}">Start</a></td>
		<td><a href="training.php?orderby=tr.endtime&orderdir=<?=$orderdir?>{$url_und_sid}">Ende</a></td>
		<td></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].myid}</td>
			<td align="left">{$rowlinks[outer].training}</font></td>
			<td align="left">{$rowlinks[outer].trainer}</font></td>
			<td align="left">{$rowlinks[outer].ort}</font></td>
			<td align="left">{$rowlinks[outer].starttime}</font></td>
			<td align="left">{$rowlinks[outer].endtime}</font></td>
			<td width="120">
			<a href="training.php?action=delete&id={$rowlinks[outer].myid}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="7">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
		
{include file="_footer.tpl.php" title=foo}
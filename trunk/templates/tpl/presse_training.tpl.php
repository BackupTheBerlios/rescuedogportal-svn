{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Training: {$mandant_name}</b></span></td>
	</tr>
</table>
<br />

{section name=outer loop=$trainingsentries}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="table_title" align="left"><span class="normalfont"><b>{$trainingsentries[outer].training} am {$trainingsentries[outer].starttime|date_format:"%A"}, den {$trainingsentries[outer].starttime|date_format:"%d.%m.%Y"}</b></span></td>
		</tr>
			<tr>
			<td class="tableb" align="left">
				<span class="normalfont">
					<table>		
					<tr><td><span class="smallfont"><b>Ausbilder:</b> {$trainingsentries[outer].trainer}</span></td></tr>
					<tr><td><span class="smallfont"><b>Ort:</b>  {$trainingsentries[outer].ort}</span></td></tr>
					<tr><td><span class="smallfont"><b>Beginn:</b> {$trainingsentries[outer].starttime|date_format:"%d.%m.%Y %H:%M:%S"} Uhr</span></td></tr>
					<tr><td><span class="smallfont"><b>Vorraussichtliches Ende:</b> {$trainingsentries[outer].endtime|date_format:"%d.%m.%Y %H:%M:%S"} Uhr</span></td></tr>
					</table>
				</span>
			</td>
		</tr>
	</table>
	<br />
{sectionelse}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="table_title" align="left"><span class="normalfont"><b>Keine Trainingseinheiten in dieser Selektion vorhanden.</b></span></td>
		</tr>
	</table>
	<br />
{/section}

{include file="_footer.tpl.php" title=foo}
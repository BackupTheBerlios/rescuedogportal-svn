{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Das ist unsere Staffeldatenbank: {$mandant_name}</b></span></td>
	</tr>
</table>
<br />


{section name=outer loop=$staffelorg}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="tablea" width="100%" colspan="4"> <span class="normalfont"><b>{$staffelorg[outer].org} </b></span><span class="smallfont">{$staffelorg[outer].beschreibung}</span></td> 			
		</tr>
		<tr>
			<td class="table_title" width="45%"><span class="normalfont">Staffelname</span></td> 
			<td class="table_title" width="15%"><span class="normalfont">PLZ</span></td> 
			<td class="table_title" width="20%"><span class="normalfont">Ort</span></td> 
			<td class="table_title" width="20%"><span class="normalfont">URL</span></td> 			
		</tr>

		{section name=inner loop=$staffel}
			{if $staffelorg[outer].id == $staffel[inner].staffel_org}
			<tr>
				<td align="left" class="tableb">{$staffel[inner].staffel_name}</td>
				<td align="center" class="tableb">{$staffel[inner].plz}</td>
				<td align="center" class="tableb">{$staffel[inner].ort}</td>
				<td align="center" class="tableb"><a class="rheinsatz" target="_blank" href="{$staffel[inner].url}" target="_blank">{$staffel[inner].url}</a></td>
			</tr>
			{/if}					
		{/section}
	</table>
	<br />
{sectionelse}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="table_title" width="45%"><span class="normalfont">Kein Ergebnis in dieser Selektion.</span></td> 			
		</tr>
	</table>
	<br />
{/section}


{include file="_footer.tpl.php" title=foo}
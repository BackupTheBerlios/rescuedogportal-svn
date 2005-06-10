{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Das ist unsere Einsatzdatenbank: {$mandant_name}</b></span></td>
	</tr>
</table>
<br />


{section name=outer loop=$einsatzjahr}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="tablea" width="100%" colspan="6"> 
				<span class="normalfont"><b>Anzeige aller Einsätze in der Datenbank aus dem Jahr {$einsatzjahr[outer].jahr}</b></span>
				<span class="smallfont"><a href="http://www.rettungshundeforum.com" target="_blank"><b>Details im Rettungshundeforum</span>
			</td> 			
		</tr>
		<tr>
			<td class="table_title" width="5%"><span class="normalfont">Erflog</span></td> 
			<td class="table_title" width="35%" align="left"><span class="normalfont">Titel</span></td> 
			<td class="table_title" width="15%"><span class="normalfont">Tag</span></td> 
			<td class="table_title" width="15%"><span class="normalfont">Land / Bundesland / Ort</span></td> 
			<td class="table_title" width="15%"><span class="normalfont">Suchart</span></td> 
			<td class="table_title" width="10%"><span class="normalfont"></span></td> 			
		</tr>

		{section name=inner loop=$einsatz}
			{if $einsatzjahr[outer].jahr == $einsatz[inner].jahr}
			<tr>
				<td align="left" class="tableb">{$einsatz[inner].erfolg}</td>
				<td align="left" class="tableb">{$einsatz[inner].titel}</td>
				<td align="center" class="tableb">{$einsatz[inner].start}</td>
				<td align="center" class="tableb">{$einsatz[inner].region}</td>
				<td align="center" class="tableb">{$einsatz[inner].suchart}</td>
				<td align="left" class="tableb">
					<a href="javascript:void(window.open('http://www.rettungshundeforum.com/mod_einsatzdb.php?&einsaction=detailein&einsid={$einsatz[inner].id}','3','scrollbars=yes,resizable=yes,width=550,height=600,toolbar=no,statusbar=no'))">Details</a> - 
					<a href="javascript:void(window.open('http://www.rettungshundeforum.com/mod_geodb.php?maptype=search&searchoption=easy&id={$einsatz[inner].ortsdb_id}','3','scrollbars=yes,resizable=yes,width=700,height=800,toolbar=no,statusbar=no'))">Map</a>
				</td>
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
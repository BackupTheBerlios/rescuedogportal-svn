{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>{$mandant_name}</b></span></td>
	</tr>
</table>
<br />

{section name=outer loop=$portal}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="tableb"> 
				<b><a href="index.php?tempid=home&mandant={$portal[outer].mandant}{$url_und_sid}">{$portal[outer].mandant_name}</a> - {$portal[outer].titel}</b><br />
				{$portal[outer].text}<br>
				<span class="normalfont">
				{if $portal[outer].bilddb_id != 0}<br><a href="gallery.php?g2_view=core.ShowItem&g2_itemId={$portal[outer].bilddb_id}">Galerie Bilder anzeigen</a><br>{/if}
				<br>
				<b>Erstellt von:</b> <a href="#" onClick="javascript:window.open('./kontakt.php?tempid=user&id={$portal[outer].customer_id}{$url_und_sid}', 'Kontakte', 'width=800,height=300,left=0,top=0,scrollbars=yes,resizable=yes');">{$portal[outer].customer_firstname} {$portal[outer].customer_surname}</a> - <a href="mailto:{$portal[outer].customer_email}">{$portal[outer].customer_email}</a> 
				am {$portal[outer].3|date_format:"%d.%m.%Y %H:%M:%S"}
				</span>				
			</td> 			
		</tr>
	</table>
	<br />
{sectionelse}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr><td class="table_title" align="left"><span class="normalfont"><b>Keine News in dieser Selection vorhanden</b></span></td></tr>
	</table>
	<br />
{/section}
{include file="_footer.tpl.php" title=foo}
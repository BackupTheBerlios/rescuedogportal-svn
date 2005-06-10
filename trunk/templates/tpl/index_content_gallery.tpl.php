{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 				
{$headhtml}
{$bodyhtml}
		</td> 			
	</tr>
</table>
<br />
{include file="_footer.tpl.php" title=foo}
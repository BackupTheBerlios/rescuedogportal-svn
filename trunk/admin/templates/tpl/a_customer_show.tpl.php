{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
<hr>
<a href="customer.php?action=new{$url_und_sid}">Neuen User eintragen</a> | 
<a href="customer_pdf.php{$url_sid}" target="_blank">Kontaktliste als PDF</a> |
{if $admin_admin == 1}
	<a href="customer_pdf.php?action=komplett{$url_und_sid}" target="_blank">Kontaktliste Komplett als PDF</a> |
{/if}
<a href="customer_pdf.php?action=accept{$url_und_sid}" target="_blank">Einverständniserklärung</a>
<hr>
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="8">Admin User</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="customer.php?orderby=customer_id&orderdir={$orderdir}{$url_und_sid}">ID</a></td>
		<td><a href="customer.php?orderby=customer_surname&orderdir={$orderdir}{$url_und_sid}">name</a></td>
		<td><a href="customer.php?orderby=customer_street&orderdir={$orderdir}{$url_und_sid}">Street</a></td>
		<td><a href="customer.php?orderby=customer_zipcode&orderdir={$orderdir}{$url_und_sid}">PLZ</a></td>
		<td><a href="customer.php?orderby=customer_city&orderdir={$orderdir}{$url_und_sid}">City</a></td>
		<td colspan="2"><a href="customer.php?orderby=customer_email&orderdir={$orderdir}{$url_und_sid}">Mail</a></td>
	</tr>

	{section name=outer loop=$rowlinks}
		<tr class="tblsection">
			<td>{$rowlinks[outer].customer_id}</td>
			<td align="left">{$rowlinks[outer].customer_surname}, {$rowlinks[outer].customer_firstname}</font></td>
			<td align="left">{$rowlinks[outer].customer_street}</font></td>
			<td align="left">{$rowlinks[outer].customer_zipcode}</font></td>
			<td align="left">{$rowlinks[outer].customer_city}</font></td>
			<td align="left">{$rowlinks[outer].customer_email}</font></td>
			<td width="120">
			<a href="customer.php?action=edit&id={$rowlinks[outer].customer_id}{$url_und_sid}">Edit</a> | 
			<a href="customer.php?action=delete&id={$rowlinks[outer].customer_id}{$url_und_sid}">Delete</a>
			</td>
		</tr>
	{sectionelse}
		<tr class="tblsection">
			<td colspan="6">Kein Eintrag vorhanden.</td>
		</tr>
	{/section}
	
</table>
				
{include file="_footer.tpl.php" title=foo}
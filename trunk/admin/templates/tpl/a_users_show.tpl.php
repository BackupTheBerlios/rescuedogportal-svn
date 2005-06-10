{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
 
 <hr>
<a href="users.php?action=new{$url_und_sid}">Einen neuen Admin User anlegen</a>
<hr>

<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<tr class="tblhead">
		<td colspan="6">Admin Users</td>
	</tr>
	<tr class="tblsectionhead">
		<td><a href="users.php?action=change&artorder=userid&artrorder={$order_1}{$url_und_sid}">ID</a></td>
		<td colspan="5"><a href="users.php?action=change&artorder=username&artrorder={$order_2}{$url_und_sid}">Name</a></td>
	</tr>
	
{section name=outer loop=$rowusers}
	<tr class="tblsection">
		<td>{$rowusers[outer].customer_id}</td>
		<td align="left">{$rowusers[outer].admin_username}</td>
		<td align="left">{$rowusers[outer].admin_email}</td>
		<td>
			<a href="users.php?action=edit&userid={$rowusers[outer].customer_id}{$url_und_sid}">Edit</a> | 
			<a href="users.php?action=delete&userid={$rowusers[outer].customer_id}{$url_und_sid}">Delete</a>
		</td>
	</tr>
{sectionelse}
	<tr class="tblsection">
		<td colspan="6">Kein Eintrag vorhanden.</td>
	</tr>
{/section}

</table>

{include file="_footer.tpl.php" title=foo}
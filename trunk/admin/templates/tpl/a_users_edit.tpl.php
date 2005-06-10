{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<form method="post" action="users.php?userid={$customer_id}&action=edit{$url_und_sid}" name="userform">
	<input type="hidden" name="send" value="send">
	<table cellpadding="4" cellspacing="1" width="100%" class="tblborder" align="center">
		<tr class="tblhead">
			<td colspan="2">Benutzer "{$admin_username}" bearbeiten</td>
		</tr>
		<tr class="tblsection">
			<td colspan="2">Allgemeine Angaben (Alle Felder werden benötigt.)</td>
		</tr>
		<tr class="firstrow">
			<td><b>Benutzername:</b></td>
			<td><input type="text" name="username" maxLength="50" style="width: 50%" value="{$admin_username}"></td>
		</tr>
		<tr class="secondrow">
			<td><b>Passwort:</b></td>
			<td>
				<input type="text" value="********" style="width: 50%" readonly> 
				<input type="button" value="Passwort ändern" onclick='window.open("users.php?action=pw&userid={$customer_id}{$url_und_sid}", "moo", "toolbar=no,scrollbars=yes,resizable=yes,width=400,height=200");'>
			</td>
		</tr>
		<tr class="firstrow">
			<td><b>eMail:</b></td>
			<td><input type="text" name="email" maxLength="150" style="width: 50%" value="{$admin_email}"></td>
		</tr>
		<tr class="secondrow">
			<td><b>Benutzergruppe:</b></td>
			<td>
				<select style="width: 50%" name="groupid">
					<option value="1" selected>Admin</option>
					<option value="2">Moderator</option>
					<option value="3">User</option>
				</select>
			</td>
		</tr>
		<tr class="firstrow">
			<td><input type="submit" value="Speichern"></td>
			<td><input type="button" value="Abbrechen" onClick="javascript:history.back();"></td>
		</tr>
	</table>
</form>

{include file="_footer.tpl.php" title=foo}
<html>
<head>
<title>{$shopconfig_pagetitle} - Bitte melden Sie sich an.</title>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<link rel="stylesheet" href="./templates/tpl/admin.css">
</head>

<body onload="document.lform.l_username.focus()">
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<table align="center">
	<tr>
		<td bgcolor="#FFFFFF"><img src="./bilder/hintergrund/bg2.jpg">&nbsp;<img src="./bilder/hintergrund/srh.jpg"></td>
	</tr>
	<tr>
		<form method="post" action="login.php" name="lform">
		<td>
			<table align="center">
				{if $error == 1 && $l_username != ""}
					<tr>
					<td><b>Fehler:</b></td>
					<td>Benutzername und/oder Passwort sind falsch oder nicht vorhanden</td>
					</tr>
				{/if}
				<tr>
					<td><b>Benutzername:</b></td>
					<td><input type="text" name="l_username" value="{$l_username}" maxlength="50"></td>
				</tr>
				<tr>
					<td><b>Passwort:</b></td>
					<td><input type="password" name="l_password" maxlength="50"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td align="right"><input type="submit" value="Anmelden"></td>
	</tr>
	</form>
</table>
<p align="center">{$shopconfig_pagetitle} - Admin Control</p>
</body>
</html>
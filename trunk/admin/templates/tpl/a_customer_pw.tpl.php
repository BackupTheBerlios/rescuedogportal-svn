<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1">
<link rel="stylesheet" href="./templates/tpl/admin.css">
<title>{$shopconfig_pagetitle}</title>
</head>

<body>
<table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
		<td bgcolor="#E6E6E6" width="79%" valign="top">
			<table width="100%" height="100%">
				<tr>
					<td valign="top" height="100%" bgcolor="#FFFFFF">						
						<form method="post" action="customer.php?action=pw&userid={$customer_id}{$url_und_sid}">
							<input type="hidden" name="send" value="send">
							<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
								<tr class="tblhead">
									<td colspan=2>Passwort von "{$customer_admin_name}" ändern</td>
								</tr>
								<tr class="firstrow">
									<td valign="top"><b>Neues Passwort:</b></td>
									<td>
									<input type="radio" name="mode" value="1" CHECKED> zufallsgeneriertes Passwort<br><input type="radio" name="mode" value="2"> 
									<input type="text" name="newpassword" value="">
									</td>
								</tr>
								<tr class="secondrow">
									<td>Benutzer benachrichtigen:</td>
									<td><input type="checkbox" name="sendmail" value="1" CHECKED> Ja</td>
								</tr>
							</table>
							<p align="center"><input type="submit" value="Speichern"> <input type="button" value="Fenster schließen" onclick="self.close()"></p>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</body>
</html>
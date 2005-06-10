{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<form method="post" action="adminsessions.php?action={$action}{$url_und_sid}">
	<input type="hidden" name="send" value="send">
	<table cellpadding="4" cellspacing="1" border="0" class="tblborder" width="100%" align="center">
		<tr class="tblhead">
			<td colspan="6">Administrator-Sitzungen</td>
		</tr>
			<tr class="tblsection" align="center">
				<td>&nbsp;</td>
				<td>Benutzer</td>
				<td>Erstelldatum</td>
				<td nowrap=nowrap>letzte Aktivität</td>
				<td nowrap=nowrap>IP-Adresse</td>
				<td>Browser</td>
			</tr>

			{section name=outer loop=$sessiondata}
				<tr class="{$sessiondata[outer].class}">
					<td><input type="checkbox" name="kicksession[]" value="{$sessiondata[outer].hash}" {$sessiondata[outer].disabled}></td>
					<td align="center" width="100%">{$sessiondata[outer].customer_admin_name}</td>
					<td align="center" nowrap=nowrap>{$sessiondata[outer].starttime}</td>
					<td align="center" nowrap=nowrap>{$sessiondata[outer].lastactivity}</td>
					<td align="center" nowrap=nowrap>{$sessiondata[outer].ipaddress}</td>
					<td nowrap=nowrap>{$sessiondata[outer].useragent}</td>
				</tr>
			{sectionelse}
				<tr class="tblsection">
					<td colspan="6">Kein Eintrag vorhanden.</td>
				</tr>
			{/section}	
			
			<tr class="tblsection">
				<td colspan=6>
					<table cellpadding="0" cellspacing="0" border="0" width="100%">
						<tr>
							<td>
								<input type="submit" value="Löschen"> 
								<input type="submit" name="all" value="Alle Löschen">
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</td>
</form>

{include file="_footer.tpl.php" title=foo}
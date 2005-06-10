{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
						
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<form action="customer.php?action={$action}&id={$customer_id}{$url_und_sid}" method="post" enctype="multipart/form-data">
	<tr class="tblhead">
		<td colspan="2">Admin User</td>
	</tr>
	{if $fehler == 1} 
		<tr><td class="tblsectionhead" colspan="2">Die Benutzerdaten wurden Erfolgreich gespeichert. Wenn die Weiterleitung nicht funktioniert, <a href="{$page_redirect}">bitte hier klicken</a></td></tr>
	{/if}
	{if $fehler == 2} 
		<tr><td class="tblsectionhead" colspan="2"><font color="#FF0000">Fehler beim Speichern. Es kann daran liegen, dass der Login Name schon vergeben ist, bitte ändern.</font></td></tr>
	{/if}
	<tr>
		<td width="25%" class="tblsectionhead">User auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_user">{$customer_show_user}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">User Gruppe:</td>
		<td width="75%"  class="tblsection"><select name="groupsid">{$customer_groups}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Nachname</td>
		<td width="75%"  class="tblsection"><input type="text" name="surname" style="width:100%" value="{$customer_surname}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Vorname</td>
		<td width="75%"  class="tblsection"><input type="text" name="firstname" style="width:100%" value="{$customer_firstname}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Beschreibung</td>
		<td width="75%"  class="tblsection"><input type="text" name="description" style="width:100%" value="{$customer_description}"/></td>
	</tr>
	<tr  class="tblsection"><td></td><td class="tblsectionhead">Admin Daten</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">Login Name:</td>
		<td width="75%"  class="tblsection"><input type="text" name="customer_admin_name" maxLength="50" style="width: 50%" value="{$customer_admin_name}"></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Passwort:</td>
		<td width="75%"  class="tblsection">
			{if $action == "new"}
				<input type="text" name="customer_admin_password" style="width:100%" value="{$customer_admin_password}"/>
			{else}
				<input type="text" value="********" style="width: 50%" readonly> 
				<input type="button" value="Passwort ändern" onclick='window.open("customer.php?action=pw&userid={$customer_id}{$url_und_sid}", "moo", "toolbar=no,scrollbars=yes,resizable=yes,width=400,height=200");'>
			{/if}
		</td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Benutzergruppe:</td>
		<td width="75%"  class="tblsection">
			<select style="width: 50%" name="customer_admin_groupsid">
				{if $admin_admin == 1}
					{$customer_admin_groupsid2}
				{else}
					<option value="6" selected>User</option>		
				{/if}
			</select>
		</td>
	</tr>
	<tr  class="tblsection"><td></td><td class="tblsectionhead">Hundedaten</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">Hund auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_dog">{$customer_show_dog}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Hund:</td>
		<td width="75%"  class="tblsection"><select name="dogid">{$customer_dogid_1}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Hund 2 auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_dog2">{$customer_show_dog2}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Hund 2:</td>
		<td width="75%"  class="tblsection"><select name="dogid2">{$customer_dogid_2}</select></td>
	</tr>
	<tr  class="tblsection"><td></td><td class="tblsectionhead">Adressdaten</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">Adresse auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_address">{$customer_show_address}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Straße</td>
		<td width="75%"  class="tblsection"><input type="text" name="street" style="width:100%" value="{$customer_street}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">PLZ</td>
		<td width="75%"  class="tblsection"><input type="text" name="zipcode" style="width:100%" value="{$customer_zipcode}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Stadt</td>
		<td width="75%"  class="tblsection"><input type="text" name="city" style="width:100%" value="{$customer_city}"/></td>
	</tr>
	<tr  class="tblsection"><td></td><td class="tblsectionhead">Email Daten</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">EMail auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_email">{$customer_show_email}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">EMail</td>
		<td width="75%"  class="tblsection"><input type="text" name="email" style="width:100%" value="{$customer_email}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">EMail 2 auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_email2">{$customer_show_email2}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">EMail 2</td>
		<td width="75%"  class="tblsection"><input type="text" name="email2" style="width:100%" value="{$customer_email2}"/></td>
	</tr>
	<tr  class="tblsection"><td></td><td class="tblsectionhead">Telefon Daten</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">Telefon auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_phone">{$customer_show_phone}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Telefon</td>
		<td width="75%"  class="tblsection"><input type="text" name="phone" style="width:100%" value="{$customer_phone}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Telefon Geschäftlich auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_phone_business">{$customer_show_phone_business}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Telefon Geschäftlich</td>
		<td width="75%"  class="tblsection"><input type="text" name="phone_business" style="width:100%" value="{$customer_phone_business}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Fax auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_fax">{$customer_show_fax}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Fax</td>
		<td width="75%"  class="tblsection"><input type="text" name="fax" style="width:100%" value="{$customer_fax}"/></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Handy auf der Website anzeigen:</td>
		<td width="75%"  class="tblsection"><select name="show_mobile">{$customer_show_mobile}</select></td>
	</tr>
	<tr>
		<td width="25%" class="tblsectionhead">Handy</td>
		<td width="75%"  class="tblsection"><input type="text" name="mobile" style="width:100%" value="{$customer_mobile}"/></td>
	</tr>
	<tr  class="tblsection"><td></td><td class="tblsectionhead">Bild</td></tr>
	<tr>
		<td width="25%" class="tblsectionhead">Bild:<br> 
		- Das Bild muss eine Breite von 144 Pixel haben.<br>
		- Es werden die Formate jpg und png gestattet.<br>
		- Die Bilder dürfen maximal 30 Kb haben.<br><br>
		Es wird versucht Bilder die nicht den Konventionen entsprechen zu konvertieren, falls das fehlschlägt bitte manuell korrigieren und erneut hochladen.
		</td>
		<td width="75%"  class="tblsection">
		<table>
			<tr>
				<td><img src="{$img_for_this_user}" alt="{$customer_firstname} {$customer_surname}" ></td>
				<td>Aktuelles Bild ändern:<br>Aktuelles Bild löschen:</td><td><input type="file" name="img_for_this_user"><br><input type="checkbox" value="1" name="delete_pic"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr class="tblsection">
		<td align="center" colspan="2"><input type="hidden" name="send" value="true" /><input type="submit" value="Speichern" /></td>
	</tr>
	</form>
</table>
												
{include file="_footer.tpl.php" title=foo}
{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}
						
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<form action="customer_dogs.php?action={$action}&id={$id}{$url_und_sid}" method="post" enctype="multipart/form-data">
	<tr class="tblhead">
		<td colspan="2">Admin User Hunde</td>
	</tr>
	{if $fehler == 1} 
		<tr><td class="tblsectionhead" colspan="2">Die Benutzerdaten wurden Erfolgreich gespeichert. Wenn die Weiterleitung nicht funktioniert, <a href="{$page_redirect}">bitte hier klicken</a></td></tr>
	{/if}
	{if $fehler == 2} 
		<tr><td class="tblsectionhead" colspan="2" align="left"><font color="#FF0000">Fehler beim Speichern.</font></td></tr>
	{/if}
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Name</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="name" style="width:100%" value="{$name}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Geburtsdatum</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="dob" style="width:100%" value="{$dob}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Rasse</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="species" style="width:100%" value="{$species}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Geschlecht</td>
		<td width="85%" class="tblsection" align="left"><select name="gender">{$gender}</select></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Prüfung Fläche</td>
		<td width="85%" class="tblsection" align="left"><select name="exam">{$exam}</select></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Prüfung Trümmer</td>
		<td width="85%" class="tblsection" align="left"><select name="exam_tr">{$exam_tr}</select></td>
	</tr>
	<tr><td class="tblsectionhead" colspan="2">Bild</td></tr>
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
				<td><img src="{$img_for_this_user}" alt="{$firstname} {$surname}" ></td>
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
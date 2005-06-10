{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}


<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Kontaktpersonen: {$mandant_name} {if $menu_template == "small"}<a href="#" onClick="window.close();">Fenster Schließen</a>{/if}</b></span></td>
	</tr>
</table>
<br />


{section name=outer loop=$kontakts}
{if $kontakts[outer].customer_show_user == 1}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	  <tr> 
		<td class="tableb" width="145">{if $menu_template == "small"}<a href="#" onClick="window.close();">{/if}<img src="{$kontakts[outer].img}" border="0" width="144" alt="">{if $menu_template == "small"}</a>{/if}</td>
		<td class="tableb" align="left" valign="top" width="100%"> 
		  <table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr> 
			  <th id="farbetr" width="100%"> 
				<div align="center">{$kontakts[outer].customer_firstname} {$kontakts[outer].customer_surname}</div>
			  </th>
			</tr>
			<tr> 
			  <td height="19"><b>{$kontakts[outer].customer_description}</b></td>
			</tr>
			<tr align="left" valign="top"> 
			  <td height="70"> 
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
				  <tr> 
					<td rowspan="2" align="left" valign="top" width="65%">
						{if $kontakts[outer].customer_show_address == 1}Adresse: {$kontakts[outer].customer_street}<br>&nbsp;&nbsp;&nbsp;{$kontakts[outer].customer_zipcode} {$kontakts[outer].customer_city}<br>{/if}
						{if $kontakts[outer].customer_show_phone == 1}Tel.: {$kontakts[outer].customer_phone}<br>{/if}
						{if $kontakts[outer].customer_show_phone_business == 1}Tel. Gesxchäftlich: {$kontakts[outer].customer_phone_business}<br>{/if}
						{if $kontakts[outer].customer_show_mobile == 1}Handy: {$kontakts[outer].customer_mobile}<br>{/if}
						{if $kontakts[outer].customer_show_fax == 1}Fax: {$kontakts[outer].customer_fax}<br>{/if}
						{if $kontakts[outer].customer_show_formmail == 1}E-Mail Formular: <a href="javascript:void(window.open('mail.php?action=send&contactid={$kontakts[outer].customer_id}','3','width=550,height=600,toolbar=no,statusbar=no'))">{$kontakts[outer].customer_firstname} {$kontakts[outer].customer_surname}</a><br>{/if}
						{if $kontakts[outer].customer_show_email == 1}E-Mail: <a href="mailto:{$kontakts[outer].email}">{$kontakts[outer].customer_email}</a><br>{/if}
						{if $kontakts[outer].customer_show_email2 == 1}E-Mail: <a href="mailto:{$kontakts[outer].email}">{$kontakts[outer].customer_email2}</a>{/if}
					</td>
					{if $kontakts[outer].customer_show_dog == 1  || $kontakts[outer].customer_show_dog2 == 1}
						<td align="left" valign="top"  width="250">
						{if $kontakts[outer].customer_show_dog == 1}
							{section name=inner loop=$dogs}
								{if $kontakts[outer].customer_dogid == $dogs[inner].id}
									<b>Hundename:</b> {$dogs[inner].name}<br>
									<b>Rasse:</b> {$dogs[inner].species}<br>
									<b>Geschlecht:</b> {$dogs[inner].gender}<br>
									<b>Geburtstag:</b> {$dogs[inner].dob}<br>
									<b>Prüfung Fläche:</b> {$dogs[inner].exam}<br>
									<b>Prüfung Trümmer:</b> {$dogs[inner].exam_tr}							
								{/if}
							{/section}
							{/if}
						{if $kontakts[outer].customer_show_dog2 == 1}
							{if $kontakts[outer].customer_dogid2 != 0 && $kontakts[outer].customer_dogid2 != 20}
								{section name=inner loop=$dogs}
									{if $kontakts[outer].customer_dogid2 == $dogs[inner].id}
										</td>
										</tr>
										<tr>
										<td align="left" valign="top"  width="250">
										<br>
										<b>Hundename:</b> {$dogs[inner].name}<br>
										<b>Rasse:</b> {$dogs[inner].species}<br>
										<b>Geschlecht:</b> {$dogs[inner].gender}<br>
										<b>Geburtstag:</b> {$dogs[inner].dob}<br>
										<b>Prüfung Fläche:</b> {$dogs[inner].exam}<br>
										<b>Prüfung Trümmer:</b> {$dogs[inner].exam_tr}							
									{/if}
								{/section}
							{/if}
						{/if}
						</td>
					{/if}
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		{if $kontakts[outer].customer_show_dog == 1  || $kontakts[outer].customer_show_dog2 == 1}<td class="tableb" width="145">{if $menu_template == "small"}<a href="#" onClick="window.close();">{/if}<img src="{$kontakts[outer].img_hund}" width="144" border="0" alt="">{if $menu_template == "small"}</a>{/if}</td>{/if}
	  </tr>
	</table>
	<br />
{/if}
{sectionelse}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	  <tr> 
		<td class="tableb" width="145"><img src="$img" width="144" alt=""></td>
		<td class="tableb" align="left" valign="top" width="100%"> 
		  <table border="0" width="100%" cellpadding="0" cellspacing="0">
			<tr> 
			  <th id="farbetr" width="100%"> 
				<div align="center">Keine Kontakte gepflegt</div>
			  </th>
			</tr>
			<tr> 
			  <td height="19"></td>
			</tr>
			<tr align="left" valign="top"> 
			  <td height="70"> 
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
				  <tr> 
					<td align="left" valign="top"  width="100%">
					</td>
				  </tr>
				</table>
			  </td>
			</tr>
		  </table>
		</td>
		<td class="tableb" width="145"><img src="$img_hund" width="144" alt=""></td>
	  </tr>
	</table>
	<br />
{/section}

{include file="_footer.tpl.php" title=foo}
{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b><a href="community.php?tempid=gaestebuch{$url_und_sid}">Gästebuch {$shopconfig_pagetitle}</a></b></span></td>
	</tr>
</table>
<br />

{if $neuer_eintrag != 1}
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="table_title" align="left">
				<span class="normalfont">
				<center><b><a href="community.php?tempid=gaestebuch&neu=1{$url_und_sid}">Einen eigenen Eintrag in das Gästebuch setzen</a><b></center>
				<br />
				</span>
				<span class="smallfont">
				Seite {$gastbooklinkleiste}
				</span>
			</td>
		</tr>
	</table>
	<br />
	
	{section name=outer loop=$guestbookentrie}
		<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
			<tr>
				<td class="table_title" width="30%"><span class="smallfont"><b>{$guestbookentrie[outer].name}</b></span></td> 
				<td class="table_title" width="70%"><span class="smallfont"><b>Nr. {$guestbookentrie[outer].id} Geschrieben am {$guestbookentrie[outer].tag} den {$guestbookentrie[outer].jahr} um {$guestbookentrie[outer].uhr} Uhr</b></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"><b>E-mail:</b> <a href="mailto:{$guestbookentrie[outer].email}">{$guestbookentrie[outer].email}</a></span></td> 
				<td class="tableb" valign="top" width="70%" rowspan="5"> <span class="smallfont">{$guestbookentrie[outer].massege}</span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"><b>Homepage:</b> <a href="{$guestbookentrie[outer].homepage}" target="_blank">{$guestbookentrie[outer].homepage}</a></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"><b>ICQ:</b> {$guestbookentrie[outer].icq}</span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"><b>AIM:</b> {$guestbookentrie[outer].aim}</span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"><b>Yahoo:</b> {$guestbookentrie[outer].yahoo}</span></td> 			
			</tr>
		</table>
		<br />
	{sectionelse}
		<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
			<tr>
				<td class="table_title" width="30%"><span class="smallfont"><b></b></span></td> 
				<td class="table_title" width="70%"><span class="smallfont"><b>Keine Einträge vorhanden</b></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"></span></td> 
				<td class="tableb" valign="top" width="70%" rowspan="5"></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"></span></td> 			
			</tr>
			<tr>
				<td class="tableb" width="30%"><span class="smallfont"</span></td> 			
			</tr>
		</table>
		<br />
	{/section}
	
	
	<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
		<tr>
			<td class="table_title" align="left">
				<span class="normalfont">
				<center><b><a href="community.php?tempid=gaestebuch&neu=1{$url_und_sid}">Einen eigenen Eintrag in das Gästebuch setzen</a><b></center>
				<br />
				</span>
				<span class="smallfont">
				Seite {$gastbooklinkleiste}
				</span>
			</td>
		</tr>
	</table>
	<br />

{else}

	<form action="./community.php?tempid=gaestebuch&neu=1{$url_und_sid}" method="post" name="postform">
	<table border="0" cellspacing="0" cellpadding="0" width="100%" align="center">
		<tr>
			<td bgcolor="#003D71">
				<table border="0" cellpadding="5" cellspacing="1" width="100%">
					<tr>
						<td bgcolor="#696969" colspan="2" align="center"><font size="2" face="Tahoma"><b>Neuen Gästebucheintrag erstellen</b></font>
						{if $fehler == 1}<br><font color="#FF0000"><b>Bitte geben sie ihren follstaendigen Namen an! Der Name muss mehr als 4 Zeichen haben.</b></font>{/if}
						{if $fehler == 2}<br><font color="#FF0000"><b>Bitte geben sie eine Nachricht ein! Ihr Nachricht muss mehr als 4 Zeichen lang sein!</b></font>{/if}
						</td>
					</tr>
					<tr>
						<td bgcolor="#c6c6c6"><font size="2" face="Tahoma">Dein Name:</font></td>
						<td bgcolor="#c6c6c6"><input type="text" name="myname" size="50" maxlength="100" value="{$myname}"></td>
					</tr>
					<tr>
						<td bgcolor="#778899"><font size="2" face="Tahoma">Deine E-mail Adresse:</font></td>
						<td bgcolor="#778899"><input type="text" name="myemail" size="50" maxlength="100" value="{$myemail}"></td>
					</tr>
					<tr>
						<td bgcolor="#c6c6c6"><font size="2" face="Tahoma">Deine Homepage:</font></td>
						<td bgcolor="#c6c6c6"><input type="text" name="myhp" size="50" maxlength="100" value="{$myhp}"></td>
					</tr>
					<tr>
						<td bgcolor="#778899"><font size="2" face="Tahoma">ICQ:</font></td>
						<td bgcolor="#778899"><input type="text" name="myicq" size="20" maxlength="20" value="{$myicq}"></td>
					</tr>
					<tr>
						<td bgcolor="#c6c6c6"><font size="2" face="Tahoma">AIM:</font></td>
						<td bgcolor="#c6c6c6"><input type="text" name="myaim" size="20" maxlength="20" value="{$myaim}"></td>
					</tr>
					<tr>
						<td bgcolor="#778899"><font size="2" face="Tahoma">Yahoo:</font></td>
						<td bgcolor="#778899"><input type="text" name="myyahoo" size="20" maxlength="20" value="{$myyahoo}"></td>
					</tr>
					<tr>
						<td bgcolor="#c6c6c6" align="center">
							<table border="0" cellspacing="0" cellpadding="1">
								<tr>
									<td bgcolor="#003D71">
										<table cellpadding="4" cellspacing="0" border="0">
											<tr>
												<td colspan="3" align="center" bgcolor="#778899"><font size="1" face="Tahoma"><b>Smilie Klickliste</b></font></td>
											</tr>
											<tr align="center" bgcolor="#c6c6c6">
												<td><a href="javascript:smilie(':)')"><img src="bilder/smilies/smile.gif" alt="smile" border="0"></a> </td>
												<td><a href="javascript:smilie(':(')"><img src="bilder/smilies/sad.gif" alt="sad" border="0"></a> </td>
												<td><a href="javascript:smilie(':o')"><img src="bilder/smilies/wow.gif" alt="wow" border="0"></a> </td>
											</tr>
											<tr align="center" bgcolor="#c6c6c6">
												<td><a href="javascript:smilie(':D')"><img src="bilder/smilies/biggrin.gif" alt="biggrin" border="0"></a> </td>
												<td><a href="javascript:smilie(';)')"><img src="bilder/smilies/wink.gif" alt="wink" border="0"></a> </td>
												<td><a href="javascript:smilie(':p')"><img src="bilder/smilies/tounge.gif" alt="tounge" border="0"></a> </td>
											</tr>
											<tr align="center" bgcolor="#c6c6c6">
												<td><a href="javascript:smilie(':cool:')"><img src="bilder/smilies/cool.gif" alt="cool" border="0"></a> </td>
												<td><a href="javascript:smilie(':rolleyes:')"><img src="bilder/smilies/rolleyes.gif" alt="rolleyes" border="0"></a> </td>
												<td><a href="javascript:smilie(':angry:')"><img src="bilder/smilies/angry.gif" alt="angry" border="0"></a> </td>
											</tr>
											<tr align="center" bgcolor="#c6c6c6">
												<td><a href="javascript:smilie(':bored:')"><img src="bilder/smilies/redface.gif" alt="redface" border="0"></a> </td>
												<td><a href="javascript:smilie(':confused:')"><img src="bilder/smilies/confused.gif" alt="confused" border="0"></a> </td>
												<td>&nbsp;</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
						<td bgcolor="#c6c6c6"><textarea name="mymassage" rows="20" cols="50" wrap="virtual">{$mymassage}</textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="center" bgcolor="#778899"><input type="submit" class="sendbutton" value="Eintrag speichern"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>	
	<input type="hidden" name="action" value="add">
	</form>
{/if}

{include file="_footer.tpl.php" title=foo}
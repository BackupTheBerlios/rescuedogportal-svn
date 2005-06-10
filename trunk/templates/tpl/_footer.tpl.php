{if $menu_template == "small"}

{else}
								</td>
								<td width="2"></td>
							</tr>
						</table>
					<!-- ++++++++++++++++ END Center Page						+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
					</td>
					<td width="183" valign="top">
					<!-- ++++++++++++++++ Begin Right Navigation Page			+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
						<table border="0" cellpadding="0" cellspacing="0" width="99%" class="tableoutborder">
							<tr>
								<td width="100%" align="left">
									<img src="./bilder/hintergrund/srh.jpg" border="0" alt="">
								</td>
							</tr>
						</table>
						<br />
						<table border="0" cellpadding="5" cellspacing="1" width="100%" class="tableinborder">
							<tr>
								<td class="table_title" align="left">
									<span class="smallfont"><b>Neueste Downloads</b></span>
								</td>
							</tr>
							<tr>
								<td class="tableb" align="left" width="100%" rowspan="5">
									<table>
									{section name=outer loop=$overall_download_data}
										<tr><td><span class="smallfont">{$overall_download_data[outer].dl_counter_man}) <a href="database.php?tempid=dlfile&id={$overall_download_data[outer].id}{$url_und_sid}" target="_blank">{$overall_download_data[outer].dlname} vom {$overall_download_data[outer].create_date|date_format:"%d.%m.%Y %H:%M:%S"}</a></span></td></tr>
									{sectionelse}
										<tr><td><span class="smallfont">Kein Ergebnis in dieser Selektion.</span></td></tr>
									{/section}
									</table>
								</td>
							</tr>
						</table>
						<br />
						<table border="0" cellpadding="5" cellspacing="1" width="100%" class="tableinborder">
							<tr>
								<td class="table_title" align="left">
									<span class="smallfont"><b>Neueste Links</b></span>
								</td>
							</tr>
							<tr>
								<td class="tableb" align="left" width="100%" rowspan="5">
									<table>
									{section name=outer loop=$overall_link_data}
										<tr><td><span class="smallfont">{$overall_link_data[outer].dl_counter_man}) <a href="database.php?tempid=linkdetail&ref={$overall_link_data[outer].refid}{$url_und_sid}">{$overall_link_data[outer].titel} vom {$overall_link_data[outer].create_date|date_format:"%d.%m.%Y %H:%M:%S"}</a></span></td></tr>
									{sectionelse}
										<tr><td><span class="smallfont">Kein Ergebnis in dieser Selektion.</span></td></tr>
									{/section}
									</table>
								</td>
							</tr>
						</table>
						<br />
						{$poll_html_text}
						<br />

						<table border="0" cellpadding="5" cellspacing="1" width="100%" class="tableinborder">
							<tr>
								<td class="table_title" align="left">
									<span class="smallfont"><b>Partner</b></span>
								</td>
							</tr>
							<tr>
								<td class="tableb" align="left" width="100%" rowspan="5">
									<span class="smallfont">
									<p align=center>
									<a href="http://www.rettungshundeforum.com" target="_blank"><img src="bilder/ansbach.gif" alt="Rettungshundeforum.com" border="0"></a>
									</p>
									<p align=center>
									<a href="http://developer.berlios.de" title="BerliOS Developer"><img src="http://developer.berlios.de/bslogo.php?group_id=3965" width="124px" height="32px" border="0" alt="BerliOS Developer Logo"></a>
									</p>
									<p align=center>
									<a href="http://www.bosrup.com/web/overlib/"><img src="http://www.bosrup.com/web/overlib/power.gif" width="88" height="31" alt="Popups by overLIB!" border="0"></a>
									</p>
									</span>
								</td>
							</tr>
						</table>
						<br />

						<table border="0" cellpadding="5" cellspacing="1" width="100%" class="tableinborder">
							<tr>
								<td class="table_title" align="left">
									<span class="smallfont"><b>Das Wetter von Wetter.de</b></span>
								</td>
							</tr>
							<tr>
								<td class="tableb" align="left" width="100%" rowspan="5">
									<span class="smallfont">
									<!-- ANFANG wetter.com-Button -->
									<a href="http://www.wetter.com/home/extern/location.php?type=WMO&id=473"><img src="http://www.wetter.com/home/woys/woys.php?,F,1,WMO,473" border="0" alt=""></a>
									<!-- ENDE wetter.com-Button -->
									<br>
									<a href="javascript:MM_openBrWindow('http://wetter.rtl.de/cgi-bin/wetter.de/plz-wetter.pl?plz=91522','','scrollbars=yes,resizable=yes,width=460,height=680')">Wetter in Mittelfranken</a>
									</span>
								</td>
							</tr>
						</table>
						<br />
					<!-- ++++++++++++++++ END Right Navigation Page				+++++++++++++++++++++++++++++++++++++++++++++++++++ -->
					</td>
					<td width="2" valign="top">&nbsp;</td>
				</tr>
			</table>
			<br />
			<table width="95%" cellpadding="0" cellspacing="1" border="0" class="tableinborder" align="center">
				<tr>
					<td width="50%" class="table_title" align="center">
						{if $show_net_stat == true}
							<!-- Begin Nedstat Basic code -->
							<!-- Title: BRK RHS Ansbach -->
							<!-- URL: http://www.rescue-dogs.de -->
							<a target="_blank" href="{$show_net_stat_url}"><img src="http://m1.nedstatbasic.net/n?id=ABqyJgyWBQfwUrr3QhWXfHqjSf4w" border="0" nosave width="18" height="18"></a>
							<!-- End Nedstat Basic code -->
						{/if}
						<span class="smallfont">
							.::. <a onMouseOver="return overlib('Impressum für die RHS BRK Ansbach.', CENTER)" onMouseOut="return nd()" href="./index.php?tempid=impressum{$url_und_sid}">Impressum</a>
							.::. <a onMouseOver="return overlib('Haftungsauschluss für die RHS BRK Ansbach.', CENTER)" onMouseOut="return nd()" href="./index.php?tempid=haftung{$url_und_sid}">Haftungsausschluss</a>
							.::.
						</span>
					</td>
					<td width="50%" class="table_title"><span class="smallfont">&nbsp;&nbsp;&nbsp;Designed by Markus Wilhelm and Claus Millizer<br />&nbsp;&nbsp;&nbsp;© 2005 <b><a href="http://www.rescue-dogs.de" target="_blank">www.rescue-dogs.de</a> - {$versions_inc_php}</b></span></td>
				</tr>
			</table>
			<br />
		</td>
	</tr>
</table>
<br />
<br />
<p align="center">
	<span class="smallfont">
		<a onMouseOver="return overlib('Wenn Sie die Seite www.rescue-dogs.de in Ihren Favoriten haben wollen, dann clicken Sie einfach hier.', CENTER)" onMouseOut="return nd()" href="javascript:window.external.AddFavorite('http://www.rescue-dogs.de/','DRK Rettungshundeportal')"><b>Diese Seite bookmarken</b></a> -
		<a onMouseOver="return overlib('Wenn Sie die Seite www.rescue-dogs.de an einen Freund oder Bekannten weiterempfehlen wollen, können Sie das hier automatisiert durchführen.', CENTER)" onMouseOut="return nd()" href="./index.php?tempid=empfehlen{$url_und_sid}"><b>Seite empfehlen</b></a> -
		<a onMouseOver="return overlib('Wenn Sie die Seite www.rescue-dogs.de als Startseite in Ihrem Brwoser haben wollen, dann clicken Sie einfach hier', CENTER)" onMouseOut="return nd()" href="" onClick="this.style.behavior='url(#default#homepage)';this.setHomePage('http://www.rescue-dogs.de/')"><b>Rescue-Dogs.de als Startseite</b></a>
	</span>
</p>
<br />
{/if}

<script>
	<!--//
	ap_showWaitMessage('waitDiv', 0);
	//-->
</script>
</body>
</html>
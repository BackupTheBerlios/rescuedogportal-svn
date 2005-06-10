{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Was ist die Leichensuche?</b></span></td>
	</tr>
</table>
<br />
			
<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb" align="center"><span class="normalfont">
			<a href="./index.php?tempid=flaeche{$url_und_sid}">Fl&auml;chensuche</a></span>
		</td> 
		<td class="tableb" align="center"><span class="normalfont">
			<a href="./index.php?tempid=truemmer{$url_und_sid}">Tr&uuml;mmersuche</a></span>
		</td> 
		<td class="tableb" align="center"><span class="normalfont">
			<a href="./index.php?tempid=lawine{$url_und_sid}">Lawinensuche</a></span>
		</td> 
		<td class="tableb" align="center"><span class="normalfont">
			<a href="./index.php?tempid=wasser{$url_und_sid}">Wassersuche</a></span>
		</td> 
		<td class="tableb" align="center"><span class="normalfont">
			<a href="./index.php?tempid=leiche{$url_und_sid}">Leichensuche</a></span>
		</td> 
		<td class="tableb" align="center"><span class="normalfont">
			<a href="./index.php?tempid=trailing{$url_und_sid}">Mantrailing</a></span>
		</td> 					
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 				
			<p style="alignment:justify; text-align:justify">
				<span class="normalfont">
				Die Leichensuche ist Sache der Polizei und wird hier vorerst nicht n&auml;her erleutert.
				</span>
			</p>									
		</td> 			
	</tr>
</table>
<br />
{include file="_footer.tpl.php" title=foo}
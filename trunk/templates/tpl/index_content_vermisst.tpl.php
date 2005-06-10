{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td align="center" class="table_title"><span class="normalfont"><b>Vermisste Personen in Deutschland</b></span></td>
	</tr>
</table>
<br />

<table width="100%" border="0" cellspacing="1" cellpadding="5" class="tableinborder">
	<tr>
		<td class="tableb"> 
			<span class="normalfont">
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www2.e110.de/">Aktenzeichen XY</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.bka.de/text/fahndungp.html">BKA</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.polizei.bayern.de/fahndung/vermisst/vermisst.htm">LKA Bayern</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.polizei.bayern.de/ppobb/pded/fahndung/index.htm">Polizeipräsidium Erding</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.polizei.bayern.de/ppmfr/fahndung/index.htm">Polizeipräsidium Mittelfranken</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.polizei.bayern.de/ppmuc/fahndung/index.htm">Polizeipräsidium München</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.gesuchte-kinder.de/">www.gesuchte-kinder.de</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.vermisste-kinder.de/">www.vermisste-kinder.de</a><br />
				<a href="index.php?tempid=vermisst{$url_und_sid}&dateiname=http://www.wir-suchen-dich.de/">www.wir-suchen-dich.de</a> <br />
			</span>
			<div align="center">
				<ilayer src="{$get_filename}" id="Reply-Iframe" width="100%" height="600" scrolling="yes">
				<iframe src="{$get_filename}" name="Reply-Iframe" width="100%" height="600" scrolling="yes"></iframe>
				</ilayer>
			</div>
		</td> 			
	</tr>
</table>
<br />
{include file="_footer.tpl.php" title=foo}
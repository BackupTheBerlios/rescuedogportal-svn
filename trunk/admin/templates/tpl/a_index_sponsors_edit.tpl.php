{config_load file=rhs.conf section="setup"}
{include file="_header.tpl.php" title=foo}

{literal}
<script type="text/javascript">
<!--

function getAppletObject() {
	if(document.getElementById('embed_wysiwyg') == null || document.getElementById('embed_wysiwyg').getTextLength == null) return document.getElementById('wysiwyg');
	return document.getElementById('embed_wysiwyg');
}

function setAppletText(theForm) {
	getAppletObject().setText(theForm.message.value);
}

function getHiddenText() {
	return document.bbform.message.value;
}

function smilie(theSmilie) {
	getAppletObject().insertSmilie(theSmilie);
}

function submitForm() {
	if (validate(document.bbform)) document.bbform.submit();
}



function getAppletText(theForm) {

	var appletObj = getAppletObject();
	if (appletObj != null) {	
		theForm.message.value = appletObj.getText();
	}

}

function resetAppletText() {

	getAppletObject().reset();

}

function getMessageLength(theform) {

	return getAppletObject().getTextLength();

}







var postmaxchars = 1000000;
function validate(theform) {
 getAppletText(theform);
 if (theform.message.value=="" || theform.topic.value=="") {
  alert("Thema- und Nachrichtfeld müssen ausgefüllt werden!");
  return false;
 }
 return messagetolong(theform);
}






function checklength(theform) {
 if (postmaxchars != 0) message = " Die maximale Grenze liegt bei "+postmaxchars+" Zeichen.";
 else message = "";
 
 var messageLength = getMessageLength(theform);
 alert("Ihre Nachricht ist "+messageLength+" Zeichen lang." + message);
}

function messagetolong(theform) {
 	if (postmaxchars != 0) {
  		var messageLength = getMessageLength(theform);
  		if (messageLength > postmaxchars) {
   			alert("Ihre Nachricht ist zu lang. Bitte reduzieren Sie Ihre Nachricht auf "+postmaxchars+" Zeichen. Momentan ist sie "+messageLength+" Zeichen lang.");
   			return false;
  		}
  		else {
  			return true;
  		}
 	} 
 	else {
 		return true;
 	}
}

function changeEditor(theForm, editorID) {
	getAppletText(theForm);
	theForm.change_editor.value = editorID;
	theForm.submit();	
}


activeMenu = false;
menuTimerRunning = false;
function toggleMenu(id, toggle) {
	if(document.getElementById) {
		if(id && toggle) {
			element = document.getElementById(id);
			status = element.style.display;
			if (!status || status == 'undefined' || status == 'none') {
				posLeft = getObjectPosLeft(toggle) + 10;
				element.style.left = posLeft + 'px';
				element.style.top = '0px';
				element.style.display = 'block';
				
				posTop = getObjectPosTop(toggle) + toggle.offsetHeight + 10;
				
				element.style.top = posTop + 'px';
				element.onmouseover = checkMenuTimer;
				element.onmouseout = startMenuTimer;
				activeMenu = id;
			}
			else {
				element.style.display = 'none';
				activeMenu = false;
			}
		}
		else if(activeMenu) {
			checkMenuTimer();
  			document.getElementById(activeMenu).style.display = 'none';
			activeMenu = false;
  		}
	}	
}

function getObjectPosLeft(element) {
	var left = element.offsetLeft;
	while((element = element.offsetParent) != null)	{
		left += element.offsetLeft;
	}
	return left;
}
function getObjectPosTop(element) {
	var top = element.offsetTop;
	while((element = element.offsetParent) != null)	{
		top += element.offsetTop;
	}
	return top;
}
function checkMenuTimer() {
	if(menuTimerRunning)  {
		clearTimeout(menuTimerRunning);
		menuTimerRunning = false;
	}
}
function startMenuTimer() {
	menuTimerRunning = setTimeout("toggleMenu()", 500);
}

//-->
</script>
{/literal}
			
<table cellpadding=4 cellspacing=1 border=0 class="tblborder" width="100%" align="center">
	<form action="index_sponsors.php?action={$action}&id={$id}{$url_und_sid}" name="bbform" method="post" onsubmit="return validate(this)">
	<tr class="tblhead">
		<td colspan="2">Admin Sponsoren</td>
	</tr>
	{if $fehler == 1} 
		<tr><td class="tblsectionhead" colspan="2">Die Benutzerdaten wurden Erfolgreich gespeichert. Wenn die Weiterleitung nicht funktioniert, <a href="{$page_redirect}">bitte hier klicken</a></td></tr>
	{/if}
	{if $fehler == 2} 
		<tr><td class="tblsectionhead" colspan="2" align="left"><font color="#FF0000">Fehler beim Speichern.</font></td></tr>
	{/if}
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Titel</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="titel" style="width:100%" value="{$titel}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">URL</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="url" style="width:100%" value="{$url}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">EMail</td>
		<td width="85%" class="tblsection" align="left"><input type="text" name="email" style="width:100%" value="{$email}"/></td>
	</tr>
	<tr>
		<td width="15%" class="tblsectionhead" align="left">Gallery Kategorie</td>
		<td width="85%" class="tblsection" align="left"><select name="bilddb_id">{$bilddb_id2}</select></td>
	</tr>
	<tr>
		<td colspan="2" width="100%" class="tblsection" align="left">	
			{literal}
			<object id="wysiwyg" classid="clsid:8AD9C840-044E-11D1-B3E9-00805F499D93" codebase="http://java.sun.com/products/plugin/autodl/jinstall-1_4_2-windows-i586.cab#Version=1,4,2,0" width="100%" height="450">
				<param name="code" value="com.woltlab.wbb.wysiwyg.WYSIWYG.class">
				<param name="codebase" value="." />
				<param name="archive" value="editor.jar" />
				<param name="type" value="application/x-java-applet;version=1.4.2">
				<param name="mayscript" value="true">
				<param name="model" value=models/hyaluronicacid.xyz>
				<param name="bgcolor" value="#E4EAF2" />
				<param name="css" value="p { margin: 0; padding: 0; } body { background-color: #E4EAF2; color: #000000; font-family: tahoma,helvetica; font-size: 13; } a { color: #000000; text-decoration: underline; }" />
				<param 
					name="smilies" 
					value=":burn 1^@~|Burn1^@~|http://www.rettungshundeforum.com/images/smilies/burn1.gif^@~|:d7^@~|Devil 7^@~|http://www.rettungshundeforum.com/images/smilies/d7.gif^@~|:d8^@~|Devil 8^@~|http://www.rettungshundeforum.com/images/smilies/d8.gif^@~|:d9^@~|Devil 9^@~|http://www.rettungshundeforum.com/images/smilies/d9.gif^@~|:dx10^@~|Devil 10^@~|http://www.rettungshundeforum.com/images/smilies/d10.gif^@~|:dx11^@~|Devil 11^@~|http://www.rettungshundeforum.com/images/smilies/d11.gif^@~|:dx12^@~|Devil 12^@~|http://www.rettungshundeforum.com/images/smilies/d12.gif^@~|:dx13^@~|Devil 13^@~|http://www.rettungshundeforum.com/images/smilies/d13.gif^@~|:dx14^@~|Devil 14^@~|http://www.rettungshundeforum.com/images/smilies/d14.gif^@~|:dx15^@~|Devil 15^@~|http://www.rettungshundeforum.com/images/smilies/d15.gif^@~|:dx16^@~|Devil 16^@~|http://www.rettungshundeforum.com/images/smilies/d16.gif^@~|:dx17^@~|Devil 17^@~|http://www.rettungshundeforum.com/images/smilies/d17.gif^@~|:d6^@~|Devil 6^@~|http://www.rettungshundeforum.com/images/smilies/d6.gif^@~|:d5^@~|Devil 5^@~|http://www.rettungshundeforum.com/images/smilies/d5.gif^@~|:d4^@~|Devil 4^@~|http://www.rettungshundeforum.com/images/smilies/d4.gif^@~|:coolgr^@~|Cool gr&uuml;n^@~|http://www.rettungshundeforum.com/images/smilies/coolgr.gif^@~|:coolred^@~|Cool rot^@~|http://www.rettungshundeforum.com/images/smilies/coolred.gif^@~|:sonne^@~|Sonnenschein^@~|http://www.rettungshundeforum.com/images/smilies/sonne.gif^@~|:birthday^@~|Geburtstag^@~|http://www.rettungshundeforum.com/images/smilies/birthday.gif^@~|:firedevil^@~|Feuerteufel^@~|http://www.rettungshundeforum.com/images/smilies/firedevil.gif^@~|:gap^@~|Zahnl&uuml;cke^@~|http://www.rettungshundeforum.com/images/smilies/gap.gif^@~|:bpl^@~|Blue Pleased^@~|http://www.rettungshundeforum.com/images/smilies/bluepleased.gif^@~|:wand^@~|Mit dem Kopf gegen die Wand...^@~|http://www.rettungshundeforum.com/images/smilies/wallbash.gif^@~|:d1^@~|Devil 1^@~|http://www.rettungshundeforum.com/images/smilies/d1.gif^@~|:d2^@~|Devil 2^@~|http://www.rettungshundeforum.com/images/smilies/d2.gif^@~|:d3^@~|Devil 3^@~|http://www.rettungshundeforum.com/images/smilies/d3.gif^@~|:dx18^@~|Devil 18^@~|http://www.rettungshundeforum.com/images/smilies/d18.gif^@~|:dx19^@~|Devil 19^@~|http://www.rettungshundeforum.com/images/smilies/d19.gif^@~|:dx20^@~|Devil 20^@~|http://www.rettungshundeforum.com/images/smilies/d20.gif^@~|:engel 1^@~|Engel1^@~|http://www.rettungshundeforum.com/images/smilies/engel.gif^@~|:engel 2^@~|Engel2^@~|http://www.rettungshundeforum.com/images/smilies/engel2.gif^@~|:whatever^@~|Whatever^@~|http://www.rettungshundeforum.com/images/smilies/whatever.gif^@~|:monster 1^@~|Monster1^@~|http://www.rettungshundeforum.com/images/smilies/monster1.gif^@~|:monster 2^@~|Monster2^@~|http://www.rettungshundeforum.com/images/smilies/monster2.gif^@~|:angryfire^@~|Angry Fire^@~|http://www.rettungshundeforum.com/images/smilies/angryfire.gif^@~|:applaus^@~|Applaus^@~|http://www.rettungshundeforum.com/images/smilies/applaus.gif^@~|:respekt^@~|Respekt!^@~|http://www.rettungshundeforum.com/images/smilies/respekt.gif^@~|:jb^@~|Jonny Bravo^@~|http://www.rettungshundeforum.com/images/smilies/jb.gif^@~|:love2^@~|Love 2^@~|http://www.rettungshundeforum.com/images/smilies/love2.gif^@~|:love1^@~|Love 1^@~|http://www.rettungshundeforum.com/images/smilies/love1.gif^@~|:schiel^@~|schiel^@~|http://www.rettungshundeforum.com/images/smilies/schiel.gif^@~|:elk^@~|Elch^@~|http://www.rettungshundeforum.com/images/smilies/elk.gif^@~|:ausheck^@~|ausheck^@~|http://www.rettungshundeforum.com/images/smilies/ausheck.gif^@~|:dx21^@~|Devil 21^@~|http://www.rettungshundeforum.com/images/smilies/d21.gif^@~|:dx22^@~|Devil 22^@~|http://www.rettungshundeforum.com/images/smilies/d22.gif^@~|:tup^@~|Daumen hoch^@~|http://www.rettungshundeforum.com/images/smilies/tup.gif^@~|:tdw^@~|Daumen runter^@~|http://www.rettungshundeforum.com/images/smilies/tdw.gif^@~|:rofl^@~|Roling on floor laughing^@~|http://www.rettungshundeforum.com/images/smilies/rofl.gif^@~|:idee^@~|:Idee^@~|http://www.rettungshundeforum.com/images/smilies/idee.gif^@~|:sure^@~|Sure...^@~|http://www.rettungshundeforum.com/images/smilies/sure.gif^@~|:chinese^@~|Chinese / Hasenz&auml;hne^@~|http://www.rettungshundeforum.com/images/smilies/chinese.gif^@~|:unsch^@~|Unschuldig^@~|http://www.rettungshundeforum.com/images/smilies/innocent.gif^@~|:dark^@~|Dark Smilie^@~|http://www.rettungshundeforum.com/images/smilies/dark.gif^@~|:cylon^@~|Cylon^@~|http://www.rettungshundeforum.com/images/smilies/cylon.gif^@~|:kiss^@~|kuss^@~|http://www.rettungshundeforum.com/images/smilies/kiss1.gif^@~|:DG^@~|gro&szlig;es Grinsen^@~|http://www.rettungshundeforum.com/images/smilies/biggrin.gif^@~|:sleep:^@~|schlafen^@~|http://www.rettungshundeforum.com/images/smilies/sleep.gif^@~|:dösen^@~|:D&ouml;sen^@~|http://www.rettungshundeforum.com/images/smilies/night.gif^@~|:looking^@~|Ui ui ui^@~|http://www.rettungshundeforum.com/images/smilies/looking.gif^@~|:tongue:^@~|Zunge raus^@~|http://www.rettungshundeforum.com/images/smilies/tongue2.gif^@~|:evil:^@~|Teufel^@~|http://www.rettungshundeforum.com/images/smilies/evil.gif^@~|:rolleyes:^@~|Augen rollen^@~|http://www.rettungshundeforum.com/images/smilies/rolleyes.gif^@~|;)^@~|Augenzwinkern^@~|http://www.rettungshundeforum.com/images/smilies/wink.gif^@~|:)^@~|smile^@~|http://www.rettungshundeforum.com/images/smilies/smile.gif^@~|X(^@~|b&ouml;se^@~|http://www.rettungshundeforum.com/images/smilies/mad.gif^@~|=)^@~|fr&ouml;hlich^@~|http://www.rettungshundeforum.com/images/smilies/happy.gif^@~|:(^@~|ungl&uuml;cklich^@~|http://www.rettungshundeforum.com/images/smilies/frown.gif^@~|8o^@~|geschockt^@~|http://www.rettungshundeforum.com/images/smilies/eek.gif^@~|;(^@~|traurig^@~|http://www.rettungshundeforum.com/images/smilies/crying.gif^@~|8:)^@~|cool^@~|http://www.rettungshundeforum.com/images/smilies/cool.gif^@~|?(^@~|verwirrt^@~|http://www.rettungshundeforum.com/images/smilies/confused.gif^@~|:O^@~|rotes Gesicht^@~|http://www.rettungshundeforum.com/images/smilies/redface.gif^@~|:]^@~|Freude^@~|http://www.rettungshundeforum.com/images/smilies/pleased.gif^@~|:hat1^@~|Kappe 1^@~|http://www.rettungshundeforum.com/images/smilies/hat1.gif^@~|:hat2^@~|Kappe 2^@~|http://www.rettungshundeforum.com/images/smilies/hat2.gif^@~|:hat3^@~|Kappe 3^@~|http://www.rettungshundeforum.com/images/smilies/hat3.gif^@~|:sick^@~|Krank^@~|http://www.rettungshundeforum.com/images/smilies/sick.gif^@~|:dead^@~|Toter Smilies^@~|http://www.rettungshundeforum.com/images/smilies/dead.gif^@~|:gaehn^@~|G&auml;hnender Smilie^@~|http://www.rettungshundeforum.com/images/smilies/gaehn.gif^@~|:geld^@~|Geld!?!?!^@~|http://www.rettungshundeforum.com/images/smilies/geld.gif^@~|:bounce:^@~|Bounce1^@~|http://www.rettungshundeforum.com/images/smilies/bounce1.gif^@~|:bounce2^@~|Bounce2^@~|http://www.rettungshundeforum.com/images/smilies/bounce2.gif^@~|:bounce3^@~|Bounce3^@~|http://www.rettungshundeforum.com/images/smilies/bounce3.gif^@~|:bounce 4^@~|Bounce4^@~|http://www.rettungshundeforum.com/images/smilies/bounce4.gif^@~|:bounce 5^@~|Bounce5^@~|http://www.rettungshundeforum.com/images/smilies/bounce5.gif^@~|:flame 2^@~|Flame2^@~|http://www.rettungshundeforum.com/images/smilies/flame2.gif^@~|:flame 1^@~|Flame1^@~|http://www.rettungshundeforum.com/images/smilies/flame1.gif^@~|:-)^@~|Grins in gr&uuml;n^@~|http://www.rettungshundeforum.com/images/smilies/biggringruen.gif^@~|:baby:^@~|Baby^@~|http://www.rettungshundeforum.com/images/smilies/baby.gif^@~|:multikill^@~|Hilfe die Killen mich!^@~|http://www.rettungshundeforum.com/images/smilies/multikiller.gif^@~|:P^@~|Zunge raus^@~|http://www.rettungshundeforum.com/images/smilies/tongue.gif^@~|:angst^@~|Angst^@~|http://www.rettungshundeforum.com/images/smilies/angst.gif^@~|:wow^@~|WoW!^@~|http://www.rettungshundeforum.com/images/smilies/wow.gif^@~|:skull1^@~|Totenkopf 1^@~|http://www.rettungshundeforum.com/images/smilies/skull1.gif^@~|:fett^@~|Boba Fett^@~|http://www.rettungshundeforum.com/images/smilies/fett.gif^@~|:borg^@~|Borg^@~|http://www.rettungshundeforum.com/images/smilies/borg.gif^@~|:alien4^@~|Alien4^@~|http://www.rettungshundeforum.com/images/smilies/alien4.gif^@~|:alien3^@~|Alien3^@~|http://www.rettungshundeforum.com/images/smilies/alien3.gif^@~|:alien2^@~|Alien2^@~|http://www.rettungshundeforum.com/images/smilies/alien2.gif^@~|:trooper^@~|Stormtrooper^@~|http://www.rettungshundeforum.com/images/smilies/trooper.gif^@~|:vader^@~|Darth Vader^@~|http://www.rettungshundeforum.com/images/smilies/vader.gif^@~|:rebel^@~|Rebel^@~|http://www.rettungshundeforum.com/images/smilies/rebel.gif^@~|:jawa^@~|Jawa^@~|http://www.rettungshundeforum.com/images/smilies/jawa.gif^@~|:alien5^@~|Alien5^@~|http://www.rettungshundeforum.com/images/smilies/alien5.gif^@~|:§$%^@~|fluchen^@~|http://www.rettungshundeforum.com/images/smilies/cussing.gif^@~|:mua^@~|muharhar^@~|http://www.rettungshundeforum.com/images/smilies/muhaha.gif^@~|:Amidala^@~|Amidala^@~|http://www.rettungshundeforum.com/images/smilies/amidala.gif^@~|:skull4^@~|Totenkopf 4^@~|http://www.rettungshundeforum.com/images/smilies/skull4.gif^@~|:achdufresse^@~|Ach du Fresse!^@~|http://www.rettungshundeforum.com/images/smilies/fresse.gif^@~|:skull3^@~|Totenkopf 3^@~|http://www.rettungshundeforum.com/images/smilies/skull3.gif^@~|:skull2^@~|Totenkopf 2^@~|http://www.rettungshundeforum.com/images/smilies/skull2.gif" />
		
				<param name="languages" value="Ladevorgang läuft...|Editor|Quellcode|Link einfügen|Bitte tragen Sie die gewünschte E-Mail-Adresse ein:|Bitte tragen Sie die gewünschte URL ein:|Bild einfügen|Bitte tragen Sie die URL zum gewünschten Bild ein:|Schriftfarbe|Schriftfarbe auswählen|In Zwischenablage ausschneiden|In Zwischenablage kopieren|Aus Zwischenablage einfügen|Rückgängig|Wiederherstellen|Fettdruck|Kursivdruck|Unterstrichen|Linksbündig|Zentriert|Rechtsbündig|Nummerierung einfügen|Aufzählung einfügen|E-Mail-Adresse einfügen|Hyperlink einfügen|Bild einfügen|Zitat Tag einfügen|Code Tag einfügen|PHP Tag einfügen" />
				<comment>
				<embed 
					id="embed_wysiwyg" 
					languages="Ladevorgang läuft...|Editor|Quellcode|Link einfügen|Bitte tragen Sie die gewünschte E-Mail-Adresse ein:|Bitte tragen Sie die gewünschte URL ein:|Bild einfügen|Bitte tragen Sie die URL zum gewünschten Bild ein:|Schriftfarbe|Schriftfarbe auswählen|In Zwischenablage ausschneiden|In Zwischenablage kopieren|Aus Zwischenablage einfügen|Rückgängig|Wiederherstellen|Fettdruck|Kursivdruck|Unterstrichen|Linksbündig|Zentriert|Rechtsbündig|Nummerierung einfügen|Aufzählung einfügen|E-Mail-Adresse einfügen|Hyperlink einfügen|Bild einfügen|Zitat Tag einfügen|Code Tag einfügen|PHP Tag einfügen" 
					bgcolor="#E4EAF2" 
					smilies=":burn 1^@~|Burn1^@~|http://www.rettungshundeforum.com/images/smilies/burn1.gif^@~|:d7^@~|Devil 7^@~|http://www.rettungshundeforum.com/images/smilies/d7.gif^@~|:d8^@~|Devil 8^@~|http://www.rettungshundeforum.com/images/smilies/d8.gif^@~|:d9^@~|Devil 9^@~|http://www.rettungshundeforum.com/images/smilies/d9.gif^@~|:dx10^@~|Devil 10^@~|http://www.rettungshundeforum.com/images/smilies/d10.gif^@~|:dx11^@~|Devil 11^@~|http://www.rettungshundeforum.com/images/smilies/d11.gif^@~|:dx12^@~|Devil 12^@~|http://www.rettungshundeforum.com/images/smilies/d12.gif^@~|:dx13^@~|Devil 13^@~|http://www.rettungshundeforum.com/images/smilies/d13.gif^@~|:dx14^@~|Devil 14^@~|http://www.rettungshundeforum.com/images/smilies/d14.gif^@~|:dx15^@~|Devil 15^@~|http://www.rettungshundeforum.com/images/smilies/d15.gif^@~|:dx16^@~|Devil 16^@~|http://www.rettungshundeforum.com/images/smilies/d16.gif^@~|:dx17^@~|Devil 17^@~|http://www.rettungshundeforum.com/images/smilies/d17.gif^@~|:d6^@~|Devil 6^@~|http://www.rettungshundeforum.com/images/smilies/d6.gif^@~|:d5^@~|Devil 5^@~|http://www.rettungshundeforum.com/images/smilies/d5.gif^@~|:d4^@~|Devil 4^@~|http://www.rettungshundeforum.com/images/smilies/d4.gif^@~|:coolgr^@~|Cool gr&uuml;n^@~|http://www.rettungshundeforum.com/images/smilies/coolgr.gif^@~|:coolred^@~|Cool rot^@~|http://www.rettungshundeforum.com/images/smilies/coolred.gif^@~|:sonne^@~|Sonnenschein^@~|http://www.rettungshundeforum.com/images/smilies/sonne.gif^@~|:birthday^@~|Geburtstag^@~|http://www.rettungshundeforum.com/images/smilies/birthday.gif^@~|:firedevil^@~|Feuerteufel^@~|http://www.rettungshundeforum.com/images/smilies/firedevil.gif^@~|:gap^@~|Zahnl&uuml;cke^@~|http://www.rettungshundeforum.com/images/smilies/gap.gif^@~|:bpl^@~|Blue Pleased^@~|http://www.rettungshundeforum.com/images/smilies/bluepleased.gif^@~|:wand^@~|Mit dem Kopf gegen die Wand...^@~|http://www.rettungshundeforum.com/images/smilies/wallbash.gif^@~|:d1^@~|Devil 1^@~|http://www.rettungshundeforum.com/images/smilies/d1.gif^@~|:d2^@~|Devil 2^@~|http://www.rettungshundeforum.com/images/smilies/d2.gif^@~|:d3^@~|Devil 3^@~|http://www.rettungshundeforum.com/images/smilies/d3.gif^@~|:dx18^@~|Devil 18^@~|http://www.rettungshundeforum.com/images/smilies/d18.gif^@~|:dx19^@~|Devil 19^@~|http://www.rettungshundeforum.com/images/smilies/d19.gif^@~|:dx20^@~|Devil 20^@~|http://www.rettungshundeforum.com/images/smilies/d20.gif^@~|:engel 1^@~|Engel1^@~|http://www.rettungshundeforum.com/images/smilies/engel.gif^@~|:engel 2^@~|Engel2^@~|http://www.rettungshundeforum.com/images/smilies/engel2.gif^@~|:whatever^@~|Whatever^@~|http://www.rettungshundeforum.com/images/smilies/whatever.gif^@~|:monster 1^@~|Monster1^@~|http://www.rettungshundeforum.com/images/smilies/monster1.gif^@~|:monster 2^@~|Monster2^@~|http://www.rettungshundeforum.com/images/smilies/monster2.gif^@~|:angryfire^@~|Angry Fire^@~|http://www.rettungshundeforum.com/images/smilies/angryfire.gif^@~|:applaus^@~|Applaus^@~|http://www.rettungshundeforum.com/images/smilies/applaus.gif^@~|:respekt^@~|Respekt!^@~|http://www.rettungshundeforum.com/images/smilies/respekt.gif^@~|:jb^@~|Jonny Bravo^@~|http://www.rettungshundeforum.com/images/smilies/jb.gif^@~|:love2^@~|Love 2^@~|http://www.rettungshundeforum.com/images/smilies/love2.gif^@~|:love1^@~|Love 1^@~|http://www.rettungshundeforum.com/images/smilies/love1.gif^@~|:schiel^@~|schiel^@~|http://www.rettungshundeforum.com/images/smilies/schiel.gif^@~|:elk^@~|Elch^@~|http://www.rettungshundeforum.com/images/smilies/elk.gif^@~|:ausheck^@~|ausheck^@~|http://www.rettungshundeforum.com/images/smilies/ausheck.gif^@~|:dx21^@~|Devil 21^@~|http://www.rettungshundeforum.com/images/smilies/d21.gif^@~|:dx22^@~|Devil 22^@~|http://www.rettungshundeforum.com/images/smilies/d22.gif^@~|:tup^@~|Daumen hoch^@~|http://www.rettungshundeforum.com/images/smilies/tup.gif^@~|:tdw^@~|Daumen runter^@~|http://www.rettungshundeforum.com/images/smilies/tdw.gif^@~|:rofl^@~|Roling on floor laughing^@~|http://www.rettungshundeforum.com/images/smilies/rofl.gif^@~|:idee^@~|:Idee^@~|http://www.rettungshundeforum.com/images/smilies/idee.gif^@~|:sure^@~|Sure...^@~|http://www.rettungshundeforum.com/images/smilies/sure.gif^@~|:chinese^@~|Chinese / Hasenz&auml;hne^@~|http://www.rettungshundeforum.com/images/smilies/chinese.gif^@~|:unsch^@~|Unschuldig^@~|http://www.rettungshundeforum.com/images/smilies/innocent.gif^@~|:dark^@~|Dark Smilie^@~|http://www.rettungshundeforum.com/images/smilies/dark.gif^@~|:cylon^@~|Cylon^@~|http://www.rettungshundeforum.com/images/smilies/cylon.gif^@~|:kiss^@~|kuss^@~|http://www.rettungshundeforum.com/images/smilies/kiss1.gif^@~|:DG^@~|gro&szlig;es Grinsen^@~|http://www.rettungshundeforum.com/images/smilies/biggrin.gif^@~|:sleep:^@~|schlafen^@~|http://www.rettungshundeforum.com/images/smilies/sleep.gif^@~|:dösen^@~|:D&ouml;sen^@~|http://www.rettungshundeforum.com/images/smilies/night.gif^@~|:looking^@~|Ui ui ui^@~|http://www.rettungshundeforum.com/images/smilies/looking.gif^@~|:tongue:^@~|Zunge raus^@~|http://www.rettungshundeforum.com/images/smilies/tongue2.gif^@~|:evil:^@~|Teufel^@~|http://www.rettungshundeforum.com/images/smilies/evil.gif^@~|:rolleyes:^@~|Augen rollen^@~|http://www.rettungshundeforum.com/images/smilies/rolleyes.gif^@~|;)^@~|Augenzwinkern^@~|http://www.rettungshundeforum.com/images/smilies/wink.gif^@~|:)^@~|smile^@~|http://www.rettungshundeforum.com/images/smilies/smile.gif^@~|X(^@~|b&ouml;se^@~|http://www.rettungshundeforum.com/images/smilies/mad.gif^@~|=)^@~|fr&ouml;hlich^@~|http://www.rettungshundeforum.com/images/smilies/happy.gif^@~|:(^@~|ungl&uuml;cklich^@~|http://www.rettungshundeforum.com/images/smilies/frown.gif^@~|8o^@~|geschockt^@~|http://www.rettungshundeforum.com/images/smilies/eek.gif^@~|;(^@~|traurig^@~|http://www.rettungshundeforum.com/images/smilies/crying.gif^@~|8:)^@~|cool^@~|http://www.rettungshundeforum.com/images/smilies/cool.gif^@~|?(^@~|verwirrt^@~|http://www.rettungshundeforum.com/images/smilies/confused.gif^@~|:O^@~|rotes Gesicht^@~|http://www.rettungshundeforum.com/images/smilies/redface.gif^@~|:]^@~|Freude^@~|http://www.rettungshundeforum.com/images/smilies/pleased.gif^@~|:hat1^@~|Kappe 1^@~|http://www.rettungshundeforum.com/images/smilies/hat1.gif^@~|:hat2^@~|Kappe 2^@~|http://www.rettungshundeforum.com/images/smilies/hat2.gif^@~|:hat3^@~|Kappe 3^@~|http://www.rettungshundeforum.com/images/smilies/hat3.gif^@~|:sick^@~|Krank^@~|http://www.rettungshundeforum.com/images/smilies/sick.gif^@~|:dead^@~|Toter Smilies^@~|http://www.rettungshundeforum.com/images/smilies/dead.gif^@~|:gaehn^@~|G&auml;hnender Smilie^@~|http://www.rettungshundeforum.com/images/smilies/gaehn.gif^@~|:geld^@~|Geld!?!?!^@~|http://www.rettungshundeforum.com/images/smilies/geld.gif^@~|:bounce:^@~|Bounce1^@~|http://www.rettungshundeforum.com/images/smilies/bounce1.gif^@~|:bounce2^@~|Bounce2^@~|http://www.rettungshundeforum.com/images/smilies/bounce2.gif^@~|:bounce3^@~|Bounce3^@~|http://www.rettungshundeforum.com/images/smilies/bounce3.gif^@~|:bounce 4^@~|Bounce4^@~|http://www.rettungshundeforum.com/images/smilies/bounce4.gif^@~|:bounce 5^@~|Bounce5^@~|http://www.rettungshundeforum.com/images/smilies/bounce5.gif^@~|:flame 2^@~|Flame2^@~|http://www.rettungshundeforum.com/images/smilies/flame2.gif^@~|:flame 1^@~|Flame1^@~|http://www.rettungshundeforum.com/images/smilies/flame1.gif^@~|:-)^@~|Grins in gr&uuml;n^@~|http://www.rettungshundeforum.com/images/smilies/biggringruen.gif^@~|:baby:^@~|Baby^@~|http://www.rettungshundeforum.com/images/smilies/baby.gif^@~|:multikill^@~|Hilfe die Killen mich!^@~|http://www.rettungshundeforum.com/images/smilies/multikiller.gif^@~|:P^@~|Zunge raus^@~|http://www.rettungshundeforum.com/images/smilies/tongue.gif^@~|:angst^@~|Angst^@~|http://www.rettungshundeforum.com/images/smilies/angst.gif^@~|:wow^@~|WoW!^@~|http://www.rettungshundeforum.com/images/smilies/wow.gif^@~|:skull1^@~|Totenkopf 1^@~|http://www.rettungshundeforum.com/images/smilies/skull1.gif^@~|:fett^@~|Boba Fett^@~|http://www.rettungshundeforum.com/images/smilies/fett.gif^@~|:borg^@~|Borg^@~|http://www.rettungshundeforum.com/images/smilies/borg.gif^@~|:alien4^@~|Alien4^@~|http://www.rettungshundeforum.com/images/smilies/alien4.gif^@~|:alien3^@~|Alien3^@~|http://www.rettungshundeforum.com/images/smilies/alien3.gif^@~|:alien2^@~|Alien2^@~|http://www.rettungshundeforum.com/images/smilies/alien2.gif^@~|:trooper^@~|Stormtrooper^@~|http://www.rettungshundeforum.com/images/smilies/trooper.gif^@~|:vader^@~|Darth Vader^@~|http://www.rettungshundeforum.com/images/smilies/vader.gif^@~|:rebel^@~|Rebel^@~|http://www.rettungshundeforum.com/images/smilies/rebel.gif^@~|:jawa^@~|Jawa^@~|http://www.rettungshundeforum.com/images/smilies/jawa.gif^@~|:alien5^@~|Alien5^@~|http://www.rettungshundeforum.com/images/smilies/alien5.gif^@~|:§$%^@~|fluchen^@~|http://www.rettungshundeforum.com/images/smilies/cussing.gif^@~|:mua^@~|muharhar^@~|http://www.rettungshundeforum.com/images/smilies/muhaha.gif^@~|:Amidala^@~|Amidala^@~|http://www.rettungshundeforum.com/images/smilies/amidala.gif^@~|:skull4^@~|Totenkopf 4^@~|http://www.rettungshundeforum.com/images/smilies/skull4.gif^@~|:achdufresse^@~|Ach du Fresse!^@~|http://www.rettungshundeforum.com/images/smilies/fresse.gif^@~|:skull3^@~|Totenkopf 3^@~|http://www.rettungshundeforum.com/images/smilies/skull3.gif^@~|:skull2^@~|Totenkopf 2^@~|http://www.rettungshundeforum.com/images/smilies/skull2.gif" 
					css="p { margin: 0; padding: 0; } body { background-color: #E4EAF2; color: #000000; font-family: tahoma,helvetica; font-size: 13; } a { color: #000000; text-decoration: underline; }" 
					type="application/x-java-applet;version=1.4.2" 
					code="com.woltlab.wbb.wysiwyg.WYSIWYG.class" 
					codebase="." 
					archive="editor.jar" 
					width="100%" 
					height="450" 
					model="models/hyaluronicacid.xyz" 
					mayscript="true" 
					pluginspage="http://java.sun.com/products/plugin/index.html#download">
				</embed>
				</comment>
			</object>
			{/literal}
			<br />
    	<input type="hidden" name="message" value="{$text}" /></td>
	</tr>
	<tr class="tblsection">
		<td align="center" colspan="2"><input type="hidden" name="send" value="true" /><input type="submit" value="Speichern" /></td>
	</tr>
	</form>
</table>
												
{include file="_footer.tpl.php" title=foo}
<!--

var IE = document.all?true:false
if (!IE) document.captureEvents(Event.MOUSEMOVE)
document.onmousemove = getMouseXY;
var tempX = 0
var tempY = 0

function jumplink(sid, template) {
    ziel="database.php?tempid="+template+sid+"&ref="+document.formjahr.page.options[document.formjahr.page.selectedIndex].value;
    if(ziel == "")return;
    parent.window.location=ziel;
  }

function jump() {
    ziel=document.formjahr.selectjahr.options[document.formjahr.selectjahr.selectedIndex].value;
    if(ziel == "")return;
    parent.window.location=ziel;
  }
  
function jump2() {
    ziel=document.formjahr2.selecttype.options[document.formjahr2.selecttype.selectedIndex].value;
    if(ziel == "")return;
    parent.window.location=ziel;
  }
  
  function jump3() {
    ziel=document.formjahr3.presse.options[document.formjahr3.presse.selectedIndex].value;
    if(ziel == "")return;
    parent.window.location=ziel;
  }

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_showHideLayers() { //v3.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v='hide')?'hidden':v; }
    obj.visibility=v; }
}


function allOff() {
	MM_showHideLayers('topdropA','','hide');
	MM_showHideLayers('topdropB','','hide');
	MM_showHideLayers('topdropC','','hide');
	MM_showHideLayers('topdropD','','hide');
	MM_showHideLayers('topdropE','','hide');
	MM_showHideLayers('topdropF','','hide');
}

function getMouseXY(e) {
	  if (IE) { // grab the x-y pos.s if browser is IE
		tempX = event.clientX + document.body.scrollLeft
		tempY = event.clientY + document.body.scrollTop
	  } else {  // grab the x-y pos.s if browser is NS
		tempX = e.pageX
		tempY = e.pageY
	  }  
	  if (tempX < 0){tempX = 0}
	  if (tempY < 0){tempY = 0}  

	 // layer off!!!!
	 if(tempY < 100)
	 {
		allOff();	
	 }
	 	 // layer off!!!!
	 if(tempY > 400)
	 {
		allOff();	
	 }
	  return true
}


function OpenPicture(ziel) {
	window.open(ziel,'Bilder_BRK_RHS_Ansbach','left=5,top=5,width=1000,height=700,resizable=yes,menubar=no,toolbar=no,location=no,directories=no,scrollbars=yes,status=no');
}

function MM_openBrWindow(theURL,winName,features) { //v2.0
	window.open(theURL,winName,features);
}


function rhfchat()
{
	window.open('http://www.rettungshundeforum.com/mod_chat.php?id=rdog','brkchat','left=30,top=10,width=700,height=650,resizable=YES,menubar=no,toolbar=no,location=no,directories=no,scrollbars=YES,status=no');
}
	
function forum()
{
	window.open('http://www.rettungshundeforum.com','rhf','left=30,top=100,width=500,height=500,resizable=yes,menubar=yes,toolbar=yes,location=yes,directories=yes,scrollbars=yes,status=yes');
}
	
function smilie(smiliecode) {
	document.postform.mymassage.value += smiliecode+" ";
	document.postform.mymassage.focus();
}


function hastofields() {


	var val = document.forms[0].pw.value;	
	if (val == "" || val.length<4) {
		alert ("Bitte geben Sie ein Passwort an, dass mindestens 4 Zeichen lang ist!");
		document.forms[0].pw.focus();
		return false;
	}
	
	var val = document.forms[0].email.value;	
	if (val == "" || val == "@" || val.length<4 || val.indexOf("@") < 0) {
		alert ("Bitte geben Sie eine gültige EMail Adresse an!");
		document.forms[0].email.focus();
		return false;
	}

	var val = document.forms[0].payment_id.value;	
	if (val == "-1") {
		alert ("Bitte wählen Sie Ihre Zahlungsweise aus!");
		document.forms[0].payment_id.focus();
		return false;
	}
	
	var val = document.forms[0].name.value;	
	if (val == "") {
		alert ("Bitte geben Sie Ihren Namen an!");
		document.forms[0].name.focus();
		return false;
	}
	
	var val = document.forms[0].surname.value;	
	if (val == "") {
		alert ("Bitte geben Sie Ihren Vornamen an!");
		document.forms[0].surname.focus();
		return false;
	}
	
	zahlen[0]="0";
	zahlen[1]="1";
	zahlen[2]="2";
	zahlen[3]="3";
	zahlen[4]="4";
	zahlen[5]="5";
	zahlen[6]="6";
	zahlen[7]="7";
	zahlen[8]="8";
	zahlen[9]="9";
	found=0;
	for (i=0; i<=(zahlen.length-1); i+=1){
		for (izip=0; izip<=(l_zip.length-1); zip+=1){
			if(l_zip.substr(izip, 1)==zahlen[i]){
				i=(zahlen.length-1);
				izip=(l_zip.length-1);
				found=1;
			}
		}
	}
	if(found==0){
		alert ("Bitte geben Sie eine gültige Postleitzahl der Lieferadresse an! (Die Postleitzahl darf nur Zahlen enthalten und nicht mehr als 5 Zahlen lang sein)");
		document.forms[0].l_zip.focus();
		return false;
	}
	
	var val = document.forms[0].r_zip.value;	
	if (val != "") {
		found=0;
		for (i=0; i<=(zahlen.length-1); i+=1){
			for (izip=0; izip<=(r_zip.length-1); zip+=1){
				if(r_zip.substr(izip, 1)==zahlen[i]){
					i=(zahlen.length-1);
					izip=(r_zip.length-1);
					found=1;
				}
			}
		}
		if(found==0){
			alert ("Bitte geben Sie eine gültige Postleitzahl der Rechnungsadresse an! (Die Postleitzahl darf nur Zahlen enthalten und nicht mehr als 5 Zahlen lang sein)");
			document.forms[0].r_zip.focus();
			return false;
		}
	}
	
	var val = document.forms[0].l_city.value;	
	if (val == "") {
		alert ("Bitte geben Sie die Stadt der Lieferadresse an!");
		document.forms[0].l_city.focus();
		return false;
	}
	
	var val = document.forms[0].l_street.value;	
	if (val == "") {
		alert ("Bitte geben Sie die Strasse der Lieferadresse an!");
		document.forms[0].l_street.focus();
		return false;
	}
			
	return true;
}
//-->
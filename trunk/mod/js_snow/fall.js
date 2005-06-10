// Fall v1.7a  By Maxx Blade - http://www.maxxblade.co.uk
var snow_fallg=new Array();

/////////////  Only Edit these lines  ////////////////
var snow_no=20, snow_speed=30, snow_slider=30, snow_fallmax=8, snow_wind=1;
snow_fallg[0]=new Array("./images/mod/snowflake/snowflake.gif",25,28,1);
snow_fallg[1]=new Array("./images/mod/snowflake/snowflake2.gif",25,28,0);
snow_fallg[2]=new Array("./images/mod/snowflake/snowflake3.gif",25,28,1);
snow_fallg[3]=new Array("./images/mod/snowflake/flake1.gif",27,29,1);
snow_fallg[4]=new Array("./images/mod/snowflake/flake2.gif",15,12,0);
snow_fallg[5]=new Array("./images/mod/snowflake/flake3.gif",40,40,1);
snow_fallg[6]=new Array("./images/mod/snowflake/flake4.gif",46,51,0);
snow_fallg[7]=new Array("./images/mod/snowflake/flake5.gif" ,35,40,1);

//////////////////////////////////////////////////////////////////
// Don't Edit Below Here Unless You Know What You're Doing ?;o) //
//////////////////////////////////////////////////////////////////
var snow_o=new Array(), snow_tog=1;
var snow_ns4 = (document.layers) ? true : false;
var snow_ie4 = (document.all) ? true : false;
var snow_ns6 = (document.getElementById&&!document.all) ? true : false;

if(snow_ie4) snow_falllayer="document.all['gf'+i].style";
if(snow_ns4) snow_falllayer="document.layers['gf'+i]";
if(snow_ns6) snow_falllayer="document.getElementById('gf'+i).style";

function snow_winWid(){ return (snow_ns4||snow_ns6) ? window.innerWidth : document.body.clientWidth; }
function snow_winHei(){ return (snow_ns4||snow_ns6) ? window.innerHeight : document.body.clientHeight; }
function snow_winOfy(){ return (snow_ns4||snow_ns6) ? window.pageYOffset : document.body.scrollTop; }

function snow_togFall(){
	if (snow_tog==1){
		clearTimeout(dofall);
		for (i = 0; i < snow_no; i++) { with(eval(snow_falllayer)){ top = 0; left = -500; } }
		snow_tog=0;
	}else{
		snow_tog=1;
		snow_fall();
	}
}
function snow_newobj(q,t){
	x=parseInt(Math.random()*snow_fallg.length);
	snow_spin = parseInt(Math.random()*snow_slider);
	snow_spin = (Math.random()>0.5) ? snow_spin : -snow_spin;
	snow_o[q] = new Array(parseInt(Math.random()*(snow_winWid()-snow_slider)),-30,snow_spin,0.02+Math.random()/10,parseInt(1+Math.random()*snow_fallmax),snow_fallg[x][1],snow_fallg[x][2],snow_fallg[x][0],snow_fallg[x][3],0);
	if(t==1){
		if(snow_ns4){ document.write('<layer name="gf'+q+'" left="0" top="0" visibility="show"><img src="'+snow_o[q][7]+'" border="0"></layer>'); }
		if(snow_ie4||snow_ns6){ document.write('<img src="'+snow_o[q][7]+'" border="0" id="gf'+q+'" style="POSITION: absolute; Z-INDEX: -'+q+'; VISIBILITY: visible; TOP: 0px; LEFT: 0px;">'); }
	}
	if(t==0 && !snow_ns4){
	  tem=(snow_ie4)?document.all['gf'+q]:document.getElementById('gf'+q);
	  tem.src=snow_o[q][7];
	}
}

function snow_fall(){
	for (i = 0; i < snow_no; i++) {
		if((snow_o[i][1]>snow_winHei()-snow_o[i][6]-10)||(snow_o[i][0]>snow_winWid()-snow_slider-snow_o[i][5])){ snow_newobj(i,0); }
		snow_o[i][1] += snow_o[i][4];
		snow_o[i][0]+=snow_wind;
		snow_o[i][9] += snow_o[i][3];
		snow_sizexy=(snow_o[i][8]==1)?Math.sin(snow_o[i][9]):1;
		snow_lay=(snow_ie4)?snow_sizexy:parseInt(snow_sizexy+1);
		with(eval(snow_falllayer)){
			top = snow_o[i][1]+snow_winOfy();
			left = snow_o[i][0]+snow_o[i][2]*Math.cos(snow_o[i][9]);
			if(!snow_ns4){
				zIndex=snow_lay;
				width = parseInt(((snow_o[i][5]/4)*3)+((snow_o[i][5]/4)*snow_sizexy));
				height = parseInt(((snow_o[i][6]/4)*3)+((snow_o[i][6]/4)*snow_sizexy));
			}
		}
	}
	dofall = setTimeout("snow_fall()", snow_speed);
}
for (i = 0; i < snow_no; i++){ snow_newobj(i,1); }

dofall = setTimeout("snow_fall()", 100);

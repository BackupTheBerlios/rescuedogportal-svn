function wrap_parent (text,icon) {
	return [['<table cellpadding=1 cellspacing=0 border=0 width=100%><tr><td bgcolor=#000000><img height=16 src=', icon !=null ? imgpathforme+'bilder/mod/menu/' + icon: imgpathforme+'mod/js_menu/pixel.gif width=16', ' hspace=3></td><td width=100%><table cellpadding=1 cellspacing=0 border=0 width=100% height=22><tr><td class=a0>&nbsp; ', text, '</td></tr></table></td><td><img src='+imgpathforme+'bilder/mod/menu/arr.gif width=4 height=7 align="middle" align=absmiddle hspace=3></td></tr></table>'].join(''),
	['<table cellpadding=1 cellspacing=0 border=0 width=100% bgcolor=#c6c6c6><tr><td><table cellpadding=1 cellspacing=0 border=0 width=100% height=22 bgcolor=#666666><tr><td><img height=16 src=', icon !=null ? imgpathforme+'bilder/mod/menu/' + icon: imgpathforme+'mod/js_menu/pixel.gif width=16', ' hspace=3></td><td width=100% class=a0>&nbsp; ', text, '</td><td><img src='+imgpathforme+'bilder/mod/menu/arr.gif width=4 height=7 align="middle" align=absmiddle hspace=3></td></tr></table></td></tr></table>'].join(''),
	['<table cellpadding=1 cellspacing=0 border=0 width=100% bgcolor=#c6c6c6><tr><td><table cellpadding=1 cellspacing=0 border=0 width=100% height=22 bgcolor=#666666><tr><td><img height=16 src=', icon !=null ? imgpathforme+'bilder/mod/menu/' + icon: imgpathforme+'mod/js_menu/pixel.gif width=16', ' hspace=3></td><td width=100% class=a0>&nbsp; ', text, '</td><td><img src='+imgpathforme+'bilder/mod/menu/arr.gif width=4 height=7 align="middle" align=absmiddle hspace=3></td></tr></table></td></tr></table>'].join('')
	];
}

function wrap_child (text,icon) {
	return [['<table cellpadding=1 cellspacing=0 border=0 width=100%><tr><td bgcolor=#000000><img height=16 src=', icon !=null ? imgpathforme+'bilder/mod/menu/' + icon: imgpathforme+'mod/js_menu/pixel.gif width=15', ' hspace=3></td><td width=100%><table cellpadding=1 cellspacing=0 border=0 width=100% height=22><tr><td class=a0>&nbsp; ', text, '</td></tr></table></td></tr></table>'].join(''),
	['<table cellpadding=1 cellspacing=0 border=0 width=100% bgcolor=#c6c6c6><tr><td><table cellpadding=1 cellspacing=0 border=0 width=100% height=22 bgcolor=#666666><tr><td><img height=16 src=', icon !=null ? imgpathforme+'bilder/mod/menu/' + icon: imgpathforme+'mod/js_menu/pixel.gif width=16', ' hspace=3></td><td width=99% class=a0>&nbsp; ', text, '</td></tr></table></td></tr></table>'].join(''),
	['<table cellpadding=1 cellspacing=0 border=0 width=100% bgcolor=#c6c6c6><tr><td><table cellpadding=1 cellspacing=0 border=0 width=100% height=22 bgcolor=#666666><tr><td><img height=16 src=', icon !=null ? imgpathforme+'bilder/mod/menu/' + icon: imgpathforme+'mod/js_menu/pixel.gif width=16', ' hspace=3></td><td width=99% class=a0>&nbsp; ', text, '</td></tr></table></td></tr></table>'].join('')
	];
}

function wrap_root (text) {
	return [
	'<table cellpadding=1 cellspacing=0 border=0 width=100%><tr><td><table cellpadding=0 cellspacing=0 border=0 width=100% height=21><tr><td width=100% class=a0 align="center">&nbsp; ' + text + ' &nbsp;</td></tr></table></td></tr></table>',
	'<table cellpadding=1 cellspacing=0 border=0 width=100% bgcolor=#c6c6c6><tr><td><table cellpadding=0 cellspacing=0 border=0 width=100% height=21><tr><td width=100% class=a1 align="center">&nbsp; ' + text + ' &nbsp;</td></tr></table></td></tr></table>',
	'<table cellpadding=1 cellspacing=0 border=0 width=100% bgcolor=#c6c6c6><tr><td><table cellpadding=0 cellspacing=0 border=0 width=100% height=21><tr><td width=100% class=a1 align="center">&nbsp; ' + text + ' &nbsp;</td></tr></table></td></tr></table>'
	];
}
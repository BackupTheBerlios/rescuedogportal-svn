var MENU_POS_XP=[
// Level 0 block configuration
{ 	
	// Item's height in pixels
	'height'     : 22,
	// Item's width in pixels
	'width'      : 105,
	// if Block Orientation is vertical
	'vertical'   : false,
	// Time Delay in milliseconds before subling block expands after mouse pointer overs an item
	'expd_delay' : 300,
	// Style class names for the level
	'css': {
		// Block outing table class
		'table' : 'mXPl0',
		// Item outer tag style class for all item states or
		// classes for [<default state>, <hovered state>, <clicked state>]
		'outer' : ['mXPl0mouto','',''],
		// Item inner tag style class for all item states or
		// classes for [<default state>, <hovered state>, <clicked state>]
		'inner' : ''
	}
},
// Level 1 block configuration
{
	'width'      : 250,
	'height'     : 24,
	// Vertical Offset between adjacent levels in pixels
	'block_top'  : 25,
	// Horizontal Offset between adjacent levels in pixels
	'block_left' : 0,
	'wise_pos'   : 2,
	'vertical'   : true,
	'transition' : [0, 0.3, 0, 0.3],
	// Time Delay in milliseconds before menu collapses after mouse pointer lefts all items
	'hide_delay' : 500,
	'css' : {
		'table' : 'mXPl1',
		'outer' : '',
		'inner' : ''
	}
},
// Level 2 block configuration
{
	'block_top'  : 0,
	'block_left' : 200,
	'width'      : 250,
	'height'     : 24,
	'vertical'   : true
}
]
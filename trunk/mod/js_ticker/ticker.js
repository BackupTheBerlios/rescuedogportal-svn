function stopBanner() {
	if (bannerRunning)
	clearTimeout(timerID)
	bannerRunning = false
}

function startBanner() {
	stopBanner()
	showBanner()
}
function clearState() {
	state = ""
	for (var i = 0; i < ar[message].length; ++i) {
		state += "0"
	}
}

function showBanner() {
	if (getString()) {
		message++
		if (ar.length <= message)
		message = 0
		clearState()
		timerID = setTimeout("showBanner()", pause)
		bannerRunning = true
	} else {
		var str = ""
		for (var j = 0; j < state.length; ++j) {
			str += (state.charAt(j) == "1") ? ar[message].charAt(j) : " "
		}
		window.status = str
		timerID = setTimeout("showBanner()", speed)
		bannerRunning = true
	}
}

function getString() {
	var full = true
	for (var j = 0; j < state.length; ++j) {
		if (state.charAt(j) == 0)
		full = false
	}
	if (full)
	return true
	while (1) {
		var num = getRandom(ar[message].length)
		if (state.charAt(num) == "0")
		break
	}
	state = state.substring(0, num) + "1" + state.substring(num + 1, state.length)
	return false
}

function getRandom(max) {
	return Math.round((max - 1) * Math.random())
}


var speed = 10 
var pause = 2250 
var timerID = null
var bannerRunning = false
var message = 0
var state = ""

var ar = new Array()
ar[0] = "www.rescue-dog.de"
ar[1] = "Homepage der Rettungshundestaffel des BRK Ansbach"
		
clearState()	
startBanner()
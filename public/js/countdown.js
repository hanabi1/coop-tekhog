
var year = 2014;			// in what year will your target be reached?
var month = 5;				// value between 0 and 11 (0=january,1=february,...,11=december)
var day = 29;				// between 1 and 31
var hour = 12;				// between 0 and 24
var minute = 0;			// between 0 and 60
var second = 0;			// between 0 and 60
var eventtext = ""; // text that appears next to the time left
var endtext = ""; // text that appears when the target has been reached
var end = new Date(year,month,day,hour,minute,second);
function timeleft(){
	var now = new Date();
	if(now.getYear() < 1900)
		yr = now.getYear() + 1900;
	var sec = second - now.getSeconds();
	var min = minute - now.getMinutes();
	var hr = hour - now.getHours();
	var dy = day - now.getDate();
	var mnth = month - now.getMonth();
	var yr = year - yr;
	var daysinmnth = 32 - new Date(now.getYear(),now.getMonth(), 32).getDate();
	if(sec < 0){
		sec = (sec+60)%60;
		min--;
	}
	if(min < 0){
		min = (min+60)%60;
		hr--;	
	}
	if(hr < 0){
		hr = (hr+24)%24;
		dy--;	
	}
	if(dy < 0){
		dy = (dy+daysinmnth)%daysinmnth;
		mnth--;	
	}
	if(mnth < 0){
		mnth = (mnth+12)%12;
		yr--;
	}	
	var sectext = "s ";
	var mintext = "m ";
	var hrtext = "h ";
	var dytext = "d ";
	var mnthtext = "";
	var yrtext = "";

// add leading zero if necessary
    function leadingZero(nr){
        if(nr < 10){
            return '0' + nr;
        }
        return nr;
    }

dy = leadingZero(dy);
hr = leadingZero(hr);
min = leadingZero(min);
sec = leadingZero(sec);

	if(now >= end){
		clearTimeout(timerID);
	}
	else{
	document.getElementById("timeleft").innerHTML = dy + '<span  class="countdown-prefix-small">' + dytext + '</span>' + 
													hr + '<span class="countdown-prefix-small">' + hrtext + '</span>' + 
													min + '<span class="countdown-prefix-small">' + mintext + '</span>' + 
													sec + '<span class="countdown-prefix-small">' + sectext + '</span>';
	}
	timerID = setTimeout("timeleft()", 1000); 
}
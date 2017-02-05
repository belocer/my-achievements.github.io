function timer_mini(){
	var els=document.querySelectorAll('.time');
	for(var i=0;i<els.length;i++){
		if(!els[i].t)els[i].t=els[i].innerHTML;
		var t=els[i].t;
		if(t==0)continue;
		t--;
		els[i].innerHTML=toFormattedTime(t,1,1);
		els[i].t=t;
		if(t==0){
			alert(els[i].parentNode.querySelector('td').innerHTML);
			els[i].parentNode.style.background='red';
		}
	}
}
//-------
function toFormattedTime(input, withHours, roundSeconds){
	if (input<=0)return '00:00:00';
    if (roundSeconds)
    {
        input = Math.ceil(input);
    }

    var hoursString = '00';
    var minutesString = '00';
    var secondsString = '00';
    var hours = 0;
    var minutes = 0;
    var seconds = 0;

    hours = Math.floor(input / (60 * 60));
    input = input % (60 * 60);

    minutes = Math.floor(input / 60);
    input = input % 60;

    seconds = input;

    hoursString = (hours >= 10) ? hours.toString() 

	: '0' + hours.toString();
		minutesString = (minutes >= 10) ? 

	minutes.toString() : '0' + minutes.toString();
		secondsString = (seconds >= 10) ? 

	seconds.toString() : '0' + seconds.toString();

		return ((withHours) ? hoursString + ':' : '') 

	+ minutesString + ':' + secondsString;
}
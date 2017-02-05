function timerCharts() {
    //create instance
    $('.chart').easyPieChart({
        animate: 2000
    });
    //update instance after 5 sec
    setInterval(function() {
		var els=document.querySelectorAll('.chart');
		for(var i=0;i<els.length;i++){
			var in_time = els[i].dataset.countsec;
			var timeout = els[i].dataset.timeoutsec;
			var out_time = els[i].querySelector('.time');
			var t = in_time;
			t = parseInt(t,10);

			timeout = parseInt(timeout,10);
			var percent = 100 - Math.floor(t/timeout*100);
			$(els[i]).data('easyPieChart').update(percent);
			t--;
			if (t >= 0){
				out_time.innerHTML = toFormattedTime(t,1,1);
				if (t <= 60){
				
				}
			}
			
			els[i].dataset.countsec = t;	
		} 
    }, 1000);
}

function timerTable(){
	setInterval(function(){
		var els=document.querySelectorAll('.ttimer');
		for(var i=0;i<els.length;i++){
			if(!els[i].t)els[i].t=els[i].innerHTML;
			var t=els[i].t;
			if(t>0){
				t--;
				els[i].innerHTML=toFormattedTime(t,1,1);
				els[i].t=t;
				if(t>=0&&t<=3){
					els[i].parentNode.setAttribute('class', 'error');
				}
				if(t<=300&&t>3){
					els[i].parentNode.setAttribute('class', 'success');
				}
				if(t<=600&&t>300){
					els[i].parentNode.setAttribute('class', 'info');
				}
			}
		}
	},1000);
}

function toFormattedTime(input, withHours, roundSeconds)
{if (input<=0)return '00:00:00';
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
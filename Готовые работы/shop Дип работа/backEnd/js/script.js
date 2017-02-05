
	
	
	
	function rev_elem(event) {
								event = event || window.event; //объект события во всех браузерах
								var x = event.currentTarget.getAttribute('class');
								if (x == 'passive_check') {
									document.getElementById('check_1').setAttribute('class', 'passive_check');
									document.getElementById('check_2').setAttribute('class', 'passive_check');
									document.getElementById('check_3').setAttribute('class', 'passive_check');
									document.getElementById('check_4').setAttribute('class', 'passive_check');
									event.currentTarget.setAttribute('class', 'active_check');
								} else {
									event.currentTarget.setAttribute('class', 'passive_check');
								}
							}
	
	
	function rev_elem1(event) {
								event = event || window.event; //объект события во всех браузерах
								var y = event.currentTarget.getAttribute('class');
								if (y == 'passive_check1') {
									document.getElementById('snoubord').setAttribute('class', 'passive_check1');
									document.getElementById('scooter').setAttribute('class', 'passive_check1');
									document.getElementById('roller').setAttribute('class', 'passive_check1');
									document.getElementById('tennis').setAttribute('class', 'passive_check1');
									document.getElementById('wakeboard').setAttribute('class', 'passive_check1');
									event.currentTarget.setAttribute('class', 'active_check1');
								} else {
									event.currentTarget.setAttribute('class', 'passive_check1');
								}
							}
	
	

										//Книги с лево
var b = "<img src=image/2.jpg>";
var c = "<img src=image/3.jpg>";
		
function Change() {
	setTimeout("ChangeImage()", 3000);
} 

function ChangeImage() { 
	document.getElementById('left').innerHTML= b;
	Change1();
}

function Change1() { 
	setTimeout("ChangeImage1()", 3000);
}

function ChangeImage1() { 
	document.getElementById('left').innerHTML= c;
	Change();
}

										//Книги с права	
var d1 = "<img src=image/4.jpg>";
var e1 = "<img src=image/5.jpg>";
		
function ChangeA() { 
	setTimeout("ChangeImageA()", 4000);     
} 

function ChangeImageA() { 
	document.getElementById('right').innerHTML= d1;
	ChangeB();
}

function ChangeB() { 
	setTimeout("ChangeImageC()", 4000);     
}

function ChangeImageC() { 
	document.getElementById('right').innerHTML= e1;
	ChangeA();
}	
ChangeA();
Change();

var c = document.querySelector('#c')
var ctx = c.getContext('2d')
var dots = []


var options = {
	size: 10,
	spawnRate: 3,
	rotation: 23,
	spawnRotationSpeed: 23,
	dotRotationSpeed: -0.2,
	moveSpeed: 2,
	shrinkTime: 5,
	clear: true
}

var colors = [
	'#F44336', '#E91E63', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3',
	'#03A9F4', '#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39',
	'#FFEB3B', '#FFC107', '#FF9800', '#FF5722'
]
var cc = 0

// r( max, min, decimal places)
function r(a,b,c){ return parseFloat((Math.random()*((a?a:1)-(b?b:0))+(b?b:0)).toFixed(c?c:0)); }

window.addEventListener('resize', function() {
	c.width = window.innerWidth
	c.height = window.innerHeight
})
window.dispatchEvent(new Event('resize'))

function render() {
	if(options.clear) {
		ctx.clearRect(0, 0, c.width, c.height)
	} else {
		ctx.fillStyle = 'rgba(0, 0, 0, 0.1)'
		ctx.fillRect(0, 0, c.width, c.height)
	}
	
	for(var i=0; i<options.spawnRate; i++) {
		options.rotation = options.rotation < 360 ? options.rotation + options.spawnRotationSpeed : options.rotation - 360 + options.spawnRotationSpeed
		cc = cc < colors.length - 1 ? cc + 1 : 0
		
		var dot = {
			rotation: options.rotation,
			x: c.width / 2,
			y: c.height / 2,
			size: options.size,
			color: colors[cc]
		}
		
		TweenMax.to(dot, options.shrinkTime, {size: 0})
		
		dots.push(dot)
	}
	
	dots.forEach(function(dot, i) {
		
		var d = {
			x: options.moveSpeed * Math.cos(dot.rotation * Math.PI / 180),
			y: options.moveSpeed * Math.sin(dot.rotation * Math.PI / 180)
		}
		
		dot.x += d.x
		dot.y += d.y
		
		dot.rotation += options.dotRotationSpeed
		
		// dot.size *= options.shrinkSpeed
		
		if(dot.size < 0.5) {
			dots.splice(i, 1)
			
			return
		}
		
		ctx.fillStyle = dot.color
		ctx.beginPath()
		ctx.arc(dot.x, dot.y, dot.size, 0, 2 * Math.PI, false)
		ctx.fill()
	})
}

;(function renderLoop() {
	requestAnimationFrame(renderLoop)
	render()
})()


var datGUI = new dat.GUI()

datGUI.add(options, 'size').min(1).max(20).step(1).name('Size').listen().onChange(function(val){ options.size = val })
datGUI.add(options, 'spawnRate').min(1).max(5).step(1).name('Spawn Rate').listen().onChange(function(val){ options.spawnRate = val })
datGUI.add(options, 'spawnRotationSpeed').min(0).max(50).step(1).name('Spawn Rotation').listen().onChange(function(val){ options.spawnRotationSpeed = val })
datGUI.add(options, 'dotRotationSpeed').min(-1).max(1).step(0.01).name('Dot Rotation').listen().onChange(function(val){ options.dotRotationSpeed = val })
datGUI.add(options, 'moveSpeed').min(1).max(5).step(1).name('Move Speed').listen().onChange(function(val){ options.moveSpeed = val })
datGUI.add(options, 'shrinkTime').min(0.1).max(20).step(0.1).name('Shrink Time (seconds)').listen().onChange(function(val){ options.shrinkTime = val })

datGUI.add(options, 'clear', true, false).name('Clear').onChange(function(val){ options.clear = val })
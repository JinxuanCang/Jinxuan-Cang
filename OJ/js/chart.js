/* 
	J.C.'s Online Software (c) 2017
    PHP-Campus Version 3.3
    Automatic chart generator module.
    Not every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang
*/
function chart(type,target,data,settings) {
	switch(type) {
		case "bar": Chart_Bar(target,data,settings);
		//case "circle_prog": Chart_Circle_Prog(target,data,settings);
		
	}
}
function Semicircle_Progress(id,pt) {
        var canvas = invoke(id);
		canvas.width = 2*canvas.scrollWidth;
		canvas.height = 2*canvas.scrollHeight;
		var ctx = canvas.getContext('2d');
        var perc = 0;

		var interval = setInterval(function() {
			if (perc==pt) {
				clearInterval(interval);
			}
		ctx.clearRect(0,0,canvas.width,canvas.height);
		ctx.translate(0, canvas.height);
		ctx.scale(1, -1);

		ctx.fillStyle = "grey";
		//  fillRect x, y, delta x, delta y
		//  arc   x, y,radius,sAngle,eAngle,direction
		var a = canvas.width/2,b = canvas.height*0.3,r = canvas.width/2;
		//console.log(canvas.width,canvas.height,canvas.scrollWidth,canvas.scrollHeight)
		var p = perc/100;
		//ctx.lineWidth = "1"
		//ctx.strokeStyle = "black";
		ctx.beginPath()
		ctx.arc(a,b,r,0,Math.PI);
		//ctx.stroke()
		ctx.fillStyle = "lightgrey"
		ctx.fill();
		ctx.closePath();

			ctx.beginPath()
			ctx.arc(a,b,r,-Math.PI,-Math.PI*(p-1),true);
			ctx.lineTo(a,b);
			ctx.closePath();
			var green = Math.round(p*500);
			var red = Math.round((1-p)*500);
			if(p>=0.5) {
				green = 255;
			}
			else {
				red = 255;
			}
			
			ctx.fillStyle = "rgb("+red+","+green+",0)";
			ctx.fill();

		ctx.strokeStyle = "cyan";
		ctx.lineWidth = "3"
		ctx.beginPath();
		ctx.moveTo(a-r+Math.sqrt(Math.pow(2*r*Math.sin(p*Math.PI/2),2)-Math.pow(r*Math.sin(p*Math.PI),2)),r*Math.sin(p*Math.PI)+b);
		ctx.lineTo(a,b);
		ctx.stroke();
		ctx.closePath()


		//ctx.drawArrow()

		ctx.translate(0, canvas.height);
		ctx.scale(1, -1);

		ctx.font = "50px Arial";
		ctx.textAlign = "center";
		ctx.fillStyle = "black";
		//text      text,     x, y
		ctx.fillText(perc+"%",a,b+180);
		perc += 1;
	},10)
}
function create_line(parent,x1,x2,y1,y2,linewidth,color) {
	var variable = SVG("line");
	variable.setAttribute("x1",x1);
	variable.setAttribute("x2",x2);
	variable.setAttribute("y1",y1);
	variable.setAttribute("y2",y2);
	variable.style.strokeWidth = linewidth;
	variable.style.stroke = color;
	parent.appendChild(variable);
}
function create_rect(parent,x,y,width,height,linewidth,linecolor,fill) {
	var variable = SVG("rect");
	variable.setAttribute("x",x);
	variable.setAttribute("y",y);
	variable.setAttribute("width",width);
	variable.setAttribute("height",height);
	variable.style.strokeWidth = linewidth;
	variable.style.stroke = linecolor;
	variable.setAttribute("fill",fill);
	parent.appendChild(variable);
	return variable;
}
function create_ctext(parent,text,x,y,font_family,font_size,color,rotate) {
	var variable = SVG("text");
	variable.innerHTML = text;
	variable.setAttribute("x",x);
	variable.setAttribute("y",y);
	variable.style.fontFamily = font_family;
	variable.style.fontSize = font_size;
	variable.style.fill = color;
	parent.appendChild(variable);
	var size = variable.getBBox();//console.log(size);
	//console.log(variable.getBoundingClientRect());
	if(rotate==undefined) var rotate = 0;
	var translate = "translate("+(-size.width/2)+","+(size.height/4)+")";
	translate += " rotate("+rotate+" "+(x+size.width/2)+","+(y-size.height/4)+")";
	variable.setAttribute("transform",translate);
	return variable;
}
function create_dtext(parent,text,x,y,font_family,font_size,color,rotate) {
	var variable = SVG("text");
	variable.innerHTML = text;
	variable.setAttribute("x",x);
	variable.setAttribute("y",y);
	variable.style.fontFamily = font_family;
	variable.style.fontSize = font_size;
	variable.style.fill = color;
	parent.appendChild(variable);
	if(rotate==undefined) var rotate = 0;
	var translate = "rotate("+rotate+" "+x+","+y+")";;
	variable.setAttribute("transform",translate);
	return variable;
}
function create_circle(parent,cx,cy,r) {
	var variable = SVG("circle");
	variable.setAttribute("cx",cx);
	variable.setAttribute("cy",cy);
	variable.setAttribute("r",r);
	parent.appendChild(variable);
}
function create_vert(parent,text,x,y,font_family,font_size,color,rotate) {

}
function SVG_flip(parent) {
	var variable = SVG("g");
	variable.setAttribute("transform","scale(1,-1)")
	parent.appendChild(variable);
	return variable;
}
function SVG(type) {
	return document.createElementNS("http://www.w3.org/2000/svg",type);
}
function animate(target,attr_name,var1,var2,duration) {
	var variable = SVG("animate");
	variable.setAttribute("attributeType","XML");
	variable.setAttribute("attributeName",attr_name);
	variable.setAttribute("from",var1);
	variable.setAttribute("to",var2);
	variable.setAttribute("dur",duration);
	target.appendChild(variable);
}
function Chart_Bar(target,data,settings) {
	var xe = settings.width;
	var ye = settings.height;
	var pregap = 60;
	var x_pregap = 60;
	var y_pregap = 60;
	var sufgap = 20;
	var x_sufgap = 20;
	var y_sufgap = 43;
	var x_length = xe-x_pregap-x_sufgap;
	var y_length = ye-y_pregap-y_sufgap;
	var border_width = 0.5;
	var label_offset = 10;

	var cursor_x = 0,cursor_y = 0;

	//console.log(x_length,y_length);

	var xaxis = settings.x_axis_title;
	var yaxis = settings.y_axis_title;
  var parent = invoke(target);
  var board = SVG("svg");
  board.height = ye;
  board.setAttribute("width", xe);
  board.setAttribute("height",ye);
  parent.appendChild(board);
  create_rect(board,0,0,xe,ye,0.5,"grey","white");
  create_line(board,x_pregap,x_pregap,y_sufgap,y_sufgap+y_length,border_width,"darkgrey");
  create_line(board,x_pregap,xe-x_sufgap,ye-y_pregap,ye-y_pregap,border_width,"darkgrey");
  create_ctext(board,settings.title,xe/2,20,"arial",16,"black")
  create_ctext(board,yaxis,label_offset,(2*y_sufgap+y_length)/2,"arial",14,"dimgrey",-90);
  create_ctext(board,xaxis,(2*x_pregap+x_length)/2,ye-label_offset,"arial",14,"dimgrey");
  //create_text(board,"Hi!",100,(ye-pregap+sufgap)/2,"arial",40,"orange",90);
  //create_circle(board,10,(ye-pregap+sufgap+23)/2,1);
  //create_line(board,0,xe,(ye-pregap+sufgap+23)/2,(ye-pregap+sufgap+23)/2,.5,"red");
  //create_line(board,10,10,0,xe,.5,"red");
  var i,j,k,l,m,n;
  var temp_max = data[0][1];
  var temp_min = data[0][1];
  for (i = 0; i < data.length; i++) {
  	temp_max = Math.max(temp_max, data[i][1]);
  	temp_min = Math.min(temp_min, data[i][1]);
  }
  //console.log(temp_max, temp_min);
  var period_leng = x_length/(4*data.length);
  cursor_x += x_pregap+period_leng/2;
  for (i = 0; i < data.length; i++) {
  	var graph_perc = data[i][1]/temp_max;
  	cursor_y = y_sufgap+y_length-y_length*graph_perc-7;
  	create_rect(SVG_flip(board),cursor_x,-ye+y_pregap,period_leng*3,y_length*graph_perc,0,"none","#64FFDA").classList.add("bars");
  	create_ctext(board,data[i][1],cursor_x+period_leng*1.5,cursor_y,"arial",12,"dimgrey").classList.add("fade_in");
  	
  	create_line(board,cursor_x,cursor_x,ye-y_pregap,ye-y_pregap-3,.5,"dimgrey");
  	create_line(board,cursor_x+period_leng*3,cursor_x+period_leng*3,ye-y_pregap,ye-y_pregap-3,.5,"dimgrey");
  	
  	create_dtext(board,data[i][0],cursor_x+period_leng*1.5-10,y_sufgap+y_length+10,"arial",12,"dimgrey",45);

  	cursor_x += period_leng*4;
  	
  }
  //create_line(board,pregap+10,pregap+10,ye-pregap,ye-pregap-3,.5,"dimgrey");

	//create_rect(SVG_flip(board),pregap+10,-ye+pregap,20,100,0,"none","pink").classList.add("bars");
}
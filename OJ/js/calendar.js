/* 
	J.C.'s Online Software (c) 2017
    PHP-Campus Version 3.3
    Dynamic calendar and events regulator module.
    Not every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang

    This library requires the Dynamic clock function module (clock.js)
*/
/*
	Invoking styles: (class)calendar_table
					 (class)table_head
					 (class)null_weekday

*/
var today = new Date;
function Calendar(target, settings) {
	var cal = create("fieldset",invoke(target),".:calendar_main");
	var h2 = create("h2",cal);

	var time_settings = {
  		target: undefined,
  		DS_month: "full",
  		DS_day: "num",
  		specifier: "month"
	}
	if(settings.smart) {
		var previous = h2.appendChild(GLB_IMG[3].cloneNode());
		var following = h2.appendChild(GLB_IMG[4].cloneNode());
		previous.setAttribute("onclick","Turn_Calendar(this,-1)");
		following.setAttribute("onclick","Turn_Calendar(this,+1)");
	}
	var h2_cont = create("div",h2);
	h2_cont.style.display = "inline-block";
	h2_cont.innerHTML += time(time_settings)+" ";
	time_settings.specifier = "year";
	h2_cont.innerHTML += time(time_settings);

	//weekday indicator (header)

	var cal_cont = create("table",cal);
	cal_cont.classList.add("calendar_table");

	var cal_tr = create("tr",cal_cont);
	cal_tr.classList.add("table_head")

	for (var i = 0; i < entire_day_name.length; i++) {
		var cal_th = create("th",cal_tr);
		cal_th.innerHTML = entire_day_name[i];
	}
	main_cont = create("tbody",cal_cont);
	Calendar_Block(main_cont,today.getMonth(),today.getFullYear());
	window[target] = new Array;
	window[target][0] = today.getMonth();
	window[target][1] = today.getFullYear();

	return true;
}
function Calendar_Block(target,month,year) {
	var time_settings = {
  		target: undefined,
  		DS_month: "full",
  		DS_day: "num",
	}
	//create main date blocks
	time_settings.start = month+1+" 1 "+year;
	time_settings.specifier = "day";
	var cal_tr = create("tr",target);

	var col,row,day_cursor;
	var max_date = monthMax(month,year);
	for (col = 0; col < time(time_settings); col++) {
		var cal_td = create("td",cal_tr);
		cal_td.classList.add("null_weekday");
	}
	for (day_cursor = 0; day_cursor < max_date; day_cursor++) {
		if (col==7) {
			col = 0;
			var cal_tr = create("tr",target);
		}
		var cal_td = create("td",cal_tr);
		cal_td.classList.add(null);
		cal_td.innerHTML = day_cursor+1;
		col++;
		
	}
	for (col; col < 7 && col != 0; col++) {
		var cal_td = create("td",cal_tr);
		cal_td.classList.add("null_weekday");
	}
}
function Turn_Calendar(target,parameter) {
	selector = target.parentNode.parentNode;
	selector.getElementsByTagName("tbody")[0].innerHTML = "";
	month_cursor = window[selector.parentNode.id][0];
	year_cursor = window[selector.parentNode.id][1];
	month_cursor += parameter;
	if (month_cursor > 11) {
		month_cursor = 0;
		year_cursor++;
	}
	if (month_cursor < 0) {
		month_cursor = 11;
		year_cursor--;
	}
	selector.getElementsByTagName("h2")[0].getElementsByTagName("div")[0].innerHTML = entire_month_name[month_cursor]+" "+year_cursor;
	Calendar_Block(selector.getElementsByTagName("tbody")[0],month_cursor,year_cursor);
	window[selector.parentNode.id][0] = month_cursor;
	window[selector.parentNode.id][1] = year_cursor;
}
function Calendar_Height(settings) {

}
function Cal_Label_Omit(target) {
	console.log(target.getElementsByTagName("th")[0])
	if (target.getElementsByTagName("th")[0].clientwidth < 103) {
		
	}
}
window.onresize = function() {
	for (var i = 0; document.body.contains(imvoke("calendar_main",i)); i++) {
		Cal_Label_Omit(imvoke("calendar_table",i).getElementsByClassName("table_head",0));
	}
}
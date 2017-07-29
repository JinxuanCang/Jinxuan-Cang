/* 
	J.C.'s Online Software (c) 2017
    PHP-Campus Version 3.3
    Dynamic clock function module.
    Not every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang
*/
function time (settings) {
	if (settings.format==undefined) {
      settings.format = GLB_Time_Format;
    }
  	else {
    	GLB_Time_Format = 24;
    	if (settings.format==12) {
      		GLB_Time_Format = 12;
    	}
  	}
  	if (settings.start==undefined) var now = new Date();
	else var now = new Date(settings.start)
  	var month = now.getMonth();
  	entire_month_name = ["January","Februray","March","April","May","June","July","August","September","October","November","December"];
  	omit_month_name = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
  	entire_day_name = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
  	omit_day_name = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
  	switch(settings.DS_month) {
  		case "full": month = entire_month_name[month]; break;
  		case "part": month = omit_month_name[month]; break;
	    default: month += 1; break;
  	}
	
	var date = now.getDate();
	var day = now.getDay();
	switch(settings.DS_day) {
		case "full": day = entire_day_name[day]; break;
		case "part": day = omit_day_name[day]; break;
		default: day = day; break;
	}
	var year = now.getFullYear();
	var hours = now.getHours();
	var minutes = now.getMinutes();
	var seconds = now.getSeconds();
  	var suffix,lhours,lminutes,lseconds;
  	if (GLB_Time_Format==12) {
      if (hours>=12) {
        suffix = " PM";
        if (hours>12) hours -= 12;
      }
      else suffix = " AM";
    }
    else suffix = "";
	if (hours<10) lhours = "0"; else lhours = "";
	if (minutes<10) lminutes = "0"; else lminutes = "";
	if (seconds<10) lseconds = "0"; else lseconds = "";
  	
  	if (settings.target==undefined)
  		if (settings.specifier==undefined)
  			return month+"/"+date+"/"+year+"  "+day+"  "+lhours+hours+":"+lminutes+minutes+":"+lseconds+seconds+suffix;
  		else
  			switch (settings.specifier) {
  				case "hours": return hours; break;
  				case "minutes": return minutes; break;
  				case "seconds": return seconds; break;
  				case "year": return year; break;
  				case "month": return month; break;
  				case "date": return date; break;
  				case "day": return day; break;
  				case "fulldate": return month+"/"+date+"/"+year; break;
  				default: return false; break;
  			}
  	else
    	invoke(settings.target).innerHTML=month+"/"+date+"/"+year+"  "+day+"  "+lhours+hours+":"+lminutes+minutes+":"+lseconds+seconds+suffix;
}
function monthMax(month,year) {
	if (typeof month === 'number' && typeof year === 'number' && month >= 0 && month < 12)
		if (month!=1)
			switch(month) {
				case 0: case 2: case 4: case 6: case 7: case 9: case 11: return 31; break;
				case 3: case 5: case 8: case 10: return 30; break;
			}
		else if (year % 100 == 0)
				if (year % 400 == 0)
					return 29;
				else return 28;
			 else if (year % 4 == 0)
			 		return 29;
			 	  else return 28;
	else return false;
}
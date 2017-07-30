/*
	J.C.'s Online Software (c) 2017 Aug
    PHP-Campus Version 3.3
    Dynamic clock function module. **Brand new version of clock.js
    Not every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang
    **Inspired by PHP Date(function)
*/
//testing version
function time2(pass_str) {
	var result = "";
	var o_weekdays = ["Sun","Mon","Tue","Wed","Thu","Fri","Sat"];
	var f_weekdays = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
	var f_monthname = ["January","Februray","March","April","May","June","July","August","September","October","November","December"];
	var o_monthname = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
	var argu = pass_str.match(/\d/g);
	if (argu==null) {
		var cur_date = new Date();
		var cur_time = {
			milliseconds:cur_date.getMilliseconds(),
			seconds:cur_date.getSeconds(),
			minutes:cur_date.getMinutes(),
			hours:cur_date.getHours(),
			date:cur_date.getDate(),
			month:cur_date.getMonth(),
			year:cur_date.getFullYear(),
			day:cur_date.getDay()
		}
		cur_time.UTC = {
			seconds:cur_date.getUTCSeconds(),
			minutes:cur_date.getUTCMinutes(),
			hours:cur_date.getUTCHours()
		}
		var days_list = [31,28,31,30,31,30,31,31,30,31,30,31];
		//if ()
		for(i = 0; i < pass_str.length; i++) {
			var pass_char = pass_str[i];
			switch(pass_char) {
				case "d":if (cur_time.date<10) result+="0"; result+=cur_time.date; break;
				case "D":result+=o_weekdays[cur_time.day];break;
				case "j":result+=cur_time.date;break;
				case "l":result+=f_weekdays[cur_time.day];break;
				case "N":if (cur_time.day==0) result+=7; else result+= cur_time.day; break;
				case "S":
					switch(cur_time.date) {
						case 1:result+="st";break;
						case 2:result+="nd";break;
						case 3:result+="rd";break;
						default:result+="th";break;
					}
				break;
				case "w":result+=cur_time.day;break;
				case "z":result+="?";break;
				case "W":result+="?";break;
				case "F":result+=f_monthname[cur_time.month];break;
				case "m":if (cur_time.month<9) result+="0"; result+=(cur_time.month+1);break;
				case "M":result+=o_monthname[cur_time.month];break;
				case "n":result+=(cur_time.month+1);break;
				case "o": case "Y":result+=cur_time.year; break;
				case "y":result+=(cur_time.year%1000%100);break;
				case "a":if (cur_time.hours<12) result+="am"; else result+="pm"; break;
				case "A":if (cur_time.hours<12) result+="AM"; else result+="PM";break;
				//case "B":result+=((UTC+1seconds + (UTC+1minutes * 60) + (UTC+1hours * 3600)) / 86.4);break;
				case "g":if (cur_time.hours%12===0) result+=12; else result+=(cur_time.hours%12);break;
				case "G":result+=cur_time.hours;break;
				case "h":if (cur_time.hours%12===0) result+=12; else if (cur_time.hours%12<10) result+="0"; result+=(cur_time.hours%12);break;
				case "H":if (cur_time.hours===0) result+="00"; else {if (cur_time.hours<10) result+="0"; result+=cur_time.hours;}break;
				case "i":if (cur_time.minutes===0) result+="00"; else {if (cur_time.minutes<10) result+="0"; result+=cur_time.minutes;}break;
				case "s":if (cur_time.seconds===0) result+="00"; else {if (cur_time.seconds<10) result+="0"; result+=cur_time.seconds;}break;
				case "v":result+=cur_time.milliseconds;break;
				default: result+=pass_char;
			}
		}
	}
	console.log(result);
}
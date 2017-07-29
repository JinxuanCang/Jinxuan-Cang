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
	var argu = pass_str.match(/\d/g);
	if (argu==null) {
		var cur_date = new Date();
		var cur_time = {
			seconds:cur_date.getSeconds(),
			minutes:cur_date.getMinutes(),
			hours:cur_date.getHours(),
			date:cur_date.getDate(),
			month:cur_date.getMonth(),
			year:cur_date.getFullYear(),
			day:cur_date.getDay()
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
				default: result+=pass_char;
			}
		}
	}
	console.log(result);
}
/*	Reference Data
-d	Day of the month, 2 digits with leading zeros	01 to 31
-D	A textual representation of a day, three letters	Mon through Sun
-j	Day of the month without leading zeros	1 to 31
-l (lowercase 'L')	A full textual representation of the day of the week	Sunday through Saturday
-N	ISO-8601 numeric representation of the day of the week (added in PHP 5.1.0)	1 (for Monday) through 7 (for Sunday)
-S	English ordinal suffix for the day of the month, 2 characters	st, nd, rd or th. Works well with j
-w	Numeric representation of the day of the week	0 (for Sunday) through 6 (for Saturday)
z	The day of the year (starting from 0)	0 through 365
Week	---	---
W	ISO-8601 week number of year, weeks starting on Monday	Example: 42 (the 42nd week in the year)
Month	---	---
-F	A full textual representation of a month, such as January or March	January through December
-m	Numeric representation of a month, with leading zeros	01 through 12
M	A short textual representation of a month, three letters	Jan through Dec
n	Numeric representation of a month, without leading zeros	1 through 12
t	Number of days in the given month	28 through 31
Year	---	---
L	Whether it's a leap year	1 if it is a leap year, 0 otherwise.
o	ISO-8601 week-numbering year. This has the same value as Y, except that if the ISO week number (W) belongs to the previous or next year, that year is used instead. (added in PHP 5.1.0)	Examples: 1999 or 2003
Y	A full numeric representation of a year, 4 digits	Examples: 1999 or 2003
y	A two digit representation of a year	Examples: 99 or 03
Time	---	---
a	Lowercase Ante meridiem and Post meridiem	am or pm
A	Uppercase Ante meridiem and Post meridiem	AM or PM
B	Swatch Internet time	000 through 999
g	12-hour format of an hour without leading zeros	1 through 12
G	24-hour format of an hour without leading zeros	0 through 23
h	12-hour format of an hour with leading zeros	01 through 12
H	24-hour format of an hour with leading zeros	00 through 23
i	Minutes with leading zeros	00 to 59
s	Seconds, with leading zeros	00 through 59
u	Microseconds (added in PHP 5.2.2). Note that date() will always generate 000000 since it takes an integer parameter, whereas DateTime::format() does support microseconds if DateTime was created with microseconds.	Example: 654321
v	Milliseconds (added in PHP 7.0.0). Same note applies as for u.	Example: 654
Timezone	---	---
e	Timezone identifier (added in PHP 5.1.0)	Examples: UTC, GMT, Atlantic/Azores
I (capital i)	Whether or not the date is in daylight saving time	1 if Daylight Saving Time, 0 otherwise.
O	Difference to Greenwich time (GMT) in hours	Example: +0200
P	Difference to Greenwich time (GMT) with colon between hours and minutes (added in PHP 5.1.3)	Example: +02:00
T	Timezone abbreviation	Examples: EST, MDT ...
Z	Timezone offset in seconds. The offset for timezones west of UTC is always negative, and for those east of UTC is always positive.	-43200 through 50400
Full Date/Time	---	---
c	ISO 8601 date (added in PHP 5)	2004-02-12T15:19:21+00:00
r	» RFC 2822 formatted date	Example: Thu, 21 Dec 2000 16:01:07 +0200
U	Seconds since the Unix Epoch (January 1 1970 00:00:00 GMT)	See also time()

JS object Reference
getDate()	Returns the day of the month (from 1-31)
getDay()	Returns the day of the week (from 0-6)
getFullYear()	Returns the year
getHours()	Returns the hour (from 0-23)
getMilliseconds()	Returns the milliseconds (from 0-999)
getMinutes()	Returns the minutes (from 0-59)
getMonth()	Returns the month (from 0-11)
getSeconds()	Returns the seconds (from 0-59)
getTime()	Returns the number of milliseconds since midnight Jan 1 1970, and a specified date
getTimezoneOffset()	Returns the time difference between UTC time and local time, in minutes
getUTCDate()	Returns the day of the month, according to universal time (from 1-31)
getUTCDay()	Returns the day of the week, according to universal time (from 0-6)
getUTCFullYear()	Returns the year, according to universal time
getUTCHours()	Returns the hour, according to universal time (from 0-23)
getUTCMilliseconds()	Returns the milliseconds, according to universal time (from 0-999)
getUTCMinutes()	Returns the minutes, according to universal time (from 0-59)
getUTCMonth()	Returns the month, according to universal time (from 0-11)
getUTCSeconds()	Returns the seconds, according to universal time (from 0-59)
getYear()	Deprecated. Use the getFullYear() method instead
now()	Returns the number of milliseconds since midnight Jan 1, 1970
parse()	Parses a date string and returns the number of milliseconds since January 1, 1970
setDate()	Sets the day of the month of a date object
setFullYear()	Sets the year of a date object
setHours()	Sets the hour of a date object
setMilliseconds()	Sets the milliseconds of a date object
setMinutes()	Set the minutes of a date object
setMonth()	Sets the month of a date object
setSeconds()	Sets the seconds of a date object
setTime()	Sets a date to a specified number of milliseconds after/before January 1, 1970
setUTCDate()	Sets the day of the month of a date object, according to universal time
setUTCFullYear()	Sets the year of a date object, according to universal time
setUTCHours()	Sets the hour of a date object, according to universal time
setUTCMilliseconds()	Sets the milliseconds of a date object, according to universal time
setUTCMinutes()	Set the minutes of a date object, according to universal time
setUTCMonth()	Sets the month of a date object, according to universal time
setUTCSeconds()	Set the seconds of a date object, according to universal time
setYear()	Deprecated. Use the setFullYear() method instead
toDateString()	Converts the date portion of a Date object into a readable string
toGMTString()	Deprecated. Use the toUTCString() method instead
toISOString()	Returns the date as a string, using the ISO standard
toJSON()	Returns the date as a string, formatted as a JSON date
toLocaleDateString()	Returns the date portion of a Date object as a string, using locale conventions
toLocaleTimeString()	Returns the time portion of a Date object as a string, using locale conventions
toLocaleString()	Converts a Date object to a string, using locale conventions
toString()	Converts a Date object to a string
toTimeString()	Converts the time portion of a Date object to a string
toUTCString()	Converts a Date object to a string, according to universal time
UTC()	Returns the number of milliseconds in a date since midnight of January 1, 1970, according to UTC time
valueOf()	Returns the primitive value of a Date object
*/

/* 
	J.C.'s Online Software (c) 2017
    PHP-Campus Version 3.3
    Essential javascript function library.
    Every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang
*/

function invoke(id) {
	return document.getElementById(id);
}
function imvoke(classname,sequence) {
	return document.getElementsByClassName(classname)[sequence];
}
function lmvoke(tagname,sequence) {
    return document.getElementsByTagName(tagname)[sequence];
}
/*
	invoke function only gets one specific element by id.
    imvoke funciton can get multiple elements by classname;
    lmvoke funciton can get multiple elements by tagname.
*/
function sincolor(id,value) {
	return invoke(id).style.backgroundColor = value;
}
function tarcolor(target,value) {
    return target.style.backgroundColor = value;
}
function tarfcolor(target,value) {
    return target.style.color = value;
}
function sinfcolor(id,value) {
	return invoke(id).style.color = value;
}
function classcolor(classname,sequence,value) {
	return imvoke(classname,sequence).style.backgroundColor = value;
}
function classfcolor(classname,sequence,value) {
	return imvoke(classname,sequence).style.color = value;
}
function appear(id,specific) {
	if (specific==undefined) { var specific = "block"}

	if (invoke(id).style.display!=specific) {
		return invoke(id).style.display = specific;
	}
	else {
		return false;
	}
}
function tappear(target,specific) {
    if (typeof specific=='undefined') { var specific = "block"}

    if (target.style.display!=specific) {
        return target.style.display = specific;
    }
    else {
        return false;
    }
}
function disappear(id) {
	return invoke(id).style.display = "none";
}
function tdisappear(target) {
    return target.style.display = "none";
}
function vartext(id,value) {
	return invoke(id).innerHTML = value;
}
function linkto(URL,target) {
  	if (target==undefined) target = "_self"
    return window.open(URL,target);
}
/*
    Standards of create(function)
    first parameter-tag name
    second parameter-the parentNode that the element appends
    #:id of the new element
    .:class of the new element
    o:onclick action of the new element
    t:type of the new element (input tag only)

*/
function create(tagname, appendto, ...args) {
    var element = document.createElement(tagname);
    for (i = 0; i < args.length; i++) {
        var com = args[i].substr(0,2);
        var str = args[i].substr(2);
        switch(com) {
            case "#:": element.setAttribute("id", str); break;
            case ".:": element.classList.add(str); break;
            case "o:": element.setAttribute("onclick", str); break;
            case "r:": element.setAttribute("oncontextmenu", str); break;
            case "t:": element.setAttribute("type",str); break;
            case "-:": element.innerHTML = str; break;
            case "w:": element.style.width = str; break;
            case "s:": element.src = str; break;
            default: return false;
        }
    }
    appendto.appendChild(element);
    return element;
}
function nodesequence(obj) {
  return Number(Array.prototype.indexOf.call(obj.parentNode.children, obj));
}
function load(filename, filetype){
    if (filetype=="js"){ 
        var fileref=document.createElement('script');
        fileref.setAttribute("type","text/javascript");
        fileref.setAttribute("src", filename);
    }
    else if (filetype=="css"){
        var fileref=document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
    }
    if (typeof fileref!=undefined)
        return lmvoke("head",0).appendChild(fileref);
}
function choose(object,instead){
  if (object==undefined||object==NaN) return instead;
  else return object;
}
function disable(id){
  return invoke(id).disabled = true;
}
function enable(id){
  return invoke(id).disabled = false;
}
//Global variables
function ms_s(value) {
    if (value>1000) {
        value /= 1000;value += "s";
    }
    else {
        value += "ms";
    }
    return value;
}

GLB_Load_Info = false;

window.onload = function () {
    var buffer = window.performance.timing.domContentLoadedEventEnd-window.performance.timing.navigationStart;//in milliseconds
	GLB_Load_Time = ms_s(buffer);
	//debugging:
	console.log("Page loaded in "+GLB_Load_Time);
    //parent.handleStateChange();
    if (GLB_Load_Info) LoadMessage("Okay","Page loaded in "+GLB_Load_Time+".");
    //Local_Sizing();
}
GLB_Time_Format = 12;

window.onkeydown = function() {
    if(window.event.ctrlKey) {

    }
    if(window.event.keyCode==73) {
		console.log(window);
    }
}
//window.onbeforeunload = function () {return false;}
//AJAX Global
XMLHttpRequest.prototype.realSend = XMLHttpRequest.prototype.send;
XMLHttpRequest.prototype.send = function(value) {
    var time = new Date;
    var sendtime = time.getTime();
    //console.log(sendtime)
    this.addEventListener("readystatechange", function() {
    	if (this.readyState==4 && this.status!=200){
    		if (this.status==0) {
    			LoadMessage("Error","No Server connection. System unable to operate normally.");
                setTimeout("LoadMessage('Notice','System is going to refresh the page immediately.')",4000);
                setTimeout("location.reload();");
    		}
    		else{
            	LoadMessage("Error","XML Http Request failed. Return code: <b>"+this.status+" "+this.statusText+"</b>.");
        	}
        }
        if (this.readyState==4 && this.status==200) {
            var time = new Date;
            var inter_time = time.getTime()-sendtime;
            GLB_AJAX_Interval = ms_s(inter_time);
            console.log("AJAX finished in "+GLB_AJAX_Interval)
        	console.log("%c"+"AJAX Success.","color: green;")
        }
    }, false)

    this.realSend(value);
};
//remove elements
Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}
/*else */
//Global Image Set
GLB_IMG = new Array();
GLB_IMG_LIST = [
    "b_drop.png","b_edit.png","b_relations.png","b_prevpage.png",
    "b_nextpage.png","eye.png","b_chart.png","b_print.png","b_export.png",
    "b_view.png","s_sortable.png","s_asc.png","s_desc.png"

];
for (var i = 0; i < GLB_IMG_LIST.length; i++) {
    GLB_IMG[i] = new Image();
    GLB_IMG[i].src = "../css/img/";
    GLB_IMG[i].src += GLB_IMG_LIST[i];
}

//Global Thematic Color Set
C50 = "var(--50)";
C100 = "var(--100)";
C200 = "var(--200)";
C300 = "var(--300)";
C400 = "var(--400)";
C500 = "var(--500)";
C700 = "var(--700)";
C900 = "var(--900)";
B200 = "var(--B200)";
//Theme settings
function theme(theme_name) {
    invoke("theme_color").href = "../css/"+theme_name+"/color.css";
    invoke("theme_font").href = "../css/"+theme_name+"/font.css";
    invoke("theme_box").href = "../css/"+theme_name+"/box.css";
}
function System_Reboot() {
    /* AJAX Setup Line Begins */
          var system_reboot=new XMLHttpRequest();
          system_reboot.onreadystatechange=function() {
            if (system_reboot.readyState==4 && system_reboot.status==200) {

            }
          }
          //AJAX Sending
          LoadMessage("Caution","System rebooting, this process may take a while. During this progress, system is unable to process any requesting work-such as refreshing the page, changing data, loading new contents. Please be patient and wait. Later, you may refresh the page.");
          system_reboot.open("GET","../module/system_reboot.php7",true);
          system_reboot.send();
          /* AJAX Setup Line Ends*/
}
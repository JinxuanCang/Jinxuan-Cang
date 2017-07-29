//initial settings

function PopMessage (hold) {
	document.getElementById("popmessage").style.display = "block";
	
	//document.getElementById("popmessage").style.opacity = 1;
	//document.getElementById("mainbody").style.marginTop = "0px";
	if (!hold) {
		setTimeout("HideMessage();",3000);
		document.getElementById("popmessage").setAttribute("title","Click to dismiss.")
    }
    else {
    	document.getElementById("popmessage").removeAttribute("title");
    }
	document.getElementById("popmessage").onclick=function() {
		if(!hold) {
	       HideMessage();
	    }
    }
}
function HideMessage () {
  
  //document.getElementById("popmessage").style.opacity = 0;
  document.getElementById("popmessage").style.display = "none";
  //document.getElementById("mainbody").style.marginTop = "70px";
}
function Loading () {
	document.getElementById("popmessage").style.backgroundColor = "#eff9fc";
	document.getElementById("popmessage").style.border = "1px solid blue";
  	document.getElementById("popmessage").innerHTML = "<img src='../css/img/ajax_clock_small.gif'> Loading...";
  	PopMessage(true);
}
function LoadMessage (type,string) {
	if(type=="Notice"){
		var b_color = "#eff9fc";
		var s_color = "blue";
		var s_img = "<img src='../css/img/s_info.png'>";
		var hold = false;
	}
	if(type=="Okay"){
		var b_color = "#e6ffe6";
		var s_color = "green";
		var s_img = "<img src='../css/img/s_okay.png'>";
		var hold = false;
	}
	if(type=="Caution"){
		var b_color = "#ffffe6";
		var s_color = "orange";
		var s_img = "<img src='../css/img/s_attention.png'>";
		var hold = true;
	}
	if(type=="Error"){
		var b_color = "#fccccc";
		var s_color = "red";
		var s_img = "<img src='../css/img/s_error.png'>";
		var hold = true;
	}
	document.getElementById("popmessage").style.backgroundColor = b_color;
	document.getElementById("popmessage").style.border = "1px solid "+s_color;
	document.getElementById("popmessage").innerHTML = s_img+" "+string;

	PopMessage(hold);
}

//Buttons statement
var s_action = "   <button onclick='HideMessage();'>Cancel</botton><button onclick='Execute();'>Continue</button>";

function Confirm(file_name,action) {
	g_filename = file_name;
	g_action = action;
	if (action=="delete") {
		LoadMessage("Caution","You are going to delete "+"<b>"+file_name+"</b>."+" Continue?"+s_action);
	}
	if (action=="clear") {
		LoadMessage("Caution","You are going to clear textarea. Continue?"+s_action);
	}
	if (action=="rename") {
		var extend = file_name.lastIndexOf(".");
        var r_name = file_name.substr(0, extend);
        var e_name = file_name.substr(extend);
		var r_filename = prompt("This file rename as:", r_name);
		if (r_filename!=null & r_filename!=r_name) {
			location.href = "./databases.php?file_name="+file_name+"&action=rename&add="+r_filename+e_name;
		}
		else {
			LoadMessage("Notice","File name didn't change.");
		}
	}
}
function Execute() {
	Loading();
	if (g_action=="delete") {
		location.href = "./databases.php?file_name="+g_filename+"&action="+g_action;
	}
	if (g_action=="clear") {
		document.getElementsByTagName('textarea')[0].innerHTML = "";
      	editor.setValue("");
      	LoadMessage("Notice","Cleared Textarea.");
	}
}
function Announce_Error() {
	LoadMessage("Error","A fatal error occured. JavaScript cannot proceed operating.")
}
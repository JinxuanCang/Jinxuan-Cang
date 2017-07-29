
window.onresize = function() {
    if(window.innerWidth<700) {
    	if (window.innerWidth<375) {
    		document.getElementById('mainbody').style.marginTop = "152px";
    	}
    	else {
        	document.getElementById('mainbody').style.marginTop = "106px";
        }
    }
    else {
    	document.getElementById('mainbody').style.marginTop = "70px";
    }
}

<!DOCTYPE html>
<html>
<head>
	<title>PHP-Campus</title>
	<link rel="stylesheet" type="text/css" href="../css/general.css">
	<script type="text/javascript" src="../js/essential.js"></script>
	<?php include("../essential_settings.php");?>
	<?php include("../module/style.php"); ?>
	<style>
		body {
			margin: 0;
			overflow: hidden;
		}
		#s_cdct_l,#s_cdct_r {
			height: 39.33px;
			position: fixed;
			z-index: 10;
			width: 0;
			height: 0;
			border-style: solid;
			background-color: var(--50);
		}
		#s_cdct_l {
			left: 0;
			/*border-width: 19.99px; top and bottom*/
			border-right-width: 10px;
			border-left-width: 0;
			border-color: transparent var(--300) transparent transparent;
		}
		#s_cdct_r {
			right: 0;
			/*border-width: 19.99px; top and bottom*/
			border-left-width: 10px;
			border-right-width: 0;
			border-color: transparent transparent transparent var(--300);
		}
		#locate_status {
			margin: auto;
			display: table;
		}
	</style>
</head>
<body>
	<div id="header">
  	  <div id="location">
  	  	<div style="width: 100%; position: fixed; left: 0;">
  	  		<div id="locate_status">No navigating occurs.</div>
  	  	</div>
        <img height="14" width="14" src="../css/img/s_host.png"><?php echo $_SERVER['HTTP_HOST'];?><div style="display: inline-block;"></div>
      </div>
		<ul id="horizontal_bar" style="overflow: hidden;">
			<div id="s_cdct_l" style="display: none;"></div>
			<div id="s_cdct_r" style="display: none;"></div>
			<div id="general" style="display: none;">
	      		<li><a href="dashboard.php" target="pages"><img src="../css/img/s_sync.png"> Dashboard</a></li>
          		<li><a href="calendar.php" target="pages"><img src="../css/img/b_calendar.png"> Calendar</a></li>
          		<li><a href="users.php" target="pages"><img src="../css/img/b_usrlist.png"> Users</a></li>
	      		<li><a href="databases.php" target="pages"><img src="../css/img/database.png"> Databases</a></li>
	      		<li><a href="status.php" target="pages"><img src="../css/img/s_status.png"> Status</a></li>
	      		<li><a href="informations.php" target="pages"><img src="../css/img/s_info.png"> Informations</a></li>
	      	</div>
	      	<div id="applications" style="display: none;">
	      		<li><a href=":javascript">All</a></li>
	      		<li><a href=":javascript">1</a></li>
	      		<li><a href=":javascript">2</a></li>
	      		<li><a href=":javascript">3</a></li>
	      		<li><a href=":javascript">4</a></li>
	      		<li><a href=":javascript">5</a></li>
	      		<li><a href=":javascript">6</a></li>
	      		<li><a href=":javascript">7</a></li>
	      		<li><a href=":javascript">8</a></li>
	      		<li><a href=":javascript">9</a></li>
	      		<li><a href=":javascript">10</a></li>
	      		<li><a href=":javascript">1</a></li>
	      		<li><a href=":javascript">2</a></li>
	      		<li><a href=":javascript">3</a></li>
	      		<li><a href=":javascript">4</a></li>
	      		<li><a href=":javascript">5</a></li>
	      		<li><a href=":javascript">6</a></li>
	      		<li><a href=":javascript">7</a></li>
	      		<li><a href=":javascript">8</a></li>
	      		<li><a href=":javascript">9</a></li>
	      		<li><a href=":javascript">10</a></li>
	      	</div>
	      	<div id="my_account" style="display: none;">
	      		<li><a href=":javascript">Personalize</a></li>
	      	</div>
	      	<div id="practice_center" style="display: none;">
	      		<li><a href=":javascript">All Problems</a></li>
	      	</div>
	    </ul>
	</div>
	<iframe name="pages" style="border: none; width: 100%;"></iframe>
	<script>
	    //document.getElementsByClassName('active')[0].removeAttribute("href");
	   	function Local_Sizing() {
	  		document.body.getElementsByTagName("iframe")[0].style.height = window.innerHeight - invoke("header").offsetHeight+"px";
	  		if (invoke("horizontal_bar").scrollWidth > window.innerWidth) {
	  			invoke("horizontal_bar").style.marginRight = "10px";
	  			//appear("s_cdct_l");
	  			appear("s_cdct_r");
	  		}
	  		else {
	  			invoke("horizontal_bar").style.margin = "0";
	  			disappear("s_cdct_l");
	  			disappear("s_cdct_r");
	  		}
	  		temp_height = invoke("horizontal_bar").getBoundingClientRect().height;
	  		// alert(temp_height);
	  		invoke("s_cdct_l").style.borderTopWidth = temp_height/2+"px";
	  		invoke("s_cdct_l").style.borderBottomWidth = temp_height/2+"px";
	  		invoke("s_cdct_r").style.borderTopWidth = temp_height/2+"px";
	  		invoke("s_cdct_r").style.borderBottomWidth = temp_height/2+"px";
	  	}
	  	window.onload = function() {
	  		Local_Sizing();
	  	}
	  	window.onresize = function() {
	  		Local_Sizing();
	  	}
	  	invoke("s_cdct_l").onmouseenter = function() {
	  		scrolling = setInterval(function() {
	  			invoke("horizontal_bar").scrollLeft -= 1;
	  			Scroll_Detector();
	  		},5);
	  	}
	  	invoke("s_cdct_l").onmouseout = function() {
	  		clearInterval(scrolling);
	  	}
	  	invoke("s_cdct_r").onmouseenter = function() {
	  		scrolling = setInterval(function() {
	  			invoke("horizontal_bar").scrollLeft += 1;
	  			Scroll_Detector();
	  		},5);
	  	}
	  	invoke("s_cdct_r").onmouseout = function() {
	  		clearInterval(scrolling);
	  	}
	  	function Scroll_Detector() {
	  		var s_l = invoke("s_cdct_l");
	  		var s_r = invoke("s_cdct_r");
	  		var base = invoke("horizontal_bar");
	  		if (invoke("horizontal_bar").scrollLeft==0)	{tdisappear(s_l); clearInterval(scrolling); base.style.marginLeft=0;}
	  		else {tappear(s_l); base.style.marginLeft="10px";}
	  		if (invoke("horizontal_bar").scrollLeft>=invoke("horizontal_bar").scrollWidth-window.innerWidth+19) {tdisappear(s_r); clearInterval(scrolling); base.style.marginRight=0;}
	  		else {tappear(s_r); base.style.marginRight="10px";}
	  	}
	  	function Navigator(id) {
	  		vartext("locate_status","Navigated to "+id);
	  		Switch_Li(id);
	  	}
	  	for (var i = 0; invoke("horizontal_bar").contains(invoke("horizontal_bar").getElementsByTagName("div")[i]); i++) {
	  		for (var j = 0; invoke("horizontal_bar").getElementsByTagName("div")[i].contains(invoke("horizontal_bar").getElementsByTagName("div")[i].getElementsByTagName("li")[j]); j++) {
	  			invoke("horizontal_bar").getElementsByTagName("div")[i].getElementsByTagName("li")[j].setAttribute("onclick","High_Light(this);");
	  		}
	  	}
	  	function High_Light(target) {
	  		for (var i = 0; target.parentNode.contains(target.parentNode.getElementsByTagName("li")[i]); i++) {
	  			target.parentNode.getElementsByTagName("li")[i].getElementsByTagName("a")[0].classList.remove("active");
	  			target.parentNode.getElementsByTagName("li")[i].setAttribute("onclick","High_Light(this)");
	  		}
	  		target.getElementsByTagName("a")[0].classList.add("active");
	  		target.setAttribute("onclick","return false;")
	  	}
	  	function Switch_Li(id) {
	  		for (var i = 0; invoke("horizontal_bar").contains(invoke("horizontal_bar").getElementsByTagName("div")[i]); i++) {
	  			tdisappear(invoke("horizontal_bar").getElementsByTagName("div")[i]);
	  		}
	  		appear(id,"flex");
	  		var link;
	  		switch(id) {
	  			case "general": link = "dashboard.php";break;
	  			case "my_account": link = "my_account.php";break;
	  			case "applications": link = "applications.php";break;
	  			case "practice_center": link = "practice_center.php";break;
	  		}
	  		window.open(link,"pages");
	  		High_Light(invoke(id).getElementsByTagName("li")[0]);
	  		Local_Sizing();
	  	}
		Local_Sizing();
	</script>
</body>
</html>
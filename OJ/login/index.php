<html>
<head>
  <title>P-C Login</title>
  <?php include("../essential_settings.php");?>
  <link rel="icon" href="../css/img/PHP_Campus_header_logo.png">
  <!-- invoking setup -->
  <link rel="stylesheet" type="text/css" href="../css/tooltip.css"><!-- invoke tool tip style sheet-->
  <link rel="stylesheet" type="text/css" href="../css/index.css"><!-- invoke index style sheets-->

  <script src="../js/clock.js"></script><!-- invoke the clock running module -->
  <script src="../js/essential.js"></script><!-- invoke essential javascript library -->

  <!-- heading javascript-->
  
  <!-- setup line ends -->
  <script>
    var current_LR = "Log";
    function PopReg () {
    	current_LR = "Reg";
      document.getElementById("confirm_code").style.display = "block";
      disappear("login");
      document.getElementById("Active_1").focus();
    }
    function HideReg () {
    	current_LR = "Log";
      document.getElementById("confirm_code").style.display = "none";
      appear("login")
      //document.getElementById("username").focus();
    }
    
    function Login_Username_Input () {
      var x = document.forms["Login"]["username"].value;
      var number = /[^A-Za-z ]/;
      var letter = /[^0-9]/;
	  if (x == null || x=="") {
	  	document.getElementById("username").style.borderBottom = "2px solid red";
	    document.getElementById("username_rsp").innerHTML = "You must type in Username.";
	    document.getElementById("username_rsp").style.display = "block";
		return 1;
	  }
	  else if (number.test(x) && letter.test(x)) {
	  			document.getElementById("username").style.borderBottom = "2px solid red";
	  			document.getElementById("username_rsp").innerHTML = "Username only can be all letters or all numbers.";
				document.getElementById("username_rsp").style.display = "block";
				return 1;
	  		}
	  else
	  {
	    document.getElementById("username_rsp").style.display = "none";
	    document.getElementById("username").style.borderBottom = null;
	    return 0;
	  }
	}
	function Login_Password_Input () {
	  var y = document.forms["Login"]["password"].value;
	  var quiz = /[^A-Za-z0-9]/;
	  if (y == null || y=="") {
	  	document.getElementById("password").style.borderBottom = "2px solid red";
	    document.getElementById("password_info").innerHTML = "You must type in Password.";
		document.getElementById("password_info").style.display = "block";
		return 1;
	  }
	  else if (quiz.test(y)) {
	  			document.getElementById("password").style.borderBottom = "2px solid red";
	  			document.getElementById("password_info").innerHTML = "Password only can be letters and/or numbers.";
				document.getElementById("password_info").style.display = "block";
				return 1;
	  		}
	  else
	  {
	    document.getElementById("password_info").style.display = "none";
	    document.getElementById("password").style.borderBottom = null;
	    return 0;
	  }
    }
    function Login_Submit () {
    	var error_count = Login_Username_Input()+Login_Password_Input();
    	if (error_count==0) {
    		AJAX_Login_Submit();
    	}
    	else Login_Submit_Rt();
    }
    function AJAX_Login_Submit() {
    	/* AJAX Setup Line Begins */
        var login_request=new XMLHttpRequest();
        var username = document.forms["Login"]["username"].value;
        var password = document.forms["Login"]["password"].value;
        login_request.onreadystatechange=function() {
            if (login_request.readyState==4 && login_request.status==200) {
            	Login_Submit_Rt();
            	switch (login_request.responseText) {
            		case "LI":LoggedIn();break;
            		case "WP":WrongPassword();break;
            		case "WU":WrongUsername();break;
            		case "UA":LoadMessage("Error","Unauthorized action, this action will record in the server logs.");break;
            		case "SF":StandardFailed();break;
            		case "MN":EntireNameFailed();break;
            		case "FR":FreezingAccount();break;
            	}
            }
        }

        //AJAX Sending
        login_request.open("POST","../module/index_users.php",true);
        login_request.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        login_request.send("username="+username+"&password="+password);
        /* AJAX Setup Line Ends*/
    }/*
	function RegSubmit () {
	  var N3error = 0;
	  var N4error = 0;
	  var N5error = 0;
	  var N6error = 0;
	  var a = document.forms["Reg"]["Rusername"].value;
	  var b = document.forms["Reg"]["Rpassword"].value;
	  var c = document.forms["Reg"]["retype"].value;
	  var d = document.forms["Reg"]["email"].value;
	  
	  if (a.length<2) {
	    document.getElementById("N3").innerHTML = "Username must be 2 letters.";
		var N3error = 1;
	  }
	  var quiz = /[^A-Za-z]/;
	  if (quiz.test(a)) {
	    document.getElementById("N3").innerHTML = "Username only can be letters.";
		var N3error = 1;
	  }
	  if (b.length<6) {
	    document.getElementById("N4").innerHTML = "Password must be 6 letters and/or numbers.";
		var N4error = 1;
	  }
	  var quiz = /[^A-Za-z0-9]/;
	  if (quiz.test(b)) {
	    document.getElementById("N4").innerHTML = "Password only can be letters and/or numbers.";
		var N4error = 1;
	  }
	  if (c!=b) {
	    document.getElementById("N5").innerHTML = "Re-type doesn't match Password.";
		var N5error = 1;
	  }
	  var quiz = /@./;
	  if (!quiz.test(d)) {
	    document.getElementById("N6").innerHTML = "Email presentation error.";
		var N6error = 1;
	  }
      if (a == null || a=="") {
	    document.getElementById("N3").innerHTML = "You must type in Username.";
		var N3error = 1;
	  }
	  
	  if (b == null || b=="") {
	    document.getElementById("N4").innerHTML = "You must type in Password.";
		var N4error = 1;
	  }
	  
	  if (c == null || c=="") {
	    document.getElementById("N5").innerHTML = "You must type in Re-type.";
		var N5error = 1;
	  }
	  
	  if (d == null || d=="") {
	    document.getElementById("N6").innerHTML = "You must type in Email.";
		var N6error = 1;
	  }
	  if (N3error==1) {
	  	document.getElementById("N3").style.display = "block";
	  }
	  else {
	  	document.getElementById("N3").style.display = "none";
	  }
	  if (N4error==1) {
	  	document.getElementById("N4").style.display = "block";
	  }
	  else {
	  	document.getElementById("N4").style.display = "none";
	  }
	  if (N5error==1) {
	  	document.getElementById("N5").style.display = "block";
	  }
	  else {
	  	document.getElementById("N5").style.display = "none";
	  }
	  if (N6error==1) {
	  	document.getElementById("N6").style.display = "block";
	  }
	  else {
	  	document.getElementById("N6").style.display = "none";
	  }
	  if (N3error==1 || N4error==1 || N5error==1 || N6error==1) {  return false;}
	}*/
    function WrongUsername () {
    	document.forms["Login"]["username"].focus();
    	document.getElementById("username").style.borderBottom = "2px solid red";
	  	document.getElementById("username_rsp").innerHTML = "Username unavailable.";
      	document.getElementById("username_rsp").style.display = "block";
	}
	function WrongPassword () {
		document.forms["Login"]["password"].focus();
		document.getElementById("password").style.borderBottom = "2px solid red";
	  	document.getElementById("password_info").innerHTML = "Password incorrect.";
      	document.getElementById("password_info").style.display = "block";
	}
	/*function SameName () {
	  document.getElementById("N3").innerHTML = "Please change Username.";
	  document.getElementById("N3").style.display = "block";
	}*/
    function LoggedIn () {
	  document.getElementById("username_rsp").innerHTML = "Logged in!";
      document.getElementById("username_rsp").style.display = "block";
	  location.href = "../views";
	}
	function StandardFailed () {
		document.getElementById("username_rsp").innerHTML = "Your privilege standard requested Login failed.";
      	document.getElementById("username_rsp").style.display = "block";
	}
	function EntireNameFailed() {
		document.getElementById("username_rsp").innerHTML = "Please use system unique ID to log in.";
		document.getElementById("username_rsp").style.display = "block";
		document.getElementById("username").focus();
	}
	function FreezingAccount() {
		document.getElementById("username_rsp").innerHTML = "Your account is freezing.";
		document.getElementById("username_rsp").style.display = "block";
	}
	/*function RegSuccessed () {
	  document.getElementById("N3").innerHTML = "Registered!";
	  document.getElementById("N3").style.display = "block";
	  location.href = "../views";
	}*/
	function Logoff () {
	  document.getElementById("username_rsp").innerHTML = "<?php if (isset($_SESSION['username'])) {echo str_replace("_", " ", $_SESSION['username']);}?> Logged off.";
	  document.getElementById('username_rsp').style.display = "block";
	}
	function NotLogin () {
	  document.getElementById("username_rsp").innerHTML = "You didn't Log in.";
	  document.getElementById('username_rsp').style.display = "block";
	}

	//Popmessage part
	function PopMessage () {
		document.getElementById("popmessage").style.display = "block";
		//scroll(0,0);
	}
	function HideMessage () {
  		document.getElementById("popmessage").style.display = "none";
	}
		

	function Loading () {
		document.getElementById("popmessage").style.backgroundColor = "#eff9fc";
		document.getElementById("popmessage").style.border = "1px solid blue";
  		document.getElementById("popmessage").innerHTML = "<img src='../css/img/ajax_clock_small.gif'> Loading...";
  		PopMessage();
	}
	function LoadMessage (type,string) {
		if(type=="Notice"){
			var b_color = "#eff9fc";
			var s_color = "blue";
			var s_img = "<img src='../css/img/s_info.png'>";
		}
		if(type=="Okay"){
			var b_color = "#e6ffe6";
			var s_color = "green";
			var s_img = "<img src='../css/img/s_okay.png'>";
		}
		if(type=="Caution"){
			var b_color = "#ffffe6";
			var s_color = "orange";
			var s_img = "<img src='../css/img/s_attention.png'>";
		}
		if(type=="Error"){
			var b_color = "#fccccc";
			var s_color = "red";
			var s_img = "<img src='../css/img/s_error.png'>";
		}
		document.getElementById("popmessage").style.backgroundColor = b_color;
		document.getElementById("popmessage").style.border = "1px solid "+s_color;
		document.getElementById("popmessage").innerHTML = s_img+" "+string;
		PopMessage();
	}
  </script>
  
</head>
<body>
  <div id="popmessage">None.</div>
  <p id="welcome">Welcome to PHP-Campus <font color="blue" face="monospace">BETA</font></p>
  <center><b id="clock" style="font-family: sans-serif;"></b></center>
  <script>
  	var clock_settings = {
  		target: "clock",
  		DS_month: "full",
  		DS_day: "full"
  	}
  	var timer = setInterval(function(){time(clock_settings)},100);
  	invoke("clock").onclick = function() {
  		if (GLB_Time_Format!=24) GLB_Time_Format = 24;
  		else GLB_Time_Format = 12;
		clock_settings.format = GLB_Time_Format;
  		time(clock_settings);
  		clearInterval(timer);
  		timer = setInterval(function(){time(clock_settings)},1000);
  	}
  </script>
  <div id="system_note">
  </div>
  <form name="Login" onsubmit="return false">
    <fieldset>
      <legend id="L1">Language</legend>
	  <select onchange="Language()" id="Lang">
        <option value="en">English - United States</option>
        <!--<option value="zh">&#20013;&#25991; - Chinese simplified</option>-->
      </select>
    </fieldset>
    <h4></h4>
    <fieldset id="login">
      <legend id="L2">Log in <div class="tooltip"><a href="../FAQs"><img src="../css/img/b_docs.png"></a><span class="tooltiptext" style="width: 120px; left:150%;">Click to see FAQs.</span></div></legend>
	  <label id="L3" for="username">Username</label><br>
      <input type="text" id="username" name="username" oninput="Login_Username_Input();" placeholder="Entire name/ID" autofocus><br>
      <div id="username_rsp" class="index_form_errors"></div>
	  <label id="L4" for="password">Password</label><br>
      <input type="password" id="password" name="password" oninput="Login_Password_Input();"><div id="password_info" class="index_form_errors"></div>
	  <div><span class="tooltip" id="L5"><a href="javascript:" onclick="PopReg();">Register&gt;&gt;</a><span style="width: 180px; left: 114%;" class="tooltiptext">Click to type in active code.</span></span></div>
	  <div id="login_sub">
	  	<input id="login_sub_bt" type="submit" value="Go">
	  	<img id="login_loading" src="../css/img/ajax_clock_small.gif">
	  </div>
	  <script>
	  	invoke("login_sub_bt").onclick = function() {
	  		disappear("login_sub_bt");
	  		appear("login_loading","inline-block");
	  		Login_Submit();
	  		
	  	}
	  	function Login_Submit_Rt() {
	  		appear("login_sub_bt","inline-block");
    		disappear("login_loading");
	  	}
	  </script>
	</fieldset>
  </form>
  <fieldset id="confirm_code">
    <legend id="L6">Register</legend>
	<form name="Reg" onsubmit="return false">
		<style>
			
		</style>
	  <label id="L7" for="Active_1">Active Code</label><br>
      <input class="active_code" type="password" name="Active_1" id="Active_1" maxlength="4" oninput="Active_Code_Input(1);" onfocus="this.value = this.value;">
      <input class="active_code" type="password" name="Active_2" id="Active_2" maxlength="4" oninput="Active_Code_Input(2);" onkeydown="Active_Code_Backspace(2);">
      <input class="active_code" type="password" name="Active_3" id="Active_3" maxlength="4" oninput="Active_Code_Input(3);" onkeydown="Active_Code_Backspace(3);">
      <input class="active_code" type="password" name="Active_4" id="Active_4" maxlength="4" oninput="Active_Code_Input(4);" onkeydown="Active_Code_Backspace(4);"><br><div id="active_code_errors" class="index_form_errors"></div>
      <script>
	  	ACT1 = document.getElementById("Active_1");
	  	ACT1.onblur=function() {
	  		ACT1.setAttribute("type","password");
	  	}
	  	ACT1.onfocus=function() {
	  		ACT1.setAttribute("type","text");
	  	}
	  	ACT2 = document.getElementById("Active_2");
	  	ACT2.onblur=function() {
	  		ACT2.setAttribute("type","password");
	  	}
	  	ACT2.onfocus=function() {
	  		ACT2.setAttribute("type","text");
	  	}
	  	ACT3 = document.getElementById("Active_3");
	  	ACT3.onblur=function() {
	  		ACT3.setAttribute("type","password");
	  	}
	  	ACT3.onfocus=function() {
	  		ACT3.setAttribute("type","text");
	  	}
	  	ACT4 = document.getElementById("Active_4");
	  	ACT4.onblur=function() {
	  		ACT4.setAttribute("type","password");
	  	}
	  	ACT4.onfocus=function() {
	  		ACT4.setAttribute("type","text");
	  	}
	  	//ACT1.setAttribute("value","5838");
	  	//ACT2.setAttribute("value","d5b8");
	  	//ACT3.setAttribute("value","70e9");
	  	//ACT4.setAttribute("value","f999");
	  </script>
      <script>
      	function Active_Code_Input(sequence) {
      		var quiz = /[^A-Za-z0-9]/;
      		document.getElementById("Active_"+sequence).style.borderBottom = null;
      		document.getElementById("active_code_errors").style.display = "none";
      		document.getElementById("active_code_submit").disabled = false;
      		var value = document.getElementById("Active_"+sequence).value;
      		if (!quiz.test(value)) {
      			if (value.length==4 && sequence!=4) {
      				document.getElementById("Active_"+sequence).blur();
      				document.getElementById("Active_"+(sequence+1)).focus();
      			}
      			else if (value.length==4 && sequence==4) {
      				Active_Code_Submit();
      			}
      	    }
      	    else {
      	    	document.getElementById("Active_"+sequence).style.borderBottom = "2px solid red";
      	    	document.getElementById("active_code_errors").innerHTML = "Active code only can be letters add/or numbers.";
      			document.getElementById("active_code_errors").style.display = "block";
      			document.getElementById("active_code_submit").disabled = true;
      	    }
      	    if (value=="" || value==null) {
      	    	document.getElementById("Active_"+sequence).style.borderBottom = "2px solid red";
      	    	document.getElementById("active_code_errors").innerHTML = "You must finish typeing active code.";
      			document.getElementById("active_code_errors").style.display = "block";
      			document.getElementById("active_code_submit").disabled = true;
      	    }
      	}
      	function Active_Code_Backspace(sequence) {
      		var value = document.getElementById("Active_"+sequence).value;
      		if (value=="" && window.event.keyCode == 8) {
      			document.getElementById("Active_"+sequence).blur();
      			document.getElementById("Active_"+(sequence-1)).focus();
      		}
      	}
      	function Active_Code_Submit() {
      		var quiz = /[^A-Za-z0-9]/;
      		string_p1 = document.getElementById("Active_1").value;
      		string_p2 = document.getElementById("Active_2").value;
      		string_p3 = document.getElementById("Active_3").value;
      		string_p4 = document.getElementById("Active_4").value;
      		
      		if (string_p1.length==4 && string_p2.length==4 && string_p3.length==4 && string_p4.length==4) {
      			if (!quiz.test(string_p1) && !quiz.test(string_p2) && !quiz.test(string_p3) && !quiz.test(string_p4)) {
      			    AJAX_Active_Code();
      			}
      			else {
      				if (quiz.test(string_p1)) {
      					document.getElementById("Active_1").style.borderBottom = "2px solid red";
      				}
      				if (quiz.test(string_p2)) {
      					document.getElementById("Active_2").style.borderBottom = "2px solid red";
      				}
      				if (quiz.test(string_p3)) {
      					document.getElementById("Active_3").style.borderBottom = "2px solid red";
      				}
      				if (quiz.test(string_p4)) {
      					document.getElementById("Active_4").style.borderBottom = "2px solid red";
      				}
      				document.getElementById("active_code_errors").innerHTML = "Active code only can be letters add/or numbers.";
      				document.getElementById("active_code_errors").style.display = "block";
      			}
      		}
      		else {
      			if (string_p1.length!=4) {
      				document.getElementById("Active_1").style.borderBottom = "2px solid red";
      			}
      			if (string_p2.length!=4) {
      				document.getElementById("Active_2").style.borderBottom = "2px solid red";
      			}
      			if (string_p3.length!=4) {
      				document.getElementById("Active_3").style.borderBottom = "2px solid red";
      			}
      			if (string_p4.length!=4) {
      				document.getElementById("Active_4").style.borderBottom = "2px solid red";
      			}

      			document.getElementById("active_code_errors").innerHTML = "Active code lacks digit(s).";
      			document.getElementById("active_code_errors").style.display = "block";
      		}
      		if (string_p1.length!=4 && string_p2.length!=4 && string_p3.length!=4 && string_p4.length!=4) {
      			for (var i = 1; i <= 4; i++) {
      				document.getElementById("Active_"+i).style.borderBottom = "2px solid red";
      			}
      			
      			document.getElementById("active_code_errors").innerHTML = "You must finish typeing active code.";
      			document.getElementById("active_code_errors").style.display = "block";
      		}
      	}
      	function AJAX_Active_Code() {
      		var active_code = string_p1+string_p2+string_p3+string_p4;
      		/* AJAX Setup Line Begins */
        	var con_active_code=new XMLHttpRequest();
        	con_active_code.onreadystatechange=function() {
            	if (con_active_code.readyState==4 && con_active_code.status==200) {
            		switch (con_active_code.responseText) {
            			case "UA":LoadMessage("Error","Unauthorized action, this action will record in the server logs.");break;
            			case "ACN":Active_Code_Invalid();break;
            			case "ACF":Active_Code_Valid();break;
            		}
            	}
            	else if (con_active_code.readyState==4 && con_active_code.status!=200){
              		LoadMessage("Error","XML Http Request failed. Return code: <b>"+con_active_code.status+"</b>.");
            	}
        	}
        	//AJAX Sending
        	con_active_code.open("POST","../module/index_users.php",true);
        	con_active_code.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        	con_active_code.send("active_code="+active_code);
        	/* AJAX Setup Line Ends*/
      	}
      	function Active_Code_Invalid() {
      		for (var i = 1; i <= 4; i++) {
      				document.getElementById("Active_"+i).style.borderBottom = "2px solid red";
      		}
      		document.getElementById("active_code_errors").innerHTML = "Invalid active code.";
      		document.getElementById("active_code_errors").style.display = "block";
      	}
      	function Active_Code_Valid() {
      		for (var i = 1; i <= 4; i++) {
      				document.getElementById("Active_"+i).style.borderBottom = "2px solid lime";
      				document.getElementById("Active_"+i).disabled = true;
      		}
      		document.getElementById("active_code_errors").style.color = "lime";
      		document.getElementById("active_code_errors").innerHTML = "Valid active code.";
      		document.getElementById("active_code_errors").style.display = "block";

      		document.getElementById("active_code_descrip").innerHTML = "Congratulations, active code is valid. Before proceeding registration, please make sure you realized that this registration may take serveral minutes to complete. Every valid active code only allows use once.";
      		document.getElementById("active_code_submit").setAttribute("onclick","Switch_Reg();");
      		document.getElementById("active_code_submit").setAttribute("value","OK");
      		document.getElementById("L11").style.display = "none";
      	}
      	function Switch_Reg() {
      		document.getElementById("confirm_code").style.display = "none";
      		document.getElementById("reg").style.display = "block";
      		AJAX_Reg_Generate();
      	}
      	function AJAX_Reg_Generate() {
      		var active_code = string_p1+string_p2+string_p3+string_p4;
      		/* AJAX Setup Line Begins */
        	var reg_generate=new XMLHttpRequest();
        	reg_generate.onreadystatechange=function() {
            	if (reg_generate.readyState==4 && reg_generate.status==200) {
            		if (reg_generate.responseText=="UA") {
            			LoadMessage("Error","Unauthorized action, this action will record in the server logs.");
            		}
            		else {
            			document.getElementById("reg").innerHTML = reg_generate.responseText;
            		}
            	}
        	}
        	//AJAX Sending
        	reg_generate.open("POST","../module/index_reg_generate.php",true);
        	reg_generate.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        	reg_generate.send("active_code="+active_code);
        	/* AJAX Setup Line Ends*/
      	}
      </script>
      <div id="active_code_descrip" style="font-family: sans-serif; font-size: 14px; color: gray;">One of the administrators will send you a 16-digit active code to active your account.</div>
	  <span id="L11"><a href="javascript:" onclick="HideReg();invoke('username').focus();">&lt;&lt;Back</a></span>
	  <input type="submit" value="Go" id="active_code_submit" onclick="Active_Code_Submit()">
	</form>
  </fieldset>
  <fieldset class="form" id="reg" style="display: none;">
  	
  </fieldset>
  <h4></h4>
  <footer>PHP-Campus is a J.C.'s Online Software product<br>Proudly written in PHP: Hypertext Preprocessor<br>Copyright &copy; Jinxuan Cang 2016-<?php echo date("Y"); ?><br>Theme style &copy; PhpMyAdmin 2003-2016<br><a href="http://php.net" target="_new">php.net</a> <a href="http://PhpMyAdmin.net" target="_new">PhpMyAdmin.net</a></footer>
  <div id="command"></div>
  <script>
    previous_message = "";
  	function Refresh_Info() {
  	    /* AJAX Setup Line Begins */

        var xml_refresh_info=new XMLHttpRequest();

        xml_refresh_info.onreadystatechange=function() {
            if (xml_refresh_info.readyState==4 && xml_refresh_info.status==200) {

            	buffer = xml_refresh_info.responseText.split("[brk]");

            	action_string = buffer[0];
    			if (action_string.includes("REG:F")) {
    				disappear("L5");
    				HideReg();
				}
				else {
					document.getElementById("L5").style.display = "inline-block";
				}

            	if (action_string.includes("LOGIN:F")) {
            		HideReg();
    				document.getElementById("login").style.display = "none";
    			}
    			else {
    				if (current_LR=="Log") {
    					appear("login");
    					//alert("?")
    				}
    			}
    			on_attention = false;
    			if(buffer[1]!="" && !on_attention) {
    				LoadMessage("Notice",buffer[1])
    			}
    			if(buffer[2]!="") {
    				vartext("system_note",buffer[2]);
    			}
            }
        }

        //AJAX Sending


        xml_refresh_info.open("GET","../module/index_refresh_info.php",true);
        xml_refresh_info.send();


        /* AJAX Setup Line Ends*/
        setTimeout("Refresh_Info()",10000);
    }
    Refresh_Info();
  </script>
  
<?php
  #Logged off
  if (isset($_SESSION["username"])) {
  	if ($_SESSION["username"]!="") {
  		echo "<script>Logoff();</script>";
  		unset($_SESSION["username"]);
  	}
  }
  #Not Logged in
  if (isset($_SESSION["logstatu"])) {
  	if ($_SESSION["logstatu"]!="") {
  		echo "<script>NotLogin();</script>";
  		unset($_SESSION["logstatu"]);
  	}
  }
?>
</body>
</html>
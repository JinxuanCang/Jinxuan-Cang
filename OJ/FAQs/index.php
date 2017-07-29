<!DOCTYPE html>
<html>
<head>
	<title>PHP-Campus</title>
	<?php include("../essential_settings.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/standard/color.css">
	<link rel="stylesheet" type="text/css" href="../css/standard/font.css">
	<link rel="stylesheet" type="text/css" href="../css/standard/box.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <style type="text/css">
    	#Notice {
			padding: 12px 20px;
			font-family:Sans-serif;
			background-color: #eff9fc;
			border:1px solid #0066ff;
        	border-radius: 5px;
    	}
    	#Caution {
			padding: 12px 20px;
			font-family:Sans-serif;
			background-color: #ffffe6;
			border:1px solid orange;
        	border-radius: 5px;
    	}
    	#Okay {
    		padding: 12px 20px;
    		font-family: sans-serif;
    		background-color: #e6ffe6;
    		border: 1px solid green;
    		border-radius: 5px;
    	}
    	#Error {
    		padding: 12px 20px;
    		font-family: sans-serif;
    		background-color: #fccccc;
    		border: 1px solid red;
    		border-radius: 5px;
    	}
    </style>
</head>
<body>
	<div id="popmessage"></div>
	<div id="mainbody">
	    <fieldset class="info">
	    	<h2>Quick Start</h2>
	    	<p>Quick Start will describes the essential usage of PHP-Campus to individual user.</p>
	    </fieldset>
		<fieldset class="info">
			<h2>About Login</h2>
			<ul class="software_info">
				<li>For the EZ-Judge and security issues, Log In process is requird.</li>
				<li>Checking by Javascript</li>
				<ul>
					<li>If user didn't type in Username before posting, system responds"<font color="red">You must type in Username.</font>";</li>
					<li>If user didn't type in Password before posting, system responds"<font color="red">You must type in Password.</font>".</li>
				</ul>
				<li>Checking by PHP</li>
				<ul>
					<li>If the Username doesn't exist, system responds "<font color="red">Username Unavailable.</font>";</li>
					<li>If the Password incorrect, system responds "<font color="red">Password Incorrect.</font>".</li>
				</ul>
				<li>User status displays</li>
				<ul>
					<li>While user logged in, system responds "<font color="red">Logged In!</font>";</li>
					<li>While user logged off, system responds "<font color="red"><i>Username</i> Logged Off.</font>"</li>
				</ul>
				<li>User action deals</li>
				<ul>
					<li>If user back to Login page while logged in, system auto logs user off;</li>
					<li>If user goes to the page(except Login page) without logged in permission, system auto returns user back to Login page and responds "<font color="red">You didn't Log in.</font>".</li>
				</ul>
			</ul>
		</fieldset>
		<fieldset class="info">
			<h2>Registration</h2>
			<ul class="software_info">
				<li>Registration requires for new users.</li>
				<li>Registration policies</li>
				<ul>
					<li>Every user must have and not exceed 1 User account;</li>
					<li>All user's registration IP address is recording;</li>
					<li>Naughty and illegal Username or Password will remove by Administrator.</li>
				</ul>
				<li>Checking by Javascript</li>
				<ul>
					<li>If user didn't type in Username before posting, system responds"<font color="red">You must type in Username.</font>";</li>
					<li>If user didn't type in Password before posting, system responds"<font color="red">You must type in Password.</font>";</li>
					<li>If user didn't type in Re-type before posting, system responds"<font color="red">You must type in Re-type.</font>";</li>
					<li>If user didn't type in Email before posting, system responds"<font color="red">You must type in Email.</font>";</li>
					<li>Username have to be at least 2 letters, otherwise system responds"<font color="red">Username must be 2 letters.</font>";</li>
					<li>Username have to be letters, otherwise system responds"<font color="red">Username only can be letters.</font>";</li>
					<li>Password have to be at least 6 letters and/or numbers, otherwose system responds"<font color="red">Password must be 6 letters and/or numbers.</font>";</li>
					<li>Password have to be numbers and/or letters, otherwise system responds"<font color="red">Password only can be letters and/or numbers.</font>";</li>
					<li>Password have to match the Re-type, otherwise system responds "<font color="red">Re-type doesn't match Password.</font>;</li>
					<li>Email presentation have to be at least 1 "@" and 1 ".", otherwise system responds "<font color="red">Email presentation error.</font>".</li>
				</ul>
				<li>Checking by PHP</li>
				<ul>
					<li>If Username collides with a existing Username, system responds "<font color="red">Please change Username.</font>".</li>
				</ul>
				<li>User status displays</li>
				<ul>
					<li>If registration form submitted and confirmed successfully, system responds "<font color="red">Registered!</font>".</li>
				</ul>
			</ul>
		</fieldset>
		<!--
		<fieldset class="info">
			<h2>Notification Solutions</h2>
			<ul class="software_info">
				<li>Pop Message</li>
			</ul>
			<div id="Notice"><img src="../css/img/s_info.png"> This is a Notice Message.</div>
			<p></p>
			<div id="Okay"><img src="../css/img/s_okay.png"> This is a Okay Message.</div>
			<p></p>
			<div id="Caution"><img src="../css/img/s_attention.png"> This is a Caution Message.</div>
			<p></p>
			<div id="Error"><img src="../css/img/s_error.png"> This is an Error Message.</div>
		</fieldset>-->
	</div>
    <script type="text/javascript">LoadMessage("Notice","Please read the Frequently Asking Question answers carefully.");
    	function Local_Sizing() {
    		
    	}
    </script>
    <?php if (isset($_SESSION["username"])): ?>
      <script>//document.getElementById("back_login").style.display = "none";</script>
    <?php endif; ?>
</body>
</html>
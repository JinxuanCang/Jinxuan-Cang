<!DOCTYPE html>
<html>
<head>
	<title>PHP-Campus</title>
	<?php include("../essential_settings.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

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
  <div id="header">
  	  <div id="location">
        <img height="14" width="14" src="../css/img/s_host.png"><?php echo $_SERVER['HTTP_HOST'];?>&gt;FAQs&gt;User Supports
      </div>
	    <ul id="horizontal_bar">
	      <li><a id="back_login" href="../login"><img src="../css/img/b_prevpage.png">Login</li></a>
	      <li><a href="../FAQs"><img src="../css/img/b_help.png"> About Login</li></a>
	      <li><a class="active"><img src="../css/img/b_unique.png"> User Supports</li></a>
	    </ul>
	  </div>
    
  
	<div id="popmessage"></div>
	<div id="mainbody">
        <fieldset class="info">
            <h2>Your Browser</h2>
            <ul class="software_info">
                <li>Microsoft Internet Explorer</li>
                <ul>
                    <li>Unfortunately, PHP-Campus doesn't support any version of Microsoft Internet Explorer, since browser doesn't support javascript "includes()" function.</li>
                </ul>
                <li>Chrome</li>
                <ul>
                    <li>Versiom require up to 41.</li>
                </ul>
                <li>Firefox</li>
                <ul>
                    <li>Version require up to 40.</li>
                </ul>
                <li>Safari</li>
                <ul>
                    <li>Unfortunately, PHP-Campus doesn't support any version of Safari brower, due to brower doesn't support HTML tag &lt;input type="color"&gt;.</li>
                </ul>
                <li>Opera</li>
                <ul>
                    <li>Version require up to 28.</li>
                </ul>
            </ul>
        </fieldset>
        <fieldset class="info">
            <h2>System Requirements</h2>
            <ul class="software_info">
                <li><font color="red">All are supported minimums.</font></li>
                <li>Operating system</li>
                <ul>
                    <li>Windows</li>
                    <ul>
                        <li>Windows 7</li>
                    </ul>
                    <li>Macintosh</li>
                    <ul>
                        <li>OS X 10.8 x</li>
                    </ul>
                </ul>
                <li>Processor</li>
                <ul>
                    <li>1 GHz 32-bit</li>
                </ul>
                <li>RAM</li>
                <ul>
                    <li>4 GB</li>
                </ul>
            </ul>
        </fieldset>
    </div>
    <script type="text/javascript">LoadMessage("Notice","Please read the Frequently Asking Question answers carefully.");</script>
    <?php if ($_SESSION["username"]!="" || $_SESSION["username"]!=null): ?>
      <script>document.getElementById("back_login").style.display = "none";</script>
    <?php endif; ?>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>EZ-Judge By PDT</title>
	<?php include("../essential_settings.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">

    <style type="text/css">
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
    </div>
</body>
</html>
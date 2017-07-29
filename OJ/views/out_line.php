<html>
  <head>
    <?php include("../essential_settings.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
  </head>
  <body>
  	<div id="header">
  	  <div id="location">
        <img height="14" width="14" src="../css/img/s_host.png"><?php echo $_SERVER['HTTP_HOST'];?>&gt;
      </div>
	    <?php $_SESSION["gen_location"]="";include("../module/header.php");?>
	  </div>
	<div id="popmessage"></div>
	<div id="mainbody">
    
	</div>
  </body>
</html>
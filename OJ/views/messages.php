<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
  </head>
  <body>
  	<div id="header">
  	  <div id="location">
        <img height="14" width="14" src="../css/img/s_host.png"><?php echo $_SERVER['HTTP_HOST'];?>&gt;Messages
      </div>
	    <ul id="horizontal_bar">
        <li><a class="active"><img src="../css/img/b_index.png"> Main</a></li>
        <li><a><img src="../css/img/b_snewtbl.png"> New</a></li>
        <li><a><img src="../css/img/b_tblanalyse.png"> Inbox</a></li>
        <li><a><img src="../css/img/b_spatial.png"> Send</a></li>
        <li><a><img src="../css/img/s_process.png"> Settings</a></li>
	    </ul>
	  </div>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <fieldset class="info">
      <h2>Message Center</h2>
      <?php if(rand(1,2)==1):?>
      <p>
        Message module allows every single user sends short messages to every other users.<br>
        Please read <a href="javascript:">Message Safety</a> Rules.
      </p>
      <?php endif; ?>
    </fieldset>
    <fieldset class="info" style="float: left; margin-top: 0; height: 100%; width: 70%">
      <h2></h2>
    </fieldset>
    <fieldset class="info" style="float: right; margin-top: 0; height: 100%">
      <h2>Recent contact</h2>
    </fieldset>
	</div>
  </body>
</html>
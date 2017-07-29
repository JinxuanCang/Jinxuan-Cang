<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <script type="text/javascript" src="../js/essential.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <style type="text/css">
      
      iframe {
        width: 99%;
        height: 100%;
      }
    </style>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <fieldset class="info">
      <h2>PHP-Campus</h2>
      <ul class="software_info">
        <li>Version 3.3</li>
        <li style="font-weight: bold;">This is the <?php echo floor((time()-mktime(0,0,0,8,5,2016))/3600/24);?>th day of developing.</li>
        <li>Copyright &copy; Jinxuan Cang 2012-2016</li>
        <li>Theme style &copy; PhpMyAdmin 2003-2016</li>
      </ul>
    </fieldset>
    <fieldset class="info">
      <h2>Web Server</h2>
      <ul class="software_info">
        <li><?php print(apache_get_version()); ?></li>
        <li>PHP <?php print(phpversion());?></li>
        <li>Localhost: 127.0.0.1</li>
        <li>Http Host: <?php echo $_SERVER['HTTP_HOST'];?></li>
      </ul>
    </fieldset>
    <fieldset class="info">
      <h2>PHP Information</h2>
      <iframe src="../phpinfo.php"></iframe>
    </fieldset>
    <fieldset class="info">
      <h2>Licenses</h2>
      <ul class="software_info">
        <li>See PHP Information</li>
      </ul>
    </fieldset>
	</div>
  </body>
</html>
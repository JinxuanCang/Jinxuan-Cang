<html>
  <head>
    <?php include("../essential_settings.php"); Initialize();?>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <fieldset class="info">
      <h2>PHP-Campus</h2>
      <ul class="software_info">
        <li>Version 3.3</li>
        <li style="font-weight: bold;">This is the <?php echo floor((time()-mktime(0,0,0,8,5,2016))/3600/24);?>th day of developing.</li>
        <li>Copyright &copy; Jinxuan Cang 2017 Aug</li>
        <li>Theme style is similar to &copy; PhpMyAdmin 2003-2016</li>
      </ul>
    </fieldset>
    <fieldset class="info">
      <h2>Web Server</h2>
      <ul class="software_info">
        <li><?php print($_SERVER["SERVER_SOFTWARE"]); ?></li>
        <li>PHP <?php print(phpversion());?></li>
        <li>Operating System(OS) Linux 2.6.32-673.26.1.lve1.4.27.el6.x86_64</li>
        <li>Local Area Network(LAN) 10.52.11.23(Subject to change)</li>
        <li>Wide Area Network(WAN) <?php echo $_SERVER['HTTP_HOST'];?></li>
      </ul>
    </fieldset>
    <fieldset class="info">
      <h2>Licenses</h2>
      <ul class="software_info">
        <li>Constructing...</li>
      </ul>
    </fieldset>
	</div>
  </body>
</html>
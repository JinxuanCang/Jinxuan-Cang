<html>
  <head>
    <?php
      include("../essential_settings.php");
      Initialize();
      LoginRequire();
      if (!strpos($_SESSION["detailPrivilege"],"gnrl_update")) header("Location: http://{$_SERVER['HTTP_HOST']}/forbidden/Unauthorized%20Action(UA)");
    ?>
  </head>
  <body>
	<div id="mainbody">
	    <fieldset class="info">
	      <h2>PHP-Campus Version Controller</h2>
	      <p><i>Restricted</i> site. <i>SuperAdministrator</i> ONLY. Warning: mis-configuring may result in fatal website failure.</p>
	    </fieldset>
      <fieldset class="form">
        <legend>Remote Path</legend>
        <label>http(s)://<?php echo $_SERVER["HTTP_HOST"]; ?>/</label>
        <input type="text" style="width: 380px; height: 20px;">
        <button>Open</button>
        <button>Previous Directory</button>
      </fieldset>
	</div>
  </body>
</html>
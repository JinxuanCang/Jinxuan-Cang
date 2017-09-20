<html>
  <head>
    <?php
      include("../essential_settings.php");
      Initialize();
      LoginRequire();
      js("../js/chart.js");
    ?>
  </head>
  <body>
	<div id="mainbody">
  	<fieldset class="info">
  		<h2>PHP-Campus</h2>
  		<p>Welcome aboard. Thank you for checking out new layout and brand new design.</p>
  	</fieldset>
  	<?php 
  		if (file_exists("../library/data/inprogress_events")) { ?>
        <fieldset class="info">
          <h2>In Progress Events</h2>
          <p>
    <?php
      $in_event = file("../library/data/inprogress_events");
      for ($i=0; array_key_exists($i, $in_event) ; $i++) { 
        echo $in_event[$i];
        if (strpos($in_event[$i], "\r") || strpos($in_event[$i], "\n")) echo "</br>";
      } ?>
          </p>
        </fieldset>
    <?php } ?>
  	<fieldset class="info">
  		<h2>Administrator's Messages
        <?php if($_SESSION["Login_status"]=="Administrator" or $_SESSION["Login_status"]=="SuperAdministrator"):?>
        <a class="link_floatright" onclick="Edit_Admin_Message();"><img src='../css/img/b_edit.png'>Edit</a>
        <?php endif; ?>
      </h2>
  		<p>
  		<?php 
  		  if (file_exists("../library/data/administrators_message")) {
    	    $admin_message = file("../library/data/administrators_message");
    	    for ($i=0; array_key_exists($i, $admin_message) ; $i++) { 
    	      echo $admin_message[$i];
    	      if (strpos($admin_message[$i], "\r") || strpos($admin_message[$i], "\n"))
    	        echo "</br>";
          }
        }
        else echo "No message exists right now.";
      ?>
  		</p>
  	</fieldset>
  	<fieldset class="info">
  		<h2><?php echo str_replace("_", " ", $_SESSION["username"])."'s";?> Progress</h2>
  		<p>No progress report is available to observe.</p>
  	</fieldset>
	</div>
  </body>
</html>
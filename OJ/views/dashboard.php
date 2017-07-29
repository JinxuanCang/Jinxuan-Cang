<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <script type="text/javascript" src="../js/chart.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
	<fieldset class="info">
		<h2>PHP-Campus</h2>
		<p>Welcome to PHP-Campus.Theme style used PhpMyAdmin.</p>
	</fieldset>
	
	<fieldset class="info">
		<h2>In Progress Events</h2>
		<p>
		<?php 
		  if (file_exists("../events/popmessage.txt")) {
  	          $popmessage = file("../events/popmessage.txt");
  	          for ($i=0; array_key_exists($i, $popmessage) ; $i++) { 
  	          		echo $popmessage[$i];
  	          		if (strpos($popmessage[$i], "\r") || strpos($popmessage[$i], "\n")) {
  	          			echo "</br>";
  	          	}
  	          }
          }
          else {
          	echo "Nothing happens right now.";
          }
        ?>
		</p>
	</fieldset>
  <script>
    function Edit_Admin_Message() {
      
    }
  </script>
	<fieldset class="info">
		<h2>Administrator's Messages
      <?php if($_SESSION["Login_status"]=="Administrator" or $_SESSION["Login_status"]=="SuperAdministrator"):?>
      <a class="link_floatright" onclick="Edit_Admin_Message();"><img src='../css/img/b_edit.png'>Edit</a>
      <?php endif; ?>
    </h2>
		<p>
		<?php 
		  if (file_exists("../events/teacher's_message.txt")) {
  	          $teacher_message = file("../events/teacher's_message.txt");
  	          for ($i=0; array_key_exists($i, $teacher_message) ; $i++) { 
  	          		echo $teacher_message[$i];
  	          		if (strpos($teacher_message[$i], "\r") || strpos($teacher_message[$i], "\n")) {
  	          			echo "</br>";
  	          	}
  	          }
          }
          else {
          	echo "No message exists right now.";
          }
        ?>
		</p>
	</fieldset>

	<fieldset class="info">
		<h2><?php echo str_replace("_", " ", $_SESSION["username"])."'s";?> Progress</h2>
		<p>No progress report is available to observe.</p>
	</fieldset>
	</div>
  <?php
    //echo "<script>PopMessage();</script>";
    
  ?>
  </body>
</html>
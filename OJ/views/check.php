<html>
<head>
  <link rel="stylesheet" type="text/css" href="../css/background.css">
</head>
<body id="manage">
<?php
  session_start();
  if($_POST["adminpassword"]=="")
  {
    echo '<script>alert("ÃÜÂëÓòÎª¿Õ£¡");history.back();</script>';
	exit;
  }
  else
  {
    $file = file("../settings.ini");
    $file[8] = trim($file[8]);
    if($_POST["adminpassword"]==$file[8])
	{
	  $_SESSION["adminpass"] = "ok";
	  echo  "<meta http-equiv=\"refresh\" content='0; url=manage.php'>";
	}
	else
	{
	  echo '<script>alert("ÃÜÂë´íÎó£¡");history.back();</script>';
	  exit;
	}
  }

?>
</body>
</html>
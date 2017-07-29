<html>
<body>
<?php
  session_start();
  if($_SESSION["user"]==null)
  {
    $_SESSION["httpstatus"] = 502;
	echo "<meta http-equiv='refresh' content='0; url=error.php'>";
	exit;
  }
  if(file_exists("../temp/time.txt"))
  {}
  else
  {
    $_SESSION["httpstatus"] = 405;
	echo "<meta http-equiv='refresh' content='0; url=error.php'>";
	exit;
  }
  $_SESSION["probtitle"] = $_GET["id"];
  echo "<meta http-equiv='refresh' content='0; url=problem.html'>";
?>
</body>
</html>
<html>
<body id="standing">
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<link href="../css/background.css" type="text/css" rel="stylesheet" />
<link href="../css/href_standing.css" type="text/css" rel="stylesheet" />
</head>
<p><center>PDT����</center></p>
<hr>
<table border="0" cellspacing="1" cellpadding="5" width="100%">
  <tr bgcolor="#330099">
  <th><font color="#FFFFFF">����</font></th>
  <th><font color="#FFFFFF">�û�</font></th>
  <?php
    session_start();
    if($_SESSION["user"]==null)
    {
      $_SESSION["httpstatus"] = 502;
   	  echo "<meta http-equiv='refresh' content='0; url=error.php'>";
	  exit;
    }
  
	$path = "../temp/";
	
	$pn = file($path."prob.txt");
	$pn[0] = trim($pn[0]);
	
	for($i=1;$i<=$pn[0];$i++)
	{
	  $pn[$i] = trim($pn[$i]);
	  if(file_exists("../temp/time.txt"))
	  {
	    echo "<th><font color=\"#FFFFFF\"><a href=\"problem.php?id=$pn[$i]\">$pn[$i]</a></font></th>\r\n";
	  }
	  else
	  {
	    echo "<th><font color=\"#FFFFFF\">$pn[$i]</font></th>\r\n"; 
	  }
	}
	
	
  ?>
  <th><font color="#FFFFFF">���</font></th>
  <th><font color="#FFFFFF">ʱ��</font></th>
  </tr>
<?php

?>
</body>
</html>
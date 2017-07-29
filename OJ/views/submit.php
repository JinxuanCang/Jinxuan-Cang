<html>
<body id="submit">
<head>
   <meta http-equiv="Content-Language" content="zh-cn">
   <link href="../css/background.css" type="text/css" rel="stylesheet" />

</head>
<?php

  session_start();
  if($_SESSION["probtitle"]==null)
  {  $probid = $_GET["id"];}
  else
  {  $probid = $_SESSION["probtitle"];unset($_SESSION["probtitle"]);}
  $_SESSION["title"] = $probid;
  $_SESSION["lang"] = "Pascal";
  if($probid===null)
  {
    echo "题目：未选择题目";
  }
  else
  {
    echo "题目：".$probid;
  }
  echo "  语言：pascal";
  echo '
  <form action="test.php" method="post">
    源程序
    <textarea name="program" cols="48" rows="4"></textarea>
    <div id="status"><input onclick="document.getElementById(\'status\').innerHTML=\'请稍候……\';location.href=\'test.php\';" type="submit" value="Submit">
    <input type="reset" value="Reset"></div>
  </form>
       ';
?>
</body>
</html>
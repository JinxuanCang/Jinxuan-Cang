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
    echo "��Ŀ��δѡ����Ŀ";
  }
  else
  {
    echo "��Ŀ��".$probid;
  }
  echo "  ���ԣ�pascal";
  echo '
  <form action="test.php" method="post">
    Դ����
    <textarea name="program" cols="48" rows="4"></textarea>
    <div id="status"><input onclick="document.getElementById(\'status\').innerHTML=\'���Ժ򡭡�\';location.href=\'test.php\';" type="submit" value="Submit">
    <input type="reset" value="Reset"></div>
  </form>
       ';
?>
</body>
</html>
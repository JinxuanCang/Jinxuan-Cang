<html>
<body id="left">
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<link href="../css/background.css" type="text/css" rel="stylesheet">
<link href="../css/href_left.css" type="text/css" rel="stylesheet" />
</head>
<?php
  session_start();
  if($_SESSION["user"]==null)
  {
    $_SESSION["httpstatus"] = 502;
	echo "<meta http-equiv='refresh' content='0; url=error.php'>";
	exit;
  }
  if($_SESSION["adminpass"]=="ok")
  {
    echo "<p><center><font size='2'>管理员</font></center></p>";
  }
  echo '<p><center><font size="2">'.$_SESSION["user"].'</font></center></p>';
?>
<div><center><font size="2">登录成功</font></center></div>
<div><center><font size="2">欢迎回来</font></center></div>
<center><p id='time'>0:0:0</p></center>

<script src='../js/time.js'></script>

<?php
  if(file_exists("../temp/time.txt"))
{
  echo '<ul><font size="2"><a target="right" href="problem.php">题库</a></font></ul>';
  echo '<ul><font size="2"><a target="right" href="status.php">状态</a></font></ul>';
}
?>
<ul><font size="2"><a target="right" href="standing.php">排名</a></font></ul>
<ul><font size="2">讨论</font></ul>
<?php
  if($_SESSION["adminpass"]=="ok")
  {
    echo "<ul><font size=\"2\"><a target='right' href='manage.php'>管理</a></font></ul>";
  }
?>
<ul><font size="2">用户</a></font></ul>
<ul><font size="2"><a target="right" href="help.php">帮助</a></font></ul>
<ul><font size="2"><a target="_top" href="logout.php">登出</a></font></ul>
<meta http-equiv='refresh' content='60; url=user.php'>
</body>
</html>
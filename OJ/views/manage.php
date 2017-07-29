<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<link href="../css/background.css" type="text/css" rel="stylesheet" />
</head>
<body id="manage">
<p><center>PDT管理</center></p>
<hr>
<p>用户登录记录</p>
<iframe src="../logs/login_history.log"></iframe>
<hr>
<p>用户注册记录</p>
<iframe src="../logs/reg_IP.log"></iframe>
<hr>
<p>比赛控制</p>
<?php
  if(file_exists("../temp/time.txt"))
  {
    $status = "正在运行";
  }
  else
  {
    $status = "已终止";
  }
  echo "<p>系统状态：$status</p><br>";
?>

<hr>
<?php
  session_start();
  
  if($_SESSION["adminpass"] == "ok")
  {}
  else
  {
    echo "<meta http-equiv=\"refresh\" content='0; url=check.html'>";
	exit;
  }
  echo "<p>用户列表</p>";
  echo '<table border="0" cellspacing="1" cellpadding="5" width="100%">
        <tr bgcolor="#FFFFFF">
        <th>序号</th>
        <th>姓名</th>
        <th>密码</th>
        <th>操作</th>
        </tr>

       ';
  $path = "../users/";
  $file = file("../temp/users.txt");
  $file[0] = trim($file[0]);
  for($i=1;$i<=$file[0];$i++)
  {
    $file[$i] = trim($file[$i]);
    $pw = file($path.$file[$i]);
    $pw[0] = trim($pw[0]);
    echo "<tr bgcolor=\"#FFFFFF\">
          <th>$i</th>
          <th>$file[$i]</th>
          <th onclick=alert('$pw[0]')><font size=\"2\"><img border='0' src='../css/img/b_primary.png' width='16' height='16'>点击查看</font></th>
          <th width='25%'>
             <a href='deal.php?ct=che&un=$file[$i]'><img border='0' src='../css/img/b_usrcheck.png' width='16' height='16'><font size=\"2\">用户信息</font></a>
             <a href='deal.php?ct=edi&un=$file[$i]'><img border='0' src='../css/img/b_usredit.png' width='16' height='16'><font size=\"2\">恢复密码</font></a>
             <a href='deal.php?ct=del&un=$file[$i]'><img border='0' src='../css/img/b_usrdrop.png' width='16' height='16'><font size=\"2\">删除用户</font></a>
          </th>
          </tr>";
    
  }
?>

</body>
</html>
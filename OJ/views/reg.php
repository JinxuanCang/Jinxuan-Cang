<html>
<body>
<?php
  session_start();
  error_reporting(E_ALL || ~E_NOTICE);

//注册用户姓名、密码写入路径
  $file = "../users/";
//IP地址写入路径
  $IP = "../logs/";
//电子邮箱地址写入路径
  $email = "../";

  
  if($_SESSION["user"]=="")
  {}
  else
  {
    echo "<script>alert('您已登录，不可再注册。');</script>";
    echo "<meta http-equiv='refresh' content='0; url=help.php'>";
    exit;
  }

  if($_POST["username"]==="")
  {
    echo "<script>alert('用户名为空！');history.back();</script>";
    exit;
  }
  
  if(file_exists($file.$_POST["username"]))
  {
    echo "<script>alert('用户名重复！');history.back();</script>";
    exit;
  }
  
  if(strlen($_POST["username"])<2)
  {
    echo "<script>alert('用户名至少2个及以上字符！');history.back();</script>";
    exit;
  }
  
  if($_POST["password"]==="")
  {
    echo "<script>alert('密码为空！');history.back();</script>";
    exit;
  }
  
  if($_POST["pass"]==="")
  {
    echo "<script>alert('确认密码为空！');history.back();</script>";
    exit;
  }
  
  if($_POST["email"]==="")
  {
    echo "<script>alert('电子邮箱为空！');history.back();</script>";
    exit;
  }
  
  if(strpos($_POST["email"],"@"))
  {}
  else
  {
    echo "<script>alert('电子邮箱格式错误！');history.back();</script>";
    exit;
  }
  
  if($_POST["password"]===$_POST["pass"])
  {}
  else
  {
    echo "<script>alert('两次密码输入不一致！');history.back();</script>";
    exit;
  }


  $myfile = fopen($file.$_POST["username"], "w") or die("Unable to open file!");
  $txt = $_POST["password"];

  fwrite($myfile, $txt);
  fclose($myfile);
  
  $myfile = fopen($email."email.txt","a") or die("Unable to open file!");
  $txt = $_POST["username"]."  ".$_POST["email"]."\r\n";
  
  fwrite($myfile, $txt);
  fclose($myfile);

  $myfile = fopen($IP."reg_IP.log","a") or die("Unable to open file!");
  $txt = $_POST["username"]."  ".$_SERVER["REMOTE_ADDR"]."\r\n";
  
  fwrite($myfile, $txt);
  fclose($myfile);

  echo "<script>alert('注册成功！');</script>";
  echo "<meta http-equiv='refresh' content='0; url=help.php'>";

?>
</body>
</html>
<html>
<body>
<?php
  session_start();
  error_reporting(E_ALL || ~E_NOTICE);

//ע���û�����������д��·��
  $file = "../users/";
//IP��ַд��·��
  $IP = "../logs/";
//���������ַд��·��
  $email = "../";

  
  if($_SESSION["user"]=="")
  {}
  else
  {
    echo "<script>alert('���ѵ�¼��������ע�ᡣ');</script>";
    echo "<meta http-equiv='refresh' content='0; url=help.php'>";
    exit;
  }

  if($_POST["username"]==="")
  {
    echo "<script>alert('�û���Ϊ�գ�');history.back();</script>";
    exit;
  }
  
  if(file_exists($file.$_POST["username"]))
  {
    echo "<script>alert('�û����ظ���');history.back();</script>";
    exit;
  }
  
  if(strlen($_POST["username"])<2)
  {
    echo "<script>alert('�û�������2���������ַ���');history.back();</script>";
    exit;
  }
  
  if($_POST["password"]==="")
  {
    echo "<script>alert('����Ϊ�գ�');history.back();</script>";
    exit;
  }
  
  if($_POST["pass"]==="")
  {
    echo "<script>alert('ȷ������Ϊ�գ�');history.back();</script>";
    exit;
  }
  
  if($_POST["email"]==="")
  {
    echo "<script>alert('��������Ϊ�գ�');history.back();</script>";
    exit;
  }
  
  if(strpos($_POST["email"],"@"))
  {}
  else
  {
    echo "<script>alert('���������ʽ����');history.back();</script>";
    exit;
  }
  
  if($_POST["password"]===$_POST["pass"])
  {}
  else
  {
    echo "<script>alert('�����������벻һ�£�');history.back();</script>";
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

  echo "<script>alert('ע��ɹ���');</script>";
  echo "<meta http-equiv='refresh' content='0; url=help.php'>";

?>
</body>
</html>
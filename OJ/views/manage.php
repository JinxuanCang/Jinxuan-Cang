<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<link href="../css/background.css" type="text/css" rel="stylesheet" />
</head>
<body id="manage">
<p><center>PDT����</center></p>
<hr>
<p>�û���¼��¼</p>
<iframe src="../logs/login_history.log"></iframe>
<hr>
<p>�û�ע���¼</p>
<iframe src="../logs/reg_IP.log"></iframe>
<hr>
<p>��������</p>
<?php
  if(file_exists("../temp/time.txt"))
  {
    $status = "��������";
  }
  else
  {
    $status = "����ֹ";
  }
  echo "<p>ϵͳ״̬��$status</p><br>";
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
  echo "<p>�û��б�</p>";
  echo '<table border="0" cellspacing="1" cellpadding="5" width="100%">
        <tr bgcolor="#FFFFFF">
        <th>���</th>
        <th>����</th>
        <th>����</th>
        <th>����</th>
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
          <th onclick=alert('$pw[0]')><font size=\"2\"><img border='0' src='../css/img/b_primary.png' width='16' height='16'>����鿴</font></th>
          <th width='25%'>
             <a href='deal.php?ct=che&un=$file[$i]'><img border='0' src='../css/img/b_usrcheck.png' width='16' height='16'><font size=\"2\">�û���Ϣ</font></a>
             <a href='deal.php?ct=edi&un=$file[$i]'><img border='0' src='../css/img/b_usredit.png' width='16' height='16'><font size=\"2\">�ָ�����</font></a>
             <a href='deal.php?ct=del&un=$file[$i]'><img border='0' src='../css/img/b_usrdrop.png' width='16' height='16'><font size=\"2\">ɾ���û�</font></a>
          </th>
          </tr>";
    
  }
?>

</body>
</html>
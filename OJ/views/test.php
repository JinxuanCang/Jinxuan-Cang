<html>

<head>
  <meta http-equiv="Content-Language" content="zh-cn">
  <link href="../css/background.css" type="text/css" rel="stylesheet" />
  <link href="../css/href_test&help.css" type="text/css" rel="stylesheet" />
</head>

<body id="test">

<?php
  session_start();

  $path = "../temp/";
  
  $i = 0;
  $jk = $_SESSION["title"];
  
  if($_SESSION["title"]===null){echo "<script>alert('��ѡ����Ŀ��');history.back();</script>"; exit;}
  if($_POST["program"]===""){echo "<script>alert('û�г����ϴ���');history.back();</script>"; exit;}
  
  if(file_exists("../temp/time.txt"))
  {}
  else
  {
     echo "<p>�ύ�����<font color='#FF00FF'>Trash  </font>������δ��ʼ���ѽ�����<a target='right' href='help.php'>ˢ��<a></p>";
     exit;
  }


  $myfile = fopen($path."new_user.txt", "w") or die("Unable to open file!");
  $txt = $_SESSION["user"];

  fwrite($myfile, $txt);
  fclose($myfile);
  
  $myfile = fopen($path."new_IP.txt", "w") or die("Unable to open file!");
  $txt = $_SERVER["REMOTE_ADDR"];

  fwrite($myfile, $txt);
  fclose($myfile);
  
  $myfile = fopen($path."new_language.txt", "w") or die("Unable to open file!");
  $txt = $_SESSION["lang"];

  fwrite($myfile, $txt);
  fclose($myfile);
  
  $myfile = fopen($path."new_program.txt", "w") or die("Unable to open file!");
  $txt = $_POST["program"];

  fwrite($myfile, $txt);
  fclose($myfile);
  
  $myfile = fopen($path."new_title.txt", "w") or die("Unable to open file!");
  $txt = $_SESSION["title"];

  fwrite($myfile, $txt);
  fclose($myfile);
  
  
  /******************************************************************************************************/
  while(1){if(file_exists("../temp/tail.txt")){break;}}
  $tail=file($path."tail.txt");
  $tail[0] = trim($tail[0]);
  $tail[0]++;

  while(1){if(file_exists("../submit/problem/$tail[0]/ok")){break;}}
  unlink("../submit/problem/$tail[0]/ok");

  $res=file("../submit/problem/".$tail[0]."/result.txt");
  $res[0] = trim($res[0]);


  if($res[0]==="Complie Error"){echo "<p>�ύ�����<font color='#FF0000'>Complie Error  </font><a href='submit.php?id=$jk'>����</a></p>";}
  if($res[0]==="Presentation Error"){echo "<p>�ύ�����<font color='#FF0000'>Presentation Error  </font><a href='submit.php?id=$jk'>����</a></p>";}
  if($res[0]==="Wrong Answer"){echo "<p>�ύ�����<font color='#FF0000'>Wrong Answer  </font><a href='submit.php?id=$jk'>����</a></p>";}
  if($res[0]==="Accepted"){echo "<p>�ύ�����<font color='#00CC00'>Accepted  </font><a target='right' href='problem.html'>��������</a></p>";}
  echo "<p>��<a target='right' href='status.php'>״̬</a>�в鿴���ࡣ</p>";


?>
</body>
</html>
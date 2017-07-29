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
  
  if($_SESSION["title"]===null){echo "<script>alert('请选择题目！');history.back();</script>"; exit;}
  if($_POST["program"]===""){echo "<script>alert('没有程序上传！');history.back();</script>"; exit;}
  
  if(file_exists("../temp/time.txt"))
  {}
  else
  {
     echo "<p>提交结果：<font color='#FF00FF'>Trash  </font>比赛尚未开始或已结束。<a target='right' href='help.php'>刷新<a></p>";
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


  if($res[0]==="Complie Error"){echo "<p>提交结果：<font color='#FF0000'>Complie Error  </font><a href='submit.php?id=$jk'>重做</a></p>";}
  if($res[0]==="Presentation Error"){echo "<p>提交结果：<font color='#FF0000'>Presentation Error  </font><a href='submit.php?id=$jk'>重做</a></p>";}
  if($res[0]==="Wrong Answer"){echo "<p>提交结果：<font color='#FF0000'>Wrong Answer  </font><a href='submit.php?id=$jk'>重做</a></p>";}
  if($res[0]==="Accepted"){echo "<p>提交结果：<font color='#00CC00'>Accepted  </font><a target='right' href='problem.html'>继续答题</a></p>";}
  echo "<p>在<a target='right' href='status.php'>状态</a>中查看更多。</p>";


?>
</body>
</html>
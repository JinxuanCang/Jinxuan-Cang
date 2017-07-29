<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<link href="../css/background.css" type="text/css" rel="stylesheet" />
<link href="../css/href_status&library.css" type="text/css" rel="stylesheet" />
</head>
<body id="library">
<p><center>PDT题库</center></p>
<hr>
<table border="0" cellspacing="1" cellpadding="5" width="100%">
  <tr bgcolor="#330099">
  <th><font color="#FFFFFF">序号</font></th>
  <th><font color="#FFFFFF">题目</font></th>
  <th><font color="#FFFFFF">提交</font></th>
  <th><font color="#FFFFFF">通过</font></th>
  <th><font color="#FFFFFF">正确率</font></th>
  </tr>


<?php
  session_start();
  
  $path="../submit/problem/";
  
  $timu = $_SESSION["probtitle"];
  $file=file("../temp/prob.txt");
  $n=count($file);
  $s=$file[0];
  $i = 0;
  
  $limit=file("../temp/tail.txt");
  $j=$limit[0];
  $j=trim($j);
  
  function display_prob($i,$file)
  {

   $file[$i] = trim($file[$i]);

   if($i%2===0)
   {
     echo "<tr bgcolor='#E0FFFF'>";
   }
   else
   {
     echo "<tr bgcolor='#CCFFFF'>";
   }
    echo "
    <th><font color=\"#000000\">$i</font></th>
    <th><font color=\"#000000\">
    <a target=\"submit\" href=\"submit.php?id=$file[$i]\" onclick=\"location.href='../library/$file[$i]/prob.html';\">$file[$i]</a>
    </font></th>
        ";
  }

  function display_record($i,$j,$path,$file)
  {
    $tj = 0;
    $tg = 0;
    while(true)
    {
	  if(file_exists($path.$j))
      {}
      else {break;}
	  
      $tm=file($path.$j."/title.txt");
      $jg=file($path.$j."/result.txt");

      $file[$i] = trim($file[$i]);
      $tm[0] = trim($tm[0]);
      $jg[0] = trim($jg[0]);
	  
      if($file[$i]===$tm[0])
      {
       if($jg[0]==="Accepted"){$tg++;}
       $tj++;
      }
      

      $j--;
    }
	if($tj==0)
	{
	  $zq = 0;
	}
	else
	{
      $zq = floor($tg/$tj*100);
	}
    if($tg===0 and $tj===0){$zql = 0;} else{$zql = $zq;}
      echo     "<th><font color='#000000'>$tj</font></th>";
      echo     "<th><font color='#000000'>$tg</font></th>";
      echo     "<th><font color='#000000'>$zql%</font></th>";
  }
  if($timu=="")
  {}
  else
  {
    echo "<meta http-equiv='refresh' content='0; url=../library/$timu/prob.html'>";
  }
  while($i<$s)
  {
    $i++;
    display_prob($i,$file);
    display_record($i,$j,$path,$file);
  }
?>


<meta http-equiv="refresh" content='60; url=library.php'>
</body>
</html>
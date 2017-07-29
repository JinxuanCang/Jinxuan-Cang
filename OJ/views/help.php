﻿<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn">
<link href="../css/background.css" type="text/css" rel="stylesheet">
<link href="../css/href_test&help.css" type="text/css" rel="stylesheet">
<p><center>PDT帮助</center></p>
<hr>
</head>
<body id="help">
<ol>

	<?php
	  session_start();
	  if($_SESSION["user"]==null)
	  {
	    echo '
    <li>请先<a href="reg.html">注册</a>；<ol>
	<li>支持中英文姓名，请用真实姓名注册；</li>
	<li>账号不能含有“ (空格)+-*/\\#$%&amp;@|~^`,;.?!\'&quot;()[]{}&lt;&gt;”等特殊字符；</li>
	<li>账号至少2个字符；</li>
	<li>为了便于老师整理，每人只准注册一个账号；</li>
	<li>没有密码找回功能，请牢记自己的密码。</li>
	</ol></li>
	<li>然后<a target="left" href="user.php">登录</a>；<ol>
	<li>账号中不要错输空格等特殊字符；</li>
	<li>忘记密码，请联系老师。</li>
	</ol>
	</li>
	         ';
	  }
	  else
	  { echo '
	<li>在<a href="problem.php">题库</a>中浏览试题，点击试题名称，打开试题；</li>
	<li>完成程序的编写，调试正确；<ol>
	<li>注意随时保存自己的程序；</li>
	<li>记住保存的路径及文件名；</li>
	<li>不需要文件输入输出格式。</li>
	</ol></li>
	<li>通过试题下方的提交框架，找到保存的源程序，打开并复制源代码；</li>
	<li>在<a href="status.php">状态</a>中可以查看评测结果；<ol>
	<li>高亮显示的是你自己的结果；</li>
	<li>Accepted：通过；Compile Error：编译错误；Presentation Error：格式错误；Wrong Answer：结果错误。</li>
	</ol></li>
	<li>在<a href="standing.php">排名</a>中可以查看排行榜；<ol>
	<li>+ 表示通过；- 表示错误；()内数字表示提交次数；()外数字表示提交时间（时刻）；</li>
	<li>解决的题数越多，排名越前；解决的题数同样多，用时少的居前；</li>
	<li>高亮显示的是你自己的结果。</li>
	</ol></li>
        <li>如果您是管理员，请由<a href="manage.php">这里</a>进入管理界面。</li>
	        ';
	  }
	?>
</ol>
</body>
</html>
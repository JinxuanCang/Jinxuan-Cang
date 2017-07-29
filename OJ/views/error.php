<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
</head>
<body>
<center>
<?php
  session_start();

  switch($_SESSION["httpstatus"])
  {
    case 400 : echo "<h1>400 Bad Request</h1>";break;
	case 401 : echo "<h1>401 Unauthorized</h1>";break;
	case 402 : echo "<h1>402 Payment Required</h1>";break;
	case 403 : echo "<h1>403 Forbidden</h1>";break;
    case 404 : echo "<h1>404 Not Found</h1>";break;
	case 405 : echo "<h1>405 Method Not Allowed</h1>";break;
    case 502 : echo "<h1>502 Bad Gateway</h1>";break;
    default : echo "<h1>601 Empty Page</h1>";
  }
  echo "<hr>";
  switch($_SESSION["httpstatus"])
  {
    case 400 : echo "";break;
	case 401 : echo "";break;
	case 402 : echo "";break;
	case 403 : echo "<p>服务器已经理解请求，但是拒绝执行它。原因是您的浏览器不是谷歌浏览器，请使用谷歌浏览器以保证良好性能。</p>";break;
    case 404 : echo "";break;
	case 405 : echo "<p>服务器已经理解请求，但是认为现在不应该访问它。原因是比赛尚未开始或已结束，你不能作弊。</p>";break;
    case 502 : echo "<p>服务器已经理解请求，但是认为不应该用这种方式进入页面。原因是你尚未登录。</p>";break;
    default : echo "<p>请您不要试图刷新此页。</p>";
  }
  unset($_SESSION["httpstatus"]);
?>

</center>
</body>
</html>
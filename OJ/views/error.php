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
	case 403 : echo "<p>�������Ѿ�������󣬵��Ǿܾ�ִ������ԭ����������������ǹȸ����������ʹ�ùȸ�������Ա�֤�������ܡ�</p>";break;
    case 404 : echo "";break;
	case 405 : echo "<p>�������Ѿ�������󣬵�����Ϊ���ڲ�Ӧ�÷�������ԭ���Ǳ�����δ��ʼ���ѽ������㲻�����ס�</p>";break;
    case 502 : echo "<p>�������Ѿ�������󣬵�����Ϊ��Ӧ�������ַ�ʽ����ҳ�档ԭ��������δ��¼��</p>";break;
    default : echo "<p>������Ҫ��ͼˢ�´�ҳ��</p>";
  }
  unset($_SESSION["httpstatus"]);
?>

</center>
</body>
</html>
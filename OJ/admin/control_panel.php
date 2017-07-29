<html>
  <head>
    <?php include("../essential_settings.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
  </head>
  <body onload="blink();">
  	<div id="header">
  	  <div id="location">
        <img height="14" width="14" src="../css/img/s_host.png"><?php echo $_SERVER['HTTP_HOST'];?>&gt;Control Panel
      </div>
	    <ul id="horizontal_bar">
	      <li><a class="active"><img src="../css/img/s_status.png"> All</a></li>
	    </ul>
	  </div>
	<div id="popmessage">None.</div>
  <style>
    body {
      background-color: darkgrey;
    }
    .signal_led {
      padding: 0 8.5px 0 8.5px;
      border-radius: 100%;
    }
    .signal_sq {
      padding: 0 8.5px 0 8.5px;
    }
  </style>
  <script>
    function blink() {
      var f = document.getElementById('mainbody').getElementsByClassName('bk')[0];
      setInterval(function() {
        f.style.backgroundColor = (f.style.backgroundColor == 'lime' ? 'red' : 'lime');
      }, 300);
      var a = document.getElementById('mainbody').getElementsByClassName('bk')[2];
      setInterval(function() {
        a.style.backgroundColor = (a.style.backgroundColor == 'darkgrey' ? 'white' : 'darkgrey');
      }, 300);
    }
  </script>
	<div id="mainbody">
    <table>
      <tr>
        <td class="signal_led bk" style="background-color: red;"></td>
        <td>demo</td>
      </tr>
      <tr>
        <td class="signal_led bk" style="background-color: red;"></td>
        <td>demo</td>
      </tr>
      <tr><td></td><td>Buffer</td></tr>
      <tr>
        <td class="signal_sq bk" style="background-color: white;"></td>
        <td>element 1</td>
      </tr>
    </table>
	</div>
  </body>
</html>
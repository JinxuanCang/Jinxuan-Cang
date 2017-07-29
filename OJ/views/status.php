<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/chart.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/chart.js"></script>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <input type="button" value="Generate Report" onclick="window.open('document.php','_blank','width=612,height=792')">
    <input type="button" value="Reboot" onclick="System_Reboot();">
    <p></p>
    <div id="chart1"></div>
    <script>
      var type = "bar";
      var target = "chart1",data = [["12:00am",10],["12:30am",11],["1:00am",12],["1:30am",13],["2:00am",14],["2:30am",15],["3:00am",16],["3:30am",17],["4:00am",18],["4:30am",19],["5:00am",20],["5:30am",21],["6:00am",22]];
      var settings = {
        width: 600,
        height: 300,
        title:"Demo of PHP-Campus Chart Generator",
        x_axis_title: "Time",
        y_axis_title: "Temperature",
        formal: true
      }
      chart(type,target,data,settings);
    </script>
	</div>
  </body>
</html>
<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/table.js"></script>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <fieldset class="info">
      <h2>Future Schedule Plan Chart</h2>
    </fieldset>
    <section id="futrue_schedule"></section>
  </div>
  <script>
    var target = "futrue_schedule";
    var head = ["APs","1","2","3","4","5","6"];
    var data = [
      ["9th Grade"],
      ["10th Grade","AP Human Geo.","AP Comp. Sci. A","AP Psyc."],
      ["11th Grade","AP Stat.","AP Calc. BC","AP CompSci. Princ.","AP US Gov.","AP Bio.","AP Phy. 1"],
      ["12th Grade","AP Phy. C","AP Envir. Sci.","AP Eng. Lang.","AP Macro-Eco.*","AP Micro-Eco.*"],
    ];
    var settings = {
      formatted:true,//boolean
      height:"300px",//"static ##" or "fit"
      scroll_bar_width:12,
    };
    table(target,head,data,settings);
  </script>
  </body>
</html>
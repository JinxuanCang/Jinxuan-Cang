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
    <style>

    </style>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <section id="specific_scan_sec">
      <fieldset class="info">
        <h2>IP Tracer</h2>
      </fieldset>
      <h3></h3>
    </section>
    <section id="server_variables_sec">
      <fieldset class="info">
        <h2>Server Variables</h2>
      </fieldset>
      <div id="server_variables"></div>
    </section>
    <section id="active_hosts_sec">
      <fieldset class="info">
        <h2>Active Hosts</h2>
      </fieldset>
      <div id="active_hosts_control" style="margin-bottom: 12px;">
        <button onclick="Update_ActiveHosts();">Refresh</button>
        <button onclick="Settings('active_hosts')">Settings</button>
      </div>
      <div id="active_hosts"></div>
    </section>
    <script>
      var target = "server_variables";
      var head = ["Variable Name","Value"];
      var data = [<?php
                      $s = "";
                      foreach ($_SERVER as $key => $value) {
                        $s .= "'".$key."','".$value."',";
                      }
                      echo substr($s, 0, -1);
                 ?>];
      var settings = {
        formal:false,//boolean
        smart_table:false,//boolean
        height:"screen-fit",//"static ##" or "fit"
        line_number:true,//boolean
      };
      table(target,head,data,settings);
      var target = "active_hosts";
      var head = ["Internet Protocol","Host Name"];
      //var data = [<?php //include("ip_scanner.php"); ?>];
      var settings = {
        formal:false,//boolean
        smart_table:false,//boolean
        height:"screen-fit",//"static ##" or "fit"
        sortable:[1,1,1],
        sorted: true,
        line_number:true,//boolean
        actions:["Trace"],//array
        action_icon:[5],//array,icons,src only
      };
      
      function Update_ActiveHosts() {
        var active_hosts = new XMLHttpRequest();
          active_hosts.onreadystatechange=function() {
              if (active_hosts.readyState==4 && active_hosts.status==200) {
                if(invoke("active_hosts").contains(invoke("active_hosts").getElementsByClassName('tbl_hct')[0])) {
                  invoke("active_hosts").firstChild.remove();
                  invoke("active_hosts").lastChild.remove();
                }
                var data = active_hosts.responseText.split(",");
                table(target,head,data,settings);
                LoadMessage("Okay","All hosts scanned successfully.");
              }
          }
          //AJAX Sending
          //active_hosts.open("POST","./ip_scanner.php",true);
          active_hosts.open("GET","./ip_scanner.php",true);
          //active_hosts.setRequestHeader("Content-type","application/x-www-form-urlencoded");
          //active_hosts.send("active_code="+active_code);
          active_hosts.send();
          Loading();
      }
      function Clear_All() {
        disappear("specific_scan_sec");
        disappear("server_variables_sec");
        disappear("active_hosts_sec");
      }
      function Switch(obj) {
        Clear_All();
        switch(obj) {
          case "specific_scan": appear("specific_scan_sec"); break;
          case "server_variables": appear("server_variables_sec"); tbl_render("server_variables"); break;
          case "active_hosts": 
            appear("active_hosts_sec");
            if(invoke("active_hosts").contains(invoke("active_hosts").getElementsByClassName('tbl_hct')[0]))
              tbl_render("active_hosts");
            else Update_ActiveHosts();
          break;
        }
      }
      Switch("specific_scan");
    </script>
	</div>
  </body>
</html>
<html>
  <head>
    <title>PHP-Campus</title>
    <link rel="icon" href="../css/img/PHP_Campus_header_logo.png">
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <?php include("../module/font_color.php");?>
    <script type="text/javascript" src="../js/initial_colorcode.js"></script>
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/colorname_converter.js"></script>
    <script type="text/javascript" src="../js/html2canvas.js"></script>
    <script type="text/javascript" src="../js/clock2.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <style>
      body {
        margin: 0;
      }
      iframe {
        border: none;
      }
      #content_divider{
        background-color: grey;
        width: 5px;
        height: 100%;
      }
    </style>
    <!-- Set all <a> target -->
    <base target="main">
  </head>
  <body style="display: flex; height: 100%">
    <style>
      body svg {
        fill: white;
      }
      .content_list div {
        padding: 10px;
        transition: all 0.2s linear;
      }
      .content_list div:hover {
        background-color: var(--800);
      }
      .content_list div svg {
        width: 30px;
        height: 30px;
        display: block;
        margin: auto;
      }
      #bottom_group {
        position: absolute;
        bottom: 0;
      }
      #logoff svg{
        transition: fill 0.2s linear;
      }
      #logoff:hover svg {
        fill: red;
      }
      #vertical_bar {
        margin-top: 70px;
        margin-left: 0px;
        background-color: var(--700);
        z-index: 9;
        transition: margin-left 0.3s linear;
      }
      #horizontal_bar {
        background-color: var(--800);
        height: 70px;
        width: 100%;
        position: absolute;
        z-index: 10;
        color: white;
      }
      #logo {
        position: absolute;
        height: 70px;
        width: 50px;
      }
      #logo img {
        position: absolute;
        top: 20px;
        left: 10px;
      }
      #account svg {
        width: 35px;
        height: 35px;
        margin: auto 10px;
        fill: aliceblue;
      }
      #account {
        float: right;
        display: flex;
        height: 70px;
        font-family: arial;
        text-shadow: 0.5px 0.5px 0.5px white;
      }
      #sub_location {
        position: absolute;
        left: 50px;
      }
      #sub_location div {
        display: flex;
        height: 70px;
      }
      #sub_location a {
        border-bottom: 3px solid var(--500);
        transition: all 0.3s linear;
        padding: 0 10px;
        line-height: 70px;
        color: white;
      }
      #sub_location a:hover {
        border-color: var(--50);
        background-color: var(--500);
      }
      #dialog {
        position: absolute;
        margin: auto;
        top: 0;right: 0;bottom: 0;left: 0;
        width: 600px;
        height: 400px;
        background-color: #ccc;
        border-radius: 3px;
        z-index: 12;
        border: 1px solid #aaa;
      }
      #dia_cover {
        z-index: 11;
        top: 0;right: 0;bottom: 0;left: 0;
        position: absolute;
        background-color: grey;
        opacity: 0.3;
      }
      #dia_close {
        hover: background-color: grey;
      }
    </style>
    <div id="horizontal_bar" ondblclick="Display_Option(); return false;" onselectstart="return false;">
      <div id="logo"><img src="../css/img/PHP_Campus_header_logo.png" height="30" width="30"></div>
      <div id="sub_location">
        <div id="general">
          <a href="dashboard.php" style="border-bottom-color: var(--B200);">Dashboard</a>
          <a href="calendar.php">Calendar</a>
          <a href="users.php">Users</a>
          <a href="scripts.php">Scripts</a>
          <a href="status.php">Status</a>
          <a href="informations.php">Informations</a>
        </div>
        <div id="assignments">
          <a href="assignments.php">Overview</a>
          <a href="assignments.php">Incomplete Assignments</a>
          <a href="assignments.php">Completed Assignments</a>
          <a href="scores.php">Score Board</a>
        </div>
        <div id="applications">
          <a></a>
        </div>
        <div id="console">
          <a href="javascript:">User Screen</a>
          <a href="javascript:">History</a>
          <a href="javascript:">Settings</a>
        </div>
        <div id="testing_table">
          <a href="javascript:Switch(this,'user_str_ctn');">User Storage</a></li>
          <a href="#">Sharing</a>
          <a href="#">Import</a>
          <a href="#">Export</a>
        </div>
        <div id="ip_tracer">
          <a href="javascript:invoke('display_main').contentWindow.Switch('specific_scan');">Specific Scan</a>
          <a href="javascript:invoke('display_main').contentWindow.Switch('server_variables');">Server Variables</a>
          <a href="javascript:invoke('display_main').contentWindow.Switch('active_hosts');">Active Hosts</a>
        </div>
        <div id="assigner">
          <a href="javascript:invoke('display_main').contentWindow.Switch('')">Assignment(s) Editor</a>
        </div>
        <div id="help">
          <a href="#">Quick Start</a>
        </div>
      </div>
      <div id="account">
        <div style="margin: auto; font-size: 15px;"><?php echo str_replace("_", " ", $_SESSION["username"]);?></div>
        <?php echo file_get_contents("../css/img/c_account.svg"); ?>
      </div>
    </div>
    <div id="vertical_bar" oncontextmenu="Hiding_Menu(); return false;" ondblclick="Display_Option(); return false;" onselectstart="return false;">
      <section id="top_group" class="content_list">
        <div id="general_bt" style="background-color: var(--900);"><?php echo file_get_contents("../css/img/c_home.svg"); ?></div>
        <div id="assignments_bt"><?php echo file_get_contents("../css/img/c_assignments.svg"); ?></div>
        <div id="applications_bt"><?php echo file_get_contents("../css/img/c_applications.svg"); ?></div>
        <div id="reference_bt"><?php echo file_get_contents("../css/img/c_reference.svg"); ?></div>
        <div id="help_bt"><?php echo file_get_contents("../css/img/c_help.svg"); ?></div>
        <script>
          //public functions
          function Vertical_Clear() {
            for (i = 0; invoke("top_group").contains(invoke("top_group").getElementsByTagName("div")[i]); i++) {
              tarcolor(invoke("top_group").getElementsByTagName("div")[i],null);
            }
          }
          function Horizontal_Clear() {

          }
          function Hiding_Clear() {
            for (i = 0; i < invoke("hiding_bar").childElementCount-1; i++) {
              tarcolor(invoke("hiding_bar").getElementsByTagName("a")[i],null);
            }
          }
          function Vertical_Nav (id) {
            Vertical_Clear();Hiding_Clear();
            invoke(id).style.backgroundColor = C900;
            for (i = 0; invoke("sub_location").contains(invoke("sub_location").getElementsByTagName("div")[i]); i++) {
              tdisappear(invoke("sub_location").getElementsByTagName("div")[i]);
            }
            id = id.substr(0, id.length-3);var location;
            appear(id,"flex");
            switch(id) {
              case "general": location = "dashboard.php"; break;
              case "assignments": location = "assignments.php"; break;
              case "help": location = "../FAQs"; break;
            }
            window.open(location,"main");
          }
          function Horizontal_Nav(item) {
            for (i = 0; item.parentNode.contains(item.parentNode.getElementsByTagName("a")[i]); i++) {
              item.parentNode.getElementsByTagName("a")[i].style.borderBottomColor = null;
            }
            item.style.borderBottomColor = B200;
          }
          for (i = 0; invoke("sub_location").contains(invoke("sub_location").getElementsByTagName("a")[i]); i++) {
            invoke("sub_location").getElementsByTagName("a")[i].setAttribute("onclick","Horizontal_Nav(this)");
            invoke("sub_location").getElementsByTagName("a")[i].setAttribute("draggable","true");
          }
          for (i = 1; invoke("sub_location").contains(invoke("sub_location").getElementsByTagName("div")[i]); i++) {
            tdisappear(invoke("sub_location").getElementsByTagName("div")[i]);
            invoke("sub_location").getElementsByTagName("div")[i].getElementsByTagName("a")[0].style.borderBottomColor = B200;
          }
          for (i = 0; invoke("top_group").contains(invoke("top_group").getElementsByTagName("div")[i]); i++) {
            invoke("top_group").getElementsByTagName("div")[i].setAttribute("onclick","Vertical_Nav(this.id);");
          }
          function Hiding_Menu() {
            if (invoke("hiding_bar").style.left == "0px") {
              invoke("display_area").style.paddingLeft = "50px";
              invoke("vertical_bar").style.marginLeft = "0px";
              invoke("hiding_bar").style.left = "-100px";
            }
            else {
              invoke("display_area").style.paddingLeft = "150px";
              invoke("vertical_bar").style.marginLeft = "100px";
              invoke("hiding_bar").style.left = "0px";
            }
          }
          function Display_Option() {
            if (invoke("display_bar").style.right == "0px") {
              invoke("display_bar").style.right = "-300px";
            }
            else {
              invoke("display_bar").style.right = "0px";
            }
          }
        </script>
      </section>
      <section id="bottom_group" class="content_list">
        <div id="messages"><?php echo file_get_contents("../css/img/c_messages.svg"); ?></div>
        <div onclick="Show_Settings();"><?php echo file_get_contents("../css/img/c_settings.svg"); ?></div>
        <div id="logoff" onclick="window.open('../login','_top');" title="logoff"><?php echo file_get_contents("../css/img/c_logoff.svg"); ?></div>
      </section>
    </div>
    <style>
      #messages svg{
        fill: orange;
      }
      #hiding_bar {
        position: absolute;
        width: 100px;
        height: 100vh;
        z-index: 2;
        left: -100;
        transition: left 0.3s linear;
      }
      #hiding_bar a{
        width: 100px;
        box-sizing: border-box;
        height: 30px;
        font-size: 13px;
        display: block;
        color: white;
        background-color: var(--500);
        line-height: 30px;
        margin: auto;
        text-align: center;
        transition: all 0.2s linear;
      }
      #hiding_bar a:hover{
        background-color: var(--600);
      }
      .Nav_selected {
        background-color: var(--900);
      }
      #display_bar {
        position: fixed;
        width: 300px;
        height: 100vh;
        z-index: 9;
        right: -300;
        transition: all 0.3s linear;
        background-color: var(--900);
        opacity: 0.96;
      }
      #display_buttons div:not(.wrapper) {
        padding: 5px 10px;
        display: flex;
        line-height: 78px;
      }
      .wrapper {
        height: 78px;
        width: 100px;
        margin-left: 80px;
      }
      #display_area {
        transition: padding-left 0.3s linear;
      }
    </style>
    <div id="hiding_bar" onselectstart="return false;">
      <a href="../admin/console.php" id="console_bt" onclick="Vertical_Nav(this.id);" style="margin-top: 70px">Console</a>
      <a href="../admin/tracer.php" id="ip_tracer_bt" onclick="Vertical_Nav(this.id)">Tracer</a>
      <a href="program_test_maker.php" id="testing_table_bt" onclick="Vertical_Nav(this.id);">Testing Table</a>
      <a href="assigner.php" id="assigner_bt" onclick="Vertical_Nav(this.id);">Assigner</a>
      <a href="polar_clock.php">Polar Clock</a>
      <a href="future_schedule.php">Future Schedule</a>
      <a href="javascript:" onclick="Hiding_Menu();" style="background-color: #FF1744;" onmouseover="this.style.backgroundColor = '#FF3060'" onmouseleave="this.style.backgroundColor = '#FF1744' ">Hide</a>
      <!-- hiding bar -->
    </div>
    <div id="display_bar">
      <section id="display_buttons" style="margin-top: 70px;">
        <div>Display: Main</div>
        <div onclick="t_c(this);">Screen 1<div class="wrapper"></div></div>
        <div>Screen 2</div>
        <script>
          function t_c(obj) {
            invoke("display_main").style.transform = "scale(0.2)";
            invoke("display_main").style.width = "500px";
            invoke("display_main").style.height = "390px";
            obj.getElementsByClassName("wrapper")[0].appendChild(invoke("display_main"));
          }
        </script>
      </section>
    </div>
    <div id="display_area" style="position: absolute; padding-left: 50px; padding-top: 70px; width: 100%; height: 100%; box-sizing: border-box;">
      <iframe src="dashboard.php" id="display_main" name="main" style="width: 100%; height: 100%;transform-origin: 0 0;"></iframe>
    </div>
    <div id="display_map" style="z-index: 14; position: fixed; bottom: 0; right: 0;">
      <!-- null -->
    </div>
    <div id="dialog" style="display: none;">
      <div id="dia_head" style="background: linear-gradient(-90deg, grey, dimgrey); height: 30px; width: 100%;border-radius: 3px; padding: 5px 6px; box-sizing: border-box;">
        <div id="dia_title" style="display: inline-block;"">Settings</div>
        <div id="dia_close" style="width: 20px; height: 20px; display: inline-block; float: right;"><img src="../css/img/b_close.png" style="margin: auto; display: block;"></div>
      </div>
    </div>
    <div id="dia_cover" style="display: none;" onclick="Hide_Settings();"></div>
    <script>
      function Show_Settings() {
        appear("dialog");
        appear("dia_cover");
      }
      function Hide_Settings() {
        disappear("dia_cover");
        disappear("dialog");
      }
      for (i = 0; i < invoke("hiding_bar").childElementCount; i++) {
        //console.log(invoke("hiding_bar").getElementsByTagName("a")[i]);
        invoke("hiding_bar").getElementsByTagName("a")[i].setAttribute("draggable","true");
      }
      function handleStateChange() {
          html2canvas(document.getElementsByTagName("iframe")[0], {
          onrendered: function(canvas) {
            //invoke("display_map").removeChild(firstChild());
            invoke("display_map").appendChild(canvas);
          }
        })
      }
      
      /*var objIFrame = window.document.getElementById("display_main");
            if (objIFrame.addEventListener) {
                objIFrame.addEventListener('onreadystatechange', handleStateChange, false);
            }else if (objIFrame.attachEvent) {
                objIFrame.attachEvent ('onreadystatechange',handleStateChange);
            }else{
                objIFrame.onclose=temp();
            }*/
    </script>
  </body>
</html>
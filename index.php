<html style="padding: 0 !important;">
  <head>
    <title>PHP-Campus</title>
    <link rel="icon" href="../css/img/PHP_Campus_header_logo.png">
    <?php
      include("../essential_settings.php");
      Initialize();
      include("../module/font_color.php");
      js("/js/initial_colorcode.js");
      js("/js/colorname_converter.js");
      js("/js/clock2.js");
      css("/css/index.css");
      js("../js/table.js");
      css("../css/table.css");
    ?>
  </head>
  <body>
    <div id="display_container">
      <div id="progress_container">
        <div id="progress_bar"></div>
      </div>
      <div id="horizontal_bar" ondblclick="Display_Option(); return false;" onselectstart="return false;">
        <div id="logo"><img src="../css/img/PHP_Campus_header_logo.png" height="30" width="30"></div>
        <div id="sub_location">
          <?php horLocation("Gate","gnrl_login","login.php"); ?>
          <?php horLocation("Dashboard","gnrl_dashbd","dashboard.php"); ?>
          <?php horLocation("Calendar","gnrl_cld","calendar.php"); ?>
          <?php horLocation("Users","gnrl_usr","users.php"); ?>
          <?php horLocation("Scripts","gnrl_scpts","scripts.php"); ?>
          <?php horLocation("Updater","gnrl_update","/updater")?>
          <?php horLocation("Information","gnrl_info","informations.php"); ?>
          <!-- Assignments-->
          <?php horLocation("Overview","asgmt_over","javascript:"); ?>
          <?php horLocation("Incomplete","asgmt_incomp","javascript:"); ?>
          <?php horLocation("Reports","asgmt_rpots","javascript:"); ?>
          <?php horLocation("Assigner&trade;","asgmt_asiner","assigner.php"); ?>
          <!--
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
          </div>-->
        </div>
        <div id="account">
          <div style="margin: auto; font-size: 15px;"><?php if (isset($_SESSION["username"])) echo str_replace("_", " ", $_SESSION["username"]); else echo "?";?></div>
          <?php echo file_get_contents("../css/img/c_account.svg"); ?>
        </div>
      </div>
      <div id="main_container">
        <div id="vertical_bar" oncontextmenu="//Hiding_Menu(); return false;" ondblclick="Display_Option(); return false;" onselectstart="return false;">
          <section id="top_group">
            <?php
              verLocation("General","gnrl","c_home.svg","dashboard.php");
              verLocation("Assignment","asgmt","c_assignments.svg","assignments.php");
              verLocation("Applications","apps","c_applications.svg","javascript:");
              verLocation("Reference","refer","c_reference.svg","javascript:");
              verLocation("Help","help","c_help.svg","javascript:");
            ?>
          </section>
          <section id="bottom_group">
            <?php
              verLocation("Message","mesg","c_messages.svg",null);
              verLocation("Settings","sets","c_settings.svg","javascript:vartext('dia_title', 'General Settings'); invoke('dia_main').append(invoke('gnrl_sets').cloneNode(true));Show_Settings();");
              verLocation("LogOff","logoff","c_logoff.svg","javascript:LoggedOff();");
            ?>
          </section>
        </div>
        <div id="hiding_bar" onselectstart="return false;">
          <a href="../admin/console.php" id="console_bt" onclick="Vertical_Nav(this.id);">Console</a>
          <a href="../admin/tracer.php" id="ip_tracer_bt" onclick="Vertical_Nav(this.id)">Tracer</a>
          <a href="program_test_maker.php" id="testing_table_bt" onclick="Vertical_Nav(this.id);">Testing Table</a>
          <a href="assigner.php" id="assigner_bt" onclick="Vertical_Nav(this.id);">Assigner</a>
          <a href="polar_clock.php">Polar Clock</a>
          <a href="future_schedule.php">Future Schedule</a>
          <a href="javascript:" onclick="Hiding_Menu();" style="background-color: #FF1744;" onmouseover="this.style.backgroundColor = '#FF3060'" onmouseleave="this.style.backgroundColor = '#FF1744' ">Hide</a>
        </div>
        <div id="iframe_display">
          <iframe id="display_main" name="main" style="width: 100%; height: 100%; min-width: 780px;"></iframe>
        </div>
        <div id="popmessage">None.</div>
        <script>
          var timecall;
          function loadMessage(type, message, hold, dismiss) {
            var b_color, g_color;
            switch(type) {
              case "notice": case 0: case "n": default: b_color = "blue"; g_color = "#eff9fc"; break;
              case "success": case "okay": case 1: b_color = "green"; g_color = "#e6ffe6"; break;
              case "warning": case "caution": case 2: b_color = "orange"; g_color = "#ffffe6"; break;
              case "danger": case "error": case 3: b_color = "red"; g_color = "#fccccc"; break;
            }
            invoke("popmessage").style.borderColor = b_color;
            invoke("popmessage").bgColor(g_color);
            vartext("popmessage",message); clearTimeout(timecall);
            invoke("popmessage").removeAttribute("onclick");
            invoke("popmessage").block(); invoke("popmessage").fadeIn();
            if(typeof hold == 'undefined'|| hold == false) timecall = setTimeout(function() {
              invoke("popmessage").fadeOut();
            }, 5000);
            if(!(typeof dismiss == 'undefined' || dismiss == false)) {
              invoke("popmessage").setAttribute("title", "Click to dismiss.");
              invoke("popmessage").setAttribute("onclick", "this.fadeOut();");
            }
          }
          function Loading() {
            loadMessage("notice", "Loading...", true);
          }
          function hideMessage() {
            invoke("popmessage").fadeOut();
          }
        </script>
        <style>
          #popmessage {
            position: absolute;
            top: 81px;
            left: 58px;
            height: auto !important;
            padding: 12px 20px;
            box-sizing: border-box;
            border:1px solid;
            border-radius: 5px;
            display: none;
            box-shadow: 0 0 100px black;
            z-index: 3;
            transition: opacity 1s;
          }
        </style>
        <div id="gnrl_sets" style="display: none;">
          <style>
            #gnrl_sets {
              height: calc(100% - 30px);
            }
            #gnrl_sets_appear_ctn {
              display: grid;
              grid-template-columns: auto 150px 1fr;
            }
            #gnrl_sets_appear_ctn>* {
              line-height: 21px;
            }
            #gnrl_sets_appear_ctn input, #gnrl_sets_appear_ctn select {
              height: 21px;
              width: 130px;
            }
          </style>
          <fieldset class="info" style="height: calc(100% - 23.333px);">
            <h3>Apperance Settings</h3>
            <section id="gnrl_sets_appear_ctn">
              <label for="">Language</label>
              <select style="justify-self: center;">
                <option>English - U.S.</option>
                <option disabled>Others...</option>
              </select>
              <div class="input_hint">Please select product language.</div>
              <label for="">Theme</label>
              <select style="justify-self: center;">
                <option>Infinite Campus</option>
                <option>Standard</option>
              </select>
              <div class="input_hint">Please select product theme.</div>
            </section>
            <h3>Other Settings</h3>
          </fieldset>
          <div id="gnrl_sets_save_ctn">
            <button style="width: 100%;">Save</button>
          </div>
        </div>
      </div>
    </div>
    
    <!--<div id="display_bar">
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
    </div>-->
    <div id="display_map" style="z-index: 14; position: fixed; bottom: 0; right: 0;">
      <!-- null -->
    </div>
    <div id="dialog" style="display: none;">
      <div id="dia_head">
        <div id="dia_title">General Settings</div>
        <div id="dia_close" onclick="Hide_Settings();"><?php echo file_get_contents("../css/img/c_cancel.svg");?></div>
      </div>
      <div id="dia_main"></div>
    </div>
    <div id="dia_cover" style="display: none;" onclick="Hide_Settings();"></div>
    <script>
      function Dialog(title,contentId) {
        vartext("dia_title", title);
        invoke("dia_main").append(invoke("display_main").contentWindow.invoke(contentId).cloneNode(true));
      }
      function Show_Settings() {
        appear("dialog","grid");
        invoke("dia_main").firstElementChild.block();
        appear("dia_cover");
      }
      function Hide_Settings() {
        disappear("dia_cover");
        invoke("dia_main").firstElementChild.remove();
        disappear("dialog");
      }
      for (i = 0; i < invoke("hiding_bar").childElementCount; i++) {
        //console.log(invoke("hiding_bar").getElementsByTagName("a")[i]);
        invoke("hiding_bar").getElementsByTagName("a")[i].setAttribute("draggable","true");
      }
    </script>
    <script>
      //public functions
      function Vertical_Clear() {//using
        for (i = 0; i < invoke("top_group").childElementCount; i++)
          invoke("top_group").children[i].dimlight();
      }
      function Horizontal_Clear() {//using
        for (i = 0; i < invoke("sub_location").childElementCount; i++)
          invoke("sub_location").children[i].dimlight();
      }
      function Horizontal_Hide() {//using
        for (i = 0; i < invoke("sub_location").childElementCount; i++)
          invoke("sub_location").children[i].invalid();
      }
      function Hiding_Clear() {
        for (i = 0; i < invoke("hiding_bar").childElementCount-1; i++) {
          tarcolor(invoke("hiding_bar").getElementsByTagName("a")[i],null);
        }
      }
      function horizontalURL(element){//using
        if (element.dataset.focus=="true") return;
        if (element.dataset.disabled=="true") return;
        Horizontal_Clear();
        element.highlight();
        window.open(element.dataset.url,"main");
      }
      function verticalURL(element){//using
        if (element.dataset.focus=="true") return;
        if (element.dataset.disabled=="true") return;
        if(!invoke("bottom_group").contains(element)) {
          Vertical_Clear();Horizontal_Clear();Horizontal_Hide();
          element.highlight();
          switch(element.id) {
            case "gnrl": valid("gnrl_dashbd","gnrl_cld","gnrl_info");highlight("gnrl_dashbd");break;
            case "asgmt": valid("asgmt_over","asgmt_incomp","asgmt_rpots","asgmt_asiner");highlight("asgmt_over");break;
          }
          window.open(element.dataset.url,"main");
        }
        else window.open(element.dataset.url,"_self");
      }

          function Hiding_Menu() {
            if (invoke("hiding_bar").style.left == "0px") {
              invoke("iframe_display").style.marginLeft = "50px";
              invoke("iframe_display").style.width = null;
              invoke("vertical_bar").style.marginLeft = "0px";
              invoke("hiding_bar").style.left = "-100px";
            }
            else {
              invoke("iframe_display").style.marginLeft = "150px";
              invoke("iframe_display").style.width = "calc(100% - 150px)";
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
        valid("gnrl_info","gnrl");
        highlight("gnrl");
        function LoggedIn() {//using
          valid("gnrl_dashbd","gnrl_cld","logoff","asgmt","sets");
          var valid_list = window["detailPrivilege"]["gnrl"].split(",");
          for (var i = 0; i < valid_list.length; i++) {
            if(valid_list[i]=="default") break;
            valid(valid_list[i]);
          }
          invalid("gnrl_login");
          horizontalURL(invoke("gnrl_dashbd"));
        }
        function LoggedOff() {//using
          Horizontal_Clear(); Vertical_Clear();
          Horizontal_Hide();
          for (i = 0; invoke("vertical_bar").contains(invoke("vertical_bar").tag("div",i)); i++)
            invoke("vertical_bar").tag("div",i).invalid();
          valid("gnrl","gnrl_login","gnrl_info");
          horizontalURL(invoke("gnrl_login"));
          highlight("gnrl");
          invoke("account").children[0].innerHTML = "?";
        }
        window["detailPrivilege"] = new Array();
      <?php if(isset($_SESSION["username"])) {?>
          var valid_list = "<?php echo $_SESSION['detailPrivilege'];?>".split(" ");
          
          window["detailPrivilege"]["gnrl"] = valid_list[0];
          window["detailPrivilege"]["asgmt"] = valid_list[1];
          LoggedIn();
      <?php }else{ ?>
          LoggedOff();
      <?php } ?>
      </script>
  </body>
</html>
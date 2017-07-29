<html>
  <head>
    <?php require_once("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <style>
          pre {
            white-space: pre-wrap;       /* Since CSS 2.1 */
            white-space: -moz-pre-wrap;  /* Mozilla, since 1999 */
            white-space: -pre-wrap;      /* Opera 4-6 */
            white-space: -o-pre-wrap;    /* Opera 7 */
            word-wrap: break-word;       /* Internet Explorer 5.5+ */
          }
          img {
            animation:spin 4s linear infinite;
          }
          .screen_lines {
            padding: 2px;
            font-family: sans-serif;
            font-size: 14px;
          }
          .execute_time {
            background-color: lightgray;
            border-right: 2px solid lime;
            width: 120px;
          }
          #function_rcv {
            color: darkorange;
          }
          #result_screen_table, #result_screen_table tr {
            width: 100%;
          }
          #com_input {
            color: blue;
            font-size: 14px;
            width: 109.33px;
            border: 0;
            background-color: whitesmoke;
          }
          #arg_input {
            color: black;
            font-size: 14px;
            border: 0;
            background-color: whitesmoke;
          }
          select {
            width: 100%;
          }
          #execute_path,#path_selector {
              width: 100%;
              height: 20;
            }
            #execute_path {
              background-color: whitesmoke;
              border: none;
            }
      #execute_inupt_downline {
        border: none;
        box-shadow: none;
        background-color: transparent;
        border-bottom: 2px solid cyan;

      }
      #purpose_ins {
        margin: 0 6px;
        font-weight: bold;
      }
    </style>
    <script>
      window.onerror = function () {
        Announce_Error();
      }
      function Run_Execute(method) {
        var i,j;
        if (method=="tool_bar") {
          exe_ran = invoke("function_rcv_set").value;
          exe_com = invoke("com_input").value;
          exe_arg = invoke("arg_input").value;
          invoke("com_input").placeholder = exe_com;
          invoke("arg_input").placeholder = exe_arg;
          Customize_Command();
          invoke("arg_input").value = "";
          manual_value = "[System]";
        }
        if (method=="down_line") {
          exe_arg = "";
          exe_raw = invoke("execute_inupt_downline").value;
          if (exe_raw.toLowerCase().includes("[system]"))
            exe_ran = "System";
          else exe_ran = "Server";
          exe_raw = exe_raw.split(" ");
          for (i = 0; i < exe_raw.length; i++) {
            if(exe_raw[i].includes("[")) continue;
            exe_com = exe_raw[i];
            for(j = i+1; j < exe_raw.length; j++) {
              exe_arg += exe_raw[j];
              if(j+1<exe_raw.length) exe_arg += " ";
            }
            break;
          }
          invoke("execute_inupt_downline").placeholder = "["+exe_ran+"] "+exe_com+" "+exe_arg;
          invoke("execute_inupt_downline").value = "";
          current_value = "";
        }
        exe_path = invoke("execute_path").value;
        //store into catalog
        Add_Catalog(exe_ran,exe_com,exe_arg);
        //proceed doing
         var now = new Date();
          month = (now.getMonth()+1).toString();
          day = now.getDate().toString();
          year = now.getFullYear();
          hours = now.getHours().toString();
          minutes = now.getMinutes().toString();
          seconds = now.getSeconds().toString();
          millisec = now.getMilliseconds().toString();
          year = year.toString().slice(2,4);
          if (month<10) { month = "0"+month;}
          if (day<10) { day = "0"+day;}
          if (hours<10) { hours = "0"+hours;}
          if (minutes<10) { minutes = "0"+minutes;}
          if (seconds<10) { seconds = "0"+seconds;}
         var send_time = year+month+day+hours+minutes+seconds+millisec;
         var temp = document.createElement("tr");
         temp.classList.add("screen_lines");
         temp.setAttribute("id",send_time);
         temp.setAttribute("onclick","Switch_Result_Line(this.id);");
         invoke("result_screen_table").appendChild(temp);
         var inner_time = document.createElement("td");
         inner_time.setAttribute("class","execute_time");
         inner_time.innerHTML = month+"/"+day+"/"+year+" "+hours+":"+minutes+":"+seconds;;
         temp.appendChild(inner_time);
         var inner_main = document.createElement("td");
         inner_main.setAttribute("class","execute_line");
         temp.appendChild(inner_main);
         var font_ran = document.createElement("font");
         font_ran.setAttribute("color","darkorange");
         font_ran.innerHTML = "["+exe_ran+"] ";
         inner_main.appendChild(font_ran);
         var font_com = document.createElement("font");
         font_com.setAttribute("color","blue");
         font_com.innerHTML = exe_com+" ";
         inner_main.appendChild(font_com);
         var font_arg = document.createElement("font");
         font_arg.setAttribute("color","black");
         font_arg.innerHTML = exe_arg;
         inner_main.appendChild(font_arg);
         var font_img = document.createElement("img");
         font_img.setAttribute("src","../css/img/col_drop.png");
         font_img.setAttribute("id",send_time+"img")
         font_img.style.float = "right";
         inner_main.appendChild(font_img);


         var temp = document.createElement("tr");
         temp.classList.add("screen_lines");
         temp.setAttribute("id",send_time+"result");
         temp.setAttribute("ondblclick","Switch_Result_Line(this.id)")
         invoke("result_screen_table").appendChild(temp);
         var inner_time = document.createElement("td");
         inner_time.setAttribute("class","execute_time");
         inner_time.innerHTML = month+"/"+day+"/"+year+" "+hours+":"+minutes+":"+seconds;
         temp.appendChild(inner_time);
         var inner_main = document.createElement("td");
         inner_main.setAttribute("class","responds_line");
         temp.appendChild(inner_main);
         var inner_pre = document.createElement("pre");
         inner_pre.setAttribute("id","previous_respond");
         inner_pre.innerHTML = "Executing...";
         inner_main.appendChild(inner_pre);
         AJAX_Run_Execute();
       }
      function AJAX_Run_Execute() {
        exe_com = exe_com.replace(/\+/g, "%2b");
        /* AJAX Setup Line Begins */
        var command_exec=new XMLHttpRequest();
        command_exec.onreadystatechange=function() {
            if (command_exec.readyState==4 && command_exec.status==200) {
                var ajax_data = command_exec.responseText.split("[brk]")
                invoke("previous_respond").innerHTML = ajax_data[1];
                Tool_Bar_Input();
                var respond_time = year+month+day+hours+minutes+seconds+millisec;
              if(ajax_data[0]!="0") {
                invoke(respond_time).getElementsByTagName("td")[0].style.borderColor = "red";
                invoke(respond_time+"result").getElementsByTagName("td")[0].style.borderColor = "red";
                invoke(respond_time+"result").getElementsByTagName("td")[1].style.backgroundColor = "#ffbcbc";
              }
              else {
                invoke(respond_time+"result").getElementsByTagName("td")[1].style.backgroundColor = "#cdffcd";
              }
              invoke("previous_respond").removeAttribute("id");
              
              invoke("result_screen_display").scrollTop = invoke("result_screen_display").scrollHeight;
            }
            else if (command_exec.readyState==4 && command_exec.status!=200){
              LoadMessage("Error","XML Http Request failed. Return code: <b>"+command_exec.status+"</b>.");
            }
        }
        //AJAX Sending
        command_exec.open("GET","execute_command.php?cmd="+exe_com+" "+exe_arg+"&path="+exe_path,true);
        command_exec.send();
        /* AJAX Setup Line Ends*/
      }
      catalog = new Array;
      function Add_Catalog() {
        catalog.push("["+exe_ran+"] "+exe_com+" "+exe_arg);
        if(catalog.length>1)
        if (catalog[catalog.length-1]==catalog[catalog.length-2])
          catalog.pop();
        //console.log(catalog)
        catalog_cursor = catalog.length;
      }
      current_value = "";
      manual_value = "";
      function Select_Catalog(operation) {
        if(catalog.length!=0) {
          if((catalog_cursor > 0 && operation=="-1")||(catalog_cursor < catalog.length && operation=="+1"))
            catalog_cursor +=operation;
          if(catalog_cursor != catalog.length) return catalog[catalog_cursor];
        }
      }

    </script>
  </head>
  <body>
	  </div>
	<div id="popmessage">None.</div>
  <script>
    window.onresize = function() {
      Local_Sizing();
      Local_Sizing()
    }
      function Local_Sizing() {
        invoke("result_screen").style.height = window.innerHeight-90;
        invoke("result_screen").style.width = document.body.scrollWidth-invoke("tool_bar").scrollWidth-3*8;
        invoke("result_screen_display").style.height = invoke("result_screen").clientHeight-invoke("result_screen_execute").clientHeight-invoke("result_screen").getElementsByTagName('h2')[0].clientHeight;
        //console.log(invoke("result_screen").clientHeight-invoke("result_screen_execute").clientHeight)
        invoke("tool_bar").style.height = invoke("result_screen").clientHeight;
        invoke("execute_input_container").style.height = invoke("result_screen").clientHeight-invoke("tool_bar").getElementsByTagName('h2')[0].clientHeight;
      }
    </script>
	<div id="mainbody">
    <fieldset class="info" id="result_screen" style="float: left; margin-top: 
    0">
      <h2>Result Screen</h2>
      <div style="overflow: auto;" id="result_screen_display">
      <table id="result_screen_table">
        
      </table>
      </div>
      <div style="display: flex; border-top: 1px solid grey; margin: 2px 0; color: grey" id="result_screen_execute">
        <div id="purpose_ins">&gt;</div>
        <div style="width: 100%; margin-right: 6px"><input type="text" id="execute_inupt_downline" style="width: 100%; color: grey; font-family: monospace; font-size: 15px;" autofocus></div>
      </div>
    </fieldset>
    <fieldset class="info" id="tool_bar" style="float:right; width: 300px; margin-top: 0;">
      <h2>Tool Bar</h2>
      <div id="execute_input_container" style="overflow-y: auto;">
      <div class="in_field" id="execute_input">
        <h3>Execute Code</h3>
        <form>
        <table>
          <tr>
            <td>Destination</td>
            <td class="divider"></td>
            <td>
              <select id="function_rcv_set" onchange="Tool_Bar_Input();Execute_Range();">
                <option value="Server" selected>Server</option>
                <option value="System">System</option>
              </select>
            </td>
            <td class="divider"></td>
            <td><div id="function_rcv">[Server]</div></td>
          </tr>
          <tr>
            <td>Command</td>
            <td class="divider"></td>
            <td>
              <select id="command_selector" onchange="Change_Command();">
                <option value="cust_command" selected>Set &gt;</option>
                <?php 
                  $server_fun = array("arp","assoc","at","attrib","bootcfg","break","cacls","call","chcp","cd","chdir","chkdsk","chkntfs","cipher","cls","cmd","cmstp","color","comp","compact","convert","copy","date","dir","diskpart","doskey","driverquery","echo","endlocal","eventcreate","exit","expand","fc","find","findstr","finger","for","ftp","ftype","getmac","goto","gpresult","graftabl","help","helpctr","hostname","if","ipconfig","label","lodctr","md","mkdir","rd","ls","tasklist");
                  for ($i=0; array_key_exists($i, $server_fun); $i++) { 
                    echo "<option value=\"$server_fun[$i]\">".$server_fun[$i]."</option>";
                  }

                ?>
              </select>
            </td>
            <td class="divider"></td>
            <td ondblclick="if(invoke('command_selector').value!='cust_command')Customize_Command();"><input type="text" id="com_input" value=""  placeholder="help"></td>
          </tr>
          <tr>
            <td>Argument</td>
            <td class="divider"></td>
            <td colspan="3"><input type="text" id="arg_input" style="width: 100%;" placeholder="/?"></td>
          </tr>
          <tr>
            <td>Tips</td>
            <td class="divider"></td>
            <td style="color: red;" colspan="3">Execution may be denied.</td>
          </tr>
        </table>
      </form>
      </div>
      <div class="in_field" id="execute_path_input">
        <h3>Execute Path</h3>
        <form onsubmit="return false">
        <table>
          <tr>
            <td><label for="execute_path">Path</label></td>
            <td class="divider"></td>
            <td ondblclick="if(invoke('path_selector').value!='cust_path')Customize_Path();"><input type="text" name="execute_path" id="execute_path" value="./" placeholder="Set the execute path" disabled></td>
          </tr>
          <tr>
            <td>Preset</td>
            <td class="divider"></td>
            <td>
              <select id="path_selector" onchange="Change_Path();">
                <option value="cust_path">^ Use textbox</option>
                <optgroup label="Built-in">
                  <option value="./" selected>This directory ./</option>
                  <option value="../">Parent directory ../</option>
                  <option value="C:/">System drive C:/</option>
                  <option value="<?php echo $_SERVER['SystemRoot']?>">System Root <?php echo $_SERVER['SystemRoot']?></option>
                  <option value="<?php echo $_SERVER['DOCUMENT_ROOT']?>"> Document root <?php echo $_SERVER["DOCUMENT_ROOT"]?></option>
                </optgroup>
                <optgroup label="Custom">
                  <option>D:/Program Files</option>
                </optgroup>
              </select>
            </td>
          </tr>
        </table>
      </form>
      </div>
      <div class="in_field" id="execute_path_input">
        <h3>Set Variable</h3>
      </div>
      <div class="in_field" id="execute_catalog">
        <h3>Execute Catalog</h3>
      </div>
      </div>
    </fieldset>
    
    <script>
      execute_inupt_downline.onfocus = function() {
        window.onkeydown = function() {
          temp_obj = invoke("execute_inupt_downline");
          if (window.event.keyCode==13) {
            if (temp_obj.value != "") Run_Execute("down_line");
            else temp_obj.value = temp_obj.placeholder;
          }
          switch(window.event.keyCode) {
            case 27:temp_obj.value = null;break;
            case 38:temp_obj.value = choose(Select_Catalog(-1),current_value);break;
            case 40:temp_obj.value = choose(Select_Catalog(+1),current_value);break;
            case 39:if(temp_obj.value=="")temp_obj.value = temp_obj.placeholder;break;
          }
        }
      }
      invoke("execute_inupt_downline").oninput = function() {
        current_value = invoke("execute_inupt_downline").value;
      }
      invoke("com_input").onfocus = function() {
        window.onkeydown = function() {
          if (window.event.keyCode==13) {
              invoke("arg_input").focus();
          }
          else if (window.event.keyCode==39&&invoke("com_input").value == "") invoke("com_input").value = invoke("com_input").placeholder;
          else if (window.event.keyCode==27) Customize_Command();
          else Trigger_List(window.event.keyCode);
        }
      }
      invoke("arg_input").onfocus = function() {
        window.onkeydown = function() {
          if (window.event.keyCode==13 && (invoke("com_input").value != ""||invoke("arg_input").value != "")) Run_Execute("tool_bar");
          else if (window.event.keyCode==39&&invoke("arg_input").value == "") invoke("arg_input").value = invoke("arg_input").placeholder;
          switch(window.event.keyCode) {
            case 27:invoke("arg_input").value = null;break;
            case 38:invoke("com_input").focus();break;
            case 40:invoke("execute_path").focus();break;
          }
        }
      }
      function Trigger_List(key) {
        var temp_value;
        if ((key==38||key==40)&&manual_value!="") {
          if (catalog.length!=0) {
            invoke("command_selector").value = "cust_command";
            invoke("com_input").disabled = false;
          }
          switch(key) {
            case 38:temp_value = choose(Select_Catalog(-1),manual_value);break;
            case 40:temp_value = choose(Select_Catalog(+1),manual_value);break;
          }
          invoke("function_rcv_set").value = temp_value.substr(1,temp_value.indexOf("]")-1);
          vartext("function_rcv",temp_value.substr(0,temp_value.indexOf("]")+1));
          invoke("com_input").value = temp_value.slice(temp_value.indexOf(" ")+1,temp_value.indexOf(" ",temp_value.indexOf(" ")+1));
          invoke("arg_input").value = temp_value.substr(temp_value.indexOf(" ",temp_value.indexOf(" ")+1)+1);
        }
      }
      invoke("com_input").onkeyup = function(){Tool_Bar_Input();}
      invoke("arg_input").onkeyup = function(){Tool_Bar_Input();}
      //invoke("com_input").onchange = function(){Tool_Bar_Input();}
      //invoke("arg_input").onchange = function(){Tool_Bar_Input();}
      function Tool_Bar_Input() {
        var tool_bar_ran = invoke("function_rcv_set").value;
        var tool_bar_com = invoke("com_input").value;
        var tool_bar_arg = invoke("arg_input").value;
        manual_value = "["+tool_bar_ran+"] "+tool_bar_com+" "+tool_bar_arg;
      }
      function Execute_Range() {
        var exeucte_range = invoke("function_rcv_set").value;
        invoke("function_rcv").innerHTML = "["+exeucte_range+"]";
      }
      function Customize_Command() {
        enable("com_input");
        invoke("com_input").value = null;
        invoke("com_input").focus();
        invoke("command_selector").value = "cust_command";
        Tool_Bar_Input();
      }
      function Change_Command() {
        var command = invoke("command_selector").value;
        if (command=="cust_command") {
          Customize_Command();
        }
        else {
          invoke("com_input").value = command;
          disable("com_input");
          Tool_Bar_Input();
        }
      }
      invoke("execute_path").onfocus = function() {
        window.onkeydown = function() {
          if (window.event.keyCode==27) Customize_Path();
          else Path_List(window.event.keyCode);
        }
      }
      function Path_List() {

      }
      function Change_Path() {
        var path = invoke("path_selector").value;
        if (path=="cust_path") {
          Customize_Path();
        }
        else {
          invoke("execute_path").value = path;
          invoke("execute_path").disabled = true;
        }
      }
      function Customize_Path() {
        invoke("execute_path").disabled = false;
        invoke("execute_path").value = null;
        invoke("execute_path").focus();
        invoke("path_selector").value = "cust_path";
        
      }
                function Switch_Result_Line(id) {
                  if (!id.includes("result")) id = id+"result";
                  var result_line_id = invoke(id);
                  id = id.slice(0,id.search("result"));
                  //alert(id);
                  var result_img_id = invoke(id+"img");
                  
                  if (result_line_id.style.display == "none") {
                    result_line_id.style.display = "table-row";
                    result_img_id.style.transform = "none";
                  }
                  else {
                    result_line_id.style.display = "none";
                    result_img_id.style.transform = "rotate(90deg)";
                  }
                }
      Local_Sizing();
    </script>
	</div>
  </body>
</html>
<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link href="../css/tooltip.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/float_bar.css">
    <script type="text/javascript" src="../js/user_regulation.js"></script>
    <script type="text/javascript" src="../js/essential.js"></script>
    <style>
.tooltip .tooltiptext {
    right: 110%;
}

.tooltip .tooltiptext::after {
    left: 100%;
    /*border-color: transparent transparent transparent dimgray;*/
}

    a {
      font-size: 14px;
    }
    .tooltiptext a {
      color: white;
    }
    span.tooltiptext {
      padding: 4px;
    }
    
    </style>
  </head>
  <body>
	<div id="popmessage"></div>
  <div class="float_bar" id="float_bar_left">
    <div id="float_bar_stat" class="float_bar_elt">Statistics</div>
    <div id="float_bar_refer" class="float_bar_elt">Reference</div>
    <div id="float_bar_adduser" class="float_bar_elt">Add user</div>
  </div>
  <div class="float_bar" id="float_bar_right">
    <div class="float_bar_elt">Select consecutively</div>
    <div id="float_bar_ctrlkey" class="float_bar_elt">Control key: <div id="float_bar_ctrlkey_lab" style="display: inline-block;">Off</div></div>
    <div id="float_bar_deselect" class="float_bar_elt">Deselect all</div>
  </div>
  <div id="stat_mainbody" class="float_bar_child">
    <fieldset class="info" style="margin: 0; height: 100%">
      <h2>Statistics</h2>
      <table style="width: 100%" class="formal">
        <tr>
          <td>Total users</td>
          <td id="stat_bar_total">0</td>
        </tr>
        <tr>
          <td>SuperAdministrator</td>
          <td id="stat_bar_s_admin">0</td>
        </tr>
        <tr>
          <td>Administrator</td>
          <td id="stat_bar_admin">0</td>
        </tr>
        <tr>
          <td>Teacher</td>
          <td id="stat_bar_teacher">0</td>
        </tr>
        <tr>
          <td>Student</td>
          <td id="stat_bar_student">0</td>
        </tr>
        <tr>
          <td>Parent</td>
          <td id="stat_bar_parent">0</td>
        </tr>
        <tr id="stat_bar_fr_act_row" class="freezing_act" style="display: none;">
          <td>Freezing accounts</td>
          <td id="stat_bar_fr_act">0</td>
        </tr>
      </table>
    </fieldset>
  </div>
  <div id="table_reference" class="float_bar_child">
    <fieldset class="info" style="margin: 0;">
      <h2>Legend</h2>
      <table style="width: 100%" class="formal">
        <tr id="table_head">
          <th>Conditions</th>
          <th>Meanings</th>
        </tr>
        <tr>
          <td style="color: dimgray">Text in dimgray.</td>
          <td>Normal account(s).</td>
        </tr>
        <tr>
          <td style="color: red">Text in red.</td>
          <td>Freezing account(s).</td>
        </tr>
        <tr>
          <td><img src="../css/img/s_sortable.png"></td>
          <td>Sortable by condition.</td>
        </tr>
        <tr>
          <td><img src="../css/img/s_asc.png"></td>
          <td>Sort ascending.</td>
        </tr>
        <tr>
          <td><img src="../css/img/s_desc.png"></td>
          <td>Sort desending.</td>
        </tr>
      </table>
    </fieldset>
    <fieldset class="info" style="margin: 0;">
      <h2>Key maps</h2>
      <table style="width: 100%" class="formal">
        <tr id="table_head">
          <th>Keys</th>
          <th>Purposes</th>
        </tr>
        <tr>
          <td>[Esc]</td>
          <td>Deselect all users.</td>
        </tr>
        <tr>
          <td>[Ctrl]</td>
          <td>Select non-contiguously.</td>
        </tr>
      </table>
    </fieldset>
  </div>
  <script>
    stat_mainbody_s = false;
    table_reference_s = false;
    manual_ctrlkey_s = false;
    float_bar_stat.onclick=function() {
      if (stat_mainbody_s) {
        stat_mainbody_s = false;
        Float_Bar_Display("stat_mainbody","float_bar_stat",false);
      }
      else {
        Close_All_Bar()
        stat_mainbody_s = true;
        AJAX_User_Stat()
      }
    }
    float_bar_refer.onclick=function() {
      
      if (table_reference_s) {
        table_reference_s = false;
        Float_Bar_Display("table_reference","float_bar_refer",false);
      }
      else {
        Close_All_Bar()
        table_reference_s = true;
        Float_Bar_Display("table_reference","float_bar_refer",true);
      }
    }
    function Float_Bar_Display(target_id,tag_id,status) {
      if(status) {
        appear(target_id);
        invoke(tag_id).classList.add("float_bar_elt_clicked");
        
      }
      else{
        disappear(target_id);
        invoke(tag_id).classList.remove("float_bar_elt_clicked");
      }
    }
    function Close_All_Bar() {
      if (stat_mainbody_s) {
        stat_mainbody_s = false;
      }
      if (table_reference_s) {
        table_reference_s = false;
      }
      Float_Bar_Display("stat_mainbody","float_bar_stat",false);
      Float_Bar_Display("table_reference","float_bar_refer",false);
    }
    float_bar_deselect.onclick = function() {
      Deselect_All_Row()
    }
    window.onkeydown = function() {
      if(window.event.ctrlKey) {
        manual_ctrlkey_s = true;
        invoke("float_bar_ctrlkey_lab").innerHTML = "On";
        Tab_Hover("float_bar_ctrlkey")
      }
      if(window.event.keyCode==27) {
        Deselect_All_Row();
      }
    }
    window.onkeyup = function() {
      if(!window.event.ctrlKey) {
        manual_ctrlkey_s = false;
        invoke("float_bar_ctrlkey_lab").innerHTML = "Off";
        Tab_Lose("float_bar_ctrlkey")
      }
    }
    function Tab_Hover(id) {
      invoke(id).classList.add("float_bar_elt_clicked");
    }
    function Tab_Lose(id) {
      invoke(id).classList.remove("float_bar_elt_clicked");
    }
    float_bar_ctrlkey.onclick = function() {
      if (manual_ctrlkey_s) {
        manual_ctrlkey_s = false;
        invoke("float_bar_ctrlkey_lab").innerHTML = "Off";
        Tab_Lose("float_bar_ctrlkey");
      }
      else {
        manual_ctrlkey_s = true;
        invoke("float_bar_ctrlkey_lab").innerHTML = "Latch";
        Tab_Hover("float_bar_ctrlkey");
      }

    }
  </script>
	<div id="mainbody">
    <fieldset class="info" id="user_list_comment">
      <h2>User Regulation</h2>
      <p>All actions will record in system logs.</p>
      <p>Smart Table</p>
    </fieldset>
    <div style="overflow-x: auto" id="table_div">
    <table id="user_list" class="formal">
      <thead>
      <tr id="table_head">
        <th id="td_ck"><input type="checkbox" id="deselect_all_row" disabled></th>
        <th onclick="Switch_Order_ID();" id="td_id">ID <img src="../css/img/s_asc.png" id="ID_order"></th>
        <th onclick="Switch_Order_Username();" id="td_un">Name <img src="../css/img/s_sortable.png" id="username_order"></th>
        <th id="td_uc">User category</th>
        <th id="td_ea">Email address</th>
        <th onclick="Switch_Order_Regtime();" id="td_rt">Reg. time <img src="../css/img/s_sortable.png" id="regtime_order"></th>
        <th id="td_ri">Reg. IP</th>
        <th id="td_ac">Action</th>
      </tr>
      </thead>
      
      <tbody id="users_table">
      
      </tbody>
      <style>
          th {
            box-sizing: border-box;
            white-space: nowrap;
            }
          td {
            white-space: nowrap;
          }
          thead{
            display: block;
          }
          #users_table {
            overflow-y: scroll;
            
            display: block;
          }
          #user_list {
            table-layout: fixed;
          }
          .freezing_act {
            color: red;
          }
          #table_div {
            margin-bottom: 20px;
          }
      </style>
      <script>
        //initial settings
        queue_select = new Array;
        //functions
        
        function Adjust_Col_Width() {
          //set detected variables
          td_ck = invoke("stat_ck").getBoundingClientRect().width;
          td_id = invoke("stat_id").getBoundingClientRect().width;
          td_un = invoke("stat_un").getBoundingClientRect().width;
          td_uc = invoke("stat_uc").getBoundingClientRect().width;
          td_ea = invoke("stat_ea").getBoundingClientRect().width;
          td_rt = invoke("stat_rt").getBoundingClientRect().width;
          td_ri = invoke("stat_ri").getBoundingClientRect().width;
          td_ac = invoke("stat_ac").getBoundingClientRect().width;
          tr_wd = invoke("table_stat").getBoundingClientRect().width;
          if(true) {
            invoke("stat_ck").style.width = td_ck;
            invoke("stat_id").style.width = td_id;
            invoke("stat_un").style.width = td_un;
            invoke("stat_uc").style.width = td_uc;
            invoke("stat_ea").style.width = td_ea;
            invoke("stat_rt").style.width = td_rt;
            invoke("stat_ri").style.width = td_ri;
            invoke("stat_ac").style.width = td_ac;
            
            invoke("td_ck").style.width = td_ck;
            invoke("td_id").style.width = td_id;
            invoke("td_un").style.width = td_un;
            invoke("td_uc").style.width = td_uc;
            invoke("td_ea").style.width = td_ea;
            invoke("td_rt").style.width = td_rt;
            invoke("td_ri").style.width = td_ri;
            invoke("td_ac").style.width = td_ac;
            invoke("table_head").style.width = tr_wd;
          }
          //alert(invoke("user_list").offsetTop)
          Adjust_Row_Height();
        }
        window.onresize = function() {
          Adjust_Row_Height();
        }
        function Adjust_Row_Height() {
          var scroll_vis = invoke("table_div").scrollWidth > invoke("table_div").clientWidth;
          if(scroll_vis) {
            var reduce_ht = 120;
          }
          else {
            var reduce_ht = 105;
          }
          var batch_action_ht = invoke("batch_action").clientHeight;
          invoke("users_table").style.height = window.innerHeight-reduce_ht-batch_action_ht-17;
        }
      </script>
      <script>
        //initial settings
        switch_order_ID_sa = true;
        switch_order_username_sa = true;
        switch_order_regtime_sa = true;
        Switch_Order_ID();

        //functions
        function Switch_Order_ID() {
          switch_order_username_sa = true;
          switch_order_regtime_sa = true;
          if(switch_order_ID_sa) {
            switch_order_ID_sa = !switch_order_ID_sa;
            document.getElementById('ID_order').setAttribute("src","../css/img/s_asc.png");
            AJAX_Switch_Order("id","asc");
            document.getElementById('username_order').setAttribute("src","../css/img/s_sortable.png");
            document.getElementById('regtime_order').setAttribute("src","../css/img/s_sortable.png");
          }
          else {
            switch_order_ID_sa = !switch_order_ID_sa;
            document.getElementById('ID_order').setAttribute("src","../css/img/s_desc.png");
            AJAX_Switch_Order("id","dec");
            document.getElementById('username_order').setAttribute("src","../css/img/s_sortable.png");
            document.getElementById('regtime_order').setAttribute("src","../css/img/s_sortable.png");
          }
        }
        function Switch_Order_Username() {
          //Loading();
          switch_order_ID_sa = true;
          switch_order_regtime_sa = true;
          if(switch_order_username_sa) {
            switch_order_username_sa = !switch_order_username_sa;
            document.getElementById('username_order').setAttribute("src","../css/img/s_asc.png");
            AJAX_Switch_Order("username","asc");
            document.getElementById('ID_order').setAttribute("src","../css/img/s_sortable.png");
            document.getElementById('regtime_order').setAttribute("src","../css/img/s_sortable.png");
          }
          else {
            switch_order_username_sa = !switch_order_username_sa;
            document.getElementById('username_order').setAttribute("src","../css/img/s_desc.png");
            AJAX_Switch_Order("username","dec");
          }
        }
        function Switch_Order_Regtime() {
          switch_order_ID_sa = true;
          switch_order_username_sa = true;
          if (switch_order_regtime_sa) {
            switch_order_regtime_sa = !switch_order_regtime_sa;
            document.getElementById('regtime_order').setAttribute("src","../css/img/s_asc.png");
            AJAX_Switch_Order("regtime","asc");
            document.getElementById('username_order').setAttribute("src","../css/img/s_sortable.png");
            document.getElementById('ID_order').setAttribute("src","../css/img/s_sortable.png");
          }
          else {
            switch_order_regtime_sa = !switch_order_regtime_sa;
            document.getElementById('regtime_order').setAttribute("src","../css/img/s_desc.png");
            AJAX_Switch_Order("regtime","dec");
          }
        }
        //queue_select = new Array;
        function AJAX_Switch_Order(item,sequence) {
          /* AJAX Setup Line Begins */
          current_sort_item = item;
          current_sort_sequence = sequence;
          var change_order=new XMLHttpRequest();
          change_order.onreadystatechange=function() {
            if (change_order.readyState==4 && change_order.status==200) {
              document.getElementById("users_table").innerHTML = change_order.responseText;
              Adjust_Col_Width();
              invoke("table_stat").style.backgroundColor = "white";
              invoke("table_stat").style.color = "dimgray";

              //multi_select = new Array;
              
              queue_select = multi_select;
              multi_select = new Array;
              queue_select.forEach(function(item){
                //alert(item)
                Color_Selectrow(true,item)
              })
                
              HideMessage();
            }
            else if (change_order.readyState==4 && change_order.status!=200){
              LoadMessage("Error","XML Http Request failed. Response detail: <b>"+change_order.status+": "+change_order.statusText+"</b>.");
            }
          }
          //AJAX Sending
          Loading();
          change_order.open("GET","../module/users_list.php?sort_user="+item+"_"+sequence,true);
          change_order.send();
          /* AJAX Setup Line Ends*/
        }
        function AJAX_User_Stat() {
          /* AJAX Setup Line Begins */
          var user_stat=new XMLHttpRequest();
          user_stat.onreadystatechange=function() {
            if (user_stat.readyState==4 && user_stat.status==200) {
              var str_stat = user_stat.responseText;
              //Loop
              var scan_start = str_stat.indexOf("[t_users]")+9;
              var stat_total = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              invoke("stat_bar_total").innerHTML = stat_total;
              //Loop ends
              var scan_start = str_stat.indexOf("[s_admin]")+9;
              var stat_s_admin = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              invoke("stat_bar_s_admin").innerHTML = stat_s_admin;

              var scan_start = str_stat.indexOf("[admin]")+7;
              var stat_admin = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              invoke("stat_bar_admin").innerHTML = stat_admin;

              var scan_start = str_stat.indexOf("[teacher]")+9;
              var stat_teacher = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              invoke("stat_bar_teacher").innerHTML = stat_teacher;

              var scan_start = str_stat.indexOf("[student]")+9;
              var stat_student = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              invoke("stat_bar_student").innerHTML = stat_student;

              var scan_start = str_stat.indexOf("[parent]")+8;
              var stat_parent = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              invoke("stat_bar_parent").innerHTML = stat_parent;

              var scan_start = str_stat.indexOf("[fr_act]")+8;
              var stat_fr_act = str_stat.slice(scan_start,str_stat.indexOf("[",scan_start));
              if (stat_fr_act!="0") {
                invoke("stat_bar_fr_act_row").style.display = "table-row";
              }
              else {
                invoke("stat_bar_fr_act_row").style.display = "none";
              }
              invoke("stat_bar_fr_act").innerHTML = stat_fr_act;

              Float_Bar_Display("stat_mainbody","float_bar_stat",true);
              HideMessage()
            }
            else if (user_stat.readyState==4 && user_stat.status!=200){
              LoadMessage("Error","XML Http Request failed. Response detail: <b>"+user_stat.status+": "+user_stat.statusText+"</b>.");
            }
          }
          //AJAX Sending
          Loading();
          user_stat.open("GET","../module/users_apps.php?app=stat",true);
          user_stat.send();
          /* AJAX Setup Line Ends*/
        }
        multi_select = new Array;
        function Checkbox_Selectrow(id) {
          //alert(id);
          this_element = document.getElementById(id);
          if (document.getElementById(id+"checkbox").checked) {
            Color_Selectrow(true,id)
          }
          else {
            Color_Selectrow(false,id)
          }
          Transcript_Multiselect()
        }
        function Switch_Selectrow(id) {
          if (id=="0") {  //If detects Root, return false.
            return false;
          }
          this_element = document.getElementById(id);
          if (document.getElementById(id+"checkbox").checked) {
            document.getElementById(id+"checkbox").checked = false;
            Color_Selectrow(false,id);

          }
          else {
            if(!manual_ctrlkey_s){Clear_Select()}
            document.getElementById(id+"checkbox").checked = true;
            Color_Selectrow(true,id)
          }
          Transcript_Multiselect()
        }
        function Transcript_Multiselect() {

          //queue_select = multi_select;
        }
        function Color_Selectrow(checked,id) {
          var this_element = invoke(id)
          if (checked) {
            this_element.style.backgroundColor = "#B3B3B3";
            document.getElementById(id+"checkbox").checked = true;
            if(this_element.className!="freezing_act"){
              this_element.style.color = "white";
            }
            multi_select.push(id);
          }
          else {
            this_element.style.backgroundColor = null;
            this_element.style.color = null;
            document.getElementById(id+"checkbox").checked = false;
            multi_select.splice(multi_select.indexOf(id),1);
          }
          Update_Multi_Select();
        }
        function Clear_Select() {
          for (var i = 1; i < invoke("users_table").childElementCount; i++) {
            var remain_row = document.getElementById("users_table").getElementsByTagName("tr")[i];
            remain_row.style.backgroundColor = null;
            remain_row.style.color = null;
            //alert(remain_row.id)
            invoke(remain_row.id+"checkbox").checked = false;
          }
          multi_select = new Array;
        }
        mainbody.onclick=function() {
          Close_All_Bar()
        }
        user_list.ondblclick = function() {
          scroll(0,invoke("user_list").offsetTop-70)
        }
        invoke("float_bar_deselect").style.backgroundColor = "lightgray";
        invoke("float_bar_deselect").style.color = "gray";
        function Update_Multi_Select() {
          invoke("table_row_selected").innerHTML = multi_select.length;
          //alert(multi_select)
          if (multi_select.length==0) {
            invoke("deselect_all_row").disabled = true;
            invoke("float_bar_deselect").style.backgroundColor = "lightgray";
            invoke("float_bar_deselect").style.color = "gray";
          }
          else {
            invoke("deselect_all_row").disabled = false;
            invoke("float_bar_deselect").style.backgroundColor = null;
            invoke("float_bar_deselect").style.color = null;
          }
        }
        function Deselect_All_Row() {
          Clear_Select();
          Update_Multi_Select()
        }
        deselect_all_row.onclick = function() {
          Deselect_All_Row();
          invoke("deselect_all_row").checked = false;
        }

      </script>
    </table>
    
      <div id="batch_action">
        <img src="../css/img/arrow_ltr.png">
        <b>
          <span id="table_row_selected">0</span>
          <span>Selected</span>
        </b>
        <span style="margin-left: 20px">With selected</span>
        <a><img src="../css/img/s_passwd.png">Reset password</a>
        <a><img src="../css/img/b_usrdrop.png">Freeze</a>
        <a><img src="../css/img/s_reload.png">Restore</a>
        <a><img src="../css/img/b_drop.png">Delete</a>
      </div>
    </div>
	</div>
  </body>
</html>
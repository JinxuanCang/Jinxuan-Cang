<html>
  <head>
    <?php include("../essential_settings.php"); //Initialize();?>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <script type="text/javascript" src="../js/table.js"></script>
  </head>
  <body>
	<div id="mainbody">
    <div id="user_str_ctn">
      <fieldset class="info">
        <h2>User Storage</h2>
      </fieldset>
      <div id="user_str"></div>
      <div id="sharing_str"></div>
	  </div>
    <div id="edit_prob_ctn">
      <fieldset class="info" style="margin-bottom: 0px;">
        <h2>Edit Problem Set</h2>
      </fieldset>
      <div id="edit_prob_ctn_left" style="float: left;">
        <fieldset class="form">
          <legend>Program Description</legend>
          <textarea width="100%"></textarea>
        </fieldset>
      </div>
      <fieldset class="form" style="float: right; width: 50%;" id="edit_prob_ctn_right">
        <legend>Editable Preview</legend>
      </fieldset>
    </div>
  </div>
  <style>
    #edit_prob_ctn {
      display: none;
    }
  </style>
  <script>
  function Reset_All(remain) {
    disappear("user_str_ctn");
    for (var i = 0; invoke("horizontal_bar").contains(lmvoke("li",i)); i++) {
      lmvoke("li",i).getElementsByTagName("a")[0].classList.remove("active");
    }
    remain.classList.add("active");
  }
  function Switch(commuter,id) {
    Reset_All(commuter);
    appear(id);
  }
  function Local_Sizing(){
    invoke("edit_prob_ctn_right").style.height = window.innerHeight-90;
  }
    var target = "user_str";
    var head = ["First Name","Last Name","RE Earth Sci.","RE Bio.","RE Chem.","RE Phy.","RE Alg.1","RE Geom.","RE Alg.2","FE Precalc.","AP Bio.","AP Chem.","AP Calc.BC"]
    var data = [<?php
      $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
      for ($i = 0; $i < 100; $i++) {
        for ($j = 0; $j < 2; $j++) {
          shuffle($seed);
          $rand = '';
          foreach (array_rand($seed, 5) as $k) $rand .= $seed[$k];
          echo "\"".ucfirst(strtolower($rand))."\",";
        }
        for ($j = 0; $j < 8; $j++) echo "\"".rand(60,100)."\",";
        for ($j = 0; $j < 3; $j++) echo "\"".rand(1,5)."\",";
      }
    ?>];
    var settings = {
      //formatted:false,//boolean
      smart_table:true,//boolean
      hover: true,
      sorted: 1,
      height:"screen",//"static ##" or "fit"
      line_number:true,//boolean
      actions:["Delete","Edit","Duplicate","Preview","Export"],//array
      action_icon:[0,1,2,9,8],//array,icons,src only
      action_link:["../css/img/.png"],
      scroll_bar_width:12,
      line_number_sortable:1,
      sortable:[true,true,true,true,1,1,1,1,1,1,1,1,1]
    };
    table(target,head,data,settings);
    var target = "sharing_str";
    var head = ["Last Name","First Name","Contest 1","2","3","4"]
    var data = [
      ["Cang","Jinxuan","5","5","6","2"],
      ["Student","A.","6","6","6","6"],
      ["A","B","6","6","6","6"],
      ["Ba","C","6","6","6","6"],
      ["Sa","C","6","6","6","6"],
      ["Sb","Ca","6","6","6","6"],
      ["D","Cb","6","6","6","6"],
      ["W","Ar","6","6","6","6"],
      ["N","Av","6","6","6","6"],
    ];
    var settings = {
      formatted:true,//boolean
      smart_table:true,//boolean
      //height:"180px",//"static ##" or "fit"
      line_number:true,//boolean
      actions:["Rank","Print"],//array
      action_icon:[6,7],//array,icons,src only
      action_link:["../css/img/.png"],
      sortable:[true,true,true,true,1,1]
    };
    table(target,head,data,settings);
  </script>
  </body>
</html>
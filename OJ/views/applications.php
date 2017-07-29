<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <script type="text/javascript" src="../js/essential.js"></script>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
  <script>
    var blocks = 18;
    var blocks_per_row = 4;
    var block_link = ["ti_84_plus.php","program_test_maker.php","practice_center.php"];
    var block_link_target = ["",""];
    var block_title = ["Ti-84 Plus Simulator(fake)","Program Test Maker","practice_center"]
    var rows = Math.ceil(blocks/blocks_per_row);
    var i,j = 0;
    for (i = 1; i <= blocks; i++) {
      j++;
      if (j==1) {
        var parent_container = document.createElement("div");
        parent_container.setAttribute("class","app_container");
        invoke("mainbody").appendChild(parent_container);
      }
      var child_block = document.createElement("div");
      child_block.setAttribute("class","app_child");
      if (block_link_target[i-1]==undefined||block_link_target[i-1]=="") block_link_target[i-1] = "_self";
      if (block_link[i-1]!=undefined&&block_link[i-1]!="") child_block.setAttribute("onclick","parent.Navigator('"+block_title[i-1]+"');");
      parent_container.appendChild(child_block);
      if (block_title[i-1]!=undefined&&block_title[i-1]!="") child_block.innerHTML = block_title[i-1];
      if (j==blocks_per_row) {
        j = 0;
      }
    }
    function Local_Sizing() {
      for (i = 0; document.body.contains(imvoke("app_child",i)); i++) {
        imvoke("app_child",i).style.width = window.innerWidth/blocks_per_row-2;
        imvoke("app_child",i).style.height = window.innerHeight/rows-2;
      }
    }
    Local_Sizing();
    window.onresize =function() {
      Local_Sizing();
    }
  </script>
<style>
  body {
    margin: 0;
  }
  .app_container{
    display: flex;
  }
  .app_child {
    display: block;
    width: 300;
    background-color: lightgrey;
    border-width: 1px;

    border-color: white;
    border-style: solid;
    
    margin: 0;
  }
  .app_child:hover {
    background-color: grey;
  }
</style>
	</div>
  </body>
</html>
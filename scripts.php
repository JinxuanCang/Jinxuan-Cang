<html>
  <head>
    <?php include("../essential_settings.php"); Initialize(); LoginRequire(); ?>

    <!-- Code Mirror Setup-->
    
    <link rel="stylesheet" href="../css/codemirror.css">
	  <script src="../js/codemirror.js"></script>
	  <script src="../css/mode/javascript/javascript.js"></script>
    <script src="../css/mode/css/css.js"></script>
    <script src="../css/mode/xml/xml.js"></script>
    <script src="../css/mode/htmlmixed/htmlmixed.js"></script>
    <script src="../js/matchbrackets.js"></script>
    <script src="../js/closebrackets.js"></script>
    <script src="../css/mode/php/php.js"></script>
    <script src="../css/mode/clike/clike.js"></script>
    <script src="../css/mode/shell/shell.js"></script>
    <script src="../js/closetag.js"></script>
    <script src="../js/matchtags.js"></script>
    <script src="../js/xml-fold.js"></script>
	
     <!--Setup Line Ends-->

	<style type="text/css">
  
  #data_name, #data_filter, #data_type{
    width: 200px;
    height: 23px;
  }
  #data_type {
    width: 130px;
  }
  #current_script {
    display: none;
    font-style: italic;
  }
  #cover {
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    margin-top: 60px;
    list-style-type: none;
    background-color: lightgray;
    position: fixed;
    opacity:0.7;
    display: none;
  }
	</style>
  <script type="text/javascript"> 
    function Data_name() {
      Type_select();
      document.getElementById("current_script").style.display = "block";
    }
    function Type_select() {
      data_type = document.getElementById("data_type").value;
      data_name = document.getElementById("data_name").value;
      var quiz = /[^A-Za-z0-9_]/;
      if (data_name=="" || data_name==null || quiz.test(data_name)) {
        document.getElementById("data_text").innerHTML = "Please fill out Dataname and Dataname only can be letters and/or numbers.";
        document.getElementById("current_script").style.color = "red";
        document.getElementById("data_temp").innerHTML = "";
        document.getElementById("jump_out").style.display = "none";
      }
      else {
        document.getElementById("current_script").style.color = "black";
        document.getElementById("data_text").innerHTML = "This script will save as ";
        document.getElementById("data_temp").innerHTML = data_name+data_type+".";
        document.getElementById("file_name").innerHTML = data_name+data_type;
        switch(data_type) {
              case ".html": editor.setOption("mode","text/html");break;
              case ".css": editor.setOption("mode","css");break;
              case ".php": editor.setOption("mode","application/x-httpd-php");break;
              case ".js": editor.setOption("mode","javascript");break;
              case ".bat": editor.setOption("mode","text/x-sh");break;
              case ".cmd": editor.setOption("mode","text/x-sh");break;
              case ".c": editor.setOption("mode","text/x-csrc");break;
              case ".cpp": editor.setOption("mode","text/x-c++src");break;
              case ".h": editor.setOption("mode", "text/x-objectivec");break;
              case ".pas": editor.setOption("mode","text/x-pascal");break;
              case ".java": editor.setOption("mode","text/x-java");break;
        }
      }
    }
    function Pop_edit() {
      var quiz = /[^A-Za-z0-9_]/;
      data_type = document.getElementById("data_type").value;
      data_name = document.getElementById("data_name").value;
      if (data_name=="" || data_name==null || quiz.test(data_name)) {
        document.getElementById("current_script").style.display = "block";
        document.getElementById("data_text").innerHTML = "Please fill out Dataname and Dataname only can be letters and/or numbers.";
        document.getElementById("current_script").style.color = "red";
        document.getElementById("data_temp").innerHTML = "";
        document.getElementById("jump_out").style.display = "none";
      }
      else {
        var text_value = document.getElementsByTagName("textarea")[0].value;
        if (text_value==editor.getValue() || editor.getValue()=="") {
          for (var i = 0; filter_name[i]!="stop"; i++) {
            if (filter_name[i]==data_name+data_type) {
              location.href = "./scripts.php?file_name="+data_name+data_type+"&action=edit";
            }
          }
        }
        else {
          for (var i = 0; filter_name[i]!="stop"; i++) {
            if (filter_name[i]==data_name+data_type) {
              document.getElementById("current_script").style.display = "block";
              document.getElementById("data_text").innerHTML = "You are going to leave this code. This code won't save. Otherwise, please change file name.";
              document.getElementById("current_script").style.color = "red";
              document.getElementById("data_temp").innerHTML = "";
              break;
            }
          }
        }
          switch(data_type) {
              case ".html": editor.setOption("mode","text/html");break;
              case ".css": editor.setOption("mode","css");break;
              case ".php": editor.setOption("mode","application/x-httpd-php");break;
              case ".js": editor.setOption("mode","javascript");break;
              case ".bat": editor.setOption("mode","text/x-sh");break;
              case ".cmd": editor.setOption("mode","text/x-sh");break;
              case ".c": editor.setOption("mode","text/x-csrc");break;
              case ".cpp": editor.setOption("mode","text/x-c++src");break;
              case ".h": editor.setOptein("mode", "text/x-objectivec");break;
              case ".pas": editor.setOption("mode","text/x-pascal");break;
              case ".java": editor.setOption("mode","text/x-java");break;
          }
          //document.getElementsByTagName("html")[0].style.overflow = "hidden";
          //document.getElementById("cover").style.display = "block";
          document.getElementById("jump_out").style.display = "block";
          document.getElementById("data_name").blur();
          document.getElementById("code").focus();
      }
    }
    function Dismiss_edit() {
      //document.getElementById("cover").style.display = "none";
      document.getElementById("jump_out").style.display = "none";
      //document.getElementsByTagName("html")[0].style.overflow = "auto";
      document.getElementById("code").blur();
      document.getElementById("data_name").focus();
      page = "front";
    }
    function Create_submit() {
      var data_value = document.forms["create_script"]["data_value"].value;
      if (data_value=="" || data_value==null) {
        return false;
      }
    }
    function Enterkey() {
         Pop_edit();
         return false;
    }
    function Data_filter() {

      filter_value = document.getElementById("data_filter").value;
      for (var i = 0; filter_name[i]!="stop"; i++) {
        document.getElementById(filter_name[i]).style.display = "none";
      }
      if (filter_value == "" || filter_value == null) {
        var j = 0;
        for (var i = 0 ; filter_name[i]!="stop" ; i++) {
          document.getElementById(filter_name[i]).style.display = "table-row";
          j++;
        }
      }
		  else {
        var j = 0;
        for (var i = 0 ; filter_name[i]!="stop" ; i++) {
          if (filter_name[i].includes(filter_value)) {
          document.getElementById(filter_name[i]).style.display = "table-row";
          j++;
		      }
        }
      }
      if (j==0) {
        document.getElementById("table_text").innerHTML = "No File Found.";
        document.getElementById("table_total").style.display = "none";
      }
      else {
        document.getElementById("table_text").innerHTML = "Total";
        document.getElementById("table_total").innerHTML = j+" File(s)";
        document.getElementById("table_total").style.display = "table-cell";
      }
	  }
    function Edit() {
      document.getElementById("jump_out").style.display = "block";
      Data_name();
    }
    function Apply_Change() {
      parent.Loading();
      document.getElementsByTagName('textarea')[0].innerHTML = editor.getValue();
      document.getElementById("create_script").submit();
    }
    function Clear() {
      if(editor.getValue()=="" || editor.getValue()==null) {
        parent.loadMessage("notice","Textarea cleared already.")
      }
      else {
        Confirm('null','clear');
      }
    }
    var s_action = "   <button onclick='hideMessage();'>Cancel</botton><button onclick='iframe(\"display_main\").Execute();'>Continue</button>";
    function Confirm(file_name,action) {
      g_filename = file_name;
      g_action = action;
      if (action=="delete") {
        parent.loadMessage("caution","You are going to delete "+"<b>"+file_name+"</b>."+" Continue?"+s_action);
      }
      if (action=="clear") {
        parent.loadMessage("caution","You are going to clear textarea. Continue?"+s_action);
      }
      if (action=="rename") {
        var extend = file_name.lastIndexOf(".");
            var r_name = file_name.substr(0, extend);
            var e_name = file_name.substr(extend);
        var r_filename = prompt("This file rename as:", r_name);
        if (r_filename!=null & r_filename!=r_name) {
          location.href = "./databases.php?file_name="+file_name+"&action=rename&add="+r_filename+e_name;
        }
        else {
          parent.loadMessage("notice","File name didn't change.");
        }
      }
    }
    function Execute() {
      parent.Loading();
      if (g_action=="delete") {
        location.href = "./databases.php?file_name="+g_filename+"&action="+g_action;
      }
      if (g_action=="clear") {
        document.getElementsByTagName('textarea')[0].innerHTML = "";
            editor.setValue("");
            parent.loadMessage("Notice","Cleared Textarea.");
      }
    }
	  function Duplicate(file_name) {
		  var sensor = 0;
		  for (var i = 0; filter_name[i]!="stop"; i++) {
            var extend = file_name.lastIndexOf(".");
            var r_name = file_name.substr(0, extend);
            var e_name = file_name.substr(extend);
            if (filter_name[i]==r_name+"_copied"+e_name) {
              
			        var sensor = 1;
			        parent.loadMessage("caution","<b>"+r_name+"_copied"+e_name+"</b> already exist.");
              break;
            }
      }
		  if (sensor==0) {
			  location.href = "./scripts.php?file_name="+file_name+"&action=duplicate";
		  }
	}
  </script>
  </head>
  <body>
    <?php
		//environment settings
          $path = "../js/";
		  if (isset($_GET["file_name"])){$file_name = $_GET["file_name"];}
		//setting line ends
	?>
  
	<div id="mainbody">
  <fieldset class="info" id="hints">
    <h2>Scripts</h2>
    <p>Scripts allows Administrator to create customize web pages, also can use as a server disk to store programs, texts, scraps and etc.</p>
  </fieldset>
  <form id="create_script" name="create_script" onkeypress="if(event.keyCode==13||event.which==13){return Enterkey();}" method="post" action="./scripts.php">
	  <fieldset class="form">
	    <legend><img src="../css/img/b_newdb.png"> Create Script</legend>
        
        <label for="data_name">Name</label>
        <input type="text" name="data_name" id="data_name" oninput ="Data_name()" value=<?php if (isset($_GET["action"])) {if ($_GET["action"]=="edit") {echo "\"".substr($_GET["file_name"],0,strrpos($_GET["file_name"],"."))."\"";$select = substr($_GET["file_name"],strrpos($_GET["file_name"],"."),strlen($_GET["file_name"]));}}?>>
        <label for="data_type">Type</label>
        <select id="data_type" name="data_type" oninput ="Type_select()">
          <optgroup label="Front Side">
            <option value=".html" <?php if(isset($select)) {if($select==".html") {echo "selected";}}?>>Html</option>
            <option value=".css" <?php if(isset($select)) {if($select==".css") {echo "selected";}}?>>CSS</option>
            <option value=".js" <?php if(isset($select)) {if($select==".js") {echo "selected";}}?>>Javascript</option>
          </optgroup>
          <optgroup label="Server Side">
            <option value=".php" <?php if(isset($select)) {if($select==".php") {echo "selected";}}?>>PHP</option>
            <option value=".cmd" <?php if(isset($select)) {if($select==".cmd") {echo "selected";}}?>>Command</option>
            <option value=".bat" <?php if(isset($select)) {if($select==".bat") {echo "selected";}}?>>Batch</option>
          </optgroup>
          <optgroup label="Program">
            <option value=".c" <?php if(isset($select)) {if($select==".c") {echo "selected";}}?>>C</option>
            <option value=".cpp" <?php if(isset($select)) {if($select==".cpp") {echo "selected";}}?>>C++</option>
            <option value=".h" <?php if(isset($select)) {if($select==".h") {echo "selected";}}?>>C/C++ Header</option>
            <option value=".pas" <?php if(isset($select)) {if($select==".pas") {echo "selected";}}?>>Pascal</option>
            <option value=".java" <?php if(isset($select)) {if($select==".java") {echo "selected";}}?>>Java</option>
          </optgroup>
        </select>
        <input type="button" value="Go" onclick="Pop_edit();">
        <div id="current_script">
          <span id="data_text">This script will save as </span>
          <span id="data_temp"></span>
        </div>      
      
      </fieldset>
      <fieldset id="jump_out" class="form">
          <legend id="file_name"></legend>
          
          <textarea name="data_value" id="code"><?php
          if(isset($_GET["file_name"])) {//sense we have to do work or not
            if($_GET["action"]=="edit") {
              
              if (file_exists($path.$file_name)) {
                $file_connect = true;
                $code = file($path.$file_name);
                for($i=0;array_key_exists($i, $code);$i++) {
                  $code[$i] = str_replace("<", "&lt;", $code[$i]);
                  $code[$i] = str_replace(">", "&gt;", $code[$i]);

                  echo $code[$i];
                }
              }
              else {
                $file_connect = false;
              }
            }
          }
          ?></textarea>
          <script>
            var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
                mode: "application/x-httpd-php",
                lineNumbers: true,
                matchBrackets: true,
                matchTags: {bothTags: true},
                autoCloseBrackets: true,
                autoCloseTags: true,
                lineWrapping: true
            });
            document.getElementById("jump_out").style.display = "none";
            parent.Loading();
          </script>
          <?php
            if (isset($_GET["file_name"])) {
			        $message = 1;
			        $r_name = substr($file_name,0,strrpos($file_name,"."));
			        $e_name = substr($file_name,strrpos($file_name,"."),strlen($file_name));
				      if (isset($_GET["add"])) { $n_name = $_GET["add"]; }
              if ($_GET["action"]=="edit") {
                echo "<script>Edit();</script>";
                
                if ($file_connect) {
                  echo "<script>parent.loadMessage(\"okay\",\"Successfully connected to <b>$file_name</b>.\")</script>";
                }
                else {
                  echo "<script>parent.loadMessage(\"error\",\"<b>$file_name</b> doesn't exist.\")</script>";
                }
              }
              if ($_GET["action"]=="duplicate") {
					      if(copy($path.$file_name, $path.$r_name."_copied".$e_name)) {
						      echo "<script>parent.loadMessage(\"okay\",\"Successfully duplicated <b>$file_name</b>.\")</script>";
					      }
					      else {
						      echo "<script>parent.loadMessage(\"error\",\"Failed to duplicate <b>$file_name</b>.\")</script>";
					      }
              }
              if ($_GET["action"]=="rename") {
                if (rename($path.$file_name, $path.$n_name)) {
                  echo "<script>parent.loadMessage(\"okay\",\"Successfully renamed <b>$file_name</b> to <b>$n_name</b>.\")</script>";
                }
                else {
                  echo "<script>parent.loadMessage(\"error\",\"Failed to rename <b>$file_name</b>.\")</script>";
                }
              }
			  
			  
            }
          ?>
          <br>
            <input style="float: right;" type="button" value="Apply Change" onclick="Apply_Change();">
            <input style="float: right;" type="button" value="Clear" onclick="Clear();">
            <input style="float: right;" type="button" value="Cancel" onclick="Dismiss_edit();">
          </br>
      </fieldset>
    </form>
    <fieldset class="form">
    	<legend>Filters</legend>
    	<form onkeypress="if(event.keyCode==13||event.which==13){return false;}">
    		<label for="data_filter">Containing the word</label>
    		<input type="text" name="data_filter" id="data_filter" oninput="Data_filter();">
    	</form>
    </fieldset>
    <table class="formal">
        <tr id="table_head">
        	<th>script</th>
        	<th>Modified</th>
        	<th>Type</th>
        	<th>Size</th>
        	<th>Owner</th>
        	<th>Action</th>
        </tr>
        <?php
          //$path = "../js/";
          if (isset($_GET["file_name"])) {
            if ($_GET["file_name"]!="" and $_GET["file_name"]!=null and $_GET["action"]!="" and $_GET["action"]!=null) {
              $message = 1;
              $file_name = $_GET["file_name"];
              $action = $_GET["action"];
              if ($action=="delete") {
                if(unlink($path.$file_name)) {
                  echo "<script>parent.loadMessage('okay','Successfully deleted <b>$file_name</b>.')</script>";
                }
                else {
                  echo "<script>parent.loadMessage('error','Failed to delete <b>$file_name</b>.')</script>";
                }
              }
              if ($action=="edit") {
                $editor = 1;
              }
            }
          }
        ?>
        <?php
          if (isset($_POST["data_name"]) and isset($_POST["data_type"]) and isset($_POST["data_value"])) {
            $f_name = $_POST["data_name"].$_POST["data_type"];
            $f_value = $_POST["data_value"];
            if (!file_exists($path.$f_name)) goto write_file;
            if(!unlink($path.$f_name)) {
              $message = 1;
              echo ("<script>parent.loadMessage('error','Failed to refresh <b>$f_name</b>.')</script>");
              goto close;
            }

            write_file:
            $value = fopen($path.$f_name, "w"); 
            if(fwrite($value, $f_value)) {
              $message = 1;
              echo "<script>parent.loadMessage('okay','Successfully modified <b>$f_name</b>.')</script>";
            }
            else {
              $message = 1;
              echo ("<script>parent.loadMessage('okay','Set <b>$f_name</b> to empty.')</script>");
            }
            close:
            fclose($value);
          }
        ?>

        <?php
           
           $file = scandir($path);
           $i = 2;
           while (array_key_exists($i, $file)) {
           	 echo "<tr id='$file[$i]'>\r\n\t\t\t<td>".$file[$i]."</td>\r\n\t\t\t";
           	 echo "<td>".date("M d Y H:i:s", filemtime($path.$file[$i]))."</td>\r\n\t\t\t";

           	 if (strpos(strtolower($file[$i]), ".html")) {
           	 	echo "<td>Html File</td>";
           	 }
           	 else if (strpos(strtolower($file[$i]), ".css")) {
           	 	echo "<td>CSS Layout File</td>";
           	 }
           	 else if (strpos(strtolower($file[$i]), ".js")) {
           	 	echo "<td>Javascript File</td>";
           	 }
           	 else if (strpos(strtolower($file[$i]), ".txt")) {
           	 	echo "<td>Pure Text File</td>";
           	 }
           	 else if (strpos(strtolower($file[$i]), ".php")) {
           	 	echo "<td>PHP File</td>";
           	 }
           	 else if (strpos(strtolower($file[$i]), ".cmd") || strpos(strtolower($file[$i]), ".bat")) {
           	 	echo "<td>Command Batch Program</td>";
           	 }
             else if (strpos(strtolower($file[$i]), ".c")) {
              echo "<td>C Program File</td>";
             }
             else if (strpos(strtolower($file[$i]), ".cpp")) {
              echo "<td>C++ Program File</td>";
             }
             else if (strpos(strtolower($file[$i]), ".h")) {
              echo "<td>C/C++ Header File</td>";
             }
             else if (strpos(strtolower($file[$i]), ".pas")) {
              echo "<td>Pascal Program File</td>";
             }
             else if (strpos(strtolower($file[$i]), ".java")) {
              echo "<td>Java Program File</td>";
             }
           	 else {
           	 	echo "<td>Unknown File</td>";
           	 }
             echo "\r\n\t\t\t";
           	 echo "<td>".filesize($path.$file[$i])." byte</td>\r\n\t\t\t";
           	 echo "<td>".$_SERVER['HTTP_HOST']."</td>\r\n\t\t\t";
           	 echo "<td>\r\n\t\t\t\t<a onclick='parent.Loading();' href='scripts.php?file_name=$file[$i]&action=edit'><img src='../css/img/b_edit.png'>Edit</a>\r\n\t\t\t\t";
             echo "<a onclick='parent.Loading();' href='javascript:Duplicate(\"$file[$i]\")'><img src='../css/img/b_relations.png'>Duplicate</a>\r\n\t\t\t\t";
             echo "<a href='../scripts/$file[$i]' download><img src='../css/img/b_export.png'>Export</a>\r\n\t\t\t\t";
             echo "<a onclick='parent.Loading();' href='javascript:Confirm(\"$file[$i]\",\"rename\")'><img src='../css/img/b_inline_edit.png'>Rename</a>\r\n\t\t\t\t";
           	 echo "<a href='javascript:Confirm(\"$file[$i]\",\"delete\")'><img src='../css/img/b_drop.png'>Delete</a>\r\n\t\t\t</td>\r\n\t\t";
           	 echo "</tr>\r\n\t\t";
           	 $i++;
           }
           
           echo "<script>\r\n";
           echo "var filter_name = [";
           for ($j=2; $j<$i ; $j++) { 
             echo "'$file[$j]'".",";
           }
           echo "'stop'";
           echo "];\r\n";
           echo "</script>";
           $i = $i-2;
           clearstatcache();
        ?>
        <tr id="table_head" style="font-style: italic;">
        	<th id="table_text">
        	  <?php 
        	     if ($i==0) {
        	     	echo "No File Found.";
        	     }
        	     else {
        	     	echo "Total</th><th id='table_total'>".$i." File(s)"; 
        	     }	
        	  ?>
        	</th>
        </tr>
    </table>
	</div>
  
  <?php
    if(isset($message)) {
      if($message==0) {
        echo "<script>parent.hideMessage();</script>";
      }
    }
    else {
      echo "<script>parent.hideMessage();</script>";
    }
  ?>
  </body>
</html>
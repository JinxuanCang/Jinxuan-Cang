<?php
  include("../essential_settings.php");
  if (isset($_GET["cmd"]) && $_GET["cmd"]!="") {
    $myfile = fopen("../logs/console.log", "a");
    $txt = "[".time()."]\r\n";fwrite($myfile, $txt);
    $txt = "[IP ".$_SERVER["REMOTE_ADDR"]."]\r\n";fwrite($myfile, $txt);
    $txt = "[User ".$_SESSION["ID"]." ".$_SESSION["username"]."]\r\n";fwrite($myfile, $txt);
    if(ip($_SERVER["REMOTE_ADDR"])) {
      
      
  	  $cmd = "cd /d ".$_GET["path"]." && ".$_GET["cmd"];
      exec($cmd." 2>&1", $output, $status);
      echo $status."[brk]";
      for ($i=0; array_key_exists($i, $output); $i++) { 
        $output[$i] = str_replace("<", "&lt;", $output[$i]);
        $output[$i] = str_replace(">", "&gt;", $output[$i]);
        echo $output[$i]."\n";
      }
    }
    else {
      echo "1"."[brk]Permission denied.";
    }
    fclose($myfile);
  }
?>
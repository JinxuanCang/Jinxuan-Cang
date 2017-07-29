<?php
  include("../essential_settings.php");

  if ($_SESSION["ENABLE_LOGIN"]) {
  	#Login
  	if (!isset($_POST["username"]) or $_POST["username"]==""):
  		goto login_ends;
  	endif;
  	$login_username = $_POST["username"];
  	if (ctype_alpha(str_replace(" ", "", $login_username))) {
  		$path = "../users/name_convert/";
  		goto login_entire_name;
  	}
  	else {
  		$ID = $login_username;
  		goto login_by_ID;
  	}
  	login_entire_name:
    if (file_exists($path.str_replace(" ", "_", $login_username))) {
	  	$pre_load = file($path.str_replace(" ", "_", $login_username));
	  	$ID = trim($pre_load[0]);
	  	if ($ID=="MN") {
	  		echo "MN";
	  		exit;
	  	}
	  	goto login_by_ID;
	}
	else {
	  	goto login_WU;
	}
	login_by_ID:
	$path = "../users/";
	if (file_exists($path.$ID)) {
	  		$info = file($path.$ID."/info");
	  		goto login_proceed;
	}
	else {
		goto login_WU;
	}
  	login_proceed:
  	if (sha1($_POST["password"])==trim($info[2])) {
  				if (file_exists($path.$ID."/freezing")) {
  					echo "FR";
  					exit;
  				}
	  			if ($_SESSION["ENABLE_STU"] && "Student"==trim($info[1])) {
	  				goto login_store_value;
	  			}
	  			else if ($_SESSION["ENABLE_TEACH"] && "Teacher"==trim($info[1])) {
	  				goto login_store_value;
	  			}
	  			else if ($_SESSION["ENABLE_ADMIN"] && "Administrator"==trim($info[1])) {
	  				goto login_store_value;
	  			}
	  			else if ("SuperAdministrator"==trim($info[1])) {
	  				goto login_store_value;
	  			}
	  			else if ("WebsiteDebugger"==trim($info[1])) {
	  				goto login_store_value;
	  			}
	  			else {
	  				echo "SF";//SF stands for Standard user login Failed.
	  				exit;
	  			}
	  		}
	else {
	    echo "WP";//WP stands for Wrong Password.
	    exit;
	}
	login_store_value:
	    $_SESSION["Login_status"] = trim($info[1]);
	  	$_SESSION["username"] = trim($info[0]);
	  	$_SESSION["ID"] = $ID;
      if (file_exists($path.$ID."/settings/theme")) {
        $user_theme = file($path.$ID."/settings/theme");
        $_SESSION["theme"] = $user_theme[0];
      }
      else {
        $_SESSION["theme"] = "standard";
      }
	    echo "LI";//LI stands for Logged In.
	    exit;
	login_WU:
	    echo "WU";
	    exit;
	login_ends:
  	#Register
  	
  	if (isset($_POST["active_code"]) and $_POST["active_code"]!="") {	
  		if ($_SESSION["ENABLE_REG"]) {
  			$active_code = $_POST["active_code"];
  			if (file_exists("../login/active_code/".md5($active_code))) {
  				echo "ACF";
  			}
  			else {
  				echo "ACN";
  			}
  		}
  		else {
  		echo "UA";
  	    }
  	}

  }
  else {
  	echo "UA";//UL stands for Unauthorized Action.
  }/*
  #Registration
  if (isset($_POST["Rusername"])) {
  	if ($_POST["Rusername"]!=""){
    	if (file_exists($path.$_POST["Rusername"])) {
  	  		echo '<script>SameName();</script>';
  	  		echo '<script>PopReg();</script>';
  	  		exit;
    	}

    	echo '<script>PopReg();</script>';

		mkdir($path.$_POST["Rusername"]);

		$userinfo = fopen($path.$_POST["Rusername"]."/info", "w");

    	#creat user's password	
    	$userpassword = $_POST["Rpassword"];
    	fwrite($userinfo, $userpassword."\r\n");
    
    	#creat user's email
    	$useremail = $_POST["email"];
    	fwrite($userinfo, $useremail."\r\n");

    	#creat user's IP address
    	$userIPaddress = $_SERVER["REMOTE_ADDR"];
    	fwrite($userinfo, $userIPaddress."\r\n");

    	#creat user's register time
    	$userRegtime = date("d/m/Y H:i:s");
    	fwrite($userinfo, $userRegtime);

    	fclose($userinfo);
    	$_SESSION["username"] = $_POST["Rusername"];
    	echo '<script>RegSuccessed();</script>';
  	}
  }*/
?>
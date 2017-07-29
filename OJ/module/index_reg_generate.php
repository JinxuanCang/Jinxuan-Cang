<?php
  include("../essential_settings.php");
  if ($_SESSION["ENABLE_LOGIN"] and $_SESSION["ENABLE_REG"] and isset($_POST["active_code"]) and $_POST["active_code"]!="") {
  	$active_code = $_POST["active_code"];
  	if (file_exists("../login/active_code/".md5($active_code))) {
      $info = file("../login/active_code/".md5($active_code));

  			?>
            <legend>Register</legend>
            <form>
              <label for="reg_fullname">Username ID#<?php echo $info[0];?></label><br>
              <input type="text" name="reg_fullname" id="reg_fullname" value="<?php echo $info[1]; ?>" disabled><br>
              <label for="reg_priviledge">Priviledge</label><br>
              <input type="text" name="reg_priviledge" id="reg_priviledge" value="<?php echo $info[2];?>" disabled><br>
              <label for="reg_password">Password</label><br>
              <input type="password" name="reg_password" id="reg_password"><br>
              <label for="reg_retype">Re-type</label><br>
              <input type="password" name="reg_retype" id="reg_retype"><br>
              <label for="reg_email">Email</label><br>
              <input type="email" name="reg_email" id="reg_email"><br>
              <label for="reg_workphone">Work phone</label><br>
              <input type="text" name="reg_workphone" id="reg_workphone" value="+1"><br>
            </form>
        <?php
  	}
  	else {
  		echo "UA";
  	}
  }
  else {
  	echo "UA";
  }
?>
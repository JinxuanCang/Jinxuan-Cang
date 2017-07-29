<?php 
  include("../essential_settings.php");
  //if ($action_deal == "return_action_code") {
    if (!$_SESSION["ENABLE_LOGIN"]):
      printf("LOGIN:F;");
    endif;
    if (!$_SESSION["ENABLE_REG"]):
      printf("REG:F;");
    endif;
    echo "[brk]";
  //}
  //if ($action_deal == "return_message") {
    #Message
    if (file_exists("../events/popmessage.txt")) {
      $popmessage = file("../events/popmessage.txt");
      for ($i=0; array_key_exists($i, $popmessage) ; $i++) { 
          $popmessage[$i] = trim($popmessage[$i]);
          echo $popmessage[$i];
      }
    }
    echo "[brk]";
  //}
  //if ($action_deal == "return_system_notification"): ?>
    <?php if(!$_SESSION["ENABLE_LOGIN"] || !$_SESSION["ENABLE_REG"] || $_GLOBAL["ADD_NOTE"]!=""):?>
    <fieldset>
      <legend>System Notification</legend>
      <?php if(!$_SESSION["ENABLE_LOGIN"]):?>
        <div class="note">Login disabled.</div>
      <?php endif;?>
      <?php if(!$_SESSION["ENABLE_REG"]):?>
        <div class="note">Registration disabled.</div>
      <?php endif;?>
      <?php if($_GLOBAL["ADD_NOTE"]!=""):?>
        <div class="add_note"><?php echo $_GLOBAL["ADD_NOTE"]; ?></div>
      <?php endif;?>
    </fieldset>
    <h4></h4>
  <?php endif;
?>
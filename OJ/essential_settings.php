<?php
  #essential settings
  session_start();//must
  error_reporting(E_ALL ^ E_NOTICE);//recommended E_ALL ^ E_NOTICE
  //error_reporting(E_ALL); ini_set('display_errors', 1);
  date_default_timezone_set("America/New_York");//match current timezone
  #if you want more timezone tag names, please visit php.net/manual/en/timezones.php

  #operating settings
  /* all boolean value */
  $_SESSION["ENABLE_LOGIN"] = true;//enable users to login system
  $_SESSION["ENABLE_REG"] = true;//enable users to register
  $_SESSION["ENABLE_LANG"] = true;//enable users to change language
  $_SESSION["ENABLE_STU"] = true;//enable students to login system
  $_SESSION["ENABLE_TEACH"] = false;//enable teachers to login system
  $_SESSION["ENABLE_ADMIN"] = true;//enable administrators to login system
  $_SESSION["SYSTEM_ON"] = true;//system switch
  $_GLOBAL["ADD_NOTE"] = "In order to enhance the PHP-Campus table feature, table.js is now obselete javascript rerendering. Instead, using CSS \"display: table-row\" and other similar statement is a better alternative. Due to the update, serveral pages of PHP-Campus are unavailable, includes but not limited to IP Tracer and Testing Table. ";

  #operating directory
  /*in double or single quotation marks*/
  $_SESSION["THEME_PATH"] = "../css";

  #system time settings
  /* time zone changes in essential settings */
  /* numbers only, use 24-hour clock time */
  $_SESSION["INITIAL_YEAR"] = 2016;//set year's starting point
  $_SESSION["INITIAL_MON"] = 11;//set month's starting point
  $_SESSION["INITIAL_DAY"] = 4;//set day's starting point
  $_SESSION["INITIAL_HOUR"] = 20;//set hour's starting point
  $_SESSION["INITIAL_MIN"] = 28;//set minute's starting point
  $_SESSION["INITIAL_SEC"] = 34;//set second's starting point
  $_SESSION["INITIAL_TIME"] = floor(mktime($_SESSION["INITIAL_HOUR"],$_SESSION["INITIAL_MIN"],$_SESSION["INITIAL_SEC"],$_SESSION["INITIAL_MON"],$_SESSION["INITIAL_DAY"],$_SESSION["INITIAL_YEAR"])/86400);//must

  #essential functions
  /* check user's IP address*/
  $IP_address = " ".$_SERVER['HTTP_HOST']." ::1 10.2.1.120";
  function ip($address) {
    global $IP_address;
    if(stripos($IP_address,$address)===false)
      return false;
    else return true;
  }
  if (!(strpos($_SERVER["PHP_SELF"],"view")===false)) {
    include("../module/users_auto.php");
  }
?>
<?php
  #preload script
  if (!$_SESSION["SYSTEM_ON"]):
    exit("System shutted off. To restore system please turn on system switch in essential_settings.php.");
  endif;
?>
<?php
  #essential settings
  session_start();//must
  error_reporting(E_ALL ^ E_NOTICE);//recommended E_ALL ^ E_NOTICE
  //error_reporting(E_ALL); ini_set('display_errors', 1);
  date_default_timezone_set("America/New_York");//match current timezone
  #if you want more timezone tag names, please visit php.net/manual/en/timezones.php
  $_SESSION["THEME_PATH"] = "../css";
  $_SESSION["theme"] = "infinite_campus";
  //$_SESSION["theme"] = "standard";
  
  #operating settings
  /* all boolean value */
  $_SESSION["ENABLE_LOGIN"] = 1;//enable users to login system
  $_SESSION["ENABLE_REG"] = true;//enable users to register
  $_SESSION["ENABLE_LANG"] = true;//enable users to change language
  $_SESSION["ENABLE_STU"] = true;//enable students to login system
  $_SESSION["ENABLE_TEACH"] = false;//enable teachers to login system
  $_SESSION["ENABLE_ADMIN"] = true;//enable administrators to login system
  #gathering user IP address info
  switch($_SERVER["HTTP_HOST"]) {
    case "::1:8080":break;
    case "127.0.0.1:8080":break;
    case "127.0.0.1":break;
    case "192.168.1.167:8080":break;
    case "10.61.17.43:8080":break;
    case "localhost:8080":break;
    default:
      $_SESSION["IP_ADDR"] = $_SERVER['REMOTE_ADDR'];
      $IP_info = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
      if($IP_info && $IP_info['status'] == 'success') {
        $_SESSION["IP_COTRY"] = $IP_info['countryCode'];
        $_SESSION["IP_REG"] = $IP_info['region'];
        $_SESSION["IP_REGNA"] = $IP_info['regionName'];
        $_SESSION["IP_COTRYNA"] = $IP_info['country'];
        $_SESSION["IP_CITY"] = $IP_info['city'];
        $_SESSION["IP_ZIP"] = $IP_info['zip'];
        $_SESSION["IP_LAT"] = $IP_info['lat'];
        $_SESSION["IP_LON"] = $IP_info['lon'];
        $_SESSION["IP_TIZON"] = $IP_info['timezone'];
        $_SESSION["IP_ISP"] = $IP_info['isp'];
        $_SESSION["IP_AS"] = $IP_info['as'];
        $_SESSION["IP_LOCATE"] = $IP_info['city'].", ".$IP_info['region'].", ".$IP_info['zip'].", ".$IP_info['country'];
      } else { ?>
        <script>window.open("forbidden.php?reason=Unverified Internet Protocol Address(UIPA)","_parent")</script>
      <?php }
    break;
  }
  
  #operating directory
  /*in double or single quotation marks*/
  $img_path = "../css/img/";
  $_SESSION["IMG_PATH"] = $image_path;

  #essential functions
  /* check user's IP address*/
  $IP_address = " ".$_SERVER['HTTP_HOST']." ::1 10.2.1.120";
  function ip($address) {
    global $IP_address;
    if(stripos($IP_address,$address)===false)
      return false;
    else return true;
  }
  function js($location) {
    ?>
    <script type="text/javascript" src="<?php echo $location;?>"></script>
    <?php
  }
  function css($location) {
    ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $location;?>"/>
    <?php
  }
  function horLocation($name,$id,$url) {
    ?>
    <div id="<?php echo $id; ?>" data-url="<?php echo $url; ?>" onclick="horizontalURL(this)" data-disabled="true"><?php echo $name; ?></div>
    <?php
  }
  function verLocation($name,$id,$svg_url,$url) {
    global $img_path;
    ?>
    <div id="<?php echo $id; ?>" data-url="<?php echo $url; ?>" onclick="verticalURL(this)" data-disabled="true" title="<?php echo $name; ?>"><?php echo file_get_contents($img_path.$svg_url);?></div>
    <?php
  }
  function AJAX($request_name,$request_method,$request_url) {
    ?>
    <script>
      function <?php echo $request_name?>AJAX(input) {
        <?php echo $request_name; ?> = new XMLHttpRequest();
        <?php echo $request_name; ?>.open("<?php echo strtoupper($request_method); ?>","<?php echo $request_url; ?>",true);
        <?php if(strtoupper($request_method)=="POST"): ?>
          <?php echo $request_name; ?>.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        <?php endif; ?>
        <?php echo $request_name; ?>.send(<?php if(strtoupper($request_method)=="POST") echo "input"; ?>);
      }
    </script>
    <?php
  }
  function Initialize() {
    ?>
      <link id="theme" rel="stylesheet" type="text/css" href="/css/<?php echo $_SESSION['theme']?>.css">
    <?php
    //css("/css/popmessage.css");
    css("/css/general.css");
    //js("/js/popmessage.js");
    js("/js/essential.js");
  }
  function LoginRequire() {
    if(!isset($_SESSION["username"])): ?>
      <script>window.open("/forbidden/Unauthorized Action(UA)","_parent")</script>
    <?php
    endif;
  }
?>
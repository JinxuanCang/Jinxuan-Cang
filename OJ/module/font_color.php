<?php
  function font_color($ini_code) {
    list($red,$green,$blue) = sscanf($ini_code, "%02x%02x%02x");
    # red,green,blue all set.
    if (($red*0.299 + $green*0.587 + $blue*0.114 )> 186) {
  	 $convert_font_color = "black";
     return "#000000";
     exit;
    }
    else {
  	 $convert_font_color = "white";
     return "#ffffff";
    }
  }
?>
<script>
  function font_color(ini_code) {
    var red = ini_code.substr(1,2);
    var green = ini_code.substr(3,2);
    var blue = ini_code.substr(5,2);
    
    red = parseInt(red, 16);
    green = parseInt(green, 16);
    blue = parseInt(blue, 16);
    if ((red*0.299 + green*0.587 + blue*0.114) > 186) {
      return "#000000";
    }
    else {
      return "#ffffff";
    }
  }
</script>
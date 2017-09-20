<html>
  <head>
    <?php
      include("../essential_settings.php");
      Initialize();
    ?>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <div>
      <div style="border: 2px solid darkgrey;width: 100%; height: fit-content; display: flex; vertical-align: center;">
        <div><img src="../users/20655/profile_photo.jpg" width="80px" height="100px"></div>
        <div style="margin: auto 30;">Jinxuan Cang</div>
        <div style="margin: auto 50; display: flex;">
          <div class="temp" style="border-left: 1px;"><b>P</b><font size="1">resent</font></div>
          <div class="temp"><b>A</b><font size="1">bsent</font></div>
          <div class="temp"><b>T</b><font size="1">ardy</font></div>
          <style>
            .temp {
              border-color: dimgrey;
              border-right: 1px;
              border-top: 1px;
              border-bottom: 1px;
              border-style: solid;
              width: 40px;
              padding: 4px;
              background-color: white;
              transition: background 0.3s linear;
            }
            .temp:hover {
              background-color: purple;
            }
          </style>
        </div>
      </div>
    </div>
	</div>
  </body>
</html>
<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <?php include("../module/font_color.php");?>
    <script type="text/javascript" src="../js/initial_colorcode.js"></script>
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/colorname_converter.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
  </head>
  <body>
  	<div id="mainbody">
  		<fieldset class="info">
  			<h2>Thematic Settings</h2>
  		</fieldset>
  		<fieldset class="form">
  			<legend><img src="../css/img/s_theme.png"> Theme Style</legend>
  			<table>
  				<tr>
  					<td>In using theme:</td>
  					<td class="divider"></td>
  					<td><?php echo $_SESSION["theme"];?></td>
  				</tr>
  				<tr>
  					<td>Previewing theme:</td>
  					<td class="divider"></td>
  					<td id="preview_thm_lab">-</td>
  				</tr>
  				<tr>
  					<td>Apply the theme:</td>
  					<td class="divider"></td>
  					<td>
  						<select id="theme_selector">
  							<optgroup label="Original">
  								<option value="standard" <?php if($_SESSION["theme"]=="standard")echo "selected";?>>standard</option>
  							</optgroup>
  							<optgroup label="Built-in">
  								<?php
  									$path = $_SESSION["THEME_PATH"];
  									$themes = scandir($path);
  									for ($i=2; array_key_exists($i, $themes); $i++) {
  										$themes[$i] = trim($themes[$i]);
  										$target = $path."/".$themes[$i];
  										if (is_dir($target) and (file_exists($target."/"."color.css") or file_exists($target."/"."font.css") or file_exists($target."/"."box.css")) and $themes[$i] != "standard") {
  											?>
  											<option value="<?php echo $themes[$i];?>"<?php if($themes
                        [$i]==$_SESSION["theme"])echo "selected";?>><?php echo $themes[$i]; ?></option>
  											<?php
  										}
  									}
  								?>
  							</optgroup>
  							<optgroup label="Costomized">
  								<option>User1</option>
  							</optgroup>
  						</select>
  					</td>
  					<td class="divider"></td>
  					<td><input type="button" id="theme_save" value="Save"></td>
  					<td><input type="button" id="theme_discard" value="Discard" style="display: none;"></td>
  				</tr>
  			</table>
  		</fieldset>
  		<script>
        var in_use_theme = "<?php echo $_SESSION["theme"];?>";
  			invoke("theme_selector").onchange = function() {
  				
  				var current_theme = invoke("theme_selector").value;
  				if (current_theme=="<?php echo $_SESSION["theme"];?>") {
  					vartext("preview_thm_lab","-");
  					disappear("theme_discard");
  					theme(in_use_theme);
  					parent.theme(in_use_theme);
  					parent.parent.content.theme(in_use_theme);
  					parent.Local_Sizing();
  					parent.parent.content.Local_Sizing();
  				}
  				else {
  					vartext("preview_thm_lab",current_theme);
  					appear("theme_discard","inline-block");
  					theme(current_theme);
  					parent.theme(current_theme);
  					parent.parent.content.theme(current_theme);
  					parent.Local_Sizing();
  					parent.parent.content.Local_Sizing();
  				}
  			}
        window.onunload = function() {
          parent.theme(in_use_theme);
            parent.parent.content.theme(in_use_theme);
            parent.Local_Sizing();
            parent.parent.content.Local_Sizing();
        }
  		</script>
  	</div>
  </body>
</html>
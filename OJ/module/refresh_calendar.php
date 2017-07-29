<?php
  include("../essential_settings.php");
  $c_month = $_GET["month_change"];
  if ($c_month<0) {
  	$c_year = ceil($c_month/12);
  }
  else {
  	$c_year = floor($c_month/12);
  }
  $c_month = $c_month % 12;

?>
<?php
  if(isset($_GET["search_color"])) {
  	$search_day = $_GET["search_day"];
  	include("./calendar_search_color.php");
  }
  else {
  	$search_day = "Undefined";
  }
?>
    <h2>
        <a onclick="Refresh_Calendar('dec')"><img src="../css/img/b_prevpage.png"></a>
        <a onclick="Refresh_Calendar('inc')"><img src="../css/img/b_nextpage.png"></a>
        <?php echo date("F Y",mktime(0, 0, 0, date("n")+$c_month, 1, date("Y")+$c_year));?>
        <?php if ($c_year!=0 or $c_month!=0):?>
        	<a title="initial" onclick="Refresh_Calendar('ini');"><img src="../css/img/b_firstpage.png"></a>
        <?php endif;?>
		<label for="search_date">Set the date</label>
      <input type="date" name="search_date" id="search_date" onchange="Search_Date();" ondblclick="Search_Date();">
      
      <label for="search_color">Set selected grid color</label>
      <input type="color" name="search_color" id="search_color" value="#ccffcc" onchange="Search_Date();">
		<a class="link_floatright" id="search_shortcut" onclick="Search_Shortcut(false);"><img src="../css/img/b_search.png"></a>
	</h2>
			<div>
				<table id="calendar_table">
					<tr id="table_head">
						<th>Sunday</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
					</tr>
					<tr>
					<?php
					    $path = "../events/calendar/";
						#analyze month's days

						$d_month = 0;
						$f_weekday = date("w", (mktime(0, 0, 0, date("n")+$c_month, 1, date("Y")+$c_year)));
						$l_month = date("t",mktime(0, 0, 0, date("n")+$c_month, 1, date("Y")+$c_year));
						for ($i=0; $i < $f_weekday; $i++) { 
							printf("\t<td class='null_weekday'></td>\r\n\t\t\t\t\t");
						}
						for ($i=$f_weekday; $i < 7; $i++) { 
							$d_month++;
							if ($d_month==$search_day) {$style=" style='$search_color_style'";} else { $style="";}
							if ($d_month==date("j") && $c_month==0 && $c_year==0) { $label=" id='t_month'";} else { $label="";}
							printf("\t<td$label$style>$d_month");
							$pa_date = floor(mktime(0, 0, 0, date("n")+$c_month, $d_month, date("Y")+$c_year)/86400);
							if (file_exists($path.$pa_date)) {
								$c_title = scandir($path.$pa_date);
								for ($j=2; $j < count($c_title); $j++) { 
									echo "<div class='event_row'>$c_title[$j]</div>";
									if ($j<>count($c_title)-1) {
										printf("<hr>");
									}
									
								}
							}
							printf("</td>\r\n\t\t\t\t\t");
						}
						printf("</tr>\r\n\t\t\t\t\t");
						loop:
						if ($d_month == $l_month) { goto end;}
						printf("<tr>\r\n");
						for ($i=0; $i < 7; $i++) { 
							$d_month++;
							if ($d_month==$search_day) {$style=" style='$search_color_style'";} else { $style="";}
							if ($d_month==date("j") && $c_month==0 && $c_year==0) { $label=" id='t_month'";} else { $label="";}
							if ($d_month == $l_month+1) {
								for ($j=$i; $j < 7; $j++) { 
									printf("\t\t\t\t\t\t<td class='null_weekday'></td>\r\n");
								}
								goto end;
							}
							printf("\t<td$label$style>$d_month");
							$pa_date = floor(mktime(0, 0, 0, date("n")+$c_month, $d_month, date("Y")+$c_year)/86400);
							if (file_exists($path.$pa_date)) {
								$c_title = scandir($path.$pa_date);
								for ($j=2; $j < count($c_title); $j++) { 
									echo "<div class='event_row'>$c_title[$j]</div>";
									if ($j<>count($c_title)-1) {
										printf("<hr>");
									}
								}
							}
							printf("</td>\r\n\t\t\t\t\t");
						}
						printf("\t\t\t\t\t</tr>\r\n\t\t\t\t\t");
						goto loop;
						end:

					?>
				</table>
			</div>
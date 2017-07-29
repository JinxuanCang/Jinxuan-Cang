		<ul id="horizontal_bar">
	      <li><a <?php if($_SESSION["gen_location"]=="dashboard"): echo "class='active'"; endif;?> href="dashboard.php"><img src="../css/img/s_sync.png"> Dashboard</a></li>
          <li><a <?php if($_SESSION["gen_location"]=="calendar"): echo "class='active'"; endif;?> href="calendar.php"><img src="../css/img/b_calendar.png"> Calendar</a></li>
          <li><a <?php if($_SESSION["gen_location"]=="users"): echo "class='active'"; endif;?> href="users.php"><img src="../css/img/b_usrlist.png"> Users</a></li>
	      <li><a <?php if($_SESSION["gen_location"]=="databases"): echo "class='active'"; endif;?> href="databases.php"><img src="../css/img/database.png"> Databases</a></li>
	      <li><a <?php if($_SESSION["gen_location"]=="status"): echo "class='active'"; endif;?> href="status.php"><img src="../css/img/s_status.png"> Status</a></li>
	      <li><a <?php if($_SESSION["gen_location"]=="informations"): echo "class='active'"; endif;?> href="informations.php"><img src="../css/img/s_info.png"> Informations</a></li>
	    </ul>
	    <script>
	    	document.getElementsByClassName('active')[0].removeAttribute("href");
	    	
	    </script>
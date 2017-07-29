<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <?php include("../module/font_color.php");?>
    <script type="text/javascript" src="../js/initial_colorcode.js"></script>
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/colorname_converter.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
  	<style type="text/css">
		#profile_photo {
			display: block;
			height: 110px;
			width: 110px;
			margin: auto;
			border-radius: 50%;
		}
		#initial_profile_photo_background {
			width: 110px;
			height: 110px;
			margin: auto;
			border-radius: 100%;
			margin-bottom: 5px;
		}
		#initial_profile_photo_text {
			margin: auto;
			font-size: 70px;
			padding-top: 16px;
		}
		.category_collapse {
			max-height: 300px;
			transition: max-height 0.5s ease-in;
		}
		.category_cld {
			max-height: 0px;
			transition: max-height 0.5s cubic-bezier(0, 1, 1, 1);
		}
		.category_gradient {
			background: linear-gradient(to bottom,var(--900),var(--700));
		}
		.tag:hover {
			background: linear-gradient(to bottom right,var(--900),var(--500));
		}
	</style>
	<script>
	  function RightBorder (tagname) {
	  	//console.log(invoke("vertical_bar").childElementCount)
	  	for (i = 0; document.body.contains(lmvoke("a",i)); i++) {
	  		lmvoke("a",i).classList.remove("focusing");
	  	}
	  	invoke("message_mark").style.marginRight = "50px";
	  	invoke(tagname).classList.add("focusing");
	  	if (tagname=="messages") {
	  		document.getElementById("message_mark").style.marginRight = "42px";
	  	}
	  	Pass(tagname);
	  }
	  /*function Local_Sizing() {
	  	invoke("navigation_bar").style.height = window.innerHeight - invoke("user_info").offsetHeight - 5;
	  	//setTimeout(function() {
	  	for (var i = 0; invoke("navigation_bar").contains(invoke("navigation_bar").getElementsByTagName("section")[i]); i++) {
	  		var s_temp = invoke("navigation_bar").getElementsByTagName("section")[i];
	  		var s_height = invoke("navigation_bar").getElementsByTagName("section")[i].offsetHeight;
	  	    //s_temp.style.height = s_height;
	  	    //s_temp.style.setProperty("--original_height",s_height);
	  		
	  		s_temp.classList.add("category_collapse");
	  		
	  	}
	  	for (var i = 0; invoke("navigation_bar").contains(invoke("navigation_bar").getElementsByClassName("tag")[i]); i++) {
	  		s_temp = invoke("navigation_bar").getElementsByClassName("tag")[i];
	  		s_temp.setAttribute("onclick","Collapse_Category(this)");
	  		s_temp.nextElementSibling.style.overflow = "hidden";
	  	}//}, 10)
	  }*/
	  window.onload = function() {
	  	//Local_Sizing();
	  }
	  window.onresize = function() {
	  	Local_Sizing();
	  }
	  function Pass(id) {
	  	parent.main.Navigator(id);
	  }
	  function Collapse_Category(element) {
	  	var s_style = element.nextElementSibling.style;
	  	element.nextElementSibling.classList.toggle("category_cld");
	    element.classList.toggle("category_gradient");
	  }
	</script>
  </head>
  <body id="content_body">
  	<style>
  		.content_list div {
  			padding: 10px;
  			transition: all 0.2s linear;
  		}
  		.content_list div:hover {
  			background-color: var(--800);
  		}
  		.content_list div svg {
  			fill: white;
  			width: 30px;
  			height: 30px;
  			display: block;
  			margin: auto;
  		}
  		#bottom_group {
  			width: 100%;
  			position: absolute;
  			bottom: 0;
  		}
  		#logoff svg{
  			transition: fill 0.2s linear;
  		}
  		#logoff:hover svg {
  			fill: red;
  		}
  	</style>
  	<section id="top_group" class="content_list">
  		<div onclick="Pass('general');"><?php echo file_get_contents("../css/img/c_home.svg"); ?></div>
  		<div><?php echo file_get_contents("../css/img/c_assignments.svg"); ?></div>
  		<div><?php echo file_get_contents("../css/img/c_applications.svg"); ?></div>
  		<div><?php echo file_get_contents("../css/img/c_reference.svg"); ?></div>
  		<div><?php echo file_get_contents("../css/img/c_help.svg"); ?></div>
  		
  	</section>
  	<section id="bottom_group" class="content_list">
  		<div id="messages"><?php echo file_get_contents("../css/img/c_messages.svg"); ?></div>
  		<style>
  			#messages svg{
  				fill: orange;
  			}
  		</style>
  		<div onclick="Pass('my_account');"><?php echo file_get_contents("../css/img/c_settings.svg"); ?></div>
  		<div id="logoff" onclick="window.open('../login','_top');" title="logoff"><?php echo file_get_contents("../css/img/c_logoff.svg"); ?></div>
  	</section>
  <!--
  	<ul id="vertical_bar">
  		<section id="user_info">
  	  		<li>
  	  			<div id="welcome">Welcome <b><?php echo str_replace("_", " ", $_SESSION["username"]);?></b></div>
  	  		</li>
  	  		<li><div><?php echo $_SESSION["Login_status"];?></div></li>

  	  		<?php if(file_exists("../users/".$_SESSION['ID']."/profile_photo.jpg")) {?>
  	  		<li><img id="profile_photo" style="margin-bottom: 5px;" src=<?php echo "../users/".$_SESSION['ID']."/profile_photo.jpg";?>></li>
  	  		<?php }else{ ?>
  	  		<li>
  	  			<div id="initial_profile_photo_background">
  	          		<div id="initial_profile_photo_text"></div>
  	      		</div>
  	  		</li>
  	  		<script>
    			var user_name = "<?php echo $_SESSION['username']?>";
    			vartext("initial_profile_photo_text",user_name.substr(0,1));
    			invoke("initial_profile_photo_background").style.backgroundColor = initial_colorcode(user_name);
        		sinfcolor("initial_profile_photo_text",font_color(colorname_tohex(initial_colorcode(user_name))));
      		</script>
  	  		<?php } ?>
  	  	</section>
  	  	<section id="navigation_bar" style="overflow: auto;">
  	  		<?php if(ip($_SERVER["REMOTE_ADDR"])&&$_SESSION["Login_status"]=="WebsiteDebugger"): ?>
  	  		<li class="tag">Localhost Tools</li>
  	  		<section>
  	  			<li><a id="console" onclick='RightBorder(this.id);' target="main" href="../console"><img src="../css/img/c_counselor.png"> Console</a></li>
  	  			<li><a id="file_regulator" onclick='RightBorder(this.id);' target="main" href="../../file_regulator"><img src="../css/img/b_docsql.png"> File Regulator</a></li>
  	  			<li><a id="control_panel" onclick="RightBorder(this.id)" target="main" href="../counselor/control_panel.php"><img src="../css/img/c_controlpanel.png"> Control Panel</a></li>
  	  		</section>

  	  		<?php endif;?>
	  		
	  		<li class="tag">Main Locations</li>
	  		<section>
      			<li><a id="general" class="focusing" onclick='RightBorder("general");' target="main" href="javascript:"><img src="../css/img/b_home.png"> General</a></li>
	  			<li><a id="assignments" onclick='RightBorder("assignments");' href="assignments.php" target="main"><img src="../css/img/b_sbrowse.png"> Assignments</a></li>
	  			<li><a id="score_board" onclick='RightBorder("score_board");' href="score_board.php" target="main"><img src="../css/img/b_chart.png"> Score Board</a></li>
	  			<li><a id="applications" onclick='RightBorder(this.id);' href="javascript:" target="main"><img src="../css/img/app_icon.png"> Applications</a></li>
	  		</section>
	  		<li class="tag">Short Cuts</li>
	  		<section>
	  			<?php ?>
	  			<li><a id="attandence" onclick='RightBorder(this.id);' target="main" href="attandence.php"> Attendance</a></li>
	  			<li><a id="weekly_agenda" onclick='RightBorder(this.id);' target="main" href="weekly_agenda.php"> Weekly Agenda</a></li>
	  		</section>
	  		<li class="tag">Help</li>
	  		<section>
	  			<li><a id="reference" onclick='RightBorder("reference");' href="reference.php" target="main"><img src="../css/img/b_sql.png"> References</a></li>
	  			<li><a id="FAQs"  onclick='RightBorder("FAQs");' href="../FAQs" target="main"><img src="../css/img/b_help.png"> FAQs</a></li>
	  		</section>
	  		<li class="tag">User Account</li>
	  		<section>
	  			<li><a id="messages"  onclick='RightBorder("messages");' href="javascript:" target="main"><img src="../css/img/b_comment.png"> Messages<div id="message_mark" style="float: right; display: inline-block;"><font color="red">???</font></div></a></li>
	  			<script>
	  				disappear("message_mark");
	  				setTimeout(function() {
						appear("message_mark","inline-block");
	  				},1000)
	  			</script>
	  			<style>
	     			img {
	     				height: 16px;
	     				width: 16px;
	     			}
	     			#message_mark {
	     				color: white;
	     				margin-right: 50px;
	     				padding: 2px 8px 2px 8px;
	     				background-color: orange;
	     			}
	  			</style>
	  			<li><a id="my_account" onclick='RightBorder(this.id);' href="javascript:"><img src="../css/img/b_usrcheck.png"> My Account</a></li>
	  			<li><a id="loggoff" href="../login" target="_top"><img src="../css/img/s_loggoff.png"> Loggoff</a></li>
	  		</section>
	  	</section>
    </ul>-->
  </body>
</html>
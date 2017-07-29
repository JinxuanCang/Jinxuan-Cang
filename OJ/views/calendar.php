<!DOCTYPE html>
<html>
<head>
	  <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/float_bar.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/calendar.js"></script>
    <script type="text/javascript" src="../js/clock.js"></script>
    <style type="text/css">
    	#event_title_filter, #event_date_filter, #search_date, .create_events{
      		width: 200px;
      		height: 23px;
      }
      #event_date_filter {
        display: none;
      }
    	.calendar_table {
    		width: 100%;
    	}
      .table_head {
  color: white;
  background-color: var(--900);
}
      input[type=date] {
        border: 1px solid #aaa;
        padding: 1px 2px;
        margin: 1px 0px;
        font-size: 14px;
        transition-duration: 0.3s;
      }
      input[type=date]:hover {
        box-shadow: 0 0 5px #aaa;
      }
    	th {
    		border: 1px solid whitesmoke;
    		padding: 4px;
    		text-align: left;
    	}
      label[for=event_date_filter] {
        display: none;
      }
    	.calendar_table th{
    		text-align: center;
    	}
    	.calendar_table tr:not(.table_head) {
    		height: 100px;
    	}
    	.calendar_table td,.calendar_table th{
    		width: calc(100%/7);
    	}
    	td {
    		border: 1px solid dimgray;
    		padding: 4px;
    		text-align: right;
    	}
      
      	.calendar_table td:hover:not(.null_weekday):not(#t_month) {
        	background-color: #B3B3B3;
        	color: white;
      	}
      	.null_weekday {
      		background-color: white;
      		border-left: none;
      		border-right: none;
      	}
      	#t_month {
      		color: red;
      		font-weight: bold;
      	}
      	#t_month:hover {
      		background-color: #B3B3B3;
      	}
      	#today_events, #all_events, #events_table, #add_choice, #edit_event{
      		display: none;
      	}
      	#events_table td, #events_table th {
      		border: 1px solid whitesmoke;
      		text-align: left;
      	}
      	#events_table tr:hover:not(.table_head) {
      		background-color: #B3B3B3;
      		color: white;
      	}
      	#events_table.hide_details tr > *:nth-child(6), #events_table.hide_details tr > *:nth-child(7) {
      		display: none;
      	}
      	.nowrap {
      		white-space: nowrap;
      	}
      	.past_events {
      		 background-color: #ffff99;
      	}
      	.current_events {
      		background-color: #ccffcc;
      	}
        .event_row {
          font-size: 11px;
        }
        hr {
          margin: 1px 0 1px 0;
        }
    </style>
</head>
<body>
	<div id="popmessage">None.</div>
  <div id="mainbody">
    <div id="calendar"></div>
    <div id="sec"></div>
    <script>
      var settings = {
        smart: true,
        height: "default"
      }
      if(Calendar("calendar",settings))
        invoke("calendar").getElementsByClassName('calendar_main')[0].classList.add("info");
      var settings = {
        smart: true,
        height: "default"
      }
      if(Calendar("sec",settings))
        invoke("sec").getElementsByClassName('calendar_main')[0].classList.add("info");
    </script>
  </div>
</body>
</html>
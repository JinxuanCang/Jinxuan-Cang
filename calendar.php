<!DOCTYPE html>
<html style="height: 100%;">
<head>
	  <?php
      include("../essential_settings.php");
      Initialize();
      LoginRequire();
      js("../js/clock2.js");
    ?>
    <style>
      #calendar {
        border: 0.5px solid lightgrey;
      }
      #cal_header {
        display: grid;height: 25px;
        grid-template-columns: repeat(7, 1fr);
        background-color: var(--h3Background);
      }
      .cal_header {
        padding: 4px;
        text-align: center;
      }
      #cal_date {
        height: calc(100% - 56px);
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        grid-auto-rows: 1fr;
      }
      #calendar section>div {
        border: 0.5px solid lightgrey;
      }
      .cal_prev, .cal_proc{
        color: grey;
        background-color: #f2f2f2;
      }
      .cal_num {
        display: inline-block;
        background-color: aliceblue;
        padding: 3px;
      }
      .cal_today {
        background-color: #E1F5FE !important;
      }
    </style>
    <script>
      window.addEventListener("keydown", function (event) {
        if (event.defaultPrevented) return;
        switch (event.key) {
          case "ArrowDown": CalScroll(1); break;
          case "ArrowUp": CalScroll(-1); break;
          case "Enter":
            // Do something for "enter" or "return" key press.
            break;
          case "Escape":
            // Do something for "esc" key press.
            break;
          default: return;
        }
        event.preventDefault();
      }, true);
      function CalScroll(direction) {
        var parent = invoke("cal_date");
        var first_date = invoke("cal_date").firstElementChild.firstElementChild;
        if (first_date.innerHTML.substr(-2)!="/1") first_date.innerHTML = first_date.innerHTML.substr(first_date.innerHTML.indexOf("/")+1);
        if(direction>0)
          for (i = 0; i<7; i++)
            parent.firstElementChild.remove();
        else
          for (i = 0; i<7; i++)
            parent.lastElementChild.remove();
        for (var i = 0; i<7; i++) {
          if(direction>0)
            var last_element = parent.lastElementChild.dataset.date;
          else
            var last_element = parent.firstElementChild.dataset.date;
          var last_month = parseInt(last_element.substring(0,last_element.indexOf("-")));
          var last_date = parseInt(last_element.substring(last_element.indexOf("-")+1,last_element.lastIndexOf("-")));
          var last_year = parseInt(last_element.substring(last_element.lastIndexOf("-")+1,last_element.length));
          //console.log(last_year,last_month,last_date+1);
          var ele = document.createElement("div");
          if (direction>0)
            insertAfter(ele,parent.lastElementChild);
          else
            parent.insertBefore(ele,parent.firstElementChild);
          ele.setAttribute("data-date",time2("n-j-Y",last_year,last_month,last_date+direction));
          if (time2("j",last_year,last_month,last_date+direction)==1) var label = time2("n/j",last_year,last_month,last_date+direction);
          else var label = time2("j",last_year,last_month,last_date+direction)
          create("div",ele,".:cal_num","-:"+label);
        }
        var month_list = new Array;
        var month_count = [0,0,0,0,0,0,0,0,0,0,0,0];
        for (var i = 0; i<42; i++) {
          var date_string = parent.children[i].dataset.date;
          var month = date_string.substring(0, date_string.indexOf("-"));
          if (month_list.indexOf(month)===-1) month_list.push(month);
          month_count[parseInt(month)-1]++;
        }
        var dom_month = month_list[0];
        for (var i = 1; i<month_list.length; i++) {
          if(month_count[parseInt(month_list[i])-1]>month_count[parseInt(dom_month)-1]) dom_month = month_list[i];
        }
        for (var i = 0; i<42; i++) {
          var element = parent.children[i];
          var month = parseInt(element.dataset.date.substring(0, element.dataset.date.indexOf("-")));
          if (month < parseInt(dom_month)) element.classList.add("cal_prev");
          else element.classList.remove("cal_prev");
          if (month > parseInt(dom_month)) element.classList.add("cal_proc");
          else element.classList.remove("cal_proc");
          if (element.dataset.date==time2("n-j-Y")) element.classList.add("cal_today");
        }

        for (var i = 0; i<42; i++)
          if(!(parent.children[i].classList.contains("cal_proc")||parent.children[i].classList.contains("cal_prev"))) {
            var year_info = parent.children[i].dataset.date.substring(parent.children[i].dataset.date.lastIndexOf("-")+1,parent.children[i].dataset.date.length);
            break;
          }
        invoke("calendar").previousElementSibling.innerHTML = time2("c:month:f:"+(parseInt(dom_month)-1).toString())+" "+year_info;
        var first_date = invoke("cal_date").firstElementChild.firstElementChild;
        if (first_date.innerHTML.substr(-2)!="/1") first_date.innerHTML = first_date.parentNode.dataset.date.substring(0,first_date.parentNode.dataset.date.indexOf("-"))+"/"+first_date.innerHTML;
      }
    </script>
</head>
<body style="height: 100%;">
  <div id="mainbody" style="height: calc(100% - 16px);">
    <fieldset class="info" style="height: 100%;">
      <h2><?php echo date("F Y");?></h2>
      <div id="calendar" style="height: calc(100% - 32px);">
        <section id="cal_header">
          <?php
            $day_list = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
            for ($i = 0; $i < 7; $i++) {?>
            <div class="cal_header"><?php echo $day_list[$i]; ?></div>
          <?php
            }
          ?>
        </section>
        <section id="cal_date" style="height: calc(100% - 25px);">
          <?php
            $day = date('w', strtotime(date('Y-m-1')));
            $prev_total = date("t", mktime(0, 0, 0, date("n")-1, 1, 2017));
            for ($j = $day-1; $j >= 0; $j--) { $date = $prev_total-$j;
              if ($j == $day-1) { ?>
                <div class="cal_prev" data-date=<?php echo "\"".date("n-$date-Y",mktime(0, 0, 0, date("n")-1, 1, 2017))."\"";?>><div class="cal_num"><?php echo date("n/$date",mktime(0, 0, 0, date("n")-1, 1, 2017));?></div></div>
              <?php } else {?>
                <div class="cal_prev" data-date=<?php echo "\"".date("n-$date-Y",mktime(0, 0, 0, date("n")-1, 1, 2017))."\"";?>><div class="cal_num"><?php echo $date;?></div></div>
          <?php }} ?>
          <?php
            $date_total = cal_days_in_month(CAL_GREGORIAN, date("n"), date("Y"));
            for ($i = 1; $i <= $date_total; $i++) {
              if($i == 1) { ?>
                <div data-date=<?php echo "\"".date("n-$i-Y")."\"";?>><div class="cal_num"><?php echo date("n")."/".$i; ?></div></div>
              <?php } else {?>
                <div data-date=<?php echo "\"".date("n-$i-Y")."\"";?>><div class="cal_num"><?php echo $i; ?></div></div>
          <?php }} ?>
          <?php
            for ($k = 1; $k < 42-($date_total+$day-1); $k++) {
              if($k == 1) { ?>
                <div class="cal_proc" data-date=<?php echo "\"".date("n-$k-Y",mktime(0, 0, 0, date("n")+1, 1, 2017))."\"";?>><div class="cal_num"><?php echo date("n/$k", mktime(0, 0, 0, date("n")+1, 1, 2017)); ?></div></div>
              <?php } else {?>
                <div class="cal_proc" data-date=<?php echo "\"".date("n-$k-Y",mktime(0, 0, 0, date("n")+1, 1, 2017))."\"";?>><div class="cal_num"><?php echo $k; ?></div></div>
          <?php }} ?>
        </section>
      </div>
    </fieldset>
  </div>
  <script>
    for (var i = 0; i < 42; i++) {
      var element = invoke("cal_date").children[i];
      if (element.dataset.date==time2("n-j-Y")) element.classList.add("cal_today");
    }

    invoke("cal_date").addEventListener('wheel', function(event) {
      var delta;
      if (event.wheelDelta) delta = event.wheelDelta;
      else delta = -1 * event.deltaY;
      if (delta < 0) CalScroll(1);
      else if (delta > 0) CalScroll(-1);
    })
  </script>
</body>
</html>
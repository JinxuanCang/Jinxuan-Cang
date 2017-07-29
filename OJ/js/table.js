/* 
	J.C.'s Online Software (c) 2017
    PHP-Campus Version 3.3
    Generating tables function library.
    Not every individual .php(extension) file requires this library.
    Programmer: Jinxuan Cang
*/
window["tbl_reg"] = new Array;
function tbl_keys() {
  var color;
  switch(true) {
    case (shift_key && control_key): color = "#a5d6a7"; break;
    case shift_key: color = "#f48fb1"; break;
    case control_key: color = "#b39ddb"; break;
    default: color = null; break;
  }
  for (i = 0; i < window["tbl_reg"].length; i++) {
    var shift_bt = invoke(window["tbl_reg"][i]).getElementsByClassName("tbl_th")[0].lastChild.lastChild.previousElementSibling;
    var control_bt = invoke(window["tbl_reg"][i]).getElementsByClassName("tbl_th")[0].lastChild.lastChild;
    if (window[window["tbl_reg"][i]+"_mode"]=="rows") {
      for (j = 0; j < invoke(window["tbl_reg"][i]).getElementsByClassName("tbl_ct")[0].childElementCount; j++)
        invoke(window["tbl_reg"][i]).getElementsByClassName("tbl_ct")[0].getElementsByClassName("tbl_tr")[j].firstChild.style.backgroundColor = color;
      lock(null,null);
    }
    else {
      for (j = 0; j < invoke(window["tbl_reg"][i]).getElementsByClassName("tbl_ct")[0].childElementCount; j++)
        invoke(window["tbl_reg"][i]).getElementsByClassName("tbl_ct")[0].getElementsByClassName("tbl_tr")[j].firstChild.style.backgroundColor = null;
      lock("lightgray","none");
    }
    if (control_key) control_bt.style.backgroundColor = "#9c27b0";
    else control_bt.style.backgroundColor = null;
    if (shift_key) shift_bt.style.backgroundColor = "#e91e63";
    else shift_bt.style.backgroundColor = null;
  }
  function lock(color,textdecro) {
    shift_bt.style.color = color;
    control_bt.style.color = color;
    shift_bt.style.textDecoration = textdecro;
    control_bt.style.textDecoration = textdecro;
  }
}
function tbl_latch(obj) {
  var tbl_id = obj.parentNode.parentNode.parentNode.parentNode.parentNode.id;
  var key = obj.innerHTML;
  if (window[tbl_id+"_mode"]=="rows") {
    if (key=="[Shift]")
      if (shift_key) shift_key = false;
      else shift_key = true;
    if (key=="[Control]")
      if (control_key) control_key = false;
      else control_key = true;
    tbl_keys();
  }
}
function table(target,head,data,settings) {
  //register
  window["tbl_reg"].push(target);
  window[target+"_hover"] = false;
  var sort_col;
  //default values
  if (typeof settings.smart_table=="undefined") settings.smart_table = false;
  if (typeof settings.line_number_sortable=="undefined") settings.line_number_sortable = false;
  if (typeof settings.line_number=="undefined") {
    settings.line_number = false;
    settings.line_number_sortable = false;
  }
  if (typeof settings.sorted=="undefined") settings.sorted = false;
  if (typeof settings.hover=="undefined") settings.hover = false;
  if (typeof settings.formatted=="undefined") settings.formatted = false;
  if (typeof settings.height=="undefined") settings.height = "200px";
  if (settings.smart_table) sort_col = 1; else sort_col = 0;
  if (settings.line_number)
    if (!settings.line_number_sortable)
      window[target+"_sort"] = [sort_col+1,settings.sorted];
    else window[target+"_sort"] = [sort_col,true];
  else window[target+"_sort"] = [sort_col,settings.sorted];
  if (settings.smart_table) {
    control_key = false;
    shift_key = false;
    invoke(target).setAttribute("onwheel","if(window.event.ctrlKey) event.preventDefault();");
    window.onkeydown = function() {
      switch(window.event.keyCode) {
        case 16: shift_key = true; break;
        case 17: control_key = true; break;
        case 27: tbl_select(null,window["tbl_mouseover"],true); break;
        //default: return false;
      }
      tbl_keys();
    }
    window.onkeyup = function() {
      if (!window.event.ctrlKey) control_key = false;
      if (!window.event.shiftKey) shift_key = false;
      tbl_keys(); 
    }
  }
  function tbl_confirm_actions() {
    return (settings.actions!=undefined);
  }
  var i,j,k = 0;
  var cols = head.length;
  window[target+"_mouse"] = false;
  if (settings.formatted)
    var rows = data.length;
  else var rows = Math.ceil(data.length/cols);
  var width = new Array;
  header_container = create("section", invoke(target), ".:tbl_hct");
  if (head!=""&&head!=undefined) {
    tr = create("div",header_container,".:tbl_tr");
    if (settings.smart_table) {
      tr_checkbox = create("div",tr,".:tbl_td");
      check_obj = create("input",tr_checkbox,"t:checkbox");
      check_obj.setAttribute("oncontextmenu","tbl_select(false,this);return false;");
      check_obj.setAttribute("onclick","tbl_entire_chk(this);");
      tr_checkbox.setAttribute("class","tbl_th");
      tr_checkbox.style.opacity = 0.75;
      tr_checkbox.style.transition = "opacity 1s linear";
      var temp_text = "window[this.parentNode.parentNode.parentNode.parentNode.id+'_mouse']";
      check_obj.setAttribute("onmouseover",temp_text+" = true;");
      check_obj.setAttribute("onmouseout",temp_text+" = false;");
      var temp_text = "if(!window[this.parentNode.parentNode.parentNode.id+'_mouse'])";
      tr_checkbox.setAttribute("oncontextmenu",temp_text+" tbl_control_top(this); return false;");
      var control_ct = create("div",tr_checkbox);
      control_ct.style.cursor = "default";
      tdisappear(control_ct);
      create("span",control_ct,"-:On selecting:").style.marginLeft = 10;
      create("span",control_ct,".:tbl_ctr","o:tbl_control(this);","-:rows");
      create("span",control_ct,"-:/").style.marginRight = -10;
      create("span",control_ct,".:tbl_ctr","o:tbl_control(this);","-:text");
      create("span",control_ct,"-:Hov. indicator:").style.marginLeft = 10;
      create("span",control_ct,".:tbl_ctr","o:tbl_control(this);","-:on");
      create("span",control_ct,"-:/").style.marginRight = -10;
      create("span",control_ct,".:tbl_ctr","o:tbl_control(this);","-:off");
      create("span",control_ct,".:tbl_ctr","o:tbl_latch(this);","-:[Shift]");
      create("span",control_ct,".:tbl_ctr","o:tbl_latch(this);","-:[Control]");
      control_ct.firstChild.nextElementSibling.classList.add("tbl_ctr_act");
      if (settings.hover) control_ct.getElementsByTagName("span")[5].classList.add("tbl_ctr_act");
      else control_ct.getElementsByTagName("span")[7].classList.add("tbl_ctr_act");
    }
    if (settings.line_number) {
      var div = create("div",tr,".:tbl_th","-:Seq. #");
      if (settings.line_number_sortable) {
        div.appendChild(GLB_IMG[11]);
        div.setAttribute("onclick","tbl_sort(this);");
        div.setAttribute("oncontextmenu","tbl_sort(this,true);return false;");
      }
    }
    for(i = 0; i < cols; i++) {
      var th = create("div",tr,".:tbl_th","-:"+head[i]);
      if (settings.sortable && settings.sortable[i]) {
        th.setAttribute("onclick","tbl_sort(this);");
        th.setAttribute("oncontextmenu","tbl_sort(this,true);return false;");
        if (!settings.line_number_sortable && i == 0 && settings.sorted) th.appendChild(GLB_IMG[11].cloneNode());
        else th.appendChild(GLB_IMG[10].cloneNode());
      }
    }
    if (tbl_confirm_actions()) {
     create("div",tr,".:tbl_th","-:Action(s)","r:tbl_control_top(this.parentNode.firstChild); return false;");
    }
  }
  scroll_container = create("section",invoke(target),".:tbl_ct");
  if (settings.smart_table)
    scroll_container.setAttribute("onmouseover","window['tbl_mouseover']=parentNode.id;");
  for(i = 0; i < rows; i++) {
    tr = create("div",scroll_container,".:tbl_tr");
    if (settings.hover) {
      tr.classList.add("tbl_hover");
      window[target+"_hover"] = true;
    }
    if (settings.smart_table) {
      tr_checkbox = create("div",tr,".:tbl_td");
      check_obj = create("input",tr_checkbox,"t:checkbox");
      tr.setAttribute("onclick","tbl_select(nodesequence(this),this)");
      check_obj.setAttribute("onmouseover","window[this.parentNode.parentNode.parentNode.parentNode.id+'_mouse'] = true;");
      check_obj.setAttribute("onmouseout","window[this.parentNode.parentNode.parentNode.parentNode.id+'_mouse'] = false;");
    }
    if (settings.line_number) {
      create("div",tr,".:tbl_td","-:"+(i+1),);
    }
    for(j = 0; j < cols; j++) {
      td = create("div",tr,".:tbl_td");
      td.setAttribute("contenteditable","true");
      if (!settings.formatted) {
        k = i*cols+j;
        if (data[k]!=""&&data[k]!=undefined) td.innerHTML = data[k];
      }
      else if(data[i][j]!=""&&data[i][j]!=undefined) td.innerHTML = data[i][j];
    }
    if (tbl_confirm_actions()) {
      var td = create("div",tr,".:tbl_td","w:fit-content");
      for (var l = 0; l < settings.actions.length; l++) {
        var tbl_action = create("a",td);
        if (settings.action_icon[l]!=undefined&&settings.action_icon[l]!=="")
          tbl_action.appendChild(GLB_IMG[settings.action_icon[l]]);
        tbl_action.innerHTML += settings.actions[l];
        if (l < settings.actions.length-1) tbl_action.style.marginRight = 5;
      }
    }
  }
  var mark = 0;
  if (settings.smart_table) {
    mark++;
    cols++;
    var tbl_tct = create("section",invoke(target),".:tbl_tct");
    var tbl_img = create("img",tbl_tct,"s:../css/img/arrow_ltr.png");
    var chk_count = create("span",tbl_tct);
    chk_count.style.fontWeight = "bold";
    chk_count.style.marginRight = 4;
    chk_count.innerHTML = 0;
    var tbl_txt = create("span",tbl_tct);
    tbl_txt.style.fontWeight = "bold";
    tbl_txt.innerHTML = "Selected";
    if (tbl_confirm_actions()) {
      var tbl_txt = create("span",tbl_tct,"-:With selected:");
      tbl_txt.style.marginLeft = 10;
      tbl_txt.style.marginRight = 10;
      for (var l = 0; l < settings.actions.length; l++) {
        var tbl_action = create("a",tbl_tct);
        if (settings.action_icon[l]!=undefined&&settings.action_icon[l]!=="") {
          tbl_action.appendChild(GLB_IMG[settings.action_icon[l]]);
        }
        tbl_action.style.fontSize = 14;
        tbl_action.innerHTML += settings.actions[l];
        if (l < settings.actions.length-1) tbl_action.style.marginRight = 5;
      }
    }
  }
  window[target+"_height"] = settings.height;
  tbl_render(target);
  invoke(target).style.overflowX = "auto";
  //register
  invoke(target).getElementsByClassName("tbl_ct")[0].addEventListener("wheel",tbl_scroll);
  invoke(target).getElementsByClassName("tbl_ct")[0].setAttribute("onmousedown","return false;");
  window[target+"_value"] = new Array;
  window[target+"_mode"] = "rows";

  tbl_window(target);
}
function tbl_render(target) {
  var flag = true;
  var cols = invoke(target).getElementsByClassName("tbl_tr")[0].childElementCount;
  var tbl_tar = invoke(target).getElementsByClassName("tbl_ct")[0];
  var tbl_ref = invoke(target).getElementsByClassName("tbl_hct")[0];
  for (i = 0; i < tbl_tar.childElementCount; i++) {
    tappear(tbl_tar.getElementsByClassName("tbl_tr")[i],"table-row");
  }
  for (i = 0; i < cols; i++) {
    var heading_wid = invoke(target).getElementsByClassName("tbl_hct")[0].getElementsByClassName("tbl_tr")[0];
    var table_wid = tbl_tar.getElementsByClassName("tbl_tr")[0];
    if (heading_wid.getElementsByClassName("tbl_th")[i].getBoundingClientRect().width<table_wid.getElementsByClassName("tbl_td")[i].getBoundingClientRect().width) {
      heading_wid.getElementsByClassName("tbl_th")[i].style.width = table_wid.getElementsByClassName("tbl_td")[i].getBoundingClientRect().width;
    }
      table_wid.getElementsByClassName("tbl_td")[i].style.width = heading_wid.getElementsByClassName("tbl_th")[i].getBoundingClientRect().width;
  }
  for (i = 0; i < tbl_tar.childElementCount; i++) {
    for (j = 0; j < cols; j++)
      tbl_tar.getElementsByClassName("tbl_tr")[i].getElementsByClassName("tbl_td")[j].style.width = table_wid.getElementsByClassName("tbl_td")[j].style.width;
    tappear(tbl_tar.getElementsByClassName("tbl_tr")[i],"flex");
  }
}
function tbl_window(target) {
  var tbl_tar = invoke(target).getElementsByClassName("tbl_ct")[0];
  var tbl_ref = invoke(target).getElementsByClassName("tbl_hct")[0];
  var extra_ht = tbl_ref.getBoundingClientRect().height;
    if (settings.smart_table) extra_ht += invoke(target).getElementsByClassName("tbl_tct")[0].getBoundingClientRect().height;
    console.log(tbl_ref.getBoundingClientRect().height)
    //console.log(invoke(target).getElementsByClassName("tbl_tct")[0].getBoundingClientRect().height);
    console.log(document.body.getBoundingClientRect().width);
    switch(window[target+"_height"]) {
      case "fit":tbl_tar.style.height = "fit-content";break;
      case "screen":tbl_tar.style.height = window.innerHeight-extra_ht/*-16-8-25*/;break;
      case "screen-fit":tbl_tar.style.height = window.innerHeight-extra_ht-(tbl_ref.offsetTop - tbl_ref.scrollTop + tbl_ref.clientTop); break;
      default: tbl_tar.style.height = settings.height;
    }
}
function tbl_select(value,obj,clear) {
  var tbl_id;
  if (!clear) {
    if (typeof value!='number')
      tbl_id = obj.parentNode.parentNode.parentNode.parentNode.id;
    else
      tbl_id = obj.parentNode.parentNode.id;
    if (window[tbl_id+"_mode"]!="rows") return false;
  }
  else tbl_id = obj;
  console.log(tbl_id);
  var heading = invoke(tbl_id).getElementsByClassName("tbl_hct")[0];
  var others = invoke(tbl_id).getElementsByClassName("tbl_ct")[0];
  var rows_total = others.childElementCount;
  if ((typeof value=='number' && !window[tbl_id+"_mouse"] && !control_key) || clear)
    for (i = 0; i < rows_total; i++)
      others.getElementsByClassName("tbl_tr")[i].classList.remove("tbl_slt");
  if (!clear)
    if (typeof value=='number')
      if (others.getElementsByClassName("tbl_sst")[0]!=null) {
        var first_seq = value,buffer;
        var second_seq = nodesequence(others.getElementsByClassName("tbl_sst")[0]);
        if (value > second_seq) {
          buffer = value;
          first_seq = second_seq;
          second_seq = buffer;
        }
        for (i = first_seq; i <= second_seq; i++)
          others.getElementsByClassName("tbl_tr")[i].classList.add("tbl_slt");
        others.getElementsByClassName("tbl_sst")[0].classList.remove("tbl_sst");
      }
      else if (shift_key) {
        others.getElementsByClassName("tbl_tr")[value].classList.add("tbl_slt");
        others.getElementsByClassName("tbl_tr")[value].classList.add("tbl_sst");
      }
      else
        others.getElementsByClassName("tbl_tr")[value].classList.toggle("tbl_slt");
    else
      if (value==true)
        for (i = 0; i < rows_total; i++)
          others.getElementsByClassName("tbl_tr")[i].classList.add("tbl_slt");
      else
        for (i = 0; i < rows_total; i++)
          others.getElementsByClassName("tbl_tr")[i].classList.toggle("tbl_slt");
  //select_store();
  window[tbl_id+"_value"] = new Array;
  for (i = 0; i < rows_total; i++) {
    if (others.getElementsByClassName("tbl_tr")[i].classList.contains("tbl_slt")) {
      others.getElementsByClassName("tbl_tr")[i].getElementsByTagName("input")[0].checked = true;
      window[tbl_id+"_value"].push(i);
    }
    else
      others.getElementsByClassName("tbl_tr")[i].getElementsByTagName("input")[0].checked = false;
  }
  console.log(window[tbl_id+"_value"])
  invoke(tbl_id).getElementsByClassName("tbl_tct")[0].getElementsByTagName("span")[0].innerHTML = window[tbl_id+"_value"].length;
  var check_temp = heading.getElementsByTagName("input")[0];
  check_temp.indeterminate = false;
  switch(window[tbl_id+"_value"].length) {
    case 0:check_temp.checked = false;break;
    case others.childElementCount:check_temp.checked = true;break;
    default: check_temp.indeterminate = true;break;
  }
}
function tbl_entire_chk(obj) {
  var temp_tar = obj.checked;
  if (temp_tar) tbl_select(true,obj);
  else tbl_select(undefined,obj);
}
function tbl_scroll(event){
  if (window.event.ctrlKey) {
    var delta,dir;
    var times = 0;
    var scroll_dis = 75; //scroll distance
    if (event.wheelDelta) delta = event.wheelDelta;
    else  delta = -1 * event.deltaY;
    if (delta < 0) dir = 1;
    else if (delta > 0) dir = -1;
    invoke(window["tbl_mouseover"]).getElementsByClassName("tbl_ct")[0].scrollTop += dir*scroll_dis;
  }
}
function tbl_control_top(obj) {
  if(obj.style.opacity==0.75) {
    tappear(obj.lastChild,'inline'); obj.style.opacity = 1;
    for (i = 1; i < obj.parentNode.childElementCount; i++)
      tdisappear(obj.parentNode.getElementsByClassName("tbl_th")[i]);
    obj.style.width = "fit-content";
  }
  else {
    tdisappear(obj.lastChild); obj.style.opacity = 0.75;
    for (i = 1; i < obj.parentNode.childElementCount; i++)
      tappear(obj.parentNode.getElementsByClassName("tbl_th")[i],"inline");
    obj.style.width = obj.parentNode.parentNode.nextElementSibling.firstChild.firstChild.style.width;
  }
}
function tbl_control(obj) {
  var tbl_id = obj.parentNode.parentNode.parentNode.parentNode.parentNode.id;
  var heading = invoke(tbl_id).getElementsByClassName("tbl_hct")[0];
  var others = invoke(tbl_id).getElementsByClassName("tbl_ct")[0];
  switch(obj.innerHTML) {
    case "text": window[tbl_id+"_mode"] = "text"; selecting(true); break;
    case "rows": window[tbl_id+"_mode"] = "rows"; selecting(false); break;
    case "on": window[tbl_id+"_hover"] = true; hover(true); break;
    case "off": window[tbl_id+"_hover"] = false; hover(false); break;
    case "[Shift]": alert("shift"); break;
    case "[Control]": alert("control"); break;
  }
  function selecting(argument) {
    obj.parentNode.getElementsByClassName("tbl_ctr_act")[0].classList.remove("tbl_ctr_act");
    obj.classList.add("tbl_ctr_act");
    tbl_keys();
    if (argument) others.removeAttribute("onmousedown");
    else others.setAttribute("onmousedown","return false;");
    heading.firstChild.firstChild.getElementsByTagName("input")[0].disabled = argument;
    for (i = 0; i < others.childElementCount; i++) {
      others.getElementsByClassName("tbl_tr")[i].firstChild.getElementsByTagName("input")[0].disabled = argument;
    }
    if (argument) {
      if (others.getElementsByClassName("tbl_sst")[0]!=null)
        others.getElementsByClassName("tbl_sst")[0].classList.remove("tbl_sst");
      for (i = 0; i < others.childElementCount; i++)
        others.getElementsByClassName("tbl_tr")[i].classList.remove("tbl_slt");
    }
    else {
      for(i = 0; i < window[tbl_id+"_value"].length; i++)
        others.getElementsByClassName("tbl_tr")[window[tbl_id+"_value"][i]].classList.add("tbl_slt");
    }
  }
  function hover(argument) {
    obj.parentNode.getElementsByClassName("tbl_ctr_act")[1].classList.remove("tbl_ctr_act");
    obj.classList.add("tbl_ctr_act");
    if (argument)
      for (i = 0; i < others.childElementCount; i++)
        others.getElementsByClassName("tbl_tr")[i].classList.add("tbl_hover");
    else
      for (i = 0; i < others.childElementCount; i++)
        others.getElementsByClassName("tbl_tr")[i].classList.remove("tbl_hover");
  }
}
function tbl_sort(obj,rightclick) {
  if (typeof rightclick=="undefined") rightclick = false;
  var tbl_row, signal = true, first_row, second_row, flag, buffer, bool;
  var row_seq = nodesequence(obj);
  var tbl_id = obj.parentNode.parentNode.parentNode.id;
  var head_row = invoke(tbl_id).getElementsByClassName("tbl_hct")[0].getElementsByClassName("tbl_th");
  var others = invoke(tbl_id).getElementsByClassName("tbl_ct")[0];
  var prev_row = window[tbl_id+"_sort"][0];
  var prev_sort = window[tbl_id+"_sort"][1];
  head_row[prev_row].lastChild.remove();
  if (row_seq!=prev_row) {
    head_row[prev_row].appendChild(GLB_IMG[10].cloneNode());
    head_row[row_seq].lastChild.remove();
    window[tbl_id+"_sort"][0] = row_seq;
    sort(!rightclick);
  }
  else  sort(!prev_sort);
  function sort(argument) {
    if (argument) {
      head_row[row_seq].appendChild(GLB_IMG[11].cloneNode());
      window[tbl_id+"_sort"][1] = true;
    }
    else {
      head_row[row_seq].appendChild(GLB_IMG[12].cloneNode());
      window[tbl_id+"_sort"][1] = false;
    }
    //bubble sorting
    while (signal) {
      signal = false;
      tbl_row = others.getElementsByClassName("tbl_tr");
      for (i = 0; i < (tbl_row.length - 1); i++) {
        flag = false;
        first_row = tbl_row[i].getElementsByClassName("tbl_td")[row_seq].innerHTML;
        second_row = tbl_row[i + 1].getElementsByClassName("tbl_td")[row_seq].innerHTML;
        if (!argument) {
          buffer = first_row;
          first_row = second_row;
          second_row = buffer;
        }
        first_value = parseInt(first_row); second_value = parseInt(second_row);
        if(isNaN(first_value)) bool = (first_row > second_row);
        else bool = (first_value > second_value);
        if (bool) { flag = 1; break; }
      }
      if (flag) {
        tbl_row[i].parentNode.insertBefore(tbl_row[i + 1], tbl_row[i]); signal = 1;
      }
    }
  }
}
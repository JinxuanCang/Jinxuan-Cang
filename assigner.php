<html>
  <head>
    <?php
      include("../essential_settings.php");
      Initialize();
      LoginRequire();
      js("../js/chart.js");
      css("../css/chart.css");
      js("../js/clock2.js");
      js("../js/table.js");
      css("../css/table.css");
    ?>
    <style>
      input:not([type=checkbox]), select {
        width: 210px;
        height: 25px;
      }
      #new_assign_abbr_sug {
        display: inline;
      }
      /*button {
        position: absolute;
        right: 70px;
        bottom: 15px;
      }*/
      #new_assign_pri>section, #new_assign_cate>section {
        display: grid;
        grid-template-columns: auto 220px 1fr;
        grid-row-gap: 3px;
      }
      #new_assign_pri>section>*:not(input):not(select),input[type=checkbox] {
        line-height: 25px;
      }
      #new_assign_cate>section>*:not(input):not(select),input[type=checkbox] {
        line-height: 25px;
      }
      #new_assign_pri>section>input,select {
        justify-self: center;
      }
      #new_assign_cate>section>input {
        justify-self: center;
      }
      .required::before {
        content: "*";
        color: red;
      }
      .assign_warn {
        line-height: initial;
        font-size: 12px;
        color: red;
        display: inline-block;
      }
      #new_assign_user>section {
        display: grid;
        grid-row-gap: 6px;
      }
      #new_assign_user>section textarea {
        width: 100%;
      }
    </style>
  </head>
  <body>
	<div id="mainbody">
    <fieldset class="info">
      <h2>Interactive Assignment(s) Editor</h2>
    </fieldset>
    <div id="new_assign_ctn">
      <fieldset class="form" id="new_assign_pri">
        <legend>New Assignment</legend>
        <legend style="display: none;">Assignment Information</legend>
        <section>
          <label for="new_assign_name" class="required">Assignment Name</label>
          <input type="text" id="new_assign_name" placeholder="type at least 5 chars.">
          <div><div class="assign_warn"></div></div>

          <label for="new_assign_abbr" class="required">Asgmt. Abbreviation</label>
          <input type="text" id="new_assign_abbr" placeholder="dbl. click for suggestion">
          <div class="input_hint">Abbr. Suggestion: <div id="new_assign_abbr_sug">Invalid</div><div class="assign_warn">Warning.</div></div>

          <label for="new_assign_range_slt">Range of Publishing</label>
          <select id="new_assign_range_slt">
            <option value="all_uesrs" selected>All users</option>
            <option value="all_insts">All instructors</option>
            <option value="all_insts_stus">All instructors, pupils</option>
            <option value="all_stus">Your pupils</option>
            <option value="spec_indiv">Others...</option>
          </select>
          <div class="input_hint">Chosen individual(s) can search for this assignment.</div>

          <label for="new_assign_date_est">Time of Establishing</label>
          <input type="datetime-local" id="new_assign_date_est" value="<?php echo date('Y-m-d\TH:i'); ?>" disabled>
          <div class="input_hint">Irrevocable.</div>

          <label for="new_assign_date_pub">Time of Publishing</label>
          <input type="datetime-local" id="new_assign_date_pub" min="<?php echo date('Y-m-d\TH:i'); ?>" value="<?php echo date('Y-m-d\TH:i'); ?>">
          <div class="input_hint">Leave any blank to publish now.</div>

          <label for="new_assign_date_olt">Time of Obselete</label>
          <input type="datetime-local" id="new_assign_date_olt" value="<?php echo date('Y')+1;echo date('-m-d\TH:i'); ?>">
          <input type="text" id="new_assign_date_olt_never" value="never obselete" style="display: none; width: 210px;" disabled>
          <div class="input_hint">You may choose <u style="cursor: pointer;" id="new_assign_never">never</u>.</div>

          <label for="new_assign_multi">Creat Multi. Asgmt.s</label>
          <input type="checkbox" name="new_assign_multi" id="new_assign_multi">
          <div class="input_hint">This assignment info. will be a template.</div>
        </section>
        <button onclick="New_Asgmt_Pri()" style="position: absolute; bottom: 15px; left: 650px;" disabled>Go</button>
      </fieldset>
      <fieldset id="new_assign_user" style="/*display: none;*/">
        <legend>Publisher Annotations</legend>
        <section>
        <div>
          <label class="required" for="new_assign_intro">Introduction</label>
          <a onclick='window.parent.Dialog("Textarea Editor","textarea_editor");window.parent.Show_Settings();'>[+]options</a>
          <textarea id="new_assign_intro"></textarea>
        </div>
        <div>
          <label class="required" for="new_Assign_adminsug">Administration Suggestion</label>
          <a>[+]options</a>
          <textarea id="new_Assign_adminsug"></textarea>
        </div>
        </section>
      </fieldset>
      <fieldset id="new_assign_cate" style="/*display: none;*/">
        <legend>Assignment's Category</legend>
        <section>
          <label for="new_assign_cate_slt">Assignment Category</label>
          <select id="new_assign_cate_slt">
            <option>Practice</option>
            <option>Quiz</option>
            <option>Test</option>
          </select>
          <div class="input_hint">Please select assignment's category.</div>
          <label style="justify-self: end;" for="new_assign_grad">Graded</label>
          <input type="checkbox" id="new_assign_grad">
          <div class="input_hint">Select this option to receive score after completion.</div>
          <label style="justify-self: end;" for="new_assign_recd">Recorded</label>
          <input type="checkbox" id="new_assign_recd">
          <div class="input_hint">Select this option to record score in the Reports.</div>
          <label style="justify-self: end;" for="new_assign_timelim">Time Limited</label>
          <select id="new_assign_timelim">
            <option value="ntl">No time limit</option>
            <option value=10>10 min.</option>
            <option value=15>15 min.</option>
            <option value=20>20 min.</option>
            <option value=30>30 min.</option>
            <option value="set">Set</option>
          </select>
          <div class="input_hint"><input type="number" style="width: 100px;" min="1"> min.</div>
        </section>
      </fieldset>
    </div>
    <div id="edit_assign_ctn">
      <fieldset class="form">
        <legend>Modify Assignment</legend>
          <label for="edit_assign_name">Assignment Name/Abbr.</label></td>
          <input type="text" name="edit_assign_name" id="edit_assign_name" placeholder="press enter to search">
        <button>Go</button>
      </fieldset>
    </div>
    <div id="textarea_editor" style="display: none;">
      <style>
        #text_edit_topmenu {
          margin: 4px;
        }
        #text_edit_area>textarea {
          width: 100%;
        }
      </style>
      <section id="text_edit_topmenu">
        <button>Browse Saved</button>
        <button>Browse System Library</button>
        <button>Save</button>
      </section>
      <section id="text_edit_select_table" style="width: 100%;"></section>
      <script>
        var target = "text_edit_select_table";
        var head = ["Content","Create Time"];
        var data = ["How are you?", "8-24-2017"];
        var settings = {
          formatted:false,//boolean
          smart_table:true,//boolean
          hover: true,
          sorted: 1,
          height:"fit",//"static ##" or "fit"
          line_number:false,//boolean
          actions:[],//array
          action_icon:[],//array,icons,src only
          action_link:[],
          scroll_bar_width:12,
          sortable:[true,true]
        };
        table(target,head,data,settings);
      </script>
      <section id="text_edit_area">
        <textarea></textarea>
      </section>
    </div>
	</div>
  </body>
  <script type="text/javascript" src="../js/assigner.js"></script>
</html>
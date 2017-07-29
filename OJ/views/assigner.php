<html>
  <head>
    <?php include("../essential_settings.php");?>
    <?php include("../module/style.php");?>
    <link rel="stylesheet" type="text/css" href="../css/popmessage.css">
    <script type="text/javascript" src="../js/popmessage.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/general.css">
    <link rel="stylesheet" type="text/css" href="../css/chart.css">
    <script type="text/javascript" src="../js/essential.js"></script>
    <script type="text/javascript" src="../js/chart.js"></script>
    <style>
      input:not([type=checkbox]), select {
        width: 200px;
        height: 25px;
      }
      input[type=datetime-local] {
        width: 210px;
      }
      #new_assign_abbr_sug {
        display: inline;
      }
      .input_hint {
        font-style: italic;
        color: dimgrey;
        font-size: 12px;
      }
      button {
        position: absolute;
        right: 70px;
        bottom: 15px;
      }
    </style>
  </head>
  <body>
	<div id="popmessage">None.</div>
	<div id="mainbody">
    <fieldset class="info">
      <h2>Interactive Assignment(s) Editor</h2>
    </fieldset>
    <div id="new_assign_ctn">
      <fieldset class="form">
      <legend><img src="../css/img/b_newtbl.png"> New Assignment</legend>
        <table>
          <tr>
            <td><label for="new_assign_name">Assignment Name</label></td>
            <td><input type="text" name="new_assign_name" id="new_assign_name" placeholder="type at least 5 chars."></td>
            <td></td>

            <td><label for="new_assign_date_est">Time of Establishing</label></td>
            <td><input type="datetime-local" name="new_assign_date_est" value="<?php echo date('Y-m-d\TH:i'); ?>" disabled></td>
            <td class="input_hint">Irrevocable.</td>
          </tr>
          <tr>
            <td><label for="new_assign_abbr">Asgmt. Abbreviation</label></td>
            <td><input type="text" name="new_assign_abbr" id="new_assign_abbr" placeholder="dbl. click for suggestion"></td>
            <td class="input_hint">Abbr. Suggestion: <div id="new_assign_abbr_sug">Invalid</div></td>

            <td><label for="new_assign_date_pub">Time of Publishing</label></td>
            <td><input type="datetime-local" name="new_assign_date_pub" value="<?php echo date('Y-m-d\TH:i'); ?>"></td>
            <td class="input_hint">Leave any blank to publish now.</td>
          </tr>
          <tr>
            <td><label for="new_assign_date_slt">Range of Publishing</label></td>
            <td>
              <select id="new_assign_range_slt">
                <option value="all_uesrs" selected>All users</option>
                <option value="all_insts">All instructors</option>
                <option value="all_insts_stus">All instructors, pupils</option>
                <option value="all_stus">Your pupils</option>
                <option value="spec_class">Specify classes...</option>
                <option value="spec_indiv">Specify individuals...</option>
              </select>
            </td>
            <td class="input_hint">Chosed individual(s) can search for this assignment.</td>

            <td><label for="new_assign_date_olt">Time of Obselete</label></td>
            <td><input type="datetime-local" name="new_assign_date_olt" value="<?php echo date('Y')+1;echo date('-m-d\TH:i'); ?>"></td>
            <td class="input_hint">Leave any blank for never.</td>
          </tr>
          <tr>
            <td><label for="new_assign_multi">Creat Multi. Asgmt.s</label></td>
            <td><input type="checkbox" name="new_assign_multi" id="new_assign_multi"></td>
            <td class="input_hint">This assignment info. will be a template.</td>
          </tr>
        </table>
        <button>Go</button>
      </fieldset>
    </div>
    <div id="edit_assign_ctn">
      <fieldset class="form">
        <legend><img src="../css/img/b_edit.png"> Modify Assignment</legend>
        <table>
          <tr>
            <td><label for="edit_assign_name">Assignment Name/Abbr.</label></td>
            <td><input type="text" name="edit_assign_name" id="edit_assign_name" placeholder="press enter to search"></td>
          </tr>
        </table>
        <button>Go</button>
      </fieldset>
    </div>
	</div>
  </body>
  <script type="text/javascript" src="../js/assigner.js"></script>
</html>
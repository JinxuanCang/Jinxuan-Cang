<?php
        include("../essential_settings.php");
        $path = "../users/";
        //$_GET["sort_user"] = "id_asc";
        $user_ID = scandir($path,1);
        switch ($_GET["sort_user"]) {
          case 'id_asc':
            asort($user_ID);
            $user_row = $user_ID;
            break;
          case 'id_dec':
            arsort($user_ID);
            $user_row = $user_ID;
            break;
          case 'username_asc':
            
            foreach ($user_ID as $key => $value) {
              if ($value=="." || $value==".." || $value=="name_convert") {
                continue;
              }
              $temp = file($path.$value."/info");
              $user_row[trim($value)] = trim($temp[0]);
            }
            natsort($user_row);
            asort($user_row);
            break;
          case 'username_dec':
            foreach ($user_ID as $key => $value) {
              if ($value=="." || $value==".." || $value=="name_convert") {
                continue;
              }
              $temp = file($path.$value."/info");
              $user_row[trim($value)] = trim($temp[0]);
            }
            arsort($user_row);
            break;
          case 'regtime_asc':
            foreach ($user_ID as $key => $value) {
              if ($value=="." || $value==".." || $value=="name_convert") {
                continue;
              }
              $temp = file($path.$value."/info");
              $user_row[trim($value)] = trim($temp[5]);
            }
            asort($user_row);
            break;
          case 'regtime_dec':
            foreach ($user_ID as $key => $value) {
              if ($value=="." || $value==".." || $value=="name_convert") {
                continue;
              }
              $temp = file($path.$value."/info");
              $user_row[trim($value)] = trim($temp[5]);
            }
            arsort($user_row);
            break;
          default:
            # code...
            break;
        } ?>
        <tr id="table_stat">
          <th id="stat_ck"></th>
          <th id="stat_id">Stat.</th>
          <th id="stat_un"><?php echo count($user_ID)-3;?></th>
          <th id="stat_uc">total users.</th>
          <th id="stat_ea" style="text-align: right;">For detail,</th>
          <th id="stat_rt">click "Statistics".</th>
          <th id="stat_ri"></th>
          <th id="stat_ac"></th>
        </tr>
        <?php
        foreach ($user_row as $i => $value) { 
          if ($user_row[$i]=="." || $user_row[$i]==".." || $user_row[$i]=="name_convert") {
            continue;
          }
          
          if ($_GET["sort_user"]=='id_asc'||$_GET["sort_user"]=='id_dec') {
            $user_system_id = $user_row[$i];
          }
          else {
            $user_system_id = $i;
          }
          $freezing = "";
          $disabled = "";
          $user_info = file($path.$user_system_id."/info");
          if(file_exists($path.$user_system_id."/freezing")):
            $freezing = "class='freezing_act'";
          endif;
          if(trim($user_info[0])=="Root"):
            $disabled = "disabled";
          endif;
          echo "<tr id='$user_system_id' $freezing>";
          echo "<td><input id='$user_system_id"."checkbox"."' type='checkbox' onchange='Checkbox_Selectrow($user_system_id)' $disabled></td>";
          echo "<td onclick='Switch_Selectrow($user_system_id)'>$user_system_id</td>";
          
          
          $user_screenname = trim(str_replace("_", " ", $user_info[0]));
          echo "<td onclick='Switch_Selectrow($user_system_id)'>$user_screenname</td>";
          for ($j=0; $j < count($user_info); $j++) { 
            $user_info[$j] = trim($user_info[$j]);
          }
          $date = date("m/d/Y H:i:s",$user_info[5]);?>
          <td onclick='Switch_Selectrow(<?php echo $user_system_id;?>)'><?php echo $user_info[1];?></td>
          <td onclick='Switch_Selectrow(<?php echo $user_system_id;?>)'><?php echo $user_info[3];?></td>
          <td onclick='Switch_Selectrow(<?php echo $user_system_id;?>)'><?php echo $date;?></td>
          <td onclick='Switch_Selectrow(<?php echo $user_system_id;?>)'><?php echo $user_info[4];?></td>
          <td>
            <a onclick='Loading();' href='databases.php?file_name=&action=edit'><img src='../css/img/s_rights.png'>Info</a>
            <div class="tooltip"><img src='../css/img/b_tblops.png'>More<span class="user_table tooltiptext">
            <a href="#"><img src="../css/img/b_usredit.png">Edit</a>
            <a href="#"><img src="../css/img/s_passwd.png">Reset password</a>
            <?php if(!file_exists($path.$user_system_id."/freezing")) {?>
            <a href="javascript:Freeze_User(<?php echo $user_system_id.",'".$user_screenname."'";?>);"><img src="../css/img/b_usrdrop.png">Freeze</a>
            <?php }else {?>
            <a href="javascript:Restore_User(<?php echo $user_system_id;?>);"><img src="../css/img/s_reload.png">Restore</a>
            <?php }?>
            <a href="javascript:Delete_User(<?php echo $user_system_id;?>);"><img src="../css/img/b_drop.png">Delete</a>
            </span></div>
          </td>
          </tr>
          <?php
        }
      ?>
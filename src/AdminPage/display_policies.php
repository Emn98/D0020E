<?php

function display_in_all_policies_table($result){
    $temp = 1;

    if(mysqli_num_rows($result) > 0){
      while ($row = $result->fetch_assoc()) {
          if($temp == 1){
              echo '<tr class="table_row_odd">';
              echo '<td onclick="test()" style="cursor: pointer;">'.$row["policy_name"].'</td>';
              echo '<td>'.$row["created_at"].'</td>';
  ?>
              <td><input type="button" value="Load" class="edit_btn" onclick="load_policy('<?php echo $row['policy_name'] ?>')"></td>
              <td><input type="button" value="Edit" class="edit_btn" onclick="edit_policy('<?php echo $row['policy_name'] ?>')"></td>
              <td><input type="button" value="Delete" class="delete_btn" onclick="delete_policy('<?php echo $row['policy_name'] ?>')"></td>
  <?php
              $temp = 0;
          }else{
              echo '<tr class="table_row_even">';
              echo '<td onclick="test()" style="cursor: pointer;">'.$row["policy_name"].'</td>';
              echo '<td>'.$row["created_at"].'</td>';
  ?>
              <td><input type="button" value="Load" class="edit_btn" onclick="load_policy('<?php echo $row['policy_name'] ?>')"></td>
              <td><input type="button" value="Edit" class="edit_btn" onclick="edit_policy('<?php echo $row['policy_name'] ?>')"></td>
              <td><input type="button" value="Delete" class="delete_btn" onclick="delete_policy('<?php echo $row['policy_name'] ?>')"></td>
  <?php
              $temp = 1; 
          } 
      }
    }else{
      echo "<h1 style='margin-left:18rem;margin-top:0.5rem;margin-bottom:0.5rem;';>No policies exists</h1>";
    }    
}


function diplay_in_loaded_policies_table($result){
    $temp = 1;

    if(mysqli_num_rows($result) > 0){
  
      while ($row = $result->fetch_assoc()) {
          if($temp == 1){
              echo '<tr class="table_row_odd">';
              echo '<td onclick="test()" style="cursor: pointer;">'.$row["policy_name"].'</td>';
              echo '<td>'.$row["loaded_at"].'</td>';
  ?>
              <td><input type="button" value="Set" class="edit_btn"    onclick="set_policy('<?php echo $row['policy_name'] ?>')"></td>
              <td><input type="button" value="Unload" class="edit_btn" onclick="unload_policy('<?php echo $row['policy_name'] ?>')" style="width: 50px;"></td>
              <td><input type="button" value="Edit" class="edit_btn"   onclick="edit_policy('<?php echo $row['policy_name'] ?>')"></td>
  <?php
              $temp = 0; 
          }else{
              echo '<tr class="table_row_even">';
              echo '<td onclick="test()" style="cursor: pointer;">'.$row["policy_name"].'</td>';
              echo '<td>'.$row["loaded_at"].'</td>';
  ?>
              <td><input type="button" value="Set" class="edit_btn"    onclick="set_policy('<?php echo $row['policy_name'] ?>')"></td>
              <td><input type="button" value="Unload" class="edit_btn" onclick="unload_policy('<?php echo $row['policy_name'] ?>')" style="width: 50px;"></td>
              <td><input type="button" value="Edit" class="edit_btn"   onclick="edit_policy('<?php echo $row['policy_name'] ?>')"></td>
  <?php
              $temp = 1; 
          }
      }
    }else{
      echo "<h1 style='margin-left:18rem;margin-top:0.3rem;margin-bottom:0.5rem;';>There are no loaded policies</h1>";
    }    

}

?>
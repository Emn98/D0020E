<!-- This file will dynamically build/print the "show all policies table" and 
     "show loaded policies table" on the admin main page -->  
<?php

function display_all_policies_head()
{
  echo "<tr>";
  echo "<th>Policy name</th>";
  echo "<th>Created</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";
}

function display_all_policies_body($result)
{
  $temp = 1;

  if (mysqli_num_rows($result) > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($temp == 1) {
        echo '<tr class="table_row_odd">';
?>
        <td id="policy_name_td" onclick="show_policy_info('<?php echo $row['policy_name'] ?>')"><?php echo $row['policy_name'] ?></td>
        <?php
        echo '<td>' . $row["created_at"] . '</td>';
        ?>
        <td><input type="button" value="Load" class="table_btn" onclick="load_policy('<?php echo $row['policy_name'] ?>', 'True')"></td>
        <td><input type="button" value="Edit" class="table_btn" onclick="edit_policy('<?php echo $row['policy_name'] ?>')"></td>
        <td><input type="button" value="Delete" class="delete_btn" onclick="check_delete_policy('<?php echo $row['policy_name'] ?>')"></td>
      <?php
        $temp = 0;
      } else {
        echo '<tr class="table_row_even">';
      ?>
        <td id="policy_name_td" onclick="show_policy_info('<?php echo $row['policy_name'] ?>')"><?php echo $row['policy_name'] ?></td>
        <?php
        echo '<td>' . $row["created_at"] . '</td>';
        ?>
        <td><input type="button" value="Load" class="table_btn" onclick="load_policy('<?php echo $row['policy_name'] ?>', 'True')"></td>
        <td><input type="button" value="Edit" class="table_btn" onclick="edit_policy('<?php echo $row['policy_name'] ?>')"></td>
        <td><input type="button" value="Delete" class="delete_btn" onclick="check_delete_policy('<?php echo $row['policy_name'] ?>')"></td>
      <?php
        $temp = 1;
      }
    }
  } else {
    //If no policies exists, print it to the user. 
    echo "<td><h1 style='margin-left:19rem;margin-top:12rem;margin-bottom:0.5rem;';>No policies exists</h1></td>";
  }
}

function display_loaded_policies_head()
{
  echo "<tr>";
  echo "<th>Policy name</th>";
  echo "<th>Loaded</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";
}



function diplay_loaded_policies_body($result)
{
  $temp = 1;

  if (mysqli_num_rows($result) > 0) {

    while ($row = $result->fetch_assoc()) {
      if ($temp == 1) {
        echo '<tr class="table_row_odd">';
      ?>
        <td id="policy_name_td" onclick="show_policy_info('<?php echo $row['policy_name'] ?>')"><?php echo $row['policy_name'] ?></td>
        <?php
        echo '<td>' . $row["loaded_at"] . '</td>>';
        ?>
        <td><input type="button" value="Set" class="set_btn" onclick="set_policy('<?php echo $row['policy_name'] ?>')"></td>
        <td><input type="button" value="Unload" class="table_btn" onclick="unload_policy('<?php echo $row['policy_name'] ?>')" style="width: 50px;"></td>
        <td><input type="button" value="Edit" class="table_btn" onclick="edit_loaded_policy('<?php echo $row['policy_name'] ?>')"></td>
      <?php
        $temp = 0;
      } else {
        echo '<tr class="table_row_even">';
      ?>
        <td id="policy_name_td" onclick="show_policy_info('<?php echo $row['policy_name'] ?>')"><?php echo $row['policy_name'] ?></td>
        <?php
        echo '<td>' . $row["loaded_at"] . '</td>';
        ?>
        <td><input type="button" value="Set" class="set_btn" onclick="set_policy('<?php echo $row['policy_name'] ?>')"></td>
        <td><input type="button" value="Unload" class="table_btn" onclick="unload_policy('<?php echo $row['policy_name'] ?>')" style="width: 50px;"></td>
        <td><input type="button" value="Edit" class="table_btn" onclick="edit_loaded_policy('<?php echo $row['policy_name'] ?>')"></td>
<?php
        $temp = 1;
      }
    }
  } else {  
    //If no loaded policies exists, print it to the user. 
    echo "<td><h1 style='margin-left:15rem;margin-top:13rem;margin-bottom:0.5rem;';>There are no loaded policies</h1></td>";
  }
}

?>
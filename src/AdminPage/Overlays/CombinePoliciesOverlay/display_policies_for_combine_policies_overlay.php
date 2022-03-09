<?php
    
    function display_all_policies_with_cond($result){
        $temp = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
              if ($temp == 1) {
                echo '<tr class="table_row_cond_odd_enable">';
                ?>
                  <td><input name="policy_con_checkbox" type="checkbox" onclick="check_con_policy(this, '<?php echo $row['policy_name'] ?>')"/></td>
                <?php
                echo '<td>' . $row["policy_name"] . '</td>';
                echo '<td></td>';
                $temp = 0;
              } else {
                echo '<tr class="table_row_cond_even_enable">';
                ?>
                  <td><input name="policy_con_checkbox" type="checkbox" onclick="check_con_policy(this, '<?php echo $row['policy_name'] ?>')"/></td>
                <?php
                echo '<td>' . $row["policy_name"] . '</td>';
                echo '<td></td>';
                $temp = 1;
              }
            }
        } else {
            echo "<td><h1 style='margin-left:19rem;margin-top:12rem;margin-bottom:0.5rem;';>No policies exists</h1></td>";
        }
    }
    
    

    function display_all_policies_without_cond($result){
        $temp = 1;
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
              if ($temp == 1) {
                echo '<tr class="table_row_odd_enable">';
                ?>
                  <td><input name="policy_non_con_checkbox" type="checkbox" onclick="check_non_con_policy(this, '<?php echo $row['policy_name'] ?>')"/></td>
                <?php
                echo '<td>' . $row["policy_name"] . '</td>';
                echo '<td></td>';
                $temp = 0;
              } else {
                echo '<tr class="table_row_even_enable">';
                ?>
                  <td><input name="policy_non_con_checkbox" type="checkbox" onclick="check_non_con_policy(this, '<?php echo $row['policy_name'] ?>')"/></td>
                <?php
                echo '<td>' . $row["policy_name"] . '</td>';
                echo '<td></td>';
                $temp = 1;
              }
            }
        } else {
            echo "<td><h1 style='margin-left:19rem;margin-top:12rem;margin-bottom:0.5rem;';>No policies exists</h1></td>";
        }
    }



?>
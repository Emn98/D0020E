<?php

function display_users_head(){
  echo "<tr>";
  echo "<th>User_id</th>";
  echo "<th>Full name</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>";  

}


function display_users_body($result){
    $temp = 1;

    if(mysqli_num_rows($result) > 0){
      while ($row = $result->fetch_assoc()) {
          if($temp == 1){
              echo '<tr class="table_row_odd">';
    ?>
              <td><?php echo $row['user_id']?></td>
    <?php              
              echo '<td>'.$row["full_name"].'</td>';
    ?>
              <td><input type="button" value="Edit" class="edit_btn" onclick="edit_user('<?php echo $row['user_id'] ?>')"></td>
              <td><input type="button" value="Delete" class="delete_btn" onclick="delete_user('<?php echo $row['user_id'] ?>')"></td>
    <?php
              $temp = 0;
          }else{
              echo '<tr class="table_row_even">';
    ?>
              <td><?php echo $row['user_id']?></td>
    <?php          
              echo '<td>'.$row["full_name"].'</td>';
    ?>
              <td><input type="button" value="Edit" class="edit_btn" onclick="edit_user('<?php echo $row['user_id'] ?>')"></td>
              <td><input type="button" value="Delete" class="delete_btn" onclick="delete_user('<?php echo $row['user_id'] ?>')"></td>
    <?php
              $temp = 1; 
          } 
      }
    }else{
      echo "<td><h1 style='margin-left:16.5rem;margin-top:17rem;margin-bottom:0.5rem;';>No users exists</h1></td>";
    }    
}


function display_objects_head(){
  echo "<tr>";
  echo "<th>Object_id</th>";
  echo "<th>Full name</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>"; 

}

function display_objects_body($result){
  $temp = 1;

  if(mysqli_num_rows($result) > 0){
    while ($row = $result->fetch_assoc()) {
        if($temp == 1){
            echo '<tr class="table_row_odd">';
  ?>
            <td><?php echo $row['object_id']?></td>
  <?php              
            echo '<td>'.$row["full_name"].'</td>';
  ?>
            <td><input type="button" value="Edit" class="edit_btn" onclick="edit_object('<?php echo $row['object_id'] ?>')"></td>
            <td><input type="button" value="Delete" class="delete_btn" onclick="delete_object('<?php echo $row['object_id'] ?>')"></td>
  <?php
            $temp = 0;
        }else{
            echo '<tr class="table_row_even">';
  ?>
            <td><?php echo $row['object_id']?></td>
  <?php          
            echo '<td>'.$row["full_name"].'</td>';
  ?>
            <td><input type="button" value="Edit" class="edit_btn" onclick="edit_object('<?php echo $row['object_id'] ?>')"></td>
            <td><input type="button" value="Delete" class="delete_btn" onclick="delete_object('<?php echo $row['object_id'] ?>')"></td>
  <?php
            $temp = 1; 
        } 
    }
  }else{
    echo "<td><h1 style='margin-left:16.5rem;margin-top:17rem;margin-bottom:0.5rem;';>No objects exists</h1></td>";
  }    
}


function display_operation_head(){
  echo "<tr>";
  echo "<th>operation_id</th>";
  echo "<th>Operation name</th>";
  echo "<th>Operation second field</th>";
  echo "<th></th>";
  echo "<th></th>";
  echo "</tr>"; 
  
}

function display_operation_body($result){
  $temp = 1;

  if(mysqli_num_rows($result) > 0){
    while ($row = $result->fetch_assoc()) {
        if($temp == 1){
            echo '<tr class="table_row_odd">';
  ?>
            <td><?php echo $row['operation_id']?></td>
  <?php              
            echo '<td>'.$row["operation_name"].'</td>';
            echo '<td>'.$row["operation_2_field"].'</td>';
  ?>
            <td><input type="button" value="Edit" class="edit_btn" onclick="edit_operations('<?php echo $row['operation_id'] ?>')"></td>
            <td><input type="button" value="Delete" class="delete_btn" onclick="delete_operation('<?php echo $row['operation_id'] ?>')"></td>
  <?php
            $temp = 0;
        }else{
            echo '<tr class="table_row_even">';
  ?>
            <td><?php echo $row['operation_id']?></td>
  <?php          
            echo '<td>'.$row["operation_name"].'</td>';
            echo '<td>'.$row["operation_2_field"].'</td>';
  ?>
            <td><input type="button" value="Edit" class="edit_btn" onclick="edit_operation('<?php echo $row['operation_id']?>')"></td>
            <td><input type="button" value="Delete" class="delete_btn" onclick="delete_operation('<?php echo $row['operation_id']?>')"></td>
  <?php
            $temp = 1; 
        } 
    }
  }else{
    echo "<td><h1 style='margin-left:20rem;margin-top:13rem;margin-bottom:0.5rem;'>No operations exist</h1></td>";
  }      
}

?>
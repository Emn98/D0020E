<?php
  require_once "../AdminPage/ShowActivePolicy/get_active_policy_request.php";
  $servername = "localhost";
  $username = "admin";
  $password = "Offbrand123$";
  $dbname = "website";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Styles/admin_main_page.css">
  <title>NGAC - Admin Fronted</title>
  <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
  <script src="/AdminPage/Scripts/unload_active_policy.js"></script>
</head>
<body>
  <div class="container">
    <header>
      <h2 onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
    </header>
    <main>
      <div class="current_loaded_policy">
        <h2>Current active policy</h2>
        <h1 class="current_active_policy_answer"></h1>
          <input class="unload_btn" id="unload_btn" type="button" value="Unload" onclick="unload_active_policy('test_book_policy')" hidden>
      </div>
      <div class="display_policy_files_container">
        <div class="search_bar_container">
            <form class="search_bar_form" method="POST" action="">
              <input class="search_bar_inp" type="text" name="user_name" placeholder="Search..." autocomplete="OFF">
              <button type="submit">Search</button>
            </form>
           <h2>Policies</h2>
           <form class="add_policy_form" method="" action="AddPolicy/add_policy_form.php">
            <button class="create_new_policy_btn">Create New Policy</button>
           </form>
           <button class="show_all_policies_btn">Show all policies</button>
           <button class="show_loaded_policies_btn">Show loaded policies</button>
          </div>
        <div class="inner_display_policy_files_container">
          <table>
              <thead id="t_head">
                <tr>
                  <th>Policy Name</th>
                  <th>Created</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
             </thead>
             <tbody id="t_body">
               <?php 
                  $query = $conn->prepare("SELECT policy_name, created_at FROM Policies");
                  $query->execute();
                  $result = $query->get_result();
                  $query->fetch();
                  $query->close();
                  
                  $temp = 1;
                  
                  while ($row = $result->fetch_assoc()) {
                    if($temp == 1){
                      echo '<tr class="table_row_odd">';
                      echo '<td onclick="test()" style="cursor: pointer;">'.$row["policy_name"].'</td>';
                      echo '<td>'.$row["created_at"].'</td>';
                    ?>
                      <td><input type="button" value="Load" class="edit_btn"></td>
                      <td><input type="button" value="Edit" class="edit_btn"></td>
                      <td><input type="button" value="Delete" class="delete_btn"></td>
                    <?php
                    $temp = 0; 
                    }else{
                      echo '<tr class="table_row_even">';
                      echo '<td onclick="test()" style="cursor: pointer;">'.$row["policy_name"].'</td>';
                      echo '<td>'.$row["created_at"].'</td>';
                    ?>
                      <td><input type="button" value="Load" class="edit_btn"></td>
                      <td><input type="button" value="Edit" class="edit_btn"></td>
                      <td><input type="button" value="Delete" class="delete_btn"></td>
                    <?php
                    $temp = 1; 
                    }
                  }
               ?>
             </tbody>
            </table>
        </div>
      </div>
    </main>
  </div>
</body>
<script>
  function test(){
    alert("More info sim");
  }
</script>
</html>

<?php
  require_once "../AdminPage/ShowActivePolicy/get_active_policy_request.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Styles/admin_main_page.css">
  <title>NGAC - Admin Fronted</title>
  <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
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
        <form class="unload_form">
          <input class="unload_btn" id="unload_btn" type="button" value="Unload" hidden>
        </form>
      </div>
      <div class="display_policy_files_container">
        <div class="search_bar_container">
            <form class="search_bar_form" method="POST" action="">
              <input class="search_bar_inp" type="text" name="user_name" placeholder="Search..." autocomplete="OFF">
              <button type="submit"><i class="fa fa-search"></i>Search</button>
            </form>
           <h2>Policies</h2>
           <form class="add_policy_form" method="" action="AddPolicy/add_policy_form.php">
            <button class="create_new_policy_btn">Create New Policy</button>
           </form>
          </div>
        <div class="inner_display_policy_files_container">
          <table>
              <thead>
                <tr>
                  <th>Policy_id</th>
                  <th>Policy Name</th>
                  <th>In Policy File</th>
                  <th>Created</th>
                  <th></th>
                  <th></th>
                </tr>
             </thead>
             <tbody>
               <tr class="table_row_odd">
                 <td onclick="test()" style="cursor: pointer;">0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
               <tr class="table_row_even">
                 <td>1</td>
                 <td>temp 2</td>
                 <td>Temp 2</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td> 
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td> 
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
               <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td> 
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
               <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td> 
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
               <tr class="table_row_odd">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td> 
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>
                <tr class="table_row_even">
                 <td>0</td>
                 <td>temp 1</td>
                 <td>Temp</td>
                 <td>01-02-2222</td>
                 <td><input type="button" value="Edit" class="edit_btn"></td>
                 <td><input type="button" value="Delete" class="delete_btn"></td>
               </tr>               
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

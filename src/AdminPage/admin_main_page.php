<?php
  include("../AdminPage/Overlays/policy_more_info_overlay.php");
  include("../AdminPage/Overlays/admin_management_overlay.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/AdminPage/Styles/admin_main_page.css">
    <title>NGAC - Admin Fronted</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
    <script src="/AdminPage/Scripts/load_policy.js"></script>
    <script src="/AdminPage/Scripts/unload_policy.js"></script>
    <script src="/AdminPage/Scripts/retrive_policies_from_database.js"></script>
    <script src="/AdminPage/Scripts/get_active_policy.js"></script>
    <script src="/AdminPage/Scripts/set_policy.js"></script>
    <script src="/AdminPage/Scripts/search.js"></script>
    <script src="/AdminPage/Scripts/checkbox_logic.js"></script>
    <script src="/AdminPage/Scripts/delete_policy.js"></script>
    <script>
      $(document).ready(function(){
        
        //Retrives the active policy from NGAC server upon page load. 
        get_active_policy();

        get_all_policies();
        
        $(".show_loaded_policies_btn").click(function(){
          get_loaded_policies();
        });
      
        $(".show_all_policies_btn").click(function(){
          get_all_policies();      
        });

        $('#policy_name_check').click(function() {
          check_policy_name();
        });
                   
        $('#user_check').click(function() {
          check_user();
        });
                 
        $('#object_check').click(function() {
          check_object();
        });
                
      });
    </script>   
  </head>
<body>
  <div class="container">
    <header>
      <h2 onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
      <div class="server_status">
        <h3 style="display:inline;float:left">NGAC Server Status: </h3>
        <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: -3.8rem;"></h3>
      </div>
    </header>
    <main>  
      <div class="current_loaded_policy">
        <h2>Current active policy</h2>
        <h1 class="current_active_policy_answer"></h1>
      </div>
      <div class="display_policy_files_container">
        <div class="search_bar_container">
            <form class="search_bar_form" method="POST" action="">
              <input class="search_bar_inp" type="text" id="myInput" name="user_name" placeholder="Search..." autocomplete="OFF">
                <label for="policy_name_check" class="form_label_policy_name">Policy name:</label>
              <input type="checkbox" class="policy_name_check" id="policy_name_check" checked>
                <label for="user_check" class="form_label_user">User:</label>
              <input type="checkbox" class="user_check" id="user_check">
                <label for="object_check" class="form_label_object">Object:</label>
              <input type="checkbox" class="object_check" id="object_check">
              <p class="search_p">Search policy files with:</p>
              <button id="submit" type="submit">Search</button>
            </form>
            <h2>Policies</h2>
            <form class="add_policy_form" method="" action="AddPolicy/select_create_method.php">
              <button class="create_new_policy_btn">Create New Policy</button>
            </form>
            <button class="show_all_policies_btn" id="show_all_policies_btn">Show All Policies</button>
            <button class="show_loaded_policies_btn" id="show_loaded_policies_btn">Show Loaded Policies</button>
          </div>
        <div class="inner_display_policy_files_container">
          <table id="table_all_policies">
              <thead id="t_head_main_page">
             </thead>
             <tbody id="t_body_main_page">
             </tbody>
          </table>         
        </div>
        <button id="admin_man_overlay_btn" onclick="admin_man_overlay()">Show Admin Overlay</button>    
      </div>
    </main>
  </div>
</body>
</html>
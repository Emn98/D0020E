<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Styles/admin_main_page.css">
  <title>NGAC - Admin Fronted</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
  <script src="/AdminPage/Scripts/load_policy.js"></script>
  <script src="/AdminPage/Scripts/unload_policy.js"></script>
  <script src="/AdminPage/Scripts/retrive_policies_from_database.js"></script>
  <script src="/AdminPage/Scripts/get_active_policy.js"></script>
  <script src="/AdminPage/Scripts/set_policy.js"></script>
  <script>
    $(document).ready(function(){
      get_active_policy();
    });
    
    $(document).ready(function(){
      $(".show_loaded_policies_btn").click(function(){
        get_loaded_policies();
      });
    });
  </script>   
</head>
<body>
  <div class="container">
    <header>
      <h2 onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
    </header>
    <main>
      <div class="server_status">
        <h3>Ngac Server Status</h3>
        <br>
        <h3 style="display:inline;float:left">Server:</h3>
        <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: 4.8rem;"></h3>
      </div>
      <div class="current_loaded_policy">
        <h2>Current active policy</h2>
        <h1 class="current_active_policy_answer"></h1>
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
           <button class="show_all_policies_btn" id="show_all_policies_btn">Show all policies</button>
           <button class="show_loaded_policies_btn" id="show_loaded_policies_btn">Show loaded policies</button>
          </div>
        <div class="inner_display_policy_files_container">
          <table id="table_all_policies">
              <thead id="t_head">
                <tr>
                  <th>Policy Name</th>
                  <th>Created</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
             </thead>
             <tbody id="t_body_all">
               <?php 
                include_once("load_all_policies.php");
               ?>
             </tbody>
            </table>
            <table id="table_loaded_policies" hidden>
              <thead id="t_head">
                <tr>
                  <th>Policy Name</th>
                  <th>Loaded At</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
             </thead>
             <tbody id="t_body_loaded">
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

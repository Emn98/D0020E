<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/AdminPage/Styles/admin_management_overlay_styles.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="/AdminPage/Scripts/users_objects_overlay_arrow_logic.js"></script>
  <script src="/AdminPage/Scripts/search_for_users_objects_overlay.js"></script>
  <script src="/AdminPage/Scripts/users_objects_overlay_logic.js"></script>
  <script src="/AdminPage/Scripts/load_in_users_at_start_admin_man.js"></script>
</head>
<body>
<div id="overlay_admin_man">
  <div id="popup_container_admin_man">
    <h1 id="right_arrow" onclick="pressed_right_arrow()">></h1>
    <h1 id="left_arrow" onclick="pressed_left_arrow()" hidden><</h1>
    <p class="close_btn" onclick="close_users_and_objects_overlay()">&#x2715</p>
    <div id="admin_man_search_container">
        <form id="admin_man_search_form" method="POST" action="">
            <input type="text" id="admin_man_search_inp" name="search_inp" autocomplete="off" placeholder="Search user by name or id...">
            <button id="admin_man_submit" type="submit">Search</button>
        </form>
        <h2 id="admin_man_title">Users</h2>
        <button onclick="create_new_user()" id="admin_man_create_btn">Create New User</button>
    </div> 
     <div id="admin_man_inner_container">
      <table id="admin_man_table">
        <thead id="admin_man_table_head">  
        </thead>
        </div>
          <tbody id="admin_man_table_body"> 
            <script>
              //Load in user table on first page load
              $(document).ready(function(){
                $("#admin_man_table_head").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php", {
                part: "head",
                table: "users"
                }); 
                $("#admin_man_table_body").load("/AdminPage/Overlays/UsersAndObjectsOverlay/load_users_and_objects.php", {
                part: "body",
                table: "users"
                });  
             });
             </script>                      
          </tbody>
        </div>
        </table> 
    </div>
  </div>
</div>  

<script>  
function show_users_and_objects_overlay() {
  document.getElementById("overlay_admin_man").style.display = "grid";
}

function close_users_and_objects_overlay() {
  document.getElementById("overlay_admin_man").style.display = "none";
}
</script>
   
</body>
</html> 

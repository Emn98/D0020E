
<!DOCTYPE html5>
<html lang="en">
  <head>
    <title>Admin NGAC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="policy_style.css">
    <link rel="stylesheet" href="/AdminPage/Styles/header.css">
    <link rel="stylesheet" href="/AdminPage/Styles/admin_main_page.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
    <script src="/AdminPage/Scripts/check_ngac_server_conn.js"></script>
    <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>
    <script>
      $(document).ready(function(){
          
          //Retrives the active policy from NGAC server upon page load. 
          check_ngac_server_conn();

      });
    </script>
  </head>
  <body>
  <div class="header">
        <h2 class="choose_frontend_txt" onclick="go_to_choose_frontend()" style='cursor: pointer;'>Choose Frontend</h2>
        <h2 class="choose_admin_page_txt" onclick="go_to_admin_page()" style='cursor: pointer; margin-left: 12.8rem; position:absolute;'>Admin page</h2>
        <div class="server_status">
            <h3 style="display:inline;float:left">NGAC Server Status: </h3>
            <h3 class="server_status_response" id="server_status_response" style="display:inline;float:right;margin-right: -3.8rem;"></h3>
        </div>
    </div>
          

    <div class="form-cont">
      <form class="dynamic_form" id="add_policy_form" method="POST" action="add_policy_users_and_objects.php" id="add_policy_form">

          <h1>Add Policy</h1>
          <div class="form_elements">
              <input type="text" id="policy_name" name="policy_name" class="policy_input" required>
              <label for="policy_name" class="form_label">Policy name</label>
          </div>
          <div class="form_elements">
              <input type="number" id="number_users" name="number_users" class="policy_input" required>
              <label for="number_users" class="form_label">Amount of users</label>
          </div>
          <div class="form_elements">
              <input type="number" id="number_objects" name="number_objects" class="policy_input" required>
              <label for="number_objects" class="form_label">Amount of objects</label>
          </div>
          <div class="form_elements">
              <input type="number" id="number_users_attr" name="number_users_attr" class="policy_input" required>
              <label for="number_users_attr" class="form_label">Amount of user attributes</label>
          </div>
          <div class="form_elements">
              <input class="policy_input" type="number" id="number_objects_attr" name="number_objects_attr"  required>
              <label for="number_objects_attr" class="form_label">Amount of object attributes</label>
          </div>

          <button class="input_button" type="submit" class="form_button" >Add Policy</button>
      </form>
    </div>
    
  </body>
</html>

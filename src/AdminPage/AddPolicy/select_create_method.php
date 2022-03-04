<!DOCTYPE html5>
<html lang="en">
  <head>
      <title>Admin NGAC</title>
      <meta charset="UTF-8">
      <link rel="stylesheet" href="policy_style.css">
      <link rel="stylesheet" href="/AdminPage/Styles/admin_main_page.css">
      <link rel="stylesheet" href="/AdminPage/Styles/header.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="/AdminPage/Scripts/go_to_choose_frontend.js"></script>
      <script src="/AdminPage/Scripts/check_ngac_server_conn.js"></script>
      <script src="/AdminPage/Scripts/go_to_admin_page.js"></script>
      <script>
        $(document).ready(function(){
            
            //Check NGAC connection upon load
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
        <div class="dynamic_form">
          <h1>Choose Create Tool</h1>
          <form class="frontend_form" action="../NGAC-graph-UI/index.html">
              <button class="input_button" type="submit" class="menu_btn">Graph tool</button>
          </form>
          <form class="frontend_form" action="add_policy_form.php">
              <button class="input_button" type="submit" class="menu_btn">Old create tool</button>
          </form>
        </div>
       
    </div>
  </body>
</html>
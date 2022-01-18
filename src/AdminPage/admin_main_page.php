
<!DOCTYPE html5>
<html lang="en">
  <head>
    <title>Admin NGAC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/index_style.css">
  </head>
  <body>
    <div class="menu_form">
      <h1>Admin Menu</h1>
      <br>
      <form class="edit_policy_form" action="">
        <button type="submit" class="menu_btn">Add New Policy</button>
      </form>
      <form class="edit_policy_form" action="">
        <button type="submit" class="menu_btn">Edit Policy</button>
      </form>
      <form class="delete_policy_form" action="/DeletePolicy/delete_policy_form.php">
        <button type="submit" class="menu_btn">Delete Policy</button>
      </form>
      <form class="logout_form" action="/Login/logout.php">
        <button type="submit" class="menu_btn">Logout</button>
      </form>
    </div>
  </body>
</html>

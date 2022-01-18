
<!DOCTYPE html5>
<html lang="en">
  <head>
    <title>Admin NGAC</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="policy_style.css">
  </head>
  <body>
    <form class="add_policy_form" method="POST" action="add_policy_query.php" id="add_policy_form">

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

        <input type="submit" class="form_button" value="Add Policy">
    </form>
  </body>
</html>

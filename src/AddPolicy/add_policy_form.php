
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

        <input type="submit" class="form_button" value="Add Policy">
    </form>
  </body>
</html>

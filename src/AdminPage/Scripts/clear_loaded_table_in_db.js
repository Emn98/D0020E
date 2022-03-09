//This function will clear the loaded policies table in the database. 
function clear_loaded_policy_table_in_db() {
    $.ajax({
      async: false,
      type: "POST",
      url: "/AdminPage/UnloadPolicy/clear_loaded_policy_table.php",
      error: function () {
        alert("failure");
      },
    });
  }
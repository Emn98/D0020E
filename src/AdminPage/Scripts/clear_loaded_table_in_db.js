//This function will make an ajax call to "clear_loaded_policy_backend" and
//delete all entries in the loaded policies table. 
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
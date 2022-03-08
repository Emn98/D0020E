function check_delete_policy(policy_name) {
  if (confirm("Are you sure you want to delete policy: '" + policy_name + "'?")) 
  {
    delete_policy(policy_name, true);
  }
}

function delete_policy(policy_name, display_promt){
  var  need_db_access = "check";
  var display_promt = display_promt;

  $.ajax({
    type: "POST",
    url: "/AdminPage/LoadPolicy/check_if_policy_already_loaded.php",
    data: {
      policy_name: policy_name,
      need_db_access: need_db_access
    },
    dataType: "text",
    success: function (response) {
      if (response == 1) {
        unload_policy(policy_name); //If the policy is loaded then unload it first
      }

      $.ajax({
        type: "POST",
        url: "/AdminPage/DeletePolicy/delete_policy_backend.php",
        data: { policy_name: policy_name },
        dataType: "text",
        success: function (response) {
          if (response == 0) {
            get_all_policies();
            if(display_promt == true){
              alert("Policy: '" + policy_name + "' was deleted successfully");
            }
          } else {
            alert("Error: Policy could not be deleted");
          }
        },
        error: function () {
          alert("Error: delete_policy_backend failed!");
        },
      });
    },
  });
}
  

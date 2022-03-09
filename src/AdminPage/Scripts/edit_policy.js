function edit_policy(policy_name) {
  var policy_name = policy_name;
  var need_db_access = "check";

  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/LoadPolicy/check_if_policy_already_loaded.php",
    data: {
      policy_name: policy_name,
      need_db_access: need_db_access
    },
    dataType: "text",
    success: function (response) {
      if (response == 1) {
        //If the policy is loaded then send it to edit_loaded_policy()
        edit_loaded_policy(policy_name); 
      } else {
        //Send the user and the name of the policy to the edit policy page
        $("#form_inp").attr("value", policy_name);
        $("#view_edit_policy").submit();
      }
    },
  });
}

function edit_loaded_policy(policy_name) {
  if (
    confirm(
      "Warning: Policy '" +policy_name + "' is currently loaded into the ngac " +
      "server. If you choose to continue, '" +policy_name + "' will " + 
      "automatically be unloaded."
    )
  ) {
    unload_policy(policy_name);
    //Send the user and the name of the policy to the edit policy page
    $("#form_inp").attr("value", policy_name);
    $("#view_edit_policy").submit();
  }
}

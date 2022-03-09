function set_policy(policy_name) {
  //If setpolicy=all mode is on. 
  if (document.getElementById("setpol_all_btn").className == "setpol_all_btn_active") {
    if(
      confirm("Warning: the ngac system is currently in 'setpolicy=all mode " +
               "If you want to set this specific policy as active, then all " +
                "the other policies will be unloaded, the mode will be " +
                "turned off and this policy will be set." )
    ){

      document.getElementById("setpol_all_btn").className = "setpol_all_btn_not_active";          
      document.getElementById("setpol_all_btn").setAttribute("onclick", "activate_setpolicy_to_all()");
      
      set_policy_in_ngac_system("none");

      clear_loaded_policy_table_in_db();

      load_policy(policy_name, "False");
      set_policy_in_ngac_system(policy_name);

      if (document.getElementById("show_all_policies_btn").style.backgroundColor != "rgb(0, 136, 169)") {
        get_loaded_policies();
      } 
    }
  }else{
    set_policy_in_ngac_system(policy_name);
  } 
}

function set_policy_in_ngac_system(policy_name){
  var url =
  "http://127.0.0.1:8001/paapi/setpol?policy=" +
  policy_name +
  "&token=admin_token";

  $.ajax({
    async: false,
    url: url,
    type: "POST",
    dataType: "json",

    complete: function (data) {
      const obj = data.responseJSON;

      if (typeof obj == "undefined") {
        $.ajax({
          type: "POST",
          url: "/AdminPage/alert_message.php",
          data: { ERROR: "Connection Error: Can't connect to the NGAC server."},
          dataType: "text",
          success: function (data) {
            window.document.write(data);
          }
        });
      } else {
        if (obj.respStatus != "success") {
          $.ajax({
            type: "POST",
            url: "/AdminPage/alert_message.php",
            data: { SUCCESS: JSON.stringify(data.responseJSON)},
            dataType: "text",
            success: function (data) {
              window.document.write(data);
            }
          });
        } else {
          get_active_policy();
          if(policy_name != "none"){
            $.ajax({
              type: "POST",
              url: "/AdminPage/alert_message.php",
              data: { SUCCESS: "Policy: '" + policy_name + "' was set successfully!"},
              dataType: "text",
              success: function (data) {
                window.document.write(data);
              }
            });
          }
        }
      }
    },
  });
}






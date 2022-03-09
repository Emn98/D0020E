function load_policy(policy_name, show_confirm_promt) {
  var show_confirm_promt = show_confirm_promt;
  var check_if_policy_already_loaded = "check";

  $.ajax({
    async: false,
    type: "POST",
    url: "/AdminPage/LoadPolicy/get_policy_backend.php",
    data: {
      policy_name: policy_name,
      check_if_policy_already_loaded: check_if_policy_already_loaded,
    },
    dataType: "text",

    success: function (response) {
      if (response == 1) {
        alert("Policy: '" + policy_name + "' is already loaded into NGAC");
      } else {
        console.log(response);
        //Create the url to complete the whole query to the ngac system.
        url_qery =
          "http://127.0.0.1:8001/paapi/loadi?policyspec=" +
          response +
          "&token=admin_token";

        $.ajax({
          url: url_qery,
          type: "GET",
          dataType: "json",

          complete: function (data) {
            const obj = data.responseJSON;

            if (typeof obj == "undefined") {
              alert("Connection Error: Can't connect to the NGAC server.");
            } else {
              if (obj.respStatus != "success") {
                alert(
                  obj.respStatus + " " + obj.respMessage + " " + obj.respBody
                );
              } else {
                set_policy_as_loaded(policy_name);
                get_active_policy();
                if(show_confirm_promt == "True"){
                  alert("Policy '" + policy_name + "' was loaded succesfully");
                }
              }
            }
          },
        });
      }
    },
    error: function () {
      alert("Failure");
    },
  });
}

//Updates the database so the policy is seen as loaded in our system. 
function set_policy_as_loaded(name) {
  $.ajax({
    type: "POST",
    url: "/AdminPage/LoadPolicy/set_policy_as_loaded.php",
    data: { policy_name: name },
    error: function () {
      alert("failure");
    },
  });
}

//This function will check the connection status of the ngac server and...
//clear the loaded table if a new session is created.
function check_ngac_server_conn() {
  $.ajax({
    async: false,
    url: "http://127.0.0.1:8001/paapi/initsession?session=admin_session&user=admin&token=admin_token",
    type: "POST",
    dataType: "json",

    complete: function (data) {
      const obj = data.responseJSON;
      if (typeof obj == "undefined") {
        $(".server_status_response").html(" Offline");
        document.getElementById("server_status_response").style.color = "red";
        $(".current_active_policy_answer").html(
          "No policy is currently active!"
        );
        return;
      }
      $(".server_status_response").html(" Online");
      document.getElementById("server_status_response").style.color = "green";
      if (obj.respStatus == "failure") {
        return;
      } else {
        //New session has been created. Empty loaded policy table.
        clear_loaded_policy_table_in_db();
        //Update the show loaded policies table if the user is looking at it while starting the ngac server.
        if (show_all_policies_btn.style.backgroundColor != "rgb(0, 136, 169)") {
          get_loaded_policies();
        }
      }
    },
  });
}

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

//Check the connection to the ngac server every 5 seconds.
setInterval(function () {
  check_ngac_server_conn();
}, 5000);

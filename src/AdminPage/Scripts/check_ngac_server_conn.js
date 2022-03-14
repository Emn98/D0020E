/*This function will check the connection status between the site and the ngac
  server */
function check_ngac_server_conn() {
  $.ajax({
    async: false,
    url: "http://127.0.0.1:8001/paapi/initsession?session=admin_session&user=admin&token=admin_token",
    type: "POST",
    dataType: "json",

    complete: function (data) {
      const obj = data.responseJSON;

      if (typeof obj == "undefined") {

        //Update the server status to indicate that the ngac server is offline. 
        $(".server_status_response").html(" Offline");
        document.getElementById("server_status_response").style.color = "red";
        $(".current_active_policy_answer").html(
          "No policy is currently active!"
        );

        //Disable the combine policy button and the set all policies button
        document.getElementById("combine_policy_overlay_btn").disabled = "disable";
        document.getElementById("combine_policy_overlay_btn").className = "combine_policy_overlay_btn_disabled";

        document.getElementById("setpol_all_btn").disabled = "disable";
        document.getElementById("setpol_all_btn").className = "setpol_all_btn_not_active_disabled";

        return;
      }

      //Update the server status to indicate that the server is up and in json mode
      $(".server_status_response").html(" Online");
      document.getElementById("server_status_response").style.color = "green";

      //Enabled the set all polcies button and give it it's correct state
      document.getElementById("setpol_all_btn").disabled = "";
      if(document.getElementById("setpol_all_btn").className == "setpol_all_btn_not_active" || document.getElementById("setpol_all_btn").className == "setpol_all_btn_not_active_disabled"){
        document.getElementById("setpol_all_btn").className = "setpol_all_btn_not_active";
      }else{
        document.getElementById("setpol_all_btn").className = "setpol_all_btn_active";
      }
      
      //Enable the combine_policy_button
      document.getElementById("combine_policy_overlay_btn").disabled = "";
      document.getElementById("combine_policy_overlay_btn").className = "combine_policy_overlay_btn";

      /*A new seassion has been creating meaning that the ngac server has been
        restarted since the last check. Update the state of the db by clearing
        the loaded table */ 
      if (obj.respStatus != "failure") {
        clear_loaded_policy_table_in_db();
        //Update the show loaded policies table if the user is looking at it while starting the ngac server.
        if (show_all_policies_btn.style.backgroundColor != "rgb(0, 136, 169)") {
          get_loaded_policies();
        }
      } 
    },
  });
}

//Check the connection to the ngac server every 5 seconds.
setInterval(function () {
  check_ngac_server_conn();
}, 5000);


/*This function will return true if the frontend is connected 
  to the ngac system, else false */
function get_is_connected_status(){
  let is_connected;
  $.ajax({
    async: false,
    url: "http://127.0.0.1:8001/paapi/initsession?session=admin_session&user=admin&token=admin_token",
    type: "POST",
    dataType: "json",

    complete: function (data) {
      const obj = data.responseJSON;

      if (typeof obj == "undefined") {
        is_connected = false;
      }else{
        is_connected = true;
      }
    },
  });
  return is_connected;
}


/*This function will get the current active policy from the ngac system (if one
  is set) and display the result on the admin page */ 
function get_active_policy() {
  $.ajax({
    url: "http://127.0.0.1:8001/paapi/getpol?token=admin_token",
    type: "GET",
    dataType: "json",

    complete: function (data) {
      const obj = data.responseJSON;

      if (typeof obj == "undefined") {
        $(".current_active_policy_answer").html(
          "No policy is currently active!"
        );
      } else {
        if (obj.respStatus != "success") {
          $(".current_active_policy_answer").html("There was an error");
        } else if (obj.respBody == "none") {
          $(".current_active_policy_answer").html(
            "No policy is currently active!"
          );
        } else if(obj.respBody == "all"){
          $(".current_active_policy_answer").html(
            "The " + obj.respMessage + " is " + obj.respBody
          );

          /*Update the button to indicate that the "set all policies to acitve"
            mode is activated*/
          document.getElementById("setpol_all_btn").className = "setpol_all_btn_active";            
          document.getElementById("setpol_all_btn").setAttribute("onclick", "deactivate_setpolicy_to_all()");
        } 
        else {
          $(".current_active_policy_answer").html(
            "The " + obj.respMessage + " is " + obj.respBody
          );
        }
      }
    },
  });
}
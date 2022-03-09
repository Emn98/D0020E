function check_delete_policy(policy_name) {
  swal({
      title: "Are you sure you want to delete policy: '" + policy_name + "'?",
      icon: "warning",
      buttons: {
          ok: {
              text:"OK",
              value: "true",
          },
          cancel: "cancel"
      },
      
  })
  .then((value)=>{
      switch(value){
          case "true":
              delete_policy(policy_name, true);
              break;

          default:
              break;

      }
      
  });

}

function delete_policy(policy_name, display_promt){
  var  need_db_access = "check";
  $("#Loader2").show();
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
            $('#Loader2').hide();
            get_all_policies();
            if(display_promt == true){
              $.ajax({
                type: "POST",
                url: "/AdminPage/alert_message.php",
                data: { SUCCESS: "Policy: '" + policy_name + "' was deleted successfully" },
                dataType: "text",
                success: function (data) {
                  window.document.write(data);
                }
              });
            }
          } else {
            $('#Loader2').hide();
            $.ajax({
              type: "POST",
              url: "/AdminPage/alert_message.php",
              data: { ERROR: "Error: Policy could not be deleted" },
              dataType: "text",
              success: function (data) {
                window.document.write(data);
              }
            });
          }
        },
        error: function () {
          $('#Loader2').hide();
          $.ajax({
            type: "POST",
            url: "/AdminPage/alert_message.php",
            data: { ERROR: "Error: delete_policy_backend failed!" },
            dataType: "text",
            success: function (data) {
              window.document.write(data);
            }
          });
        },
      });
    },
  });
}
  

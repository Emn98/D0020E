function delete_policy(policy_name){
    if(confirm("Are you sure you want to delete policy: '"+policy_name+"'?")){
        var delete_policy = "delete_policy";

        $.ajax({
            type: "POST",
            url:  "/AdminPage/LoadPolicy/check_if_policy_already_loaded.php", 
            data: {policy_name: policy_name,
                   delete_policy: delete_policy
                  },
            dataType: "text",
            success: function(response){
                if(response == 1){
                    unload_policy(policy_name);
                }

                $.ajax({
                    type: "POST",
                    url:  "/AdminPage/DeletePolicy/delete_policy_backend.php", 
                    data: {policy_name: policy_name,
                          },
                    dataType: "text",
                    success: function(response){
                        if(response == 0){
                            get_all_policies();
                            alert("Policy: '"+policy_name+"' was deleted successfully");
                        }else{
                            alert("Error: Policy could not be deleted");
                        }
                    },
                    error: function(){
                        alert("Failure");
                    }
                });
            },
        });
    }
}
<!-- This script will contact the NGAC system and retrive the name of the current active policy -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
     
    function jquery(URL){   

        $.ajax({
            url: URL,
            type: 'GET',
            dataType: 'json',
            
            complete: function(data){
                
                const obj = data.responseJSON;
                
                if(typeof obj == 'undefined'){
                    $(".current_active_policy_answer").html("The server is not activated/activated correctly");   
                }else{
                    if(obj.respStatus != "success"){
                        $(".current_active_policy_answer").html("There was an error");
                    }else if(obj.respBody == "none"){
                        $(".current_active_policy_answer").html("No policy is currently active");
                    }else{
                        $("#unload_btn").removeAttr("hidden");
                        $(".current_active_policy_answer").html("The " + obj.respMessage + " is " + obj.respBody);
                    }      
                }
            },
        });
    }
</script>
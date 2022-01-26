
function get_active_policy(){
    
    $.ajax({
        
        url: "http://127.0.0.1:8001/paapi/getpol?token=admin_token",
        type: 'GET',
        dataType: 'json',
        
        complete: function(data){           
            const obj = data.responseJSON;
            
            if(typeof obj == 'undefined'){
                $(".current_active_policy_answer").html("The server is not activated/activated correctly");  
                $(".server_status_response").html("Offline");
                document.getElementById("server_status_response").style.color = "red";
                
            }else{
                $(".server_status_response").html("Online");
                document.getElementById("server_status_response").style.color = "green";

                if(obj.respStatus != "success"){
                    $(".current_active_policy_answer").html("There was an error");
                }else if(obj.respBody == "none"){
                    $(".current_active_policy_answer").html("No policy is currently active");
                }else{
                    $(".current_active_policy_answer").html("The " + obj.respMessage + " is " + obj.respBody);
                }      
            }
        },
    });    
}

setInterval(function(){
    get_active_policy(); 
}, 4000);
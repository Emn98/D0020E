function unload_policy(policy_name){
    var url = "http://127.0.0.1:8001/paapi/unload?policy="+policy_name+"&token=admin_token";

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        
        complete: function(data){           
            const obj = data.responseJSON;
            
            if(typeof obj == 'undefined'){
                alert("Connection Error: Can't connect to the NGAC server");
            }else{
                if(obj.respStatus != "success"){
                    alert(JSON.stringify(data.responseJSON));
                }else{
                    unset_policy_as_loaded(policy_name);
                    setInterval(function(){ 
                    }, 250);
                    get_active_policy();
                    setInterval(function(){ 
                    }, 250);
                    get_loaded_policies();
                    alert("Policy: '"+policy_name+"' was successfully unloaded");
                }      
            }
        },
    });
}

//Update the database state so the file is seen as unloaded
function unset_policy_as_loaded(name){
    $.ajax({
        type: "POST",
        url:  "/AdminPage/UnloadPolicy/unset_policy_as_loaded.php", 
        data: {policy_name: name
        }, 
        error: function(){
            alert("failure");
        }
    });  
}
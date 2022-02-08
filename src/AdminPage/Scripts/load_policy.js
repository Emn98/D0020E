function load_policy(policy_name){
    var submit = "submit";
    
    $.ajax({
        type: "POST",
        url:  "/AdminPage/LoadPolicy/get_policy_backend.php", 
        data: {policy_name: policy_name,
               submit: submit
              },
        dataType: "text",

        success: function(response){
            console.log(response);
            if(response == 1){
                alert("Policy: '" + policy_name + "' is already loaded into NGAC");
            }else{
                //Create the url to complete the whole query to the ngac system.  
                url_qery = "http://127.0.0.1:8001/paapi/loadi?policyspec="+response+"&token=admin_token";
                
                $.ajax({
                    url: url_qery,
                    type: 'GET',
                    dataType: 'json',

                    complete: function(data){
                        const obj = data.responseJSON;
                
                        if(typeof obj == 'undefined'){
                            alert("Connection Error: Can't connect to the NGAC server.")   
                        }else{
                            if(obj.respStatus != "success"){
                                alert(obj.respStatus + " " + obj.respMessage + " " + obj.respBody);    
                            }else{
                                set_policy_as_loaded(policy_name);
                                get_active_policy();
                                alert("Policy '"+policy_name+"' was loaded succesfully");
                            }         
                        }                   
                    },
                });                     
            }
        },
        error: function(){
            alert("Failure");
        }
    });
}

//Updates the database so the 
function set_policy_as_loaded(name){
    $.ajax({
        type: "POST",
        url:  "/AdminPage/LoadPolicy/set_policy_as_loaded.php", 
        data: {policy_name: name
        }, 
        error: function(){
            alert("failure");
        }
    });  
}

function set_policy(policy_name){
    var url = "http://127.0.0.1:8001/paapi/setpol?policy="+policy_name+"&token=admin_token";

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        
        complete: function(data){           
            const obj = data.responseJSON;
            
            if(typeof obj == 'undefined'){
                alert("Connection Error: Can't connect to the NGAC server.");
            }else{
                if(obj.respStatus != "success"){
                    alert(JSON.stringify(data.responseJSON));
                }else{
                    alert("Policy: '"+policy_name+"' was set successfully!");
                    get_active_policy();
                }      
            }
        },
    });
}
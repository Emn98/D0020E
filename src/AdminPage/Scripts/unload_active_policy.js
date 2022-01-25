//This javascript will unload the current active policy in the NGAC system//

function unload_active_policy(policy){
    if(confirm("Are you sure you want to unload the current active policy?") == true){
        $.ajax({
          url: "http://127.0.0.1:8001/paapi/unload?policyspec="+policy+"&token=admin_token", 
          type: 'GET',
          dataType: 'json',
          
          complete: function(data){

            const obj = data.responseJSON; 

            if((obj.respStatus != "success")){
              alert("Failure");
            }else{
              location.reload()
            }  
          },
        });       
    }else{
        exit;
    }
}
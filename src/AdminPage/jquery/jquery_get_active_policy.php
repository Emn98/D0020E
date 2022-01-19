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
                $(".current_active_policy_answer").html("The Server Is Not Activated/Activated Correctly");   
            }else{
              if(obj.respStatus != "success"){
                $(".current_active_policy_answer").html("There Were An Error");
              }else if(obj.respBody == "none"){
                $(".current_active_policy_answer").html("No Policy Is Currently Active");
              } 
              else{
                $(".current_active_policy_answer").html("The " + obj.respMessage + " is " + obj.respBody);
              }      
            }  
         },
        });
    }

</script>

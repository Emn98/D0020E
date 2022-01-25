function load_test(name){
    var submit = "submit";
    $.ajax({
        type: "POST",
        url:  "load_policy_backend.php", 
        data: {policy_name: name,
               submit: submit
              },                
        success: function(response){
            console.log(response)
            $.ajax({
                url: response,
                type: 'GET',
                dataType: 'json',
                
                complete: function(data)
                {
                    alert ("SUCCESS: " + JSON.stringify(data.responseJSON));
                    window.location.href = "../AdminPage/admin_main_page.php";
                    exit;
                },
            });            
            
        },
        error: function(){
          alert("failure");
              }
          });    
}
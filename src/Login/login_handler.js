$('login_form').on('submit', function(){
    url = this.attr("action"),
    method = this.attr("method");
    var username = $("#username").val();
    var password = $("#password").val();

    $.ajax({
        type: method,
        url:  url,  
        data: {username: username,
               password: password},                
        success: function(response){
            $(".form_message").text(response);
        },
        error: function(){
            alert("Failure");
        }
    });
});
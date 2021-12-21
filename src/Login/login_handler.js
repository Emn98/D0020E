$(document).ready(function(){
  $("#login_form").on("submit", function(event){
    event.preventDefault();
    $.ajax({
      url:  $(this).attr("action"),
      type: $(this).attr("method"),
      data: $(this).serialize(),
      success: function(response){
        if(response==1){
          window.location="/index.php";
        }else{
          $("#form_message").html(response);
        }
      },
      error: function(){
        alert("Failure!");
      }
    });
  });
});
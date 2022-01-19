<?php
    require_once 'cookies.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
     
    function jquery(URL){
        
        $.ajax({
            url: URL,
            type: 'GET',
            dataType: 'json',
            complete: function(data) {
                make_cookie("acccess", JSON.stringify(data.responseJSON));
                location.href = "test_main_page.php";
            },
            
        });
    }

</script>
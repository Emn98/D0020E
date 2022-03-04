<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
     
    function jquery(URL){
        
        $.ajax({
            url: URL,
            type: 'GET',
            dataType: 'json',
            
            complete: function(data)
            {
                alert ("SUCCESS: " + JSON.stringify(data.responseJSON));
                window.location.href = "../AdminPage/admin_main_page.php";
                exit;
            },
        });
    }

</script>
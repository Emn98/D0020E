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
                location.href = "../index.php";
            },
        });
    }

</script>
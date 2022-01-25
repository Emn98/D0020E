<?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/AdminPage/jquery/jquery.php";
    include($path);

    $URL = "http://127.0.0.1:8001/paapi/unload?token=admin_token";

    ?>
    <script>
        jquery(<?php echo json_encode($URL) ?>);
    </script>
    <?php
    
?>
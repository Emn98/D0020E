<?php

    $path = $_SERVER['DOCUMENT_ROOT'];
    $path .= "/AdminPage/jquery/jquery_get_active_policy.php";
    include($path);

    $URL = "http://127.0.0.1:8001/paapi/getpol?token=admin_token";

    ?>
    <script>
        jquery(<?php echo json_encode($URL) ?>);
    </script>
    <?php
    
?>
        
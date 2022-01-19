<?php
    require_once '../jquery/jquery.php';

    
    // TEMPORARY TEST POLISY
    $myfile = fopen("../../policies/"."pol.txt", "r") or die("Unable to open location for log file !");
    
    $policy = fread($myfile, filesize("../../policies/"."pol.txt"));

    fclose($myfile);

    $URL = "http://127.0.0.1:8001/paapi/loadi?policyspec=".$policy."&token=admin_token";

    echo $URL;

    ?>
        <script>

            jquery(<?php echo json_encode($URL) ?>);

        </script>
    <?php

?>
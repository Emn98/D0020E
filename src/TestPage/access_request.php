<?php
    require_once 'jquery.php';

    if(isset($_GET["submit"]))
    {
        $user = $_GET["user"];
        $object = $_GET["object"];
        $URL = "http://localhost:8005/peapi/access?user=" . $user . "&ar=r&object=".$object ;
        ?>
        <script>
            jquery(<?php echo json_encode($URL) ?>);
        </script>
        <?php
        
    }
?>
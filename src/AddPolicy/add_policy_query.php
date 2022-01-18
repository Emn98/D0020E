<?php
    require_once '../jquery/jquery.php';

    if(isset($_POST["policy_name"]))
    {
        $URL = "http://127.0.0.1:8001/paapi/loadi?policyspec=policy(".$_POST["policy_name"].",access,[
            user(u1),
            user_attribute(ua1),
            object(o1),
            object_attribute(oa1),
            policy_class(access),
            connector('PM'),
            assign(u1,ua1),
            assign(o1,oa1),
            assign(ua1,access),
            assign(oa1,access),
            assign(access,'PM'),
            associate(ua1,[r,w],oa1)])
        &token=admin_token";

        $myfile = fopen("../../policies/".$_POST["policy_name"].".txt", "w") or die("Unable to open location for log file !");

        fwrite($myfile, $_POST["policy_name"]);
            
        require_once "../db_conn/db_conn.php";
        require_once "../db_queries/policies_queries.php";

        add_policy_to_db($conn, $_POST["policy_name"], "policies/".$_POST["policy_name"].".txt");


        fclose($myfile);

        ?>
            <script>

                //jquery(<?php //echo json_encode($URL) ?>);
                

            </script>
        <?php
    }

?>
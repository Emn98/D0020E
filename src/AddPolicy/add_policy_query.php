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

        ?>
            <script>

                jquery(<?php echo json_encode($URL) ?>);
                
            </script>
        <?php
    }

?>
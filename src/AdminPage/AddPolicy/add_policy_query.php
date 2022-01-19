<?php

    if(isset($_POST["policy_name"]))
    {
        $pol_text = "policy(".$_POST["policy_name"].",access,[\n";

        for($num_users = 0; $num_users < $_POST["number_users"]; $num_users ++)
        {
            $pol_text = $pol_text. "user(" . $_POST["user".$num_users] . "),\n";
            $pol_text = $pol_text . "user_attribute(ua_" . $_POST["user".$num_users] . "),\n";
            $pol_text = $pol_text. "assign(" . $_POST["user".$num_users] . ",ua_" . $_POST["user".$num_users] . "),\n";
            $pol_text = $pol_text . "assign(ua_" . $_POST["user".$num_users] . ",access),\n";
        }

        for($num_objects = 0; $num_objects < $_POST["number_objects"]; $num_objects ++)
        {
            $pol_text = $pol_text. "object(" . $_POST["object".$num_objects] . "),\n";
            $pol_text = $pol_text . "object_attribute(oa_" . $_POST["object".$num_objects] . "),\n";
            $pol_text = $pol_text. "assign(" . $_POST["object".$num_objects] . ",oa_" . $_POST["object".$num_objects] . "),\n";
            $pol_text = $pol_text . "assign(oa_" . $_POST["object".$num_objects] . ",access),\n";
        }

        $pol_text = $pol_text . "policy_class(access),\n";
        $pol_text = $pol_text . "connector('PM'),\n";

        $pol_text = $pol_text . "assign(access,'PM'),\n";

        for($num_users = 0; $num_users < $_POST["number_users"]; $num_users ++)
        {
            for($num_objects = 0; $num_objects < $_POST["number_objects"]; $num_objects ++)
            {
                $connection = false;
                $connections = "";
                if(isset($_POST["read_".$_POST["user".$num_users]."_".$_POST["object".$num_objects]]))
                {
                    $connections = "r";

                    $connection = true;
                }

                if(isset($_POST["write_".$_POST["user".$num_users]."_".$_POST["object".$num_objects]]))
                {
                    if($connection)
                    {
                        $connections = $connections . ", w";
                    }
                    else
                    {
                        $connections =  "w";

                        $connection = true;
                    }
                }

                if($connection)
                {
                    $pol_text = $pol_text. "associate(ua_" . $_POST["user".$num_users] . ",[" . $connections  . "],oa_" . $_POST["object".$num_objects] . "),\n";
                }
                
                

            }
        }

        $pol_text = substr_replace($pol_text ,"\n",-2);

        $pol_text = $pol_text . "]).";

        $myfile = fopen("../../../policies/".$_POST["policy_name"].".txt", "w") or die("Unable to open location for log file !");

        fwrite($myfile, $pol_text);
            
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
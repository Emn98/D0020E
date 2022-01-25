<?php
    if(isset($_POST["policy_name"]))
    {
        require_once "add_to_DB.php";

        $users = [];
        for($num_users = 0; $num_users < $_POST["number_users"]; $num_users ++)
        {
            $users[$num_users] = $_POST["user".$num_users];
        }

        for($num_objects = 0; $num_objects < $_POST["number_objects"]; $num_objects ++)
        {
            $objects[$num_objects] = $_POST["object".$num_objects];
        }

        $assotiation = [];

        // creates a 3d dictonar [user => [object => [operations]]]
        for($num_users = 0; $num_users < sizeof($users); $num_users ++)
        {
            $opject_conns = [];
            for($num_objects = 0; $num_objects < sizeof($objects); $num_objects ++)
            {
                $connection = false;
                $operations = [];
                if(isset($_POST["read_".$_POST["user".$num_users]."_".$_POST["object".$num_objects]]))
                {
                    $operations[0] = "read";

                    $connection = true;
                }

                if(isset($_POST["write_".$_POST["user".$num_users]."_".$_POST["object".$num_objects]]))
                {
                    if($connection)
                    {
                        $operations[1] = "write";
                    }
                    else
                    {
                        $operations[0] =  "write";

                        $connection = true;
                    }
                }

                if($connection)
                {
                    $opject_conns += [$_POST["object".$num_objects] => $operations];
                    
                }
                
            }
            $assotiation += [$_POST["user".$num_users] => $opject_conns];

        }

        /*
        for($num_users = 0; $num_users < sizeof($users); $num_users ++)
        {
            for($num_objects = 0; $num_objects < sizeof($objects); $num_objects ++)
            {
                $operations = $assotiation[$users[$num_users]][$objects[$num_objects]];
                for($num_operation = 0; $num_operation < sizeof($operations); $num_operation ++)
                {
                    echo $users[$num_users];
                    echo "-";
                    echo $objects[$num_objects];
                    echo ": ";
                    echo $operations[$num_operation];
                    echo ", ";
                }
                echo "\n";

            }
        }
        */

        add_policy_data_to_DB($_POST["policy_name"], $users, $objects, $assotiation);
    }
?>
<?php
    if(isset($_POST["policy_name"]))
    {
        require_once "add_to_DB.php";
        
        $user_attributes = [];
        for($num_user_attr = 0; $num_user_attr < $_POST["number_users_attr"]; $num_user_attr ++)
        {
            $user_attributes[$num_user_attr] = $_POST["user_attr".$num_user_attr];
        }

        $object_attributes = [];
        for($num_object_attr = 0; $num_object_attr < $_POST["number_objects_attr"]; $num_object_attr ++)
        {
            $object_attributes[$num_object_attr] = $_POST["object_attr".$num_object_attr];
        }


        $user_attributes_conns = [];
        for($num_users = 0; $num_users < $_POST["number_users"]; $num_users ++)
        {
            
            for($num_user_attr = 0; $num_user_attr < $_POST["number_users_attr"]; $num_user_attr ++)
            {
                if(isset($_POST["user_attr_conn_".$_POST["user".$num_users]."_".$_POST["user_attr".$num_user_attr] ]))
                {
                    array_push($user_attributes_conns, [ $_POST["user".$num_users], $_POST["user_attr".$num_user_attr] ] );
                }

            }
            
        }

        $object_attributes_conns = [];
        for($num_objects = 0; $num_objects < $_POST["number_objects"]; $num_objects ++)
        {
            for($num_object_attr = 0; $num_object_attr < $_POST["number_objects_attr"]; $num_object_attr ++)
            {
                if(isset($_POST["object_attr_conn_".$_POST["object".$num_objects]."_".$_POST["object_attr".$num_object_attr] ]))
                {
                    array_push($object_attributes_conns, [ $_POST["object".$num_objects], $_POST["object_attr".$num_object_attr] ] );
                }
            }
        }

        $attribute_connections = [];
        for($num_user_attr = 0; $num_user_attr < $_POST["number_users_attr"]; $num_user_attr ++)
        {
            $attribute_connections[$_POST["users_attr".$num_user_attr]] = NULL;
        }
        for($num_object_attr = 0; $num_object_attr < $_POST["number_objects_attr"]; $num_object_attr ++)
        {
            $attribute_connections[$_POST["object_attr".$num_object_attr]] = NULL;
        }
        

        $assotiation = [];

        
        // creates a 3d dictonar [user => [object => [operations]]]
        for($num_user_attr = 0; $num_user_attr < sizeof($user_attributes); $num_user_attr ++)
        {
            $opject_conns = [];
            for($num_object_attr = 0; $num_object_attr < sizeof($object_attributes); $num_object_attr ++)
            {
                
                $connection = false;
                $operations = [];
                if(isset($_POST["read_".$user_attributes[$num_user_attr]."_".$object_attributes[$num_object_attr]]))
                {
                    $operations[0] = "r";

                    $connection = true;
                }

                if(isset($_POST["write_".$user_attributes[$num_user_attr]."_".$object_attributes[$num_object_attr]]))
                {
                    if($connection)
                    {
                        $operations[1] = "w";
                    }
                    else
                    {
                        $operations[0] =  "w";

                        $connection = true;
                    }
                }

                if($connection)
                {
                    $opject_conns += [$object_attributes[$num_object_attr] => $operations];
                    
                }
                
            }
            $assotiation += [$user_attributes[$num_user_attr] => $opject_conns];

        }
        
        /*
        for($num_user_attr = 0; $num_user_attr < sizeof($user_attributes); $num_user_attr ++)
        {
            for($num_object_attr = 0; $num_object_attr < sizeof($object_attributes); $num_object_attr ++)
            {
                $operations = $assotiation[$user_attributes[$num_user_attr]][$object_attributes[$num_object_attr]];
                for($num_operation = 0; $num_operation < sizeof($operations); $num_operation ++)
                {
                    echo $user_attributes[$num_user_attr];
                    echo "-";
                    echo $object_attributes[$num_object_attr];
                    echo ": ";
                    echo $operations[$num_operation];
                    echo ", ";
                }
                echo "\n";

            }
        }
        */

        // TEST
        /*
        $user_attributes = ["ua1", "ua2", "ua3"];
        $object_attributes = ["oa1", "oa2"];
        $user_attributes_conns = [
            ["u1", "ua2"],
            ["u2", "ua3"]
        ];
        $object_attributes_conns = [
            ["o1", "oa1"],
            ["o2", "oa2"],
            ["o3", "oa2"]
        ];
        $attribute_connections = [
            "ua1" => NULL, 
            "ua2" => "ua1", 
            "ua3" => "ua1",
            "oa1" => NULL,
            "oa2" => "oa1"
        ];
        $assotiation = [
            "ua1" => ["oa1" => ["r"]],
            "ua2" => ["oa1" => ["w"]],
            "ua3" => ["oa2" => ["w"]]
        ];
        */

        $result = add_policy_data_to_DB($_POST["policy_name"], $user_attributes, $object_attributes, $user_attributes_conns, $object_attributes_conns, $attribute_connections, $assotiation);

        if($result == true)
        {
            header('Location: ../admin_main_page.php');
            exit();
        }
        else
        {
            echo "\n\r Somthing whent wrong!\n\r";
        }

    }
    else
    {
        header('Location: ../admin_main_page.php');
        exit();

    }
?>
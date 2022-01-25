<?php

function add_policy_data_to_DB($policy_name, $users, $objects, $assotiation)
{
    require_once "../db_conn/db_conn.php";
    require_once "../db_queries/insert_queries.php";
    require_once "../db_queries/select_queries.php";

    mysqli_autocommit($conn, false);

    $no_error = true;

    $no_error = add_policy_to_db($conn, $_POST["policy_name"], "access");

    for($num_users = 0; $num_users < sizeof($users); $num_users ++)
    {

        $user = get_user($conn, $users[$num_users]);
        $no_error = add_User_attr_policy_conns_to_db($conn, $policy_name, "ua_" . $users[$num_users], NULL);
        $user_attribute = get_User_attr_policy_conns($conn, $policy_name, "ua_" . $users[$num_users]);
        $no_error = add_user_policy_conn_to_db($conn, $policy_name, $user["user_id"], $user_attribute["user_attribute_ID"]);

        add_Assign_user_attr_policy_class_to_db($conn, $user_attribute["user_attribute_ID"], $policy_name);
    }

    for($num_objects = 0; $num_objects < sizeof($objects); $num_objects ++)
    {
        $object = get_object($conn, $objects[$num_objects]);
        $no_error = add_Object_attr_policy_conns_to_db($conn, $policy_name, "oa_" . $objects[$num_objects], NULL);
        $object_attribute = get_Object_attr_policy_conns($conn, $policy_name, "oa_" . $objects[$num_objects]);
        $no_error = add_object_policy_conn_to_db($conn, $policy_name, $object["object_id"], $object_attribute["object_attribute_ID"]);

        add_Assign_policy_classes_to_db($conn, $object_attribute["object_attribute_ID"], $policy_name);
    }

    for($num_users = 0; $num_users < sizeof($users); $num_users ++)
    {
        for($num_objects = 0; $num_objects < sizeof($objects); $num_objects ++)
        {
            $operations = $assotiation[$users[$num_users]][$objects[$num_objects]];
            for($num_operation = 0; $num_operation < sizeof($operations); $num_operation ++)
            {
                $operation = get_Operations($conn, $operations[$num_operation]);
                $user_attribute = get_User_attr_policy_conns($conn, $policy_name, "ua_" . $users[$num_users]);
                $object_attribute = get_Object_attr_policy_conns($conn, $policy_name, "oa_" . $objects[$num_objects]);
                $no_error = add_Associations_to_db($conn, $user_attribute["user_attribute_ID"], $operation["operation_id"], $object_attribute["object_attribute_ID"]);
            }
            

        }
    }

    if($no_error == false)
    {
        mysqli_rollback($conn);
    }

    mysqli_commit($conn);
    
}
?>
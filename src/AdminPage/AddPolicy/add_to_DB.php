<?php

function add_policy_data_to_DB($policy_name, $users, $objects, $user_attributes, $object_attributes, $user_attributes_conns, $object_attributes_conns, $attribute_connections, $assotiation)
{
    require_once "../db_conn/db_conn.php";
    require_once "../db_queries/insert_queries.php";
    require_once "../db_queries/select_queries.php";

    mysqli_autocommit($conn, false);

    $no_error = [];

    array_push($no_error, add_policy_to_db($conn, $policy_name, "access"));

    // Add all user attributes
    // Attributes must be added from the bigest parent down i.e first the attribute with no parent then it's children and so on...
    $current_attributes_to_find_conn = NULL;
    $next_attributes_to_find_conn = [];
    while(true)
    {
        for($num_user_attribute = 0; $num_user_attribute < sizeof($user_attributes); $num_user_attribute++)
        {
            if($current_attributes_to_find_conn != NULL)
            {
                for($current_attr_num = 0; $current_attr_num < sizeof($current_attributes_to_find_conn); $current_attr_num++)
                {
                    // Check if this user_attribute is connected to the current_attribute_to_find a connection for
                    if($attribute_connections[$user_attributes[$num_user_attribute]] == $current_attributes_to_find_conn[$current_attr_num])
                    {
                        $user_attribute = get_User_attr_policy_conns($conn, $policy_name, $current_attributes_to_find_conn[$current_attr_num]);
                        array_push($no_error, add_User_attr_policy_conns_to_db($conn, $policy_name, $user_attributes[$num_user_attribute], $user_attribute["user_attribute_ID"]));
                        $next_attributes_to_find_conn += [$user_attributes[$num_user_attribute]];
                    }
                }
            }
            else
            {
                // Check if this user_attribute has no parent attribute
                if($attribute_connections[$user_attributes[$num_user_attribute]] == NULL)
                {
                    array_push($no_error, add_User_attr_policy_conns_to_db($conn, $policy_name, $user_attributes[$num_user_attribute], NULL));
                    $next_attributes_to_find_conn += [$user_attributes[$num_user_attribute]];

                    
                    $user_attribute = get_User_attr_policy_conns($conn, $policy_name, $user_attributes[$num_user_attribute]);
                    array_push($no_error, add_Assign_policy_classes_to_db($conn, $policy_name, $user_attribute["user_attribute_ID"], NULL));
                    
                }
            }
            
        }

        // Stop if their is no more attributes to find connections for
        if(sizeof($next_attributes_to_find_conn) == 0)
        {
            break;
        }
        else
        {
            $current_attributes_to_find_conn = $next_attributes_to_find_conn;
            $next_attributes_to_find_conn = [];
        }
        
    }

    // add all object attributes
    // Attributes must be added from the bigest parent down i.e first the attribute with no parent then it's children and so on...
    $current_attributes_to_find_conn = NULL;
    $next_attributes_to_find_conn = [];
    while(true)
    {
        for($num_object_attribute = 0; $num_object_attribute < sizeof($object_attributes); $num_object_attribute++)
        {
            if($current_attributes_to_find_conn != NULL)
            {
                for($current_attr_num = 0; $current_attr_num < sizeof($current_attributes_to_find_conn); $current_attr_num++)
                {
                    // Check if this object_attribute is connected to the current_attribute_to_find a connection for
                    if($attribute_connections[$object_attributes[$num_object_attribute]] == $current_attributes_to_find_conn[$current_attr_num])
                    {
                        $object_attribute = get_Object_attr_policy_conns($conn, $policy_name, $current_attributes_to_find_conn[$current_attr_num]);
                        array_push($no_error, add_Object_attr_policy_conns_to_db($conn, $policy_name, $object_attributes[$num_object_attribute], $object_attribute["object_attribute_ID"]));
                        $next_attributes_to_find_conn += [$object_attributes[$num_object_attribute]];
                    }
                }
            }
            else
            {
                // Check if this object_attribute has no parent attribute
                if($attribute_connections[$object_attributes[$num_object_attribute]] == NULL)
                {
                    array_push($no_error, add_Object_attr_policy_conns_to_db($conn, $policy_name, $object_attributes[$num_object_attribute], NULL));
                    $next_attributes_to_find_conn += [$object_attributes[$num_object_attribute]];

                    
                    $object_attribute = get_Object_attr_policy_conns($conn, $policy_name, $object_attributes[$num_object_attribute]);
                    array_push($no_error, add_Assign_policy_classes_to_db($conn, $policy_name, NULL, $object_attribute["object_attribute_ID"]));
                    
                }
            }
            
        }

        // Stop if their is no more attributes to find connections for
        if(sizeof($next_attributes_to_find_conn) == 0)
        {
            break;
        }
        else
        {
            $current_attributes_to_find_conn = $next_attributes_to_find_conn;
            $next_attributes_to_find_conn = [];
        }
        
    }
    

    for($num_users = 0; $num_users < sizeof($users); $num_users ++)
    {

        $user = get_user($conn, $users[$num_users]);
        $user_attribute = get_User_attr_policy_conns($conn, $policy_name, $user_attributes_conns[$user["full_name"]]);
        array_push($no_error, add_user_policy_conn_to_db($conn, $policy_name, $user["user_id"], $user_attribute["user_attribute_ID"]));
       
        
        
    }

    for($num_objects = 0; $num_objects < sizeof($objects); $num_objects ++)
    {
        $object = get_object($conn, $objects[$num_objects]);
        $object_attribute = get_Object_attr_policy_conns($conn, $policy_name, $object_attributes_conns[$object["full_name"]]);
        array_push($no_error, add_object_policy_conn_to_db($conn, $policy_name, $object["object_id"], $object_attribute["object_attribute_ID"]));
        

    }

    for($num_user_attribute = 0; $num_user_attribute < sizeof($user_attributes); $num_user_attribute++)
    {
        for($num_object_attribute = 0; $num_object_attribute < sizeof($object_attributes); $num_object_attribute++)
        {
            $operations = $assotiation[$user_attributes[$num_user_attribute]][$object_attributes[$num_object_attribute]];
            for($num_operation = 0; $num_operation < sizeof($operations); $num_operation ++)
            {
                $operation = get_Operations($conn, $operations[$num_operation]);
                $user_attribute = get_User_attr_policy_conns($conn, $policy_name, $user_attributes[$num_user_attribute]);
                $object_attribute = get_Object_attr_policy_conns($conn, $policy_name, $object_attributes[$num_object_attribute]);
                array_push($no_error, add_Associations_to_db($conn, $policy_name, $user_attribute["user_attribute_ID"], $operation["operation_id"], $object_attribute["object_attribute_ID"]));
            }
            

        }
    }

    if(in_array(false, $no_error))
    {
        mysqli_rollback($conn);
        mysqli_commit($conn);

        return false;
    }
    else
    {
        mysqli_commit($conn);

        return true;
    }
    
    
}
?>
<?php
function add_attributes($conn, $policy_name, $no_error, $attributes, $attribute_connections, $MODE, $current_parent_attribute_name=NULL)
{
    require_once "../db_queries/insert_queries.php";
    require_once "../db_queries/select_queries.php";

    foreach($attribute_connections as $attribute_name=>$parent_attribute_name)
    {
        if($parent_attribute_name == $current_parent_attribute_name && in_array($attribute_name, $attributes))
        {
            echo $attribute_name."=>".$parent_attribute_name."<br>";
            if($parent_attribute_name == NULL)
            {
                if($MODE == "user")
                {
                    array_push($no_error, add_User_attr_policy_conns_to_db($conn, $policy_name, $attribute_name, NULL));
                    $attribute = get_User_attr_policy_conns($conn, $policy_name, $attribute_name);
                    array_push($no_error, add_Assign_policy_classes_to_db($conn, $policy_name, $attribute["user_attribute_ID"], NULL));
                }
                else if($MODE == "object")
                {
                    array_push($no_error, add_Object_attr_policy_conns_to_db($conn, $policy_name, $attribute_name, NULL));
                    $attribute = get_Object_attr_policy_conns($conn, $policy_name, $attribute_name);
                    array_push($no_error, add_Assign_policy_classes_to_db($conn, $policy_name, NULL, $attribute["object_attribute_ID"]));
                }
                else
                {
                    array_push($no_error, false); 
                    return;
                }
                

            }
            else
            {
                if($MODE == "user")
                {
                    echo $policy_name.": ".$parent_attribute_name."<br>";
                    $parent_attribute = get_User_attr_policy_conns($conn, $policy_name, $parent_attribute_name);
                    array_push($no_error, add_User_attr_policy_conns_to_db($conn, $policy_name, $attribute_name, $parent_attribute["user_attribute_ID"]));
                
                }
                else if($MODE == "object")
                {
                    $parent_attribute = get_Object_attr_policy_conns($conn, $policy_name, $parent_attribute_name);
                    array_push($no_error, add_Object_attr_policy_conns_to_db($conn, $policy_name, $attribute_name, $parent_attribute["object_attribute_ID"]));
                
                }
                else
                {
                    array_push($no_error, false); 
                    return;  
                }      
                
            }

            add_attributes($conn, $policy_name, $no_error, $attributes, $attribute_connections, $MODE, $attribute_name);

            
        }
        
    }
}
    require_once "../db_conn/db_conn.php";
    require_once "../db_queries/insert_queries.php";
    require_once "../db_queries/select_queries.php";

    $no_error = [];
    $policy_name = "TEST_9000";
    array_push($no_error, add_policy_to_db($conn, $policy_name, "access"));
    $user_attributes = ['ua1', 'ua2', 'ua3', 'ua4', 'ua5', 'ua6'];
    $object_attributes = ["oa1", "oa2"];
    $attribute_conns = ["ua1" => NULL, 
                        "ua5" => "ua2",
                        "ua4" => "ua2",
                        "oa1" => NULL,
                        "oa2" => "oa1",
                        "ua3" => "ua1",
                        "ua6" => "ua1",
                        "ua2" => "ua1"];

    add_attributes($conn, $policy_name, $no_error, $user_attributes, $attribute_conns, "user");
    add_attributes($conn, $policy_name, $no_error, $object_attributes, $attribute_conns, "object");

    echo sizeof($no_error);
    $parent_attribute = get_User_attr_policy_conns($conn, $policy_name, "ua1");
    echo $parent_attribute["user_attribute_ID"];
?>

<?php

//creates connection to database
$path = $_SERVER['DOCUMENT_ROOT'];
$path .= "/AdminPage/db_conn/db_conn.php";
include_once($path);

require("../db_queries/select_queries_for_load_policy.php");

$policy_name = $_POST["policy_name"];

$policy_class = get_policy_class_name($conn, $policy_name);

//Display the name of the pressed policy name. 
echo "<h1 class='policy_name_text'>$policy_name</h1>";

//Get Information from database and display them as unsorted lists nestes in details tags. 
    
//Retrive all users. 
echo "<details><summary>User(s)</summary><ul>";
$result = get_users_associated_with_policy($conn, $policy_name);
while( $row = $result->fetch_assoc()){
    $user = $row["full_name"];
    $user_id = $row["user_id"];
    echo "<li>$user ($user_id)</li>"; 
}
echo "</ul></details>";

//Retrive all user attributes
echo "<details><summary>User attribute(s)</summary><ul>";
$result = get_user_attributes_associated_with_policy($conn, $policy_name);
while( $row = $result->fetch_assoc()){
    $user_attr_name = $row["user_attr_name"];
    echo "<li>$user_attr_name</li>"; 
}
echo "</ul></details>";

//retrive all objects
echo "<details><summary>Objects(s)</summary><ul>";
$result = get_objects_associated_with_policy($conn, $policy_name);
while( $row = $result->fetch_assoc()){
    $object = $row["full_name"];
    $object_id = $row["object_id"];
    echo "<li>$object ($object_id)</li>"; 
}
echo "</ul></details>";

//retrive all object attributes
echo "<details><summary>Object attribute(s)</summary><ul>";
$result = get_object_attributes_associated_with_policy($conn, $policy_name);
while( $row = $result->fetch_assoc()){
    $object_attr_name = $row["object_attr_name"];
    echo "<li>$object_attr_name</li>"; 
}
echo "</ul></details>";

//Retriva all user -> user_attr assignes.
echo "<details><summary>Assignes</summary><ul>";
$result = get_user_id_and_assigned_attr($conn,$_POST["policy_name"]);
while( $row = $result->fetch_assoc()){
    $user_id = $row["user_id"];
    $assigned_attribute_id = $row["assigned_attribute"];

    //Retrive the full_name of the user.
    $user = get_user_full_name($conn, $user_id);

    //Retrive the name of the attribute
    $attribute_name = get_user_attribute_name($conn, $assigned_attribute_id);

    echo "<li>assign('$user','$attribute_name')</li>"; 
}

//Retrive all user_attr -> user_attr assignes
$result = get_user_attr_and_parent_attr_id_associated_with_policy($conn, $_POST["policy_name"]);

while($row = $result->fetch_assoc()){
    $user_attr_name = $row["user_attr_name"];
    $parent_attr_id = $row["parent_attribute"];

    $parent_attribute_name = get_user_attribute_name($conn, $parent_attr_id);

    echo "<li>assign('".$user_attr_name."','".$parent_attribute_name."')</li>";
}

//retrive all object -> object_attr assignes
$result = get_object_id_assigned_attr($conn, $_POST["policy_name"]);

while($row = $result->fetch_assoc()){
    $object_id = $row["object_id"];
    $assigned_attribute_id = $row["assigned_attribute"];

    //Retrive the full_name of the object.
    $object = get_object_full_name($conn, $object_id);

    //Retrive the name of the object attribute
    $attribute_name = get_object_attribute_name($conn, $assigned_attribute_id);

    echo "<li>assign('".$object."','".$attribute_name."')</li>";
}

//retrive all object_attr -> object_attr assignes. 
$result = get_object_attr_and_parent_attr_id_associated_with_policy($conn, $_POST["policy_name"]);

while( $row = $result->fetch_assoc()){
    $object_attr_name = $row["object_attr_name"];
    $parent_attr_id = $row["parent_attribute"];

    $parent_attribute_name = get_object_attribute_name($conn, $parent_attr_id);

    echo "<li>assign('".$object_attr_name."','".$parent_attribute_name."')</li>";
} 

//assign object_attr/user_attr -> policy_class
$result = get_obj_attr_user_attr_from_assign_policy_class($conn, $_POST["policy_name"]);
        
while( $row = $result->fetch_assoc()){
    $object_attr_id = $row["object_attribute_ID"];
    $user_attr_id = $row["user_attribute_ID"];
    
    if($object_attr_id==""){
        $user_attr = get_user_attribute_name($conn, $user_attr_id);

        //Append policy classes assignments to the policy file
        echo "<li>assign('".$user_attr."','".$policy_class."')</l1>";

    }else{
        $object_attr = get_object_attribute_name($conn, $object_attr_id);
                
        //Append policy classes assignments to the policy file
        echo "<li>assign('".$object_attr."','".$policy_class."')</li>";
    }
}    
echo "</ul></details>";

    
echo "<details><summary>Associations</summary><ul>";
//Retrive all associations belonging to the policy 
$result = get_association_info($conn, $_POST["policy_name"]);
while( $row = $result->fetch_assoc()){
    $user_attr_id = $row["user_attribute"];
    $object_attr_id = $row["object_attribute"];
    $operation_id = $row["operation_id"];

    $user_attr = get_user_attribute_name($conn, $user_attr_id);

    $object_attr = get_object_attribute_name($conn, $object_attr_id);

    $operation = get_operation($conn, $operation_id);

    echo "<li>associate('".$user_attr."',[".$operation."],'".$object_attr."')</li>";
}
echo "</ul></details>";
    
?>
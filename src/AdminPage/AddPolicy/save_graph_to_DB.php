<?php
    require_once 'add_to_DB.php';

    $policy = $_POST['policy'];
    $user_attributes = $_POST['user_attributes'];
    $object_attributes = $_POST['object_attributes'];
    $user_attributes_conns = $_POST['user_attributes_conns'];
    $object_attributes_conns = $_POST['object_attributes_conns'];
    $attribute_conns = $_POST['attribute_conns'];
    $associations = $_POST['associations'];

    foreach($attribute_conns as $attribute_name=>$parent_attribute_name)
    {
        if($parent_attribute_name == "NULL")
        {
            $attribute_conns[$attribute_name] = NULL;
        }
    }
    

    $result = add_policy_data_to_DB($policy, $user_attributes, $object_attributes, $user_attributes_conns, $object_attributes_conns, $attribute_conns, $associations);

    if($result == true)
    {
        $_POST["SUCCESS"] = "Policy was successfully saved to the database";
    }
    else
    {
        $_POST["ERROR"] = "Somthing went wrong!";
    }
    require_once '../alert_message.php';

?>
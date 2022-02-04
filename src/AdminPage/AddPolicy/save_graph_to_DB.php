<?php
    require_once 'add_to_DB.php';

    $policy = $_POST['policy'];
    $user_attributes = $_POST['user_attributes'];
    $object_attributes = $_POST['object_attributes'];
    $user_attributes_conns = $_POST['user_attributes_conns'];
    $object_attributes_conns = $_POST['object_attributes_conns'];
    $attribute_conns = $_POST['attribute_conns'];
    $associations = $_POST['associations'];

    $result = add_policy_data_to_DB($policy, $user_attributes, $object_attributes, $user_attributes_conns, $object_attributes_conns, $attribute_conns, $associations);

    if($result == true)
    {
        echo "The graph was saved successfully \n";
    }
    else
    {
        echo "\n An error occurred when saving the graph \n";
    }

?>
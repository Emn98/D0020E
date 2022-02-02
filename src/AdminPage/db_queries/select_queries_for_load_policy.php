<?php

function get_policy_class_name($conn, $policy_name){
    $policy_class = "";

    $query = $conn->prepare("SELECT policy_class_name FROM Policies WHERE policy_name=?");
    $query->bind_param("s", $policy_name);
    $query->execute();
    $query->bind_result($policy_class);
    $query->fetch();
    $query->close();

    return $policy_class;

}

function get_users_associated_with_policy($conn, $policy_name){
    $query = $conn->prepare("SELECT full_name FROM Users WHERE user_id IN (SELECT user_id FROM User_policy_conns WHERE policy_name=?)");  
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_user_attributes_associated_with_policy($conn, $policy_name){
    $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE policy_name=?");  
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_objects_associated_with_policy($conn, $policy_name){
    $query = $conn->prepare("SELECT full_name FROM Objects WHERE object_id IN (SELECT object_id FROM Object_policy_conns WHERE policy_name=?)");  
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;

}

function get_object_attributes_associated_with_policy($conn, $policy_name){
    $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE policy_name=?");  
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;

}

function get_user_id_and_assigned_attr($conn, $policy_name){
    $query = $conn->prepare("SELECT user_id, assigned_attribute FROM User_policy_conns WHERE policy_name=?"); 
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;

}

function get_user_full_name($conn, $user_id){
    $user = "";

    $query = $conn->prepare("SELECT full_name FROM Users WHERE user_id=?"); 
    $query->bind_param("i", $user_id);
    $query->execute();
    $query->bind_result($user);
    $query->fetch();
    $query->close();

    return $user;
}

function get_user_attribute_name($conn, $attribute_id){
    $attribute_name = "";

    $query = $conn->prepare("SELECT user_attr_name FROM User_attr_policy_conns WHERE user_attribute_ID=?"); 
    $query->bind_param("i", $attribute_id);
    $query->execute();
    $query->bind_result($attribute_name);
    $query->fetch();
    $query->close();

    return $attribute_name;
}


function get_user_attr_and_parent_attr_id_associated_with_policy($conn, $policy_name){
    $query = $conn->prepare("SELECT user_attr_name, parent_attribute FROM User_attr_policy_conns WHERE policy_name=? AND parent_attribute IS NOT NULL"); 
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;

}

function get_object_id_assigned_attr($conn, $policy_name){
    $query = $conn->prepare("SELECT object_id, assigned_attribute FROM Object_policy_conns WHERE policy_name=?"); 
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;

}

function get_object_full_name($conn, $object_id){
    $object = "";

    $query = $conn->prepare("SELECT full_name FROM Objects WHERE object_id=?"); 
    $query->bind_param("i", $object_id);
    $query->execute();
    $query->bind_result($object);
    $query->fetch();
    $query->close();

    return $object;

}

function get_object_attribute_name($conn, $attribute_id){
    $attribute_name = "";

    $query = $conn->prepare("SELECT object_attr_name FROM Object_attr_policy_conns WHERE object_attribute_ID=?"); 
    $query->bind_param("i", $attribute_id);
    $query->execute();
    $query->bind_result($attribute_name);
    $query->fetch();
    $query->close();

    return $attribute_name;
}

function get_object_attr_and_parent_attr_id_associated_with_policy($conn, $policy_name){
    $query = $conn->prepare("SELECT object_attr_name, parent_attribute FROM Object_attr_policy_conns WHERE policy_name=? AND parent_attribute IS NOT NULL"); 
    $query->bind_param("s", $_POST["policy_name"]);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_obj_attr_user_attr_from_assign_policy_class($conn, $policy_name){
    $query = $conn->prepare("SELECT user_attribute_ID, object_attribute_ID FROM Assign_policy_classes WHERE policy_name=?"); 
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_association_info($conn, $policy_name){
    $query = $conn->prepare("SELECT user_attribute, operation_id, object_attribute  FROM Associations WHERE policy_name=?"); 
    $query->bind_param("s", $policy_name);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;

}


function get_operation($conn, $operation_id){
    $operation = "";

    $query = $conn->prepare("SELECT operation_name FROM Operations WHERE operation_id=?"); 
    $query->bind_param("i", $operation_id);
    $query->execute();
    $query->bind_result($operation);
    $query->fetch();
    $query->close(); 

    return $operation;

}


?>
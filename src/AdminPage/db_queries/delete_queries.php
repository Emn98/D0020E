<?php

function delete_policy_from_db($conn, $policy_name){
    
    $query = $conn->prepare("DELETE FROM Policies WHERE policy_name = ?");
    $query -> bind_param("s", $policy_name);
    $query->execute();
    $result = $query->affected_rows;
    $query ->close();

    return $result;
    
}

function delete_user_from_db($conn, $user_id){
    $query = $conn->prepare("DELETE FROM Users WHERE user_id = ?");
    $query -> bind_param("i", $user_id);
    $query->execute();
    $result = $query->affected_rows;
    $query ->close();

    return $result;
}

function delete_object_from_db($conn, $object_id){
    $query = $conn->prepare("DELETE FROM Objects WHERE object_id = ?");
    $query -> bind_param("i", $object_id);
    $query->execute();
    $result = $query->affected_rows;
    $query ->close();

    return $result;

}

function delete_operation_from_db($conn, $operation_id){
    $query = $conn->prepare("DELETE FROM Operations WHERE operation_id = ?");
    $query -> bind_param("i", $operation_id);
    $query->execute();
    $result = $query->affected_rows;
    $query ->close();

    return $result;

}

?>
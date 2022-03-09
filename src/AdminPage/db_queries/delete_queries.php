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
    $result = mysqli_stmt_affected_rows($query);
    $query ->close();

    return $result;
}

function delete_object_from_db($conn, $object_id){
    $query = $conn->prepare("DELETE FROM Objects WHERE object_id = ?");
    $query -> bind_param("i", $object_id);
    $query->execute();
    $result = mysqli_stmt_affected_rows($query);
    $query->close();

    return $result;

}


function delete_condition_from_db($conn, $condition_ID){
    $query = $conn->prepare("DELETE FROM conditions WHERE condition_ID = ?;");
    $query -> bind_param("i", $condition_ID);
    $query->execute();
    $result = $query->affected_rows;
    $query ->close();

    return $result;

}

?>
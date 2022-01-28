<?php

function delete_policy_from_db($conn, $policy_name){
    
    $query = $conn->prepare("DELETE FROM Policies WHERE policy_name = ?");
    $query -> bind_param("s", $policy_name);
    $query->execute();
    $result = $query->affected_rows;
    $query ->close();

    return $result;
    
}

?>
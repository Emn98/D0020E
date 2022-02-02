<?php 

function update_user_in_db($conn, $new_name, $user_id){

    $stmt = $conn->prepare("UPDATE Users SET full_name=? WHERE user_id = ?");
    $stmt->bind_param("si", $new_name, $user_id);
    $stmt->execute();
    $conn->close();
}

function update_object_in_db($conn, $new_name, $object_id){
    $stmt = $conn->prepare("UPDATE Objects SET full_name=? WHERE object_id = ?");
    $stmt->bind_param("si", $new_name, $object_id);
    $stmt->execute();
    $conn->close();
}

function update_operation_name_in_db($conn, $new_name, $operation_id){
    $stmt = $conn->prepare("UPDATE Operations SET operation_name=? WHERE operation_id = ?");
    $stmt->bind_param("si", $new_name, $operation_id);
    $stmt->execute();
    $conn->close();
}

function update_operation_name_and_2_field_in_db($conn, $new_name, $operation_id, $new_operation_field_2){
    $stmt = $conn->prepare("UPDATE Operations SET operation_name=?, operation_2_field=? WHERE operation_id = ?");
    $stmt->bind_param("ssi", $new_name, $new_operation_field_2, $operation_id);
    $stmt->execute();
    $conn->close();
}



?>

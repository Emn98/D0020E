<?php

function get_policies_by_name_all_table($conn, $search_word){
    $search_word_prepare = "%".$search_word."%";

    $query = $conn->prepare("SELECT policy_name, created_at FROM Policies WHERE policy_name LIKE ?");
    $query -> bind_param("s", $search_word_prepare);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_policies_by_name_loaded_table($conn, $search_word){
    $search_word_prepare = "%".$search_word."%";

    $query = $conn->prepare("SELECT policy_name, loaded_at FROM Loaded_policies WHERE policy_name LIKE ?");
    $query -> bind_param("s", $search_word_prepare);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_policies_by_user_all_table($conn, $search_word){
    $search_word_prepare = "%".$search_word."%";

    $query = $conn->prepare("SELECT policy_name, created_at FROM Policies WHERE policy_name IN (SELECT policy_name FROM User_policy_conns WHERE user_id IN (SELECT user_id FROM Users WHERE full_name LIKE ? OR user_id=?))");
    $query -> bind_param("si", $search_word_prepare, $search_word);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_policies_by_user_loaded_table($conn, $search_word){
    $search_word_prepare = "%".$search_word."%";

    $query = $conn->prepare("SELECT policy_name, loaded_at FROM Loaded_policies WHERE policy_name IN (SELECT policy_name FROM User_policy_conns WHERE user_id IN (SELECT user_id FROM Users WHERE full_name LIKE ? OR user_id=?))");
    $query -> bind_param("si", $search_word_prepare, $search_word);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}

function get_policies_by_object_all_table($conn, $search_word){
    $search_word_prepare = "%".$search_word."%";

    $query = $conn->prepare("SELECT policy_name, created_at FROM Policies WHERE policy_name IN (SELECT policy_name FROM Object_policy_conns WHERE object_id IN (SELECT object_id FROM Objects WHERE full_name LIKE ? OR object_id=?))");
    $query -> bind_param("si", $search_word_prepare, $search_word);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
    
}

function get_policies_by_object_loaded_table($conn, $search_word){
    $search_word_prepare = "%".$search_word."%";

    $query = $conn->prepare("SELECT policy_name, loaded_at FROM Loaded_policies WHERE policy_name IN (SELECT policy_name FROM Object_policy_conns WHERE object_id IN (SELECT object_id FROM Objects WHERE full_name LIKE ? OR object_id=?))");
    $query -> bind_param("si", $search_word_prepare, $search_word);
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();

    return $result;
}


?>
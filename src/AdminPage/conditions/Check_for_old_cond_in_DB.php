<?php

    require_once "../db_conn/db_conn.php";
    require_once "../db_queries/select_queries.php";
    require_once "../db_queries/select_queries_for_load_policy.php";

    $associations = $_POST["associations"];
    $association = get_Association_from_ID($conn ,$associations[0]);
    $policy_name = $association["policy_name"];

    $all_associations = get_association_info($conn, $policy_name);;


    while( $row = $all_associations->fetch_assoc())
    {
        if($row["cond_ID"] != NULL)
        {
            echo json_encode(array("result" => "DUP_ERROR", "cond_ID" => $row["cond_ID"]));
            exit();
        } 
    }

    echo json_encode(array("result" => "SUCCESS"));
?>
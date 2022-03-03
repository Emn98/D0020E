<?php

    require_once "../db_conn/db_conn.php";
    require_once "../db_queries/insert_queries.php";
    require_once "../db_queries/select_queries.php";
    require_once "../db_queries/upadate_queries.php";

    $cond_def = $_POST["cond_def"];
    $associations = $_POST["associations"];


    add_condition($conn, $cond_def);
    $result = get_Condition_ID($conn, $cond_def);
    $cond_ID = $result["condition_ID"];

    for($association_num = 0; $association_num < sizeof($associations); $association_num ++)
    {   
        if(!update_associaion_cond_ID($conn, $associations[$association_num], $cond_ID))
        {
            echo "ERROR";
        }
    }
    echo "SUCCESS";
?>
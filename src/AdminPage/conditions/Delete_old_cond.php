<?php

    require_once "../db_conn/db_conn.php";
    require_once "../db_queries/delete_queries.php";

    $cond_ID = $_POST["cond_ID"];
    delete_condition_from_db($conn, $cond_ID);
?>
<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("../db_queries/delete_queries.php");
   
  $policy_name = $_POST["policy_name"];

  $result = delete_policy_from_db($conn, $policy_name);

  //If a policy was successfully deleted then return 1. 
  if($result == "1"){
      echo "0";
  }else{
      echo "1";
  }

?>

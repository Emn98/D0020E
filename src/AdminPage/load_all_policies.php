<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("display_policies.php");

  $query = $conn->prepare("SELECT policy_name, created_at FROM Policies");
  $query->execute();
  $result = $query->get_result();
  $query->fetch();
  $query->close();

  display_in_all_policies_table($result);

?>
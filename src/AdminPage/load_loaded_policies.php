<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("display_policies.php");

  $query = $conn->prepare("SELECT policy_name, loaded_at FROM Loaded_policies");
  $query->execute();
  $result = $query->get_result();
  $query->fetch();
  $query->close();

  diplay_in_loaded_policies_table($result);

?>

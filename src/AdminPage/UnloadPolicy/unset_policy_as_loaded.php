<?php 
  /*This PHP script will delete a policy in the Loaded_policies table and thus
    be seen as unloaded by the system. */

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  $query = $conn->prepare("DELETE FROM Loaded_policies WHERE policy_name=?");  
  $query->bind_param("s", $_POST["policy_name"]);
  $query->execute();
  $query->close();

?>
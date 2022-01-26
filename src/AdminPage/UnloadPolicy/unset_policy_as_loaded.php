<?php 
  //This PHP script will add a policy to the Loaded_policies table and thus be seen as loaded

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  //Retrive the object(s) associated with the policy
  $query = $conn->prepare("DELETE FROM Loaded_policies WHERE policy_name=?");  
  $query->bind_param("s", $_POST["policy_name"]);
  $query->execute();
  $query->close();

?>
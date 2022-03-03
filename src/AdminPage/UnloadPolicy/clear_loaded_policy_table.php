<?php 
  //This php script will clear the loaded policy table in the database

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  //Clear the loaded policies table
  $query = $conn->prepare("DELETE FROM Loaded_policies");  
  $query->execute();
  $query->close();
?>
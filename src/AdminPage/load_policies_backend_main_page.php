<?php
   
  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  //These help functions display the policies in a correct way. 
  include("display_policies.php");

  $part = $_POST["part"];
  $table = $_POST["table"];

  if($part=="head" && $table == "loaded"){
    display_loaded_policies_head();
  }

  if($part=="body" && $table == "loaded"){
    $query = $conn->prepare("SELECT policy_name, loaded_at FROM Loaded_policies");
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  
    diplay_loaded_policies_body($result);
  }

  if($part=="head" && $table == "all"){
       display_all_policies_head();

  }

  if($part=="body" && $table == "all"){
    $query = $conn->prepare("SELECT policy_name, created_at FROM Policies");
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  
    display_all_policies_body($result);
  }
  
?>
<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("display_users_and_objects.php");

  if($_POST["table"] == "users" && $_POST["part"] == "head"){
    display_users_head();
  }

  if($_POST["table"] == "users" && $_POST["part"] == "body"){
    $query = $conn->prepare("SELECT * FROM Users");
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  
    display_users_body($result);
  }

  if($_POST["table"] == "objects" && $_POST["part"] == "head"){
    display_objects_head();
  }

  if($_POST["table"] == "objects" && $_POST["part"] == "body"){
    $query = $conn->prepare("SELECT * FROM Objects");
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  
    display_objects_body($result);
  }

?>
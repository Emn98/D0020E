<?php
  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("display_admin_man_info_overlay.php");

  if(isset($_POST["head"])){
    display_objects_head();
  }
 
  //Load in body on start or if body variable is set. 
  if(isset($_POST["body"])){
    $query = $conn->prepare("SELECT * FROM Objects");
    $query->execute();
    $result = $query->get_result();
    $query->fetch();
    $query->close();
  
    display_objects_body($result);

  }



?>
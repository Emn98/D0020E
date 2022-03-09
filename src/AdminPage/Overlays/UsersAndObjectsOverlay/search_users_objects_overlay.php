<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("../../db_queries/search_queries.php");
  include("display_users_and_objects.php");
 
  $current_table = $_POST["current_table"];
  $search_word = $_POST["search_word"];

  //Make a search and display based on which table the user is looking at. 
  if($current_table == "Users"){
      $result = get_user_info($conn, $search_word);
      display_users_body($result);
  }else{
      $result = get_object_info($conn, $search_word);
      display_objects_body($result);
  }

?>
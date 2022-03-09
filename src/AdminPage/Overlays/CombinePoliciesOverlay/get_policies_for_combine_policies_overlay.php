<?php
  //This php script will get the file to the database and display then. 


  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  //These help functions display the policies in a correct way. 
  include("display_policies_for_combine_policies_overlay.php");
  include("../../db_queries/select_queries_for_load_policy.php");

  $table = $_POST["table"];

  if($table == "cond_policy"){
    $result = get_policies_with_conditions($conn);
    display_all_policies_with_cond($result);

      
  }
  
  if($table == "non_cond_policy"){
      $result = get_policies_without_conditions($conn);
      display_all_policies_without_cond($result);

  }

?>
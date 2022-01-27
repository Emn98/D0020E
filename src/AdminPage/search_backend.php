<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("db_queries/search_queries.php");
  include("display_policies.php");

  $table = $_POST["table"];
  $search_by = $_POST["search_by"];
  $search_word = $_POST["search_word"];

  
  if($search_by == "Policy_name"){//If the user searches after policies by policy file names  
    if($table == "all_policies"){
        $result = get_policies_by_name_all_table($conn, $search_word);
        display_in_all_policies_table($result);        
    }else{
        $result = get_policies_by_name_loaded_table($conn, $search_word);
        diplay_in_loaded_policies_table($result);
    }
  }else if($search_by == "Users"){//If the user searches after policies by user
    if($table == "all_policies"){
        $result = get_policies_by_user_all_table($conn, $search_word);
        display_in_all_policies_table($result);        
    }else{
        $result = get_policies_by_user_loaded_table($conn, $search_word);
        diplay_in_loaded_policies_table($result);
    }
  }else{//If the user searches after policies by object
    if($table == "all_policies"){
        $result = get_policies_by_object_all_table($conn, $search_word);
        display_in_all_policies_table($result);        
    }else{
        $result = get_policies_by_object_loaded_table($conn, $search_word);
        diplay_in_loaded_policies_table($result);
    }      
  }
    
?>
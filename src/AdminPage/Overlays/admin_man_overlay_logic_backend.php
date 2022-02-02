<?php

  //creates connection to database
  $path = $_SERVER['DOCUMENT_ROOT'];
  $path .= "/AdminPage/db_conn/db_conn.php";
  include_once($path);

  include("../db_queries/insert_queries.php");
  include("../db_queries/upadate_queries.php");
  include("../db_queries/delete_queries.php");


  $func = $_POST["func"];

  if(isset($func) && $func=="Create user"){
      $full_name = $_POST["full_name"];

      $result = add_user_to_db($conn, $full_name);

      echo $result;
  }

  if(isset($func) && $func=="Create object"){
    $full_name = $_POST["full_name"];

    $result = add_object_to_db($conn, $full_name);

    echo $result;
  }

  if(isset($func) && $func=="Create operation"){
    $operation_name = $_POST["operation_name"];
    $operation_2_field = $_POST["operation_2_field"];

    $result = add_Operations_to_db($conn, $operation_name, $operation_2_field );

    echo $result;
  }

  if(isset($func) && $func=="Edit user"){
    $full_name = $_POST["full_name"];
    $user_id = $_POST["user_id"];

    $result = update_user_in_db($conn, $full_name, $user_id);


  }

  if(isset($func) && $func=="Edit object"){
    $full_name = $_POST["full_name"];
    $object_id = $_POST["object_id"];

    $result = update_object_in_db($conn, $full_name, $object_id);


  }

  if(isset($func) && $func=="Edit operation"){
    $operation_name = $_POST["operation_name"];
    $operation_id = $_POST["operation_id"];
    $operation_2_field = $_POST["operation_2_field"];

    if($operation_2_field == ""){
      $result = update_operation_name_in_db($conn, $operation_name, $operation_id);

    }else{
      $result = update_operation_name_and_2_field_in_db($conn, $operation_name, $operation_id, $operation_2_field);

    }
  }

  if(isset($func) && $func=="Delete user"){
    $user_id = $_POST["user_id"];

    $result = delete_user_from_db($conn, $user_id);
  }

  if(isset($func) && $func=="Delete object"){
    $object_id = $_POST["object_id"];

    $result = delete_object_from_db($conn, $object_id);
  }

  if(isset($func) && $func=="Delete operation"){
    $operation_id = $_POST["operation_id"];

    $result = delete_operation_from_db($conn, $operation_id);
  }



  

?>